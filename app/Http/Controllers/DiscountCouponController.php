<?php

namespace App\Http\Controllers;

use App\Models\Discount_Coupon;
use Illuminate\Http\Request;

class DiscountCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $copuons = Discount_Coupon::latest();

        if (!empty($request->get('keyword'))) {
            $copuons = $copuons->where('name', 'like', '%' . $request->get('keyword') . '%');
        }
        $copuons = $copuons->paginate(10);
        return view('admin.coupon.all_coupon', compact('copuons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.add_coupon');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $coupon = new Discount_Coupon();
        $coupon->code = $request->code;
        $coupon->name = $request->name;
        $coupon->max_uses = $request->max_uses;
        $coupon->max_uses_user = $request->max_uses_user;
        $coupon->type = $request->type;
        $coupon->discount_amount = $request->discount_amount;
        $coupon->min_amount = $request->min_amount;
        $coupon->status = $request->status;
        $coupon->starts_at = $request->starts_at;
        $coupon->expiers_at = $request->expiers_at;
        $coupon->description = $request->description;

        $coupon->save();

        $notifications = [
            'message' => 'Coupon created successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('coupon.index')->with($notifications);
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount_Coupon $discount_Coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $coupon = Discount_Coupon::findOrFail($id);
        return view('admin.coupon.edit_coupon', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $coupon = Discount_Coupon::findOrFail($id);
        $coupon->code = $request->code;
        $coupon->name = $request->name;
        $coupon->max_uses = $request->max_uses;
        $coupon->max_uses_user = $request->max_uses_user;
        $coupon->type = $request->type;
        $coupon->discount_amount = $request->discount_amount;
        $coupon->min_amount = $request->min_amount;
        $coupon->status = $request->status;
        $coupon->starts_at = $request->starts_at;
        $coupon->expiers_at = $request->expiers_at;
        $coupon->description = $request->description;
        $coupon->save();
        $notifications = [
            'message' => 'Coupon updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('coupon.index')->with($notifications);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $coupon = Discount_Coupon::findOrFail($id);
        $coupon->delete();
        $notifications = [
            'message' => 'Coupon deleted successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('coupon.index')->with($notifications);
    }
}
