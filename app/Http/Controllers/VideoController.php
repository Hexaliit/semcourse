<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideo;
use App\Http\Requests\UpdateVideo;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index(Course $course)
    {
        if (Auth::user()->id == $course->user_id or Auth::user()->level ==='مدیر')
        {
            $videos = $course->videos;
            return view('video.index')
                ->with('course',$course)
                ->with('videos',$videos);
        } else {
            return redirect('/admin/course')->with('warning','دسترسی مجاز نیست');
        }
    }
    public function create(Course $course)
    {
        if (Auth::user()->id == $course->user_id or Auth::user()->level ==='مدیر')
        {
            return view('video.create')->with('course',$course);
        } else {
            return redirect('/admin/course')->with('warning','دسترسی مجاز نیست');
        }

    }
    public function save(StoreVideo $request,Video $video)
    {
        if (isset($request->show_on_demo))
        {
            $video->show_on_demo = $request->show_on_demo;
        }
        $video->course_id = $request->course_id;
        $video->title = $request->title;
        //make folder for course title
        $course = Course::where('id',$request->course_id)->first();
        if ($request->hasFile('video')) {
            $videoPath = Storage::disk('uploads')->put('/courses/' . $course->title, $request->file('video'));
            $video->video = 'http://localhost:8000/' . $videoPath;
        }
        $video->save();
        return redirect('/admin/course')
            ->with('success','ویدیو با موفقیت ذخیره شد');
    }
    public function edit(Course $course,Video $video)
    {
        if (Auth::user()->id == $course->user_id or Auth::user()->level ==='مدیر')
        {
            return view('video.edit')
                ->with('course',$course)
                ->with('video',$video);
        } else {
            return redirect('/admin/course')->with('warning','دسترسی مجاز نیست');
        }

    }
    public function update(UpdateVideo $request,Video $video)
    {
        if (isset($request->show_on_demo))
        {
            $video->show_on_demo = $request->show_on_demo;
        }
        $video->title = $request->title;
        $video->course_id = $request->course_id;
        //make folder for course title
        $course = Course::where('id',$request->course_id)->first();
        $oldValue = str_replace('/','\\',ltrim($request->oldVideo,'http://localhost:8000/'));
        if ($request->hasFile('video')) {
            unlink(dirname(storage_path()).'\\public\\'.$oldValue);
            $videoPath = Storage::disk('uploads')->put('/video/' . $course->title, $request->file('video'));
            $video->video = 'http://localhost:8000/' . $videoPath;
        } else {
            $video->video = $request->oldVideo;
        }
        $video->save();
        return redirect('/admin/course')
            ->with('success','ویدیو با موفقیت ویرایش شد');

    }
    public function display(Video $video)
    {
        return view('video.display')
            ->with('video',$video);
    }
    public function destroy(Video $video)
    {
        $course = Course::where('id',$video->course_id)->first();
        if (Auth::user()->id == $course->user_id or Auth::user()->level ==='مدیر')
        {
            $oldValue = str_replace('/','\\',ltrim($video->video,'http://localhost:8000/courses'));
            unlink(dirname(storage_path()).'\\public\\courses\\'.$oldValue);
            $video->delete();
            return redirect('/admin/course')
                ->with('success','ویدیو با موفقیت حذف شد');
        } else {
            return redirect('/admin/course')->with('warning','دسترسی مجاز نیست');
        }

    }
}
