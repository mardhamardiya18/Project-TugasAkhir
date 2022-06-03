@extends('layouts.dashboard')

@section('title')
    Mebel 54 Malang - Account Setting
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">My Account</h2>
                <p class="dashboard-subtitle">Update your current profile</p>
            </div>


            <div class="dashboard-content mt-4 mt-ld-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('dashboard-redirect-setting', 'dashboard-account-setting') }}"
                            id="form-cart" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    @if (Auth::user()->profile_picture)
                                        <img src="{{ Storage::url(Auth::user()->profile_picture) }}"
                                            class="rounded-circle profile-picture mr-2" width="150" height="150"
                                            style="object-fit: cover" alt="" />
                                    @elseif (Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" class="rounded-circle profile-picture mr-2"
                                            alt="" />
                                    @else
                                        <img src="{{ Auth::user()->gravatar() }}"
                                            class="rounded-circle profile-picture mr-2" alt="" />
                                    @endif
                                    <div class="form-group">
                                        <label for="profile_picture">Update Photo</label>
                                        <input type="file" name="profile_picture" class="form-control" id="">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" value="{{ $user->email }}"
                                            class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" />
                                        <small class="text-danger">*kosongkan jika tidak diganti</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address_one">Alamat 1</label>
                                        <input type="text" name="address_one" value="{{ $user->address_one }}"
                                            class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address_two">Alamat 2</label>
                                        <input type="text" name="address_two" value="{{ $user->address_two }}"
                                            class="form-control" />
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="provinces_id">Provinsi</label>
                                        <select name="provinces_id" id="province_id" v-if="provinces" v-model="provinces_id"
                                            class="form-control">
                                            <option v-for="province in provinces" :value="province.id">
                                                @{{ province.name }}
                                            </option>
                                        </select>
                                        <select v-else class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="regencies_id">Kota/Kabupaten</label>
                                        <select name="regencies_id" id="regencies_id" v-if="regencies"
                                            v-model="regencies_id" class="form-control">

                                            <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}
                                            </option>
                                        </select>
                                        <select v-else class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="districts_id">Kecamatan</label>
                                        <select name="districts_id" id="districts_id" v-if="districts"
                                            v-model="districts_id" class="form-control">
                                            <option v-for="district in districts" :value="district.id">
                                                @{{ district.name }}
                                            </option>
                                        </select>
                                        <select v-else class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="villages_id">Kelurahan</label>
                                        <select name="villages_id" id="villages_id" v-if="villages" v-model="villages_id"
                                            class="form-control">
                                            <option v-for="village in villages" :value="village.id">@{{ village.name }}
                                            </option>
                                        </select>
                                        <select v-else class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="zip_code">Kode Pos</label>
                                        <input type="number" name="zip_code" value="{{ $user->zip_code }}"
                                            class="form-control" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number">Nomor Telepon</label>
                                        <input type="text" name="phone_number" value="{{ $user->phone_number }}"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success px-5 mt-3">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        var app = new Vue({
            el: "#form-cart",
            mounted() {
                AOS.init();
                this.getProvincesData();
            },
            data: {
                provinces: null,
                regencies: null,
                districts: null,
                villages: null,
                provinces_id: null,
                regencies_id: null,
                districts_id: null,
                villages_id: null
            },
            methods: {
                getProvincesData() {
                    var self = this
                    axios.get('{{ route('province') }}')
                        .then(function(response) {
                            self.provinces = response.data
                        })
                },
                getRegenciesData() {
                    var self = this
                    axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                        .then(function(response) {
                            self.regencies = response.data
                        })
                },
                getDistrictsData() {
                    var self = this
                    axios.get('{{ url('api/districts') }}/' + self.regencies_id)
                        .then(function(response) {
                            self.districts = response.data
                        })
                },
                getVillagesData() {
                    var self = this
                    axios.get('{{ url('api/villages') }}/' + self.districts_id)
                        .then(function(response) {
                            self.villages = response.data
                        })
                },
            },
            watch: {
                provinces_id: function(val, oldVal) {
                    this.regencies_id = null;
                    this.getRegenciesData();
                },
                regencies_id: function(val, oldVal) {
                    this.districts_id = null;
                    this.getDistrictsData();
                },
                districts_id: function(val, oldVal) {
                    this.villages_id = null;
                    this.getVillagesData();
                }
            }
        });
    </script>
    <script src="/script/navbar.js"></script>
@endpush
