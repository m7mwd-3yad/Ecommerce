<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::latest();

        if (!empty($request->get('keyword'))) {
            $categories = $categories->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $categories = $categories->paginate(10);
        return view('admin.category.all_category', compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.add_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug'
        ]);


        $category = new Category;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $image_data = $request->image;


        $image_extentions = $image_data->getClientOriginalExtension();
        $image_name = $image_data->getClientOriginalName();
        $locations = public_path() . '/upload' . '/' . $category->name;
        $image_data->move($locations, $image_name);
        $category->image = $image_name;

        $category->save();

        $notifications = [
            'message' => 'Category created successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('category.index')->with($notifications);

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit_category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $old_category_name = $category->name;

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $image_data = $request->file("image");

        if ($image_data == null) {
            $image_name = $category->image;
        } else {
            $image_name = $category->image;
            $image_path = public_path() . '/upload' . '/' . $old_category_name . '/' . $category->image;

            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $image_extination = $image_data->getClientOriginalExtension();
            $image_name = $image_data->getClientOriginalName();
            $locations = public_path() . '/upload' . '/' . $category->name;

            if (!is_dir($locations)) {
                mkdir($locations, 0777, true);
            }

            $image_data->move($locations, $image_name);
        }

        if ($old_category_name !== $category->name) {
            $old_folder_path = public_path() . '/upload/' . $old_category_name;
            $new_folder_path = public_path() . '/upload/' . $category->name;

            if (is_dir($old_folder_path)) {
                rename($old_folder_path, $new_folder_path);
            }
        }

        $category->image = $image_name;
        $category->save();

        $notifications = [
            'message' => 'Category updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('category.index')->with($notifications);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $image_name = $category->image;
        $file_path = public_path("upload/$category->name/$image_name");

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $folder_path = public_path("upload/$category->name");
        if (is_dir($folder_path) && count(scandir($folder_path)) == 2) {
            rmdir($folder_path);
        }

        $category->delete();

        $notifications = [
            'message' => 'Category and associated files deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('category.index')->with($notifications);
    }

}
