@extends('layouts.admin')

@section('title')
    Admin Dashboard - Kelola Banner Homepage
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Admin Dashboard - Kelola Banner Homepage</h2>
                <p class="dashboard-subtitle">Look what you have made today!</p>
            </div>

            <div class="dashboard-content mt-4 mt-ld-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('banner-homepage.create') }}" class="btn btn-danger mb-3">
                                    + Tambah Banner Baru
                                </a>
                                <div class="table-responsive">
                                    <table class="table table-hover scrolled w-100" id="crudTable">
                                        <thead>
                                            <td>ID</td>
                                            <td>Nama Event</td>
                                            <td>Photo</td>
                                            <td>Aksi</td>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: "{!! url()->current() !!}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'event',
                    name: 'event'
                },
                {
                    data: 'photos',
                    name: 'photos'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '15%'

                }
            ]
        })
    </script>
@endpush
