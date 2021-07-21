<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Evidence;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    public function index()
    {
        $order = Order::orderBy('created_at', 'DESC')->with(['invoice'])->where('status_produksi', 3)->get();
        return view('invoice.index', compact('order'));
    }

    public function create($id)
    {
        $order = Order::findOrFail($id);

        return view('invoice.create', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('invoice.edit', compact('order'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'invoice' => ['required', 'mimes:pdf']
        ]);

        try {
            $order = Order::find($id);

            if ($request->hasFile('invoice')) {
                $file = $request->file('invoice');

                $file_name = time() . $order->job . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/invoices', $file_name);
            }

            Invoice::create([
                'file' => $file_name,
                'order_id' => $order->id
            ]);

            $order->update([
                'status' => 3
            ]);

            Mail::to($order->user->email)->send(new InvoiceMail($order));

            return redirect(route('invoice.index'))->with(['message' => 'Berhasil Menambahkan Invoice']);
        } catch (\Exception $error) {
            return redirect()->back()->with(['error' => $error->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'bukti' => ['required', 'mimes:png,jpeg,jpg']
        ]);

        try {
            $order = Order::find($id);

            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');

                $file_name = time() . $order->id . 'bukti.' . $file->getClientOriginalExtension();
                $file->storeAs('public/evidences', $file_name);
            }

            Evidence::create([
                'bukti' => $file_name,
                'order_id' => $order->id
            ]);

            return redirect(route('invoice.index'))->with(['message' => 'Berhasil Menambahkan Bukti Pembayaran']);
        } catch (\Exception $error) {
            return redirect()->back()->with(['error' => $error->getMessage()]);
        }
    }

    public function setuju($id)
    {
        try {
            $order = Order::find($id);

            $order->update([
                'status_produksi' => 4,
                'status' => 4
            ]);

            return redirect(route('invoice.index'))->with(['message' => 'Berhasil Menyetujui']);
        } catch (\Exception $error) {
            return redirect()->back()->with(['error' => $error->getMessage()]);
        }
    }
}