@extends('layouts.admin')

@section('title')
    Admin Dashboard - Pesanan Jadi
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Admin Dashboard - Pesanan Jadi</h2>
                <p class="dashboard-subtitle">Look what you have made today!</p>
            </div>

            <div class="dashboard-content mt-4 mt-ld-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-hover scrolled w-100" id="crudTable">
                                        <thead>
                                            <td>ID</td>
                                            <td>Nama Pembeli</td>
                                            <td>Status Transaksi</td>
                                            <td>Tanggal Transaksi</td>
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
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'print',
                    title: 'transaction for print',
                    exportOptions: {
                        stripHtml: false,
                        columns: [0, 1, 2, 3]
                        //specify which column you want to print

                    }
                },
                {
                    extend: 'excelHtml5',
                    title: 'Transactions for excel',
                    exportOptions: {
                        stripHtml: false,
                        columns: [0, 1, 2, 3]
                        //specify which column you want to print

                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Transactions for pdf',
                    download: 'open',

                    exportOptions: {
                        stripHtml: false,
                        columns: [0, 1, 2, 3]
                        //specify which column you want to print
                    }
                },

            ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'user.name',
                    name: 'user.name'
                },
                {
                    data: 'transaction_status',
                    name: 'transaction_status'
                },
                {
                    data: 'created_at',
                    name: 'created_at',

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
