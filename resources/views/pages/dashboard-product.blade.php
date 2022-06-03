@extends('layouts.dashboard')

@section('title')
    Mebel 54 Malang - Product
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">My Products</h2>
                <p class="dashboard-subtitle">Manage it well and get money</p>
            </div>

            <div class="dashboard-content mt-4 mt-ld-5">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('dashboard-product-create') }}" class="btn btn-success">Add New Product</a>
                    </div>
                </div>
                <div class="row mt-3 mt-sm-5">
                    @foreach ($products as $product)
                        <div class="col-md-3">
                            <a href="{{ route('dashboard-product-detail', $product->id) }}" class="card p-3 mt-3">
                                <div class="product-dashboard-thumbnail">
                                    <img src="{{ Storage::url($product->galleries->first()->photos) }}"
                                        class="rounded-lg img-fluid product-dashboard-img" alt="" />
                                </div>

                                <div class="card-body p-0 mt-4">
                                    <h5 class="card-text text-dark">
                                        {{ $product->name }}
                                    </h5>
                                    <p class="card-text text-muted">by {{ $product->category->name }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
