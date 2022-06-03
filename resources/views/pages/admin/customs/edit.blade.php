@extends('layouts.admin')

@section('title')
    Admin Dashboard - Update Pesanan Custom
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Admin Dashboard - Update {{ $custom->custom->code }}</h2>
                <p class="dashboard-subtitle">Look what you have made today!</p>
            </div>

            <div class="dashboard-content mt-4 mt-ld-5">
                <div class="row">
                    <div class="col-lg-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('custom.update', $custom->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="name">Status Transaksi</label>
                                            <select name="payment_status" class="form-control" id="">
                                                <option value="{{ $custom->payment_status }}" selected="true"
                                                    disabled="disabled">
                                                    --{{ $custom->payment_status }}--</option>
                                                <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                                                <option value="Terbayar">Sukses</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="estimasi_biaya">Total Pembayaran</label>
                                            <input type="number" name="estimasi_biaya"
                                                value="{{ $custom->estimasi_biaya }}" class="form-control">
                                            <small class="text-muted">*Jangan ada titik koma</small>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="estimasi_pengerjaan">Durasi Pengerjaan</label>
                                            <input type="number" name="estimasi_pengerjaan"
                                                value="{{ $custom->estimasi_pengerjaan }}" class="form-control">
                                            <small class="text-muted">*Isi dengan angka/jumlah hari kerja</small>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="name">Status Pengerjaan</label>
                                            <select name="status_pengerjaan" class="form-control" id="">
                                                <option value="{{ $custom->status_pengerjaan }}" selected="true"
                                                    disabled="disabled">
                                                    --{{ $custom->status_pengerjaan }}--</option>
                                                <option value="PENDING">Pending</option>
                                                <option value="DIPROSES">Diproses</option>
                                                <option value="PENGUKURAN">Pengukuran</option>
                                                <option value="PERAKITAN">Perakitan</option>
                                                <option value="PENGECATAN">Pengecatan</option>
                                                <option value="SELESAI">SELESAI</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row mt-4">
                                        <div class="col text-right">
                                            <a href="{{ route('custom.index') }}" class="btn btn-danger">Kembali</a>
                                            <button type="submit" class="btn btn-success">Update Transaksi</button>
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
