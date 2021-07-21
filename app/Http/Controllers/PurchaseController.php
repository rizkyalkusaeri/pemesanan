<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $order = Order::orderBy('created_at', 'DESC')->with(['purchase'])->where('status_produksi', 2)->get();
        return view('purchase.index', compact('order'));
    }

    public function create($id)
    {
        $order = Order::findOrFail($id);

        return view('purchase.create', compact('order'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'purchase' => ['required', 'mimes:pdf']
        ]);

        try {
            $order = Order::find($id);

            if ($request->hasFile('purchase')) {
                $file = $request->file('purchase');

                $file_name = time() . $order->job . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/purchases', $file_name);
            }

            Purchase::create([
                'file' => $file_name,
                'order_id' => $order->id
            ]);

            return redirect(route('purchase.index'))->with(['message' => 'Berhasil Menambahkan Purchase']);
        } catch (\Exception $error) {
            return redirect()->back()->with(['error' => $error->getMessage()]);
        }
    }

    public function update($id)
    {
        try {
            $invoice = Order::find($id);

            $invoice->update([
                'status_produksi' => 3
            ]);

            return redirect(route('purchase.index'))->with(['message' => 'Berhasil Menyetujui']);
        } catch (\Exception $error) {
            return redirect()->back()->with(['error' => $error->getMessage()]);
        }
    }
}