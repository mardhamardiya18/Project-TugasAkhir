@extends('layouts.admin')

@section('title')
    Admin Dashboard - Update User
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
                                <form action="{{ route('user.update', $item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="name">Nama Lengkap</label>
                                            <input type="text" name="name" value="{{ $item->name }}" required
                                                class="form-control" autofocus>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="name">Email</label>
                                            <input type="email" name="email" value="{{ $item->email }}" required
                                                class="form-control">
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="name">Password</label>
                                            <input type="password" name="password" class="form-control">
                                            <small class="text-denger">Kosongkan jika tidak ingin ganti password</small>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="name">Roles</label>
                                            <select name="roles" class="form-control">
                                                <option value="{{ $item->roles }}" selected>Tidak Ganti</option>
                                                <option value="ADMIN">Admin</option>
                                                <option value="USER">User</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row mt-4">
                                        <div class="col text-right">
                                            <a href="{{ route('user.index') }}" class="btn btn-danger">Kembali</a>
                                            <button type="submit" class="btn btn-success">Update User</button>
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
