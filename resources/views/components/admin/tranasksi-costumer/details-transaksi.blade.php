@extends('layouts.admin')

@section('title')
Details Transaksi
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Detail Transaksi {{ $details->user->name }}</h1>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <form action="{{ route('update_transaksi', $details->transaction_code) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <tr>
                        <th>Kode Transaksi</th>
                        <td>{{ $details->transaction_code }}</td>
                    </tr>
                    <tr>
                        <th>Nama Penngguna</th>
                        <td>{{ $details->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap Pemebeli</th>
                        <td>{{ $details->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $details->alamat}}</td>
                    </tr>
                    <tr>
                        <th>No. Tlpn</th>
                        <td>{{ $details->no_telpn }}</td>
                    </tr>
                    <tr>
                        <th>Diskon</th>
                        <td>{{ $details->discount }}%</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>Rp.{{ number_format($details->sub_total) }}</td>
                    </tr>
                    <tr>
                        <th>Bukti Pembayaran</th>
                        <td>
                            <img width="200px;" src="{{ Storage::url($details->foto) }}" alt="" srcset="">
                        </td>
                    </tr>
                    <tr>
                        <th>Metode Pembayaran/Pengirmiman</th>
                        <td>{{ $details->metode_pembayaran }}</td>
                    </tr>
                    <tr>
                        <th>Status Transaksi</th>
                        <td>
                            <select class="form-control" name="status">
                                <option value="">
                                    {{$details->status == 1 ? 'Sudah di proses' : 'Sedang di proses'}}
                                </option>
                                <option value="">-- Silahkan pilih --</option>
                                <option value="1">Terima pesanan</option>
                                <option value="0">Tolak pesanan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <button type="submit" class="btn btn-primary">Kirim
                                Pembaruan</button>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
    </div>
</div>

@endsection

@push('script')
<script src="{{ url('assets/backend/js/cleave.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('deskripsi');
</script>
<script src="{{ url('assets/backend/js/image_upload.js') }}"></script>
<script src="{{ url('assets/backend/js/my_cleave.js') }}"></script>
@endpush