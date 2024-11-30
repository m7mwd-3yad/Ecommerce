<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use App\Models\shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shippings = Shipping::leftJoin('countries', 'countries.id', '=', 'shippings.country_id')
            ->select('shippings.*', 'countries.name as country_name')
            ->get();


        return view('admin.shipping.all_shipping', compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Countries::get();
        return view('admin.shipping.add_shipping', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $shipping = new shipping();
        $shipping->country_id = $request->country;
        $shipping->amount = $request->amount;
        $shipping->save();

        $notifications = [
            'message' => 'Shipping method added successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('shipping.index')->with($notifications);
    }

    /**
     * Display the specified resource.
     */
    public function show(shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $shipping = Shipping::find($id);
        $countries = Countries::get();
        return view('admin.shipping.edit_shipping', compact('shipping', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'country_id' => 'required|exists:countries,id',
        ]);

        $shipping = Shipping::findOrFail($id);

        $shipping->name = $request->name;
        $shipping->amount = $request->amount;
        $shipping->country_id = $request->country_id;
        $shipping->save();

        $notifications = [
            'message' => 'Shipping method updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('shipping.index')->with($notifications);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $shipping = Shipping::findOrFail($id);
        $shipping->delete();
        $notifications = [
            'message' => 'Shipping method deleted successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route(route: 'shipping.index')->with($notifications);
    }
}
