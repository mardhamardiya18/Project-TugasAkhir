@extends('layouts.dashboard')

@section('title')
    Mebel 54 Malang - Transaction
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">List Pesanan</h2>
                <p class="dashboard-subtitle">
                    Pantau Pesanan Furniture Anda Disini
                </p>
            </div>

            <div class="dashboard-content mt-4 mt-ld-5">
                <div class="row mt-4 recent-transaction">
                    <div class="col-md-12">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                    role="tab" aria-controls="pills-home" aria-selected="true">Pesanan Jadi</a>
                            </li>
                            <li class="nav-item ml-5" role="presentation">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                    role="tab" aria-controls="pills-profile" aria-selected="false">Pesanan Custom</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                @forelse ($buyTransactions as $transaction)
                                    <a href="{{ route('dashboard-transaction-detail', $transaction->id) }}"
                                        class="card card-list mt-3">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-lg-1 mb-3">
                                                    <div class="img-box">
                                                        <img src="{{ Storage::url($transaction->product->galleries->first()->photos) }}"
                                                            class="img-fluid" alt="" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 detail">
                                                    {{ $transaction->product->name }}
                                                </div>
                                                <div class="col-lg-3 text-lg-center detail">
                                                    Rp {{ number_format($transaction->price) }}
                                                </div>
                                                <div class="col-lg-1 text-lg-center detail">
                                                    <small
                                                        class="text-white {{ $transaction->transaction->transaction_status == 'Menunggu Pembayaran'
                                                            ? 'badge badge-warning'
                                                            : ($transaction->transaction->transaction_status == 'Terbayar'
                                                                ? 'badge badge-success'
                                                                : ($transaction->transaction->transaction_status == 'Gagal'
                                                                    ? 'badge badge-danger'
                                                                    : '')) }}">{{ $transaction->transaction->transaction_status }}</small>
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
                                @empty
                                    <p>Upss..belum ada pesanan nih</p>
                                @endforelse

                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                @forelse ($customs as $custom)
                                    <a href="{{ route('order-custom-detail', $custom->id) }}" class="card card-list mt-3">
                                        <div class="card-body">
                                            <div class="row align-items-center py-3">
                                                <div class="col-lg-2 detail">
                                                    {{ $custom->custom->code }}
                                                </div>
                                                <div class="col-lg-2 detail">
                                                    {{ $custom->custom->user->name }}
                                                </div>
                                                <div class="col-lg-2 detail">
                                                    {{ $custom->custom->categories }}
                                                </div>
                                                <div class="col-lg-2 text-white status detail ">
                                                    <small
                                                        class="{{ $custom->payment_status == 'Menunggu Pembayaran'
                                                            ? 'badge badge-warning'
                                                            : ($custom->payment_status == 'Terbayar'
                                                                ? 'badge badge-success'
                                                                : ($transaction->transaction->transaction_status == 'Gagal'
                                                                    ? 'badge badge-danger'
                                                                    : '')) }}">
                                                        {{ $custom->payment_status }}
                                                    </small>
                                                </div>

                                                <div class="col-lg-3 text-lg-center detail">
                                                    @php
                                                        $date = $custom->created_at;
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
                                @empty
                                    <h3>Upss..belum ada pesanan nih</h3>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
