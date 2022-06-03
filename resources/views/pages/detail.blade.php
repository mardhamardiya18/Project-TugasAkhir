@extends('layouts.app')

@section('title')
    Mebel 54 Malang - Product Detail
@endsection

@section('content')
    <div class="page-content page-detail">
        <section class="store-breadcrumb" data-aos="fade-down">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('homepage') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Product Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-gallery" id="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8" data-aos="zoom-in">
                        <transition name="slide-fade" mode="out-in">
                            <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" class="w-100 main-image"
                                alt="" />
                        </transition>
                    </div>
                    <div class="col-lg-2">
                        <div class="row">
                            <div class="col-3 col-lg-12 mt-3 mt-lg-0" data-aos="zoom-in" data-aos-delay="100"
                                v-for="(photo, index) in photos" :key="photo.id">
                                <a href="#" @click="changeActive(index)">
                                    <img :src="photo.url" class="w-100 thumbnail-image"
                                        :class="{active : index == activePhoto}" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-detail">
            <div class="container">
                <div class="row heading-detail">
                    <div class="col-lg-8">
                        <h2>{{ $details->name }}</h2>
                        <p class="owner">Kategori <a class=" text-decoration-none bold"
                                href="{{ route('category-detail', $details->category->slug) }}">{{ $details->category->name }}</a>
                        </p>
                        <p class="price">@currency($details->price)</p>
                    </div>
                    <div class="col-lg-2">
                        @auth
                            <form action="{{ route('add-to-cart', $details->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="btn btn-success btn-block">Tambah ke keranjang</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-danger btn-block">Login untuk melanjutkan</a>
                        @endauth

                    </div>
                </div>
                <div class="row description-detail">
                    <div class="col-12 col-lg-8">
                        <p>
                            {!! $details->description !!}
                        </p>
                    </div>
                </div>
                <div class="row testimoni-heading mt-3">
                    <div class="col-12 col-lg-8">
                        <h5>Customer Review (3)</h5>
                    </div>
                </div>
                <div class="row testimoni-body mt-3">
                    <div class="col-12 col-lg-8">
                        <ul class="list-unstyled">
                            <li class="media">
                                <img src="/images/testi-1.png" width="90" class="rounded" alt="" />
                                <div class="media-body ml-3">
                                    <h5 class="mt-2 mb-1">Hazza Risky</h5>
                                    I thought it was not good for living room. I really happy to
                                    decided buy this product last week now feels like homey.
                                </div>
                            </li>
                            <li class="media mt-3 mt-lg-5">
                                <img src="/images/testi-2.png" width="90" class="rounded" alt="" />
                                <div class="media-body ml-3">
                                    <h5 class="mt-2 mb-1">Farah Maulida</h5>
                                    Color is great with the minimalist concept. Even I thought
                                    it was made by Cactus industry.
                                </div>
                            </li>
                            <li class="media mt-3 mt-lg-5">
                                <img src="/images/testi-3.png" width="90" class="rounded" alt="" />
                                <div class="media-body ml-3">
                                    <h5 class="mt-2 mb-1">Fitri Susanti</h5>
                                    When I saw at first, it was really awesome to have with.
                                    Just let me know if there is another upcoming product like
                                    this.
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var app = new Vue({
            el: "#gallery",
            mounted() {
                AOS.init();
            },
            data: {
                activePhoto: 0,
                photos: [
                    @foreach ($details->galleries as $gallery)
                        {
                        id: {{ $gallery->id }},
                        url: "{{ Storage::url($gallery->photos) }}",
                        },
                    @endforeach


                ],
            },
            methods: {
                changeActive(id) {
                    this.activePhoto = id;
                },
            },
        });
    </script>
    <script src="/script/navbar.js"></script>
@endpush
