@extends('layouts.app')

@section('title')
    Mebel 54 Malang - Category
@endsection

@section('content')
    <div class="page-content page-home">
        <section class="store-trend-categories">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h5>All Categories</h5>
                    </div>
                </div>
                <div class="row">
                    @forelse ($categories as $category)
                        <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up">
                            <a href="{{ route('category-detail', $category->slug) }}" class="component-categories d-block">
                                <div class="categories-image">
                                    <img src="{{ Storage::url($category->photo) }}" class="w-100" alt="" />
                                </div>
                                <p class="categories-text">{{ $category->name }}</p>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>Kategori Tidak Ditemukan!</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </section>
        <section class="store-new-product">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h5>All Products</h5>
                    </div>
                </div>
                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{ route('detail', $product->slug) }}" class="component-product d-block">
                                <div class="product-thumbnail">
                                    <div class="product-image" style="
                                                                @if ($product->galleries->count()) background-image : url('{{ Storage::url($product->galleries->first()->photos) }}')
                                        @else
                                        background-color: #eee; @endif
                                                            "></div>
                                </div>
                                <p class="product-text m-0">{{ $product->name }}</p>
                                <small class="text-muted">{{ $product->category->name }}</small>
                                <p class="product-price mt-4">@currency($product->price)</p>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>Product Tidak Ditemukan!</p>
                        </div>
                    @endforelse


                </div>
            </div>
        </section>
    </div>
@endsection
