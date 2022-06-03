@extends('layouts.dashboard')

@section('title')
    Mebel 54 Malang - Product Detail
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Adidas Shoe Sneakers</h2>
                <nav class="nav-bread mt-4 mb-3">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard-product') }}" class="text-dark">Products</a>
                        </li>
                        <li class="breadcrumb-item active">Product Detail</li>
                    </ol>
                </nav>
            </div>

            <div class="dashboard-content mt-4 mt-ld-5">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-5">
                                <form action="{{ route('dashboard-product-update', $product->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="users_id" value="{{ Auth::user()->id }}" id="">
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Product Name</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    value="{{ $product->name }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="number" class="form-control" name="price"
                                                    value="{{ $product->price }}" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="category">Kategori</label>
                                                <select name="categories_id" class="form-control" id="">
                                                    <option value="{{ $product->categories_id }}">Tidak
                                                        Ganti({{ $product->category->name }})</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="editor" class="form-control" cols="30" rows="10">{!! $product->description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success px-4 py-2">
                                        Update Product
                                    </button>
                                    <a href="#" class="btn btn-danger px-4 py-2 ml-sm-3 mt-3 mt-sm-0">Delete Product</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-5">

                                <div class="row">
                                    @foreach ($product->galleries as $gallery)
                                        <div class="col-md-4">
                                            <div class="img-box-detail position-relative">
                                                <a href="{{ route('dashboard-product-gallery-delete', $gallery->id) }}"
                                                    class="btn-delete-detail badge bg-warning rounded-circle p-2 d-flex position-absolute justify-content-center align-items-center">
                                                    <i class="bx bx-x bx-sm" style="color: #fff"></i>
                                                </a>
                                                <div class="dashboard-detail-thumbnail">
                                                    <img src="{{ Storage::url($gallery->photos) }}"
                                                        class="img-fluid rounded-lg dashboard-detail-img" alt="" />
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <form action="{{ route('dashboard-product-gallery-upload', $product->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="products_id" value="{{ $product->id }}">
                                    <input type="file" name="photos" id="file" style="display: none;"
                                        onchange="form.submit()">
                                    <button type="button" onclick="thisFileUpload()" class="btn btn-success mt-4">Upload
                                        Photo
                                        Product</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
    <script>
        function thisFileUpload() {
            document.getElementById('file').click();
        }
    </script>
@endpush
