@extends('layouts.admin')

@section('title')
    Admin Dashboard - Update User
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Admin Dashboard - Update {{ $transaction->code }}</h2>
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
                                <form action="{{ route('transaction.update', $transaction->transaction->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="name">Status Transaksi</label>
                                            <select name="transaction_status" class="form-control" id="">
                                                <option value="{{ $transaction->transaction->transaction_status }}"
                                                    selected="true" disabled="disabled">
                                                    --{{ $transaction->transaction->transaction_status }}--</option>
                                                <option value="Menunggu Pembayaran">Pending</option>
                                                <option value="Terbayar">Sukses</option>
                                                <option value="Gagal">Cancel</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="total_price">Total Pembayaran</label>
                                            <input type="number" name="total_price"
                                                value="{{ $transaction->transaction->total_price }}"
                                                class="form-control">
                                        </div>

                                    </div>
                                    <div class="row mt-4">
                                        <div class="col text-right">
                                            <a href="{{ route('transaction.index') }}" class="btn btn-danger">Kembali</a>
                                            <button type="submit" class="btn btn-success">Update User</button>
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
