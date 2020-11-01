<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourse;
use App\Models\Category;
use App\Models\Course;
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
            $course->avatar = null;
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
        $categories = Category::with('parent')->whereNotNull('parent_id')->get();
        $main = Category::with('parent')->whereNull('parent_id')->get();
        $cats = $course->categories;
        if (Auth::user()->id == $course->user_id or Auth::user()->level === 'مدیر') {
            return view('course.edit')
                ->with('main', $main)
                ->with('categories', $categories)
                ->with('course', $course)
                ->with('cats', $cats);
        } else {
            return redirect('/admin/course')->with('warning', 'دسترسی مجاز نیست');
        }

    }

    public function getFile($file)
    {
        $file = ltrim($file, "p://localhost:8000/");
        $file = str_replace('/', '\\', $file);
        return $file;
    }

    public function update(StoreCourse $request, Course $course)
    {
        $course->user_id = $request->user_id;
        $course->title = $request->title;
        $course->content = $request->input('content');
        $course->price = $request->price;
        $course->categories()->sync($request->input('category'));

        if ($request->hasFile('avatar')) {
            unlink(dirname(storage_path()) . '\\public\\courses\\' . str_replace('/', '\\', trim($request->oldAvatar, 'http://localhost:8000/courses/')));
            $avatarPath = Storage::disk('uploads')->put('/courses/' . $request->title, $request->file('avatar'));
            $course->avatar = 'http://localhost:8000/' . $avatarPath;
        } else {
            $course->avatar = $request->oldAvatar;
        }
        if ($request->hasFile('source')) {
            unlink(dirname(storage_path()) . '\\public\\courses\\' . str_replace('/', '\\', trim($request->oldSource, 'http://localhost:8000/courses/')));
            $sourcePath = Storage::disk('uploads')->put('/courses/' . $request->title, $request->file('source'));
            $course->source = 'http://localhost:8000/' . $sourcePath;
        } else {
            $course->source = $request->oldSource;
        }
        $course->save();
        return redirect('/admin/course')->with('success', 'دوره با موفقیت ویرایش شد');
    }


    public function destroy(Course $course)
    {
        if (Auth::user()->id == $course->user_id or Auth::user()->level === 'مدیر') {
            $courseVideos = $course->videos;
            if (count($courseVideos) > 0) {
                foreach ($courseVideos as $video) {
                    $video->delete();
                }
            }
            $cat = DB::table('category_course')->where('course_id', $course->id)->delete();
            File::deleteDirectory(dirname(storage_path()) . '\\public\\courses\\' . $course->title);
            $course->delete();
            return redirect('/admin/course')->with('success', 'دوره با موفقیت حذف شد');
        } else {
            return redirect('/admin/course')->with('warning', 'دسترسی مجاز نیست');
        }
    }


    public function show($slug1, $slug2 = null)
    {
        if ($slug2 == null) {
            $slug1 = str_replace('-', ' ', $slug1);
            $course = Course::where('title', $slug1)->firstOrFail();
            $categories = $course->categories;
            $name = $course->user->name;
            $videos = $course->videos;
            return view('course.show')
                ->with('videos', $videos)
                ->with('name', $name)
                ->with('categories', $categories)
                ->with('course', $course);
        } else {
            $slug1 = str_replace('-', ' ', $slug1);
            $slug2 = str_replace('-', ' ', $slug2);
            //
            //return $video;
            $course = Course::where('title', $slug1)->firstOrFail();
            $courseId = $course->id;
            $video = Video::where('title', $slug2)->where('course_id', $courseId)->firstOrFail();
            $videos = $course->videos;
            return view('video.show')
                ->with('videos', $videos)
                ->with('course', $course)
                ->with('video', $video);


        }
    }

}
