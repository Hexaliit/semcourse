<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
}
