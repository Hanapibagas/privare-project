<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\DetailsTransaksi;
use App\Models\Pertanyaan;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\RiviewProduct;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function category()
    {
        $kategory = ProductCategory::all();
        $product = Product::all();

        return view('components.pages.category', compact('kategory', 'product'));
    }

    public function getPencarian(Request $request)
    {
        $keywords = $request->search;

        $product = Product::where('name', 'like', "%" . $keywords . "%")->paginate(10);

        return view('components.pages.category', compact('product'));
    }

    public function details_products(Request $request, $id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        $riview = RiviewProduct::where('product_id', $id)->paginate(5);
        $jumlah = RiviewProduct::where('product_id', $id)->count();
        return view('components.pages.details', compact('product', 'riview', 'jumlah'));
    }

    public function getCart()
    {
        $user = Auth::id();

        $coupons = Coupon::where('user_id', $user)
            ->orWhere('user_id', null)
            ->get();

        $data = Cart::where('user_id', $user)->get();
        $subTotal = $data->sum('total_price');

        $transaksi = Transaction::where('user_id', $user)->get();

        return view('components.pages.cart', compact('data', 'coupons', 'transaksi', 'subTotal'));
    }

    public function storeCart($id)
    {
        $product = Product::find($id);
        $purchase_price = $product->purchase_price;

        $duplicate = Cart::where('user_id', $id)->first();

        $previous_stock = $product->stock;

        $cart = Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
            'product_price' => $purchase_price,
            'quantity' => '1',
            'total_price' => $purchase_price
        ]);

        // $new_stock = $previous_stock - $cart->quantity;
        // $product->stock = $new_stock;
        // $product->save();

        return redirect()->back()->with('status', 'Berhasil menambah item ke keranjang');
    }

    public function getUpdateCart(Request $request, $id)
    {
        $data = Cart::where('id', $id)->first();

        $previous_quantity = $data->quantity;
        $new_quantity = $request->input('quantity');
        $quantity_diff = $new_quantity - $previous_quantity;

        $product = Product::find($data->product_id);

        $data->update([
            'quantity' => $new_quantity,
            'total_price' => $data->total_price + ($data->product_price * $quantity_diff)
        ]);

        return redirect()->back()->with('status', 'Berhasil mengubah jumlah barang');
    }

    public function getDeleteCart($id)
    {
        $delete = Cart::find($id);

        if ($delete->banner && file_exists(storage_path('app/public/' . $delete->banner))) {
            Storage::delete('public/' . $delete->banner);
        }

        $product = Product::find($delete->product_id);
        $product->stock += $delete->quantity;
        $product->save();

        $delete->delete();

        return redirect()->back()->with('status', 'Berhasil menghapus barang dari cart');
    }

    public function getCheckOut(Request $request)
    {
        $user = Auth::id();

        $message = [
            'required' => 'Mohon maaf anda lupa untuk mengisi ini dan harap anda mangisi terlebih dahulu'
        ];

        $this->validate($request, [
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'metode_pembayaran' => 'required',
            'no_telpn' => 'required',
            'foto' => 'mimes:jpg,png',
        ], $message);

        $file = null;

        if ($request->file('foto')) {
            $file = $request->file('foto')->store('bukti-pembayaran', 'public');
        }

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $randomCode = '';
        for ($i = 0; $i < 7; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $randomCode .= $characters[$randomIndex];
        }

        $transaction = Transaction::create([
            'user_id' => $user,
            'foto' => $file,
            'nama_lengkap' => $request->input('nama_lengkap'),
            'discount' => $request->input('discount'),
            'sub_total' => str_replace(',', '', $request['sub_total']),
            'discount_price' => str_replace(',', '', $request['discount_price']),
            'grand_total' => str_replace(',', '', $request['grand_total']),
            'no_telpn' => $request->input('no_telpn'),
            'metode_pembayaran' => $request->input('metode_pembayaran'),
            'alamat' => $request->input('alamat'),
            'kode_pemesanan' => $randomCode,
        ]);

        $cartItems = Cart::where('user_id', $user)->get();

        foreach ($cartItems as $cartItem) {
            $detailTransaksi = new DetailsTransaksi();
            $detailTransaksi->order_date = date('Y-m-d');
            $detailTransaksi->transaksi_id = $transaction->id;
            $detailTransaksi->product_id = $cartItem->product_id;
            $detailTransaksi->jumlah_barang = $cartItem->quantity;

            $product = Product::find($cartItem->product_id);
            $sellingPrice = $product->selling_price * $cartItem->quantity;
            $purchasePrice = $product->purchase_price * $cartItem->quantity;

            $detailTransaksi->selling_price = $sellingPrice;
            $detailTransaksi->purchase_price = $purchasePrice;
            $detailTransaksi->profit = $purchasePrice - $sellingPrice;
            $detailTransaksi->discount = $transaction->discount;
            $detailTransaksi->save();

            $product->stock -= $cartItem->quantity;
            $product->save();
        }

        Cart::where('user_id', $user)->delete();

        return redirect()->route('get.Jawab.Quesioner')->with('status', 'Selamat transaksi anda segera kami proses dan mohon untuk mengisi pertanyaan ini');
    }

    public function getKuponInfo(Request $request)
    {
        $input = $request->all();
        $input['coupon_code'] = strtoupper(str_replace(' ', '', $input['coupon_code']));
        $couponCode = $input['coupon_code'];

        $hasCoupon = false;
        $coupons = Coupon::where('coupon_code', $couponCode)->get();

        foreach ($coupons as $coupon) {
            if ($coupon->expired !== null && Carbon::create($coupon->expired) < Carbon::now()) {
                return redirect()->back()
                    ->withErrors(['coupon_invalid' => 'Kupon sudah tidak berlaku.']);
            }

            if ($coupon->status == 0 && $coupon->expired !== null) {
                return redirect()->back()
                    ->withErrors(['coupon_invalid' => 'Kupon tidak aktif.']);
            }

            $hasCoupon = true;
            $discount = $coupon->discount;
        }

        if (!$hasCoupon) {
            return redirect()->back()
                ->withErrors(['coupon_invalid' => 'Kupon tidak ditemukan.']);
        }

        return redirect()->back()
            ->with([
                'coupon_code' => $couponCode,
                'discount' => $discount
            ]);
    }

    public function getQuesioner()
    {
        return view('components.pages.quesioner');
    }

    public function postQuesioner(Request $request)
    {
        $user = Auth::id();
        Pertanyaan::create([
            'users_id' => $user,
            'q1' => $request->input('q1'),
            'q2' => $request->input('q2'),
            'q3' => $request->input('q3'),
            'q4' => $request->input('q4'),
            'q5' => $request->input('q5'),
            'q6' => $request->input('q6'),
            'q7' => $request->input('q7'),
            'q8' => $request->input('q8'),
            'tanggal' => date('Y-m-d')
        ]);

        return redirect()->route('get-index')->with('status', 'Terimakasi telah mengisi pertanyaan, ini adalah daftar transaksi anda');
    }
}
