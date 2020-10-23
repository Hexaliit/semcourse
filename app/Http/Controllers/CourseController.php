<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show($slug1, $slug2 = null)
    {
        if ($slug2 == null) {
            $slug1 = str_replace('-', ' ', $slug1);
            $course = Course::where('title', $slug1)->firstOrFail();
            $videos = $course->videos;
            return view('course.show')
                ->with('videos', $videos)
                ->with('course', $course);
        } else {
            $slug1 = str_replace('-', ' ', $slug1);
            $slug2 = str_replace('-', ' ', $slug2);
            $video = Video::where('title', $slug2)->firstOrFail();
            $course = Course::where('title', $slug1)->firstOrFail();
            $videos = $course->videos;
            if ($video->course_id == $course->id) {
                return view('video.show')
                    ->with('videos', $videos)
                    ->with('course', $course)
                    ->with('video', $video);
            } else {
                return abort(404);
            }

        }
    }

}
