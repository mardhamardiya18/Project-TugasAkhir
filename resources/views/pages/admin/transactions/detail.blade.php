@extends('layouts.admin')

@section('title')
    Mebel 54 Malang - Transaction Detail
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">No Transaction {{ $transaction_details->first()->transaction->code }}</h2>
                <nav class="nav-bread mt-4 mb-3">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('transaction.index') }}" class="text-dark">Transactions</a>
                        </li>
                        <li class="breadcrumb-item active">Transaction Detail</li>
                    </ol>
                </nav>
            </div>

            <div class="dashboard-content mt-4 mt-ld-5">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Informasi Produk</h4>
                                    </div>
                                </div>


                                @foreach ($transaction_details as $transaction_detail)
                                    <div class="row justify-content-md-between justify-content-lg-start mt-4">
                                        <div class="col-md-4">
                                            <img src="{{ Storage::url($transaction_detail->product->galleries->first()->photos) }}"
                                                class="img-fluid img-transaction-detail" alt="" />
                                        </div>
                                        <div class="col-md-3 offset-md-1 mt-4 mt-sm-0">
                                            <div class="form-group">
                                                <p class="label-detail text-muted m-0">
                                                    Tanggal Transaksi
                                                </p>
                                                <p class="text-detail">
                                                    @php
                                                        $date = $transaction_detail->created_at;
                                                        $date_carbon = \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMM Y | H:m');
                                                    @endphp
                                                    {{ $date_carbon }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <p class="label-detail text-muted m-0">
                                                    Harga Produk
                                                </p>
                                                <p class="text-detail">@currency($transaction_detail->price)</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <p class="label-detail text-muted m-0">
                                                    Nama Produk
                                                </p>
                                                <p class="text-detail">
                                                    {{ $transaction_detail->product->name }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <p class="label-detail text-muted m-0">
                                                    Status Pembayaran
                                                </p>
                                                <small
                                                    class="text-detail text-white {{ $transaction_detail->transaction->transaction_status == 'Menunggu Pembayaran' ? 'badge badge-warning' : ($transaction_detail->transaction->transaction_status == 'Terbayar' ? 'badge badge-success' : ($transaction_detail->transaction->transaction_status == 'Gagal' ? 'badge badge-danger' : '')) }}">
                                                    {{ $transaction_detail->transaction->transaction_status }}
                                                </small>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h4>Informasi Pelanggan</h4>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <p class="label-detail text-muted m-0">
                                        Nama Pelanggan
                                    </p>
                                    <p class="text-detail">{{ $transaction_details->first()->transaction->user->name }}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p class="label-detail text-muted m-0">
                                        No telepon
                                    </p>
                                    <p class="text-detail">
                                        {{ $transaction_details->first()->transaction->user->phone_number }}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p class="label-detail text-muted m-0">
                                        Email
                                    </p>
                                    <p class="text-detail">
                                        {{ $transaction_details->first()->transaction->user->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col">
                                    <h4>Informasi Pengiriman</h4>
                                </div>
                            </div>

                            <form action="{{ route('transaction-detail-update', $transaction_details->first()->id) }}"
                                method="POST" enctype="multipart/form-data" id="form-app">

                                @csrf
                                <div class="row mt-4">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Alamat I
                                            </p>
                                            <p class="text-detail">
                                                {{ $transaction_details->first()->transaction->user->address_one }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Provinsi
                                            </p>
                                            <p class="text-detail">
                                                {{ App\Models\Province::find($transaction_details->first()->transaction->user->provinces_id)->name }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Kode pos
                                            </p>
                                            <p class="text-detail">
                                                {{ $transaction_details->first()->transaction->user->zip_code }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Shipping Status
                                            </p>
                                            <select name="shipping_status" class="form-control mt-2" id="" v-model="resi">
                                                <option value="{{ $transaction_details->first()->id }}" selected="true"
                                                    disabled>
                                                    (Default){{ $transaction_details->first()->shipping_status }}
                                                </option>
                                                <option value="DIKEMAS">DIKEMAS</option>
                                                <option value="DIKIRIM">DIKIRIM</option>
                                                <option value="DITERIMA">DITERIMA</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-3 offset-md-1">
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Alamat II
                                            </p>
                                            <p class="text-detail">
                                                {{ $transaction_details->first()->transaction->user->address_two }}</p>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">Kota/Kabupaten</p>
                                            <p class="text-detail">
                                                {{ App\Models\Regency::find($transaction_details->first()->transaction->user->regencies_id)->name }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">Kecamatan</p>
                                            <p class="text-detail">
                                                {{ App\Models\District::find($transaction_details->first()->transaction->user->districts_id)->name }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">Kelurahan</p>
                                            <p class="text-detail">
                                                {{ App\Models\Village::find($transaction_details->first()->transaction->user->villages_id)->name }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Input Resi
                                            </p>
                                            <input type="text" name="resi"
                                                value="{{ $transaction_details->first()->resi }}"
                                                class="form-control mt-2" />
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success px-5 mt-4">Update Resi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        $(function() {
            $('#toggle-two').bootstrapToggle({
                on: 'LUNAS',
                off: 'PENDING'
            });
        })
    </script>
@endpush
