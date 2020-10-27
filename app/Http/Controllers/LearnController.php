<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class LearnController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->whereNull('parent_id')->get();

        $subCategories = Category::with('parent')->whereNotNull('parent_id')->get();

        return view('category.index')
            ->with('cats',$categories)
            ->with('subs',$subCategories);
    }
    public function create()
    {
        $categories = Category::with('parent')->whereNull('parent_id')->get();
        return view('category.create')
            ->with('cats',$categories);
    }
    public function save(StoreCategory $request)
    {
        if ($request->parent_id == 0)
        {
            $parent_id = null;
        } else {
            $parent_id = $request->parent_id;
        }
        Category::create([
            'name' => $request->name,
            'parent_id' => $parent_id,
        ]);
        return redirect('/admin/category')->with('success','دسته بندی با موفقیت ذخیره شد');
    }
    public function edit($id)
    {
        $cat = Category::find($id);
        //$parent = $cat->parent;
        $cats = Category::with('parent')->whereNull('parent_id')->get();
        return view('category.edit')
            ->with('cats',$cats)
            ->with('cat',$cat);
    }
    public function update(StoreCategory $request,$id)
    {
        $cat = Category::find($id);
        $cat->name = $request->name;
        if ($request->parent_id == 0)
        {
            $parent_id = null;
        } else {
            $parent_id = $request->parent_id;
        }
        $cat->parent_id = $parent_id;
        $cat->save();
        return redirect('/admin/category')->with('success','دسته بندی با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        $cat = Category::find($id);
        $children = $cat->children;
        if (count($children) > 0)
        {
            foreach ($children as $childs)
            {
                $childs->delete();
            }
        }
        $cat->delete();
        return redirect('/admin/category')->with('success','دسته بندی با موفقیت حذف شد');
    }

















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
