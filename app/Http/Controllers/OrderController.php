<?php

namespace App\Http\Controllers;

use App\Mail\OrderEmail;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin' || auth()->user()->role == 'direktur') {
            $data = Order::orderBy('created_at', 'DESC')->get();
        } else {
            $data = Order::orderBy('created_at', 'DESC')->where('user_id', auth()->user()->id)->get();
        }

        return view('order.index', compact('data'));
    }

    public function create()
    {
        return view('order.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => ['required', 'string'],
            'qty' => ['required', 'numeric']
        ]);

        $order = Order::create([
            'description' => $request->description,
            'qty' => $request->qty,
            'status_produksi' => 0,
            'job' => '',
            'user_id' => auth()->user()->id
        ]);

        $user = User::find($order->user_id);

        Mail::to("rizkyalkus12@gmail.com")->send(new OrderEmail($user));

        return redirect(route('order.index'))->with(['message' => 'Berhasil menyimpan data']);
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $data = Order_detail::where('order_id', $id)->get();
        $customer = Customer::where('user_id', $order->user_id)->first();

        return view('order.edit', compact('order', 'customer', 'data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'bukti' => ['required', 'mimes:pdf,jpg,png,jpeg']
        ]);

        try {
            $order = Order::find($id);
            $bukti = null;
            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');

                $bukti = time() . $order->invoice . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/evidences', $bukti);
            }

            $order->update([
                'status' => 1,
                'bukti' => $bukti
            ]);

            Mail::to("admin@gmail.com")->send(new OrderEmail(auth()->user()));

            return redirect(route('order.index'))->with(['message' => 'Berhasil Menambahkan Bukti']);
        } catch (\Exception $error) {
            return redirect()->back()->with(['error' => $error->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        if (!empty($order->job)) {
            //file akan dihapus dari folder uploads/produk
            File::delete(storage_path('app/public/jobs/' . $order->job));
        }

        $order->delete();

        return redirect(route('order.index'))->with(['message' => 'Berhasil menghapus data']);
    }

    public function job_order($id)
    {
        $order = Order::find($id);

        return view('order.job', compact('order'));
    }

    public function job_order_store(Request $request, $id)
    {
        $this->validate($request, [
            'job' => ['required', 'mimes:pdf']
        ]);

        try {
            $order = Order::find($id);

            $file_name = $order->job;

            if ($request->hasFile('job')) {
                $file = $request->file('job');

                $file_name = time() . $order->id . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/jobs', $file_name);
                //File::delete(storage_path('app/public/job' . $order->job));
            }

            $order->update([
                'job' => $file_name,
                'status' => 2,
                'status_produksi' => 2
            ]);

            return redirect(route('order.index'))->with(['message' => 'Berhasil Menambahkan job order']);
        } catch (\Exception $error) {
            return redirect()->back()
                ->with(['error' => $error->getMessage()]);
        }
    }

    public function addOrder()
    {
        $products = Product::all();
        return view('order.add', compact('products'));
    }

    public function checkout()
    {
        $customer = Customer::where('user_id', auth()->user()->id)->first();

        return view('order.checkout', compact('customer'));
    }

    public function getProduct($id)
    {
        $product = Product::find($id);
        return response()->json($product, 200);
    }

    public function addToCart(Request $request)
    { //dari ajax request addToCart mengirimkan product_id dan qty
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer'
        ]);


        //mengambil data product berdasarkan id
        $product = Product::findOrFail($request->product_id);
        //mengambil cookie cart dengan $request->cookie('cart')
        $getCart = json_decode($request->cookie('cart'), true);

        //jika datanya ada
        if ($getCart) {
            //jika key nya exists berdasarkan product_id
            if (array_key_exists($request->product_id, $getCart)) {
                //jumlahkan qty barangnya
                $getCart[$request->product_id]['qty'] += $request->qty;
                //dikirim kembali untuk disimpan ke cookie
                return response()->json($getCart, 200)
                    ->cookie('cart', json_encode($getCart), 120);
            }
        }

        $getCart[$request->product_id] = [
            'name' => $product->name,
            'size' => $product->size,
            'price' => $product->price,
            'qty' => $request->qty
        ];

        return response()->json($getCart, 200)->cookie('cart', json_encode($getCart), 120);
    }

    public function getCart()
    {
        //mengambil cart dari cookie
        $cart = json_decode(request()->cookie('cart'), true);
        //mengirimkan kembali dalam bentuk json untuk ditampilkan dengan vuejs
        return response()->json($cart, 200);
    }

    public function getAmmount()
    {
        //mengambil cart dari cookie
        $cart = json_decode(request()->cookie('cart'), true);
        $result = collect($cart)->map(function ($value) {
            return [
                'name' => $value['name'],
                'qty' => $value['qty'],
                'price' => $value['price'],
                'size' => $value['size'],
                'result' => $value['price'] * $value['qty']
            ];
        })->all();

        $total = array_sum(array_column($result, 'result'));
        //mengirimkan kembali dalam bentuk json untuk ditampilkan dengan vuejs
        return response()->json($total, 200);
    }

    public function removeCart($id)
    {
        $cart = json_decode(request()->cookie('cart'), true);
        //menghapus cart berdasarkan product_id
        unset($cart[$id]);
        //cart diperbaharui
        return response()->json($cart, 200)->cookie('cart', json_encode($cart), 120);
    }

    public function storeOrder(Request $request)
    {
        //mengambil list cart dari cookie
        $cart = json_decode($request->cookie('cart'), true);
        //memanipulasi array untuk menciptakan key baru yakni result dari hasil perkalian price * qty
        $result = collect($cart)->map(function ($value) {
            return [
                'size' => $value['size'],
                'name' => $value['name'],
                'qty' => $value['qty'],
                'price' => $value['price'],
                'result' => $value['price'] * $value['qty']
            ];
        })->all();

        $total = array_sum(array_column($result, 'result'));
        //database transaction
        DB::beginTransaction();
        try {
            // $bukti = null;
            // if ($request->hasFile('bukti')) {
            //     $bukti = $this->saveFile($request->auth()->user()->id, $request->file('bukti'));
            // }

            //menyimpan data ke table orders
            $order = Order::create([
                'invoice' => $this->generateInvoice(),
                'total' => $total,
                'status' => 0,
                'note' => $request->note,
                'user_id' => auth()->user()->id,

                //array_sum untuk menjumlahkan value dari result
            ]);


            //looping cart untuk disimpan ke table order_details
            foreach ($result as $key => $row) {
                $order->order_detail()->create([
                    'product_id' => $key,
                    'qty' => $row['qty'],
                    'price' => $row['price']
                ]);
            }
            //apabila tidak terjadi error, penyimpanan diverifikasi
            DB::commit();


            //me-return status dan message berupa code invoice, dan menghapus cookie
            return response()->json([
                'status' => 'success',
                'message' => $order->invoice,
            ], 200)->cookie(Cookie::forget('cart'));
        } catch (\Exception $e) {
            //jika ada error, maka akan dirollback sehingga tidak ada data yang tersimpan 
            DB::rollback();
            //pesan gagal akan di-return
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function generateInvoice()
    {
        //mengambil data dari table orders
        $order = Order::orderBy('created_at', 'DESC');
        //jika sudah terdapat records
        if ($order->count() > 0) {
            //mengambil data pertama yang sdh dishort DESC
            $order = $order->first();
            //explode invoice untuk mendapatkan angkanya
            $explode = explode('-', $order->invoice);
            $hasil = 'INV-' . ($explode[1] + 1);
            //angka dari hasil explode di +1
            return $hasil;
        }
        //jika belum terdapat records maka akan me-return INV-1
        return 'INV-1';
    }

    public function setujui($id)
    {
        try {
            $order = Order::find($id);

            $order->update([
                'status' => 2
            ]);

            return redirect(route('order.index'))->with(['message' => 'Berhasil Menyetujui']);
        } catch (\Exception $error) {
            return redirect()->back()->with(['error' => $error->getMessage()]);
        }
    }

    public function tolak($id)
    {
        try {
            $order = Order::find($id);

            $order->update([
                'status' => 10
            ]);

            return redirect(route('order.index'))->with(['message' => 'Berhasil Menolak']);
        } catch (\Exception $error) {
            return redirect()->back()->with(['error' => $error->getMessage()]);
        }
    }

    public function diterima($id)
    {
        try {
            $order = Order::find($id);

            $order->update([
                'status' => 5
            ]);

            return redirect(route('order.index'))->with(['message' => 'Terimakasih telah berbelanja']);
        } catch (\Exception $error) {
            return redirect()->back()->with(['error' => $error->getMessage()]);
        }
    }

    private function saveFile($name, $bukti)
    {
        $images = Str::slug($name) . time() . '.' . $bukti->getClientOriginalExtension();

        $bukti->storeAs('public/orders', $images);

        return $images;
    }
}