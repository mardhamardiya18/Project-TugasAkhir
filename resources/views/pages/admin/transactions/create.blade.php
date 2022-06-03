@extends('layouts.admin')

@section('title')
    Admin Dashboard - Create Product
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Admin Dashboard - Create Product</h2>
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
                                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="name">Nama Produk</label>
                                            <input type="text" name="name" required class="form-control" autofocus>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="users_id">Pemilik</label>
                                            <select name="users_id" class="form-control" id="">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->store_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="categories_id">Pilih Kategori</label>
                                            <select name="categories_id" class="form-control" id="">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="role">Harga</label>
                                            <input type="text" name="price" required class="form-control">
                                            <small class="text-danger">notice : Jangan cantumkan koma(,) pada
                                                nominal</small>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="description">Deskripsi</label>
                                            <textarea name="description" id="editor" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col text-right">
                                            <a href="{{ route('product.index') }}" class="btn btn-danger">Kembali</a>
                                            <button type="submit" class="btn btn-success">Save Product</button>
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

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
@endpush
