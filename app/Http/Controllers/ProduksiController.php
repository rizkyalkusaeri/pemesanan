<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    public function index()
    {
        $data = Order::where('status', '!=', 1)->where('status', '!=', 0)->where('status', '!=', 10)->where('status', '!=', 5)->get();
        return view('produksi.index', compact('data'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $data = Order_detail::where('order_id', $id)->get();
        $customer = Customer::where('user_id', $order->user_id)->first();

        return view('produksi.edit', compact('order', 'customer', 'data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'end_date' => ['required']
        ]);

        try {
            $order = Order::find($id);

            $order->update([
                'selesai' => $request->end_date,
                'status' => 3
            ]);

            return redirect(route('produksi.index'))->with(['message' => 'Berhasil Mengupdate data']);
        } catch (\Exception $error) {
            return redirect()->back()->with(['error' => $error->getMessage()]);
        }
    }
}