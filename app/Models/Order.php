<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['created_at'];

    public function order_detail()
    {
        return $this->hasMany(Order_detail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    public function evidence()
    {
        return $this->hasOne(Evidence::class);
    }

    public function getStatusLabelAttribute()
    {
        if ($this->status == 0) {
            return '<span class="badge badge-danger">Belum bayar</span>';
        } else if ($this->status == 1) {
            return '<span class="badge badge-warning">Sedang Diverifikasi</span>';
        } else if ($this->status == 2) {
            return '<span class="badge badge-success">Disetujui</span>';
        } else if ($this->status == 3) {
            return '<span class="badge badge-warning">Produksi</span>';
        } else if ($this->status == 4) {
            return '<span class="badge badge-warning">Proses Pengiriman</span>';
        } else if ($this->status == 10) {
            return '<span class="badge badge-danger">Orderan anda ditolak</span>';
        } else {
            return '<span class="badge badge-success">Selesai</span>';
        }
    }

    public function getStatusProduksiLabelAttribute()
    {
        if ($this->status_produksi == 0) {
            return '<span class="badge badge-secondary"> Belum Disetujui </span>';
        } else if ($this->status_produksi == 1) {
            return '<span class="badge badge-success">Pengecekan PPIC</span>';
        } else if ($this->status_produksi == 2) {
            return '<span class="badge badge-warning">Pengecekan Gudang</span>';
        } else if ($this->status_produksi == 3) {
            return '<span class="badge badge-danger">Proses Produksi</span>';
        } else if ($this->status_produksi == 4) {
            return '<span class="badge badge-warning">Proses Pengiriman</span>';
        } else {
            return '<span class="badge badge-danger">Selesai</span>';
        }
    }
}