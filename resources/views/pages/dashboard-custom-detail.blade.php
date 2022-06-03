@extends('layouts.dashboard')

@section('title')
    Mebel 54 Malang - Transaction Detail
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">No Transaksi {{ $custom->custom->code }}</h2>
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
                @if ($custom->estimasi_biaya !== 'CHECKING' && $custom->estimasi_biaya !== '0')
                    <div
                        class="row {{$custom->payment_status == "Checking..." || $custom->payment_status == "Terbayar" ? 'd-none' : ''}}">
                        <div class="col-12">
                            <div class="alert alert-danger  d-flex align-items-center" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-exclamation-triangle-fill flex-shrink-0 mr-2" viewBox="0 0 16 16"
                                    role="img" aria-label="Warning:">
                                    <path
                                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>


                                <div>
                                    Pesanan ini belum terbayar, harap selesaikan pembayaran <strong>min 50% dari total
                                        biaya</strong> sebelum
                                    <strong>24 Jam dari sekarang</strong>
                                    <a href="{{ route('order-custom-confirm', $custom->id) }}">klik disini</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-info  d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 mr-2" width="24" height="24" role="img" aria-label="Info:">
                                    <use xlink:href="#info-fill" />
                                </svg>
                                <div>
                                    Pesanan anda saat ini sedang diproses, baik dari segi waktu pengerjaan dan biaya, mohon
                                    menunggu😇
                                </div>

                            </div>
                        </div>
                    </div>
                @endif

                @if ($custom->photos_confirm && $custom->payment_status == 'Checking...')
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-info  d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 mr-2" width="24" height="24" role="img" aria-label="Info:">
                                    <use xlink:href="#info-fill" />
                                </svg>
                                <div>
                                    Terima kasih telah melakukan pembayaran, pembayaran anda akan kami cek terlebih dahulu😇
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
                                        <img src="{{ Storage::url($custom->custom->first()->photos) }}"
                                            class="img-fluid img-transaction-detail" alt="" />
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

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Status Pembayaran
                                            </p>

                                            <small
                                                class="text-detail status text-white {{ $custom->payment_status == 'Menunggu Pembayaran' ? 'badge badge-danger' : 'badge badge-success' }}">
                                                {{ $custom->payment_status }}
                                            </small>


                                        </div>
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Nomor Telepon
                                            </p>
                                            <p class="text-detail">{{ $custom->custom->phone_number }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col">
                                        <h4>Informasi Pengiriman</h4>
                                    </div>
                                </div>

                                <form action="#" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mt-4">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <p class="label-detail text-muted m-0">
                                                    Alamat I
                                                </p>
                                                <p class="text-detail">
                                                    {{ $custom->custom->address_one }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <p class="label-detail text-muted m-0">Kota/Kabupaten</p>
                                                <p class="text-detail">
                                                    @if ($custom->custom->user->regencies_id)
                                                        {{ App\Models\Regency::find($custom->custom->user->regencies_id)->name }}
                                                    @else
                                                        <small class="text-danger">Harap isi data Kota/Kabupaten di
                                                            pengaturan
                                                            akun anda!</small>
                                                    @endif

                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <p class="label-detail text-muted m-0">Kelurahan</p>
                                                <p class="text-detail">
                                                    @if ($custom->custom->user->villages_id)
                                                        {{ App\Models\Village::find($custom->custom->user->villages_id)->name }}
                                                    @else
                                                        <small class="text-danger">Harap isi data kelurahan di pengaturan
                                                            akun anda!</small>
                                                    @endif

                                                </p>
                                            </div>

                                        </div>
                                        <div class="col-md-3 offset-md-1">
                                            <div class="form-group">
                                                <p class="label-detail text-muted m-0">
                                                    Alamat II
                                                </p>
                                                <p class="text-detail">
                                                    {{ $custom->custom->address_two }}</p>
                                            </div>

                                            <div class="form-group">
                                                <p class="label-detail text-muted m-0">Kecamatan</p>
                                                <p class="text-detail">
                                                    @if ($custom->custom->user->districts_id)
                                                        {{ App\Models\District::find($custom->custom->user->districts_id)->name }}
                                                    @else
                                                        <small class="text-danger">Harap isi data kecamatan di pengaturan
                                                            akun anda!</small>
                                                    @endif

                                                </p>
                                            </div>


                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="card">
                            <div class="card-body py-5">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Informasi Pemesanan</h4>
                                    </div>
                                </div>
                                <div class="row justify-content-md-between justify-content-lg-start mt-4">
                                    <div class="col-md-3 offset-md-1 offset-lg-0 mt-4 mt-sm-0">
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Kategori Produk
                                            </p>
                                            <p class="text-detail">{{ $custom->custom->categories }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">

                                            <p class="label-detail text-muted m-0">
                                                Estimasi Pengerjaan
                                            </p>

                                            <div class="wrapper d-flex">
                                                <p class="text-detail">{{ $custom->estimasi_pengerjaan }} Hari</p>
                                                @if ($custom->estimasi_pengerjaan == 'CHECKING')
                                                    <div class="spinner-border ml-2" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <p class="label-detail text-muted m-0">
                                                Total Biaya
                                            </p>
                                            <div class="wrapper d-flex">
                                               
                                                @if ($custom->estimasi_biaya == 'CHECKING')
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
                                                Status Pengerjaan
                                            </p>
                                            <p
                                                class="text-detail d-inline-block status mt-1 text-white {{ $custom->status_pengerjaan == 'PENDING' ? 'badge badge-danger' : 'badge badge-success' }}">
                                                {{ $custom->status_pengerjaan }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
