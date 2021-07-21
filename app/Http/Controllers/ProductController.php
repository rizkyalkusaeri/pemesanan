<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'size' => ['required', 'string'],
            'price' => 'required|integer',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }

            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'size' => $request->size,
                'price' => $request->price,
                'photo' => $photo
            ]);

            return redirect(route('product.index'))->with(['success' => '<strong>' . $product->name . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data = Product::findOrFail($id);

        return view('product.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'size' => ['required', 'string'],
            'price' => 'required|integer',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        $product = Product::findOrFail($id);
        $photo = $product->photo;


        try {
            if ($request->hasFile('photo')) {
                //cek, jika photo tidak kosong maka file yang ada di folder uploads/product akan dihapus
                !empty($photo) ? File::delete(storage_path('app/public/products/' . $photo)) : null;
                //uploading file dengan menggunakan method saveFile() yg telah dibuat sebelumnya
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }

            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'size' => $request->size,
                'price' => $request->price,
                'photo' => $photo
            ]);

            return redirect(route('product.index'))->with(['success' => '<strong>' . $product->name . '</strong> Diperbarui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!empty($product->photo)) {
            File::delete(storage_path('app/public/products/' . $product->photo));
        }
        $product->delete();
        return redirect()->back()->with(['success' => '<strong>' . $product->name . '</strong> Telah dihapus']);
    }

    private function saveFile($name, $photo)
    {
        $images = Str::slug($name) . time() . '.' . $photo->getClientOriginalExtension();

        $photo->storeAs('public/products', $images);

        return $images;
    }
}