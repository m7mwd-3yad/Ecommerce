<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\sub_category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = sub_category::select('sub_categories.*', 'categories.name as CategorieName')
            ->latest()
            ->leftJoin('categories', 'categories.id', '=', 'sub_categories.category_id');

        if ($request->filled('keyword')) {
            $query->where('sub_categories.name', 'like', '%' . $request->get('keyword') . '%');
        }

        $sub_categories = $query->paginate(10);

        return view('admin.sub_category.all_sub_category', compact('sub_categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name', "ASC")->get();
        $data['categories'] = $categories;
        return view("admin.sub_category.add_sub_category", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $sub_category = new sub_category();
        $sub_category->name = $request->name;
        $sub_category->slug = $request->slug;
        $sub_category->category_id = $request->category;
        $sub_category->status = $request->status;


        $sub_category->save();

        $notifications = [
            'message' => 'Sub Category Added Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('sub-category.index')->with($notifications);

    }

    /**
     * Display the specified resource.
     */
    public function show(sub_category $sub_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subCategory = sub_category::select('sub_categories.*', 'categories.name as CategorieName')
            ->leftJoin('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->where('sub_categories.id', $id)
            ->firstOrFail();

        $categories = Category::orderBy('name', 'ASC')->get();

        $data = [
            'subCategory' => $subCategory,
            'categories' => $categories,
        ];

        return view('admin.sub_category.edit_sub_category', $data);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $sub_category = sub_category::findOrFail($id)->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'category_id' => $request->category,
            'status' => $request->status,
        ]);

        $notifications = [
            'message' => 'Sub Category Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('sub-category.index')->with($notifications);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sub_category = sub_category::findOrFail($id)->delete();
        $notifications = [
            'message' => 'Sub Category Deleted Successfully',
            'alert-type' =>'success'
        ];
        return redirect()->route('sub-category.index')->with($notifications);
    }
}
