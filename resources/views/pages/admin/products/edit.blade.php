@extends('layouts.admin')

@section('title')
    Admin Dashboard - Update Product
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Admin Dashboard - Update {{ $item->name }}</h2>
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
                                <form action="{{ route('product.update', $item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="name">Nama Produk</label>
                                            <input type="text" name="name" required class="form-control"
                                                value="{{ $item->name }}" autofocus>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="users_id">Pemilik</label>
                                            <select name="users_id" class="form-control" id="">
                                                <option value="{{ $item->users_id }}">{{ $item->user->name }}</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="categories_id">Kategori</label>
                                            <select name="categories_id" class="form-control" id="">
                                                <option value="{{ $item->categories_id }}">{{ $item->category->name }}
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="role">Harga</label>
                                            <input type="text" name="price" required value="{{ $item->price }}"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="description">Deskripsi</label>
                                            <textarea name="description" id="editor" cols="30"
                                                rows="10">{!! $item->description !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col text-right">
                                            <a href="{{ route('product.index') }}" class="btn btn-danger">Kembali</a>
                                            <button type="submit" class="btn btn-success">Update Product</button>
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
