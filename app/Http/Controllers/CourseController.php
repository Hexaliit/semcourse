<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourse;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('created_at', 'desc')->get();
        return view('course.index')
            ->with('courses', $courses);
    }

    public function display(Course $course)
    {
        $videos = $course->videos;
        return view('course.display')
            ->with('course', $course)
            ->with('videos', $videos);
    }
    public function search(Request $request)
    {
        $searchTerm = $request->search;
        $courses = Course::whereRaw('match(title,content) against (? in Boolean mode)',$searchTerm)->get();
        return view('course.search')
            ->with('courses',empty($courses) ? '' : $courses)
            ->with('searchTerm',$searchTerm);
    }
    public function create()
    {
        $categories = Category::with('parent')->whereNotNull('parent_id')->get();
        $main = Category::with('parent')->whereNull('parent_id')->get();
        return view('course.create')
            ->with('main', $main)
            ->with('categories', $categories);
    }

    public function save(StoreCourse $request, Course $course)
    {
        $course->user_id = $request->user_id;
        $course->title = $request->title;
        $course->content = $request->input('content');
        $course->price = $request->price;

        if ($request->hasFile('avatar')) {
            $avatarPath = Storage::disk('uploads')->put('/courses/' . $request->title, $request->file('avatar'));
            $course->avatar = 'http://localhost:8000/' . $avatarPath;
        } else {
            $course->avatar = 'http://localhost:8000/image/main.jpg';
        }

        if ($request->hasFile('source')) {
            $sourcePath = Storage::disk('uploads')->put('/courses/' . $request->title, $request->file('source'));
            $course->source = 'http://localhost:8000/' . $sourcePath;
        } else {
            $course->source = null;
        }

        $course->save();
        $course->categories()->attach($request->input('category'));
        return redirect('/admin/course')
            ->with('success', 'دوره با موفقیت ذخیره شد');

    }

    public function edit(Course $course)
    {
        if (Auth::user()->id == $course->user_id or Auth::user()->level === 'مدیر') {
            $categories = Category::with('parent')->whereNotNull('parent_id')->get();
            $main = Category::with('parent')->whereNull('parent_id')->get();
            $cats = $course->categories;
            return view('course.edit')
                ->with('main', $main)
                ->with('categories', $categories)
                ->with('course', $course)
                ->with('cats', $cats);
        } else {
            return redirect('/admin/course')->with('warning', 'دسترسی مجاز نیست');
        }

    }
    public function update(StoreCourse $request, Course $course)
    {
        $basePath = dirname(storage_path()) . '\\public\\courses\\';
        $course->user_id = $request->user_id;
        $course->title = $request->title;
        rename($basePath.$request->oldTitle,$basePath.$request->title);
        $course->content = $request->input('content');
        $course->price = $request->price;
        $course->categories()->sync($request->input('category'));

        if ($request->hasFile('avatar')) {
            $avatarName = '\\'.explode('/',$request->oldAvatar)[5];
            unlink(dirname(storage_path()) . '\\public\\courses\\' .$request->title.$avatarName);
            $avatarPath = Storage::disk('uploads')->put('/courses/' . $request->title, $request->file('avatar'));
            $course->avatar = 'http://localhost:8000/' . $avatarPath;
        } else {
            $course->avatar = str_replace($request->oldTitle,$request->title,$request->oldAvatar);
        }
        if ($request->hasFile('source')) {
            $sourceName = '\\'.explode('/',$request->oldSource)[5];
            unlink(dirname(storage_path()) . '\\public\\courses\\' .$request->title.$sourceName);
            $sourcePath = Storage::disk('uploads')->put('/courses/' . $request->title, $request->file('source'));
            $course->source = 'http://localhost:8000/' . $sourcePath;
        } else {
            $course->source = str_replace($request->oldTitle,$request->title,$request->oldSource);
        }
        $course->save();
        return redirect('/admin/course')->with('success', 'دوره با موفقیت ویرایش شد');
    }


    public function destroy(Course $course)
    {
        if (Auth::user()->id == $course->user_id or Auth::user()->level === 'مدیر') {
            //if course is sold return money to who has bought this course
            $users = $course->users;
            if (count($users) > 0)
            {
                foreach ($users as $user)
                {
                    $editUser = User::find($user->id);
                    $editUser->balance = $editUser->balance + $course->price;
                    $editUser->save();
                }
            }
            //delete all videos of the course
            $courseVideos = $course->videos;
            if (count($courseVideos) > 0) {
                foreach ($courseVideos as $video) {
                    $video->delete();
                }
            }
            //detach courses from category_course table
            $course->categories()->detach();
            //delete directory of the course
            File::deleteDirectory(dirname(storage_path()) . '\\public\\courses\\' . $course->title);
            $course->delete();
            return redirect('/admin/course')->with('success', 'دوره با موفقیت حذف شد');
        } else {
            return redirect('/admin/course')->with('warning', 'دسترسی مجاز نیست');
        }
    }


    public function showCourse($slug1, $slug2 = null)
    {
        if ($slug2 == null) {
            $slug1 = $this->strToSlug($slug1);
            $course = Course::where('title', $slug1)->firstOrFail();
            $categories = $course->categories;
            $name = $course->user->name;
            $videos = $course->videos;
            $sorted = $videos->sort();
            $videos = $sorted->values()->all();
            return view('course.show')
                ->with('videos', $videos)
                ->with('name', $name)
                ->with('categories', $categories)
                ->with('course', $course);
        } else {
            return $this->showVideo($slug1,$slug2);
        }
    }
    public function strToSlug($slug)
    {
        $slug = str_replace('-', ' ', $slug);
        return $slug;
    }
    public function showVideo($slug1,$slug2)
    {
        $slug1 = $this->strToSlug($slug1);
        $slug2 = $this->strToSlug($slug2);
        $course = Course::where('title', $slug1)->firstOrFail();
        $courseId = $course->id;
        $video = Video::where('title', $slug2)->where('course_id', $courseId)->firstOrFail();
        if ($video->show_on_demo == 1){
            $videos = $course->videos;
            return view('video.show')
                ->with('videos', $videos)
                ->with('course', $course)
                ->with('video', $video);
        } else {
            //checking if the user has th course
            if (Auth::user())
            {
                $videos = $course->videos;
                $id = $video->course->id;
                $courses = Auth::user()->courses;
                foreach ($courses as $course)
                {
                    if ($course->id == $id)
                    {
                        return view('video.show')
                            ->with('videos', $videos)
                            ->with('course', $course)
                            ->with('video', $video);
                    }
                }
                return redirect()->back()->with('warning','شما این دوره را خریداری نکرده اید');
            }
            return redirect('/login')->with('login','برای دسترسی به این بخش باید وارد سایت شوید');
        }
    }
    public function buy($user_id,$course_id)
    {
        $user = User::find($user_id);
        $course = Course::find($course_id);
        if ($user->balance < $course->price)
        {
            return redirect()->back()->with('warning','موجودی شما کافی نیست');
        } else {
            //if user already has the course
            $bought = DB::table('course_user')->where('course_id',$course_id)->where('user_id',$user_id)->get();
            if (count($bought) > 0)
            {
                return redirect()->back()->with('warning','شما قبلا این دوره را خریده اید');
            } else {
                //mines value price of course from user's balance
                $user->balance = $user->balance - $course->price;
                $user->save();
                //attaching to course_user table
                $user->courses()->attach($course->id);
                return redirect('/')->with('success','دوره با موفقیت خریداری شد');
            }
        }

    }

}
