<?php

namespace App\Http\Controllers;

use App\Models\brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $brands = brand::latest();

        if (!empty($request->get('keyword'))) {
            $brands = $brands->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $brands = $brands->paginate(10);

        return view('admin.brand.all_brand',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.add_brand');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $brand =  new brand();
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->status = $request->status;
        $brand->save();

        $notifications = [
            'message' => 'Brand Added Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('brand.index')->with($notifications);

    }

    /**
     * Display the specified resource.
     */
    public function show(brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brand = brand::findOrFail($id);
        return view('admin.brand.edit_brand',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $brand = brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->status = $request->status;
        $brand->save();
        $notifications = [
            'message' => 'Brand Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('brand.index')->with($notifications);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brand = brand::findOrFail($id)->delete();
        $notifications = [
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('brand.index')->with($notifications);
        }
}
