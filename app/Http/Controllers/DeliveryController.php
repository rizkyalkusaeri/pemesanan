<?php

namespace App\Http\Controllers;

use App\Mail\DeliveryMail;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DeliveryController extends Controller
{
    public function index()
    {
        $order = Order::orderBy('created_at', 'DESC')->where('status', 3)->get();
        return view('delivery.index', compact('order'));
    }

    public function create($id)
    {
        $order = Order::findOrFail($id);
        $data = Order_detail::where('order_id', $id)->get();
        $customer = Customer::where('user_id', $order->user_id)->first();

        return view('delivery.create', compact('order', 'data', 'customer'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'faktur' => ['required', 'mimes:pdf'],
            'surat_jalan' => ['required', 'mimes:pdf']
        ]);

        try {
            $order = Order::find($id);

            if ($request->hasFile('faktur') && $request->hasFile('surat_jalan')) {
                $faktur = $request->file('faktur');
                $surat_jalan = $request->file('surat_jalan');

                $file_name_faktur = time() . 'faktur' . '.' . $faktur->getClientOriginalExtension();
                $file_name_surat = time() . 'surat' . '.' . $surat_jalan->getClientOriginalExtension();

                $faktur->storeAs('public/deliveries', $file_name_faktur);
                $surat_jalan->storeAs('public/deliveries', $file_name_surat);
            }

            Delivery::create([
                'faktur' => $file_name_faktur,
                'surat_jalan' => $file_name_surat,
                'order_id' => $order->id
            ]);

            $order->update([
                'status' => 4,
            ]);


            Mail::to($order->user->email)->send(new DeliveryMail($order));

            return redirect(route('delivery.index'))->with(['message' => 'Berhasil Menambahkan Faktur dan Surat Jalan']);
        } catch (\Exception $error) {
            return redirect()->back()->with(['error' => $error->getMessage()]);
        }
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $data = Order_detail::where('order_id', $id)->get();
        $customer = Customer::where('user_id', $order->user_id)->first();

        return view('delivery.show', compact('order', 'customer', 'data'));
    }
}