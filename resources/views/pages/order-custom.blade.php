@extends('layouts.app')

@section('title')
    Mebel 54 Malang - Order Custom
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
                                <li class="breadcrumb-item active">Order Custom</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-cart">
            <div class="container">
                <p class="text-center">Wujudkan Furniture Impian Anda Bersama Kami</p>
                <form action="{{ route('order-custom-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card mt-4 p-3">
                        <div class="row text-center">
                            <div class="col">
                                <h3>Layanan Pemesanan Custom</h3>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_number">No Whatsapp</label>
                                    <input type="number" class="form-control" name="phone_number" id="phone_number"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="address">Alamat 1</label>
                                    <input type="text" class="form-control" name="address_one"
                                        placeholder="ex: Ruko jaya abadi">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="address">Alamat 2</label>
                                    <input type="text" class="form-control" name="address_two"
                                        placeholder="ex: jl.panjaitan No.20, Kota Malang, Jawa timur">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Saya membutuhkan furniture untuk</h5>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="cafe" name="needs"
                                                        id="cafe">
                                                    <label class="form-check-label" for="cafe">
                                                        Cafe/Restoran
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="rumah" name="needs"
                                                        id="rumah">
                                                    <label class="form-check-label" for="rumah">
                                                        Rumah
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="kantor" name="needs"
                                                        id="kantor">
                                                    <label class="form-check-label" for="kantor">
                                                        Kantor/Sekolah
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="kantor" name="needs"
                                                        id="apartment">
                                                    <label class="form-check-label" for="apartment">
                                                        Apartment
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Pilih Kategori Furniture</h5>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="categories"
                                                        value="kitchen" id="kitchen">
                                                    <label class="form-check-label" for="kitchen">
                                                        Kitchen Set
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="lemari"
                                                        name="categories" id="lemari">
                                                    <label class="form-check-label" for="lemari">
                                                        Lemari
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="categories"
                                                        value="ranjang" id="ranjang">
                                                    <label class="form-check-label" for="ranjang">
                                                        Ranjang
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="categories"
                                                        value="meja" id="meja">
                                                    <label class="form-check-label" for="meja">
                                                        Meja
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="categories"
                                                        value="sofa" id="sofa">
                                                    <label class="form-check-label" for="sofa">
                                                        Sofa
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="categories"
                                                        value="rak" id="rak">
                                                    <label class="form-check-label" for="rak">
                                                        Rak
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5>Referensi Desain Furniture Anda</h5>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">Upload Desain</label>
                                    <input type="file" class="form-control" placeholder="upload desain" name="photos"
                                        id="">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5>Keterangan lainnya (ukuran, warna, jumlah, dll)</h5>
                                <textarea name="caption" id="editor" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <button class="btn btn-danger mt-5">Kirim Pesanan</button>
                    </div>
                </form>

            </div>
        </section>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script src="/script/navbar.js"></script>
@endpush
