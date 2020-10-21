<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index()
    {
        //return Category::create(['name'=>'کامئیوتر','parent_id'=>1]);
        //return DB::table('category_course')->insert(['course_id'=>4,'category_id'=>2,'created_at'=>now(),'updated_at'=>now()]);
        return view('main');
    }
    public function search(Request $request)
    {
        $searchTerm = $request->search;
        $courses = Course::whereRaw('match(title,content) against (? in Boolean mode)',$searchTerm)->get();
        return view('inc.search')
            ->with('courses',empty($courses) ? '' : $courses)
            ->with('searchTerm',$searchTerm);
    }
}
