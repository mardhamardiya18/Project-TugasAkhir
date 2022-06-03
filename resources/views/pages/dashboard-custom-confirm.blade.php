@extends('layouts.dashboard')

@section('title')
    Mebel 54 Malang - Konfirmasi Pembayaran Uang Muka/Kontan
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">No Pemesanan {{ $custom->custom->code }}</h2>
                <p class="dashboard-subtitle">Konfirmasi Pembayaran Uang Muka/Kontan</p>
            </div>

            <div class="dashboard-content mt-4 mt-ld-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('order-custom-confirm-upload', $custom->id) }}" id="form-cart"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="Checking..." name="payment_status" id="">
                            <div class="form-group">
                                <label for="">Penerima</label>
                                <input type="text" class="form-control" disabled
                                    value="{{ $custom->custom->user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Barang</label>
                                <input type="text" class="form-control" disabled
                                    value="{{ $custom->custom->categories }}" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Total Biaya</label>
                                <input type="text" class="form-control" disabled
                                    value="Rp {{ number_format($custom->estimasi_biaya) }}" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Upload Bukti Pembayaran</label>
                                <input type="file" class="form-control" name="photos_confirm" id="">
                            </div>

                            <button type="submit" class="btn btn-success px-5 mt-3">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
