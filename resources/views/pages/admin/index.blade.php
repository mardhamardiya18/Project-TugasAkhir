@extends('layouts.admin')

@section('title')
    Admin Dashboard - Home
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Admin Dashboard</h2>
                <p class="dashboard-subtitle">Look what you have made today!</p>
            </div>

            <div class="dashboard-content mt-4 mt-ld-5">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card mb-md-3 mb-2 pl-3">
                            <div class="card-body">
                                <h5 class="card-dashboard-title">Customer</h5>
                                <h2 class="card-dashboard-subtitle">{{ $customer }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card mb-2 mb-md-0 pl-3">
                            <div class="card-body">
                                <h5 class="card-dashboard-title">Revenue</h5>
                                <h2 class="card-dashboard-subtitle">Rp {{ number_format($revenue) }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card mb-2 pl-3">
                            <div class="card-body">
                                <h5 class="card-dashboard-title">Transaksi Sukses</h5>
                                <h2 class="card-dashboard-subtitle">{{ $transaction_success }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card mb-2 pl-3">
                            <div class="card-body">
                                <h5 class="card-dashboard-title">Transaksi Pending</h5>
                                <h2 class="card-dashboard-subtitle">{{ $transaction_pending }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4 recent-transaction">
                    <div class="col-md-12">
                        <h3 class="title-recent">Transaksi Terbaru</h3>
                        @foreach ($transaction_data as $transaction)
                            <a href="{{ route('transaction.show', $transaction->id) }}" class="card card-list mt-3">
                                <div class="card-body py-5">
                                    <div class="row align-items-center">

                                        <div class="col-lg-2 text-lg-center detail">
                                            {{ $transaction->transaction->user->name }}
                                        </div>
                                        <div class="col-lg-3 text-lg-center detail">
                                            <small
                                                class="text-white {{ $transaction->transaction->transaction_status == 'Menunggu Pembayaran'
                                                    ? 'badge badge-warning'
                                                    : ($transaction->transaction->transaction_status == 'Terbayar'
                                                        ? 'badge badge-success'
                                                        : ($transaction->transaction->transaction_status == 'Gagal'
                                                            ? 'badge badge-danger'
                                                            : '')) }}">{{ $transaction->transaction->transaction_status }}</small>
                                        </div>
                                        <div class="col-lg-2 text-lg-center detail">
                                            Rp {{ number_format($transaction->price) }}
                                        </div>
                                        <div class="col-lg-4 text-lg-center detail">
                                            @php
                                                $date = $transaction->created_at;
                                                $date_carbon = \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMM Y | H:m');
                                            @endphp
                                            {{ $date_carbon }}
                                        </div>
                                        <div class="col-lg-1">
                                            <i class="bx bx-chevron-right bx-sm"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
