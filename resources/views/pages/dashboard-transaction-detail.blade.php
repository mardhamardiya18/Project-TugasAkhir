@extends('layouts.dashboard')

@section('title')
    Mebel 54 Malang - Transaction Detail
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">No Transaksi {{ $transaction->transaction->code }}</h2>
                <nav class="nav-bread mt-4 mb-3">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard-transaction') }}" class="text-dark">Pesanan</a>
                        </li>
                        <li class="breadcrumb-item active">Pesanan Detail</li>
                    </ol>
                </nav>
            </div>

            <div class="dashboard-content mt-4 mt-ld-5">
                @if ($transaction->transaction->transaction_status == 'Menunggu Pembayaran')
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                Pesanan ini belum terbayar, segera selesaikan pembayaran sebelum <strong>24 jam dari
                                    sekarang</strong> mohon cek email anda😇
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body py-5">
                                <div class="row justify-content-md-between justify-content-lg-start">
                                    <div class="col-md-4">
                                        <img src="{{ Storage::url($transaction->product->galleries->first()->photos) }}"
                                            class="img-fluid img-transaction-detail" alt="" />
                                    </div>
                                    <div class="col-md-3 offset-md-1 mt-4 mt-sm-0">
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Nama Pelanggan
                                            </p>
                                            <p class="text-detail">{{ $transaction->transaction->user->name }}</p>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Tanggal Transaksi
                                            </p>
                                            <p class="text-detail">
                                                @php
                                                    $date = $transaction->created_at;
                                                    $date_carbon = \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMM Y | H:m');
                                                @endphp
                                                {{ $date_carbon }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Jumlah Pembelian
                                            </p>
                                            <p class="text-detail">@currency($transaction->price)</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Nama Produk
                                            </p>
                                            <p class="text-detail">
                                                {{ $transaction->product->name }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Status Pembayaran
                                            </p>
                                            <small
                                                class="text-detail status text-white {{ $transaction->transaction->transaction_status == 'Menunggu Pembayaran' ? 'badge badge-warning' : ($transaction->transaction->transaction_status == 'Terbayar' ? 'badge badge-success' : ($transaction->transaction->transaction_status == 'Gagal' ? 'badge badge-danger' : '')) }}">
                                                {{ $transaction->transaction->transaction_status }}


                                            </small>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Nomor Telepon
                                            </p>
                                            <p class="text-detail">{{ $transaction->transaction->user->phone_number }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col">
                                        <h4>Informasi Pengiriman</h4>
                                    </div>
                                </div>

                                <form action="{{ route('dashboard-transaction-update', $transaction->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mt-4">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <p class="label-detail text-muted m-0">
                                                    Alamat I
                                                </p>
                                                <p class="text-detail">
                                                    {{ $transaction->transaction->user->address_one }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <p class="label-detail text-muted m-0">
                                                    Provinsi
                                                </p>
                                                <p class="text-detail">
                                                    {{ App\Models\Province::find($transaction->transaction->user->provinces_id)->name }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <p class="label-detail text-muted m-0">
                                                    Kode pos
                                                </p>
                                                <p class="text-detail">{{ $transaction->transaction->user->zip_code }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <p class="label-detail text-muted m-0">
                                                    Shipping Status
                                                </p>
                                                <small
                                                    class="text-detail text-white {{ $transaction->shipping_status == 'PENDING' ? 'badge badge-danger' : ($transaction->shipping_status == 'DIKEMAS' ? 'badge badge-info' : ($transaction->shipping_status == 'DIKIRIM' ? 'badge badge-info' : ($transaction->shipping_status == 'DITERIMA' ? 'badge badge-success' : ''))) }} ">
                                                    {{ $transaction->shipping_status }}
                                                </small>
                                                <br>
                                                @if ($transaction->shipping_status == 'DIKIRIM' || $transaction->shipping_status == 'DITERIMA')
                                                    <small class="text-white badge badge-info mt-3">No Resi :
                                                        {{ $transaction->resi }}</small>
                                                    <br>
                                                    <small>Oleh J&T Express</small>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-3 offset-md-1">
                                            <div class="form-group">
                                                <p class="label-detail text-muted m-0">
                                                    Alamat II
                                                </p>
                                                <p class="text-detail">
                                                    {{ $transaction->transaction->user->address_two }}</p>
                                            </div>
                                            <div class="form-group">
                                                <p class="label-detail text-muted m-0">Kota/Kabupaten</p>
                                                <p class="text-detail">
                                                    {{ App\Models\Regency::find($transaction->transaction->user->regencies_id)->name }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <p class="label-detail text-muted m-0">Kecamatan</p>
                                                <p class="text-detail">
                                                    {{ App\Models\District::find($transaction->transaction->user->districts_id)->name }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <p class="label-detail text-muted m-0">Kelurahan</p>
                                                <p class="text-detail">
                                                    {{ App\Models\Village::find($transaction->transaction->user->villages_id)->name }}
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
