<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\Category;
use App\Models\product;
use App\Models\sub_category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = product::latest('id')->paginate(10);

        if (!empty($request->get('keyword'))) {
            $products = $products->where('name', 'like', '%' . $request->get('keyword') . '%');
        }
        $data['products'] = $products;
        return view('admin.product.all_product', $data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $category = Category::orderBy('name', 'ASC')->get();
        $sub_category = sub_category::orderBy('name', 'ASC')->get();
        $brand = brand::orderBy('name', 'ASC')->get();
        $data['category'] = $category;
        $data['brand'] = $brand;
        $data['sub_category'] = $sub_category;
        return view('admin.product.add_product', $data);
    }

    public function getSubCategories($categoryId)
    {
        $subCategories = sub_category::where('category_id', $categoryId)->get();
        return response()->json($subCategories);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

        ]);
        $product = new product();
        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->compare_price = $request->compare_price;
        $product->sku = $request->sku;
        $product->barcode = $request->barcode;
        $product->track_qty = $request->track_qty;
        $product->qty = $request->qty;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->brand_id = $request->brand_id;
        $product->is_featured = $request->is_featured;

        $product->save();

        $notificatiosn = [
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('product.index')->with($notificatiosn);
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // جلب المنتج
        $product = Product::findOrFail($id);

        // جلب جميع العلامات التجارية والفئات لتعبئة القوائم المنسدلة
        $brands = Brand::all();
        $categories = Category::all();
        $subCategories = sub_category::where('category_id', $product->category_id)->get();

        // تمرير البيانات إلى العرض
        return view('admin.product.edit_product', compact('product', 'brands', 'categories', 'subCategories'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:255',
            'barcode' => 'nullable|string|max:255',
            'track_qty' => 'nullable|boolean',
            'qty' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'is_featured' => 'nullable|boolean',
        ]);

        // جلب المنتج المطلوب تعديله
        $product = Product::findOrFail($id);

        // تحديث بيانات المنتج
        $product->update([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'compare_price' => $request->input('compare_price'),
            'sku' => $request->input('sku'),
            'barcode' => $request->input('barcode'),
            'track_qty' => $request->input('track_qty', false), // الافتراضي غير مفعّل
            'qty' => $request->input('qty'),
            'status' => $request->input('status'),
            'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
        ]);
        $notifications = [
            'title' => 'تم تعديل المنتج بنجاح',
            'message' => 'تم تعديل المنتج بنجاح',
            'alert-type' => 'success'
        ];
        return redirect()->route('product.index')->with($notifications);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id)->delete();
        $notificatiosn = [
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('product.index')->with($notificatiosn);
    }
}
