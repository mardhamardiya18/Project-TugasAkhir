@extends('layouts.admin')

@section('title')
    Mebel 54 Malang - custom Detail
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">No custom {{ $custom->custom->code }}</h2>
                <nav class="nav-bread mt-4 mb-3">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('custom.index') }}" class="text-dark">customs</a>
                        </li>
                        <li class="breadcrumb-item active">custom Detail</li>
                    </ol>
                </nav>
            </div>

            <div class="dashboard-content mt-4 mt-ld-5">
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                    </symbol>
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </symbol>
                </svg>
                @if ($custom->photos_confirm)
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 mr-2" width="24" height="24" role="img" aria-label="Info:">
                                    <use xlink:href="#info-fill" />
                                </svg>
                                <div>
                                    Pesanan ini telah melakukan pembayaran Uang Muka/Konten, cek pada panel bukti pembayaran
                                    dibawah
                                </div>

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
                                        <img src="{{ Storage::url($custom->custom->photos) }}"
                                            class="img-fluid img-custom-detail" alt="" />
                                    </div>
                                    <div class="col-md-3 offset-md-1 mt-4 mt-sm-0">
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Nama Pelanggan
                                            </p>
                                            <p class="text-detail">{{ $custom->custom->user->name }}</p>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Tanggal Transaksi
                                            </p>
                                            <p class="text-detail">
                                                @php
                                                    $date = $custom->created_at;
                                                    $date_carbon = \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMM Y | H:m');
                                                @endphp
                                                {{ $date_carbon }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Total Biaya
                                            </p>
                                            <div class="wrapper d-flex">
                                                
                                                @if ($custom->estimasi_pengerjaan == 'CHECKING')
                                                    <div class="spinner-border ml-2" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                @else
                                                <p class="text-detail">Rp {{ number_format($custom->estimasi_biaya) }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Nama Produk
                                            </p>
                                            <p class="text-detail">
                                                {{ $custom->custom->categories }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Status Pembayaran
                                            </p>
                                            <p
                                                class="text-detail status text-white {{ $custom->payment_status == 'Menunggu Pembayaran' ? 'badge badge-danger' : 'badge badge-success' }}">
                                                {{ $custom->payment_status }}
                                            </p>

                                        </div>

                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Nomor Telepon
                                            </p>
                                            <p class="text-detail">{{ $custom->custom->user->phone_number }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col">
                                        <h4>Shipping Information</h4>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Alamat I
                                            </p>
                                            <p class="text-detail">
                                                {{ $custom->custom->user->address_one }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Kode pos
                                            </p>
                                            <p class="text-detail">{{ $custom->custom->user->zip_code }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">Kelurahan</p>
                                            <p class="text-detail">
                                                {{ App\Models\Village::find($custom->custom->user->villages_id)->name }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 offset-md-1">
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Alamat II
                                            </p>
                                            <p class="text-detail">
                                                {{ $custom->custom->user->address_two }}</p>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">Kota/Kabupaten</p>
                                            <p class="text-detail">
                                                {{ App\Models\Regency::find($custom->custom->user->regencies_id)->name }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">Kecamatan</p>
                                            <p class="text-detail">
                                                {{ App\Models\District::find($custom->custom->user->districts_id)->name }}
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @if ($custom->photos_confirm)
                    <div class="row mt-5">
                        <div class="col-12">
                            <h5>Konfirmasi Pembayaran Pelanggan</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="img-thumbnail" style="width: 500px;">
                                        <img src="{{ Storage::url($custom->photos_confirm) }}" alt=""
                                            class="img-fluid">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif

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
