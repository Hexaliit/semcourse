<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class LearnController extends Controller
{
    public function show($slug1=null,$slug2=null)
    {
        if ($slug1 == null && $slug2 == null) {
            $mainCategories = Category::whereNull('parent_id')->get();
            return \view('category.show-main')->with('mainCategories', $mainCategories);
        } elseif ($slug2 == null) {
            $orgCategory = Category::where('name', $slug1)->first();
            $subCategories = $orgCategory->children;
            return \view('category.show-sub')->with('subCategories', $subCategories)->with('orgCategory', $orgCategory);

        } else {
            $category = Category::where('name', $slug2)->firstOrFail();
            $par = Category::where('name', $slug1)->first();
            if ($par && $category->parent_id === $par->id) {
                $courses = $category->courses;
                return \view('category.show-courses')
                    ->with('courses', $courses)
                    ->with('category', $category)
                    ->with('parent', $par);
            } else {
                return abort(404);
            }
        }
    }
}
