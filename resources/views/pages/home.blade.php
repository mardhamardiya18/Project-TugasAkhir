@extends('layouts.app')

@section('title')
    Mebel 54 Malang - Wujudkan Furniture Impianmu
@endsection

@section('content')
    <div class="page-content page-home">
        <section class="store-carousel mb-5">
            <div class="container">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($banners as $index => $banner)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}"
                                class="active"></li>
                        @endforeach

                    </ol>
                    <div class="carousel-inner">
                        @forelse ($banners as $index=>$banner)
                            <div class="carousel-item @if ($index == '0') {{ 'active' }} @endif""> <img class="
                                
                                
                                                              
                                d-block w-100"
                                src="{{ Storage::url($banner->photos) }}" alt="First slide" />
                    </div>
                @empty
                    <div class="row text-center">
                        <div class="col-12">
                            <p>Banner Not Found!</p>
                        </div>
                    </div>
                    @endforelse

                </div>
            </div>
    </div>
    </section>
    <section class="store-trend-categories mt-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h5>Kategori Terpopuler</h5>
                </div>
            </div>
            <div class="row mt-3">
                @php
                    $increment = 0;
                @endphp
                @forelse ($categories as $category)
                    <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $increment += 100 }}">

                        <a href="{{ route('category-detail', $category->slug) }}" class="component-categories d-block">
                            <div class="categories-image">
                                <img src="{{ Storage::url($category->photo) }}" class="w-100" alt="" />
                            </div>
                            <p class="categories-text">{{ $category->name }}</p>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <p>Data Category Not Found</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <section class="store-new-product">
        <div class="container">
            <div class="row mt-5">
                <div class="col">
                    <h5>Produk Terbaru</h5>
                </div>
            </div>
            <div class="row mt-3">
                @php
                    $incrementProduct = 0;
                @endphp
                @forelse ($products as $product)
                    <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up"
                        data-aos-delay="{{ $incrementProduct += 100 }}">
                        <a href="{{ route('detail', $product->slug) }}" class="component-product d-block text-dark">
                            <div class="product-thumbnail">
                                <div class="product-image" style="
                                                                                                                          @if ($product->galleries->count()) background-image : url('{{ Storage::url($product->galleries->first()->photos) }}');

                                    @else
                                    background-color : #eee; @endif
                                                                                                                        ">
                                </div>
                            </div>
                            <p class="product-text m-0">{{ $product->name }}</p>
                            <small class="text-muted">{{ $product->category->name }}</small>
                            <p class="product-price mt-4">@currency($product->price)</p>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-danger">Product Not Found!</p>
                    </div>
                @endforelse


            </div>
        </div>
    </section>
    </div>
@endsection

@push('addon-script')
    <script src="https://unpkg.com/vue-toasted"></script>
@endpush
