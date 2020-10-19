<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index()
    {
        //return Category::create(['name'=>'دانش خانواده','parent_id'=>3]);
        return view('main');
    }
    public function show($slug1=null,$slug2=null)
    {
        if ($slug1 ==null && $slug2==null)
        {
            $mainCategories = Category::whereNull('parent_id')->get();
            return \view('category.show-main')->with('mainCategories',$mainCategories);
        }
        elseif ($slug2==null)
        {
            $orgCategory = Category::where('name',$slug1)->first();
            $subCategories = $orgCategory->children;
            return \view('category.show-sub')->with('subCategories',$subCategories)->with('orgCategory',$orgCategory);

        }

    }
}
