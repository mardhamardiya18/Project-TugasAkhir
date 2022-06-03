@extends('layouts.admin')

@section('title')
    Admin Dashboard - Banner Event Baru
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Admin Dashboard - Buat Banner Event Baru</h2>
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
                                <form action="{{ route('banner-homepage.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="event">Nama Event</label>
                                            <input type="text" name="event" required class="form-control" autofocus>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="photos">Upload Photo</label>
                                            <input type="file" name="photos" required class="form-control">
                                            <small class="text-danger">Direkomendasikan untuk resolusi 950 x 360
                                                px</small>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col text-right">
                                            <a href="{{ route('banner-homepage.index') }}"
                                                class="btn btn-danger">Kembali</a>
                                            <button type="submit" class="btn btn-success">Save Category</button>
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
