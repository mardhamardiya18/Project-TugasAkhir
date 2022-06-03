@extends('layouts.app')

@section('title')
    Mebel 54 Malang - Cart
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
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-cart">
            <div class="container">
                <div class="row" data-aos="fade-down" data-aos-delay="100">
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart">
                            <thead>
                                <tr>
                                    <td>Image</td>
                                    <td>Name &amp; Seller</td>
                                    <td>Price</td>
                                    <td>Menu</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @forelse ($carts as $cart)
                                    <tr>
                                        <td>
                                            <img src="{{ Storage::url($cart->product->galleries->first()->photos) }}"
                                                class="cart-img" alt="" />
                                        </td>
                                        <td>
                                            <p class="title">{{ $cart->product->name }}</p>
                                            <p class="subtitle">by {{ $cart->user->store_name }}</p>
                                        </td>
                                        <td>
                                            <p class="title">@currency($cart->product->price)</p>
                                            <p class="subtitle">Rupiah</p>
                                        </td>
                                        <td>
                                            <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-cart">Remove</button>
                                            </form>

                                        </td>
                                    </tr>
                                    @php
                                        $totalPrice += $cart->product->price;
                                    @endphp
                                @empty
                                    <tr>
                                        <td class="text-center py-5" colspan="100">Keranjang Belanjanya Masih
                                            Kosong
                                            Nih😁</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-5" data-aos="fade-down" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h5>Shipping Details</h5>
                    </div>
                </div>
                <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data" id="form-cart">
                    @csrf

                    <input type="hidden" name="total_price" id="" :value="getTotalFinal">
                    <div class="row mt-4" data-aos="fade-up" data-aos-delay="100">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="address_one">Alamat 1</label>
                                <input type="text" class="form-control" required name="address_one"
                                    value="{{ Auth::user()->address_one }}" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="address_two">Alamat 2</label>
                                <input type="text" class="form-control" required name="address_two"
                                    value="{{ Auth::user()->address_two }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="provinces_id">Provinsi</label>
                                <select name="provinces_id" id="province_id" required v-if="provinces"
                                    v-model="provinces_id" class="form-control">
                                    <option v-for="province in provinces" :value="province.id">@{{ province.name }}
                                    </option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="regencies_id">Kota/Kabupaten</label>
                                <select name="regencies_id" required id="regencies_id" v-if="regencies"
                                    v-model="regencies_id" class="form-control">
                                    <option v-for="regency in regencies" :value="regency.id">
                                        @{{ regency.name }}
                                    </option>
                                </select>
                                <select v-else class="form-control"></select>
                                @{{ kota }}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="districts_id">Kecamatan</label>
                                <select name="districts_id" required id="districts_id" v-if="districts"
                                    v-model="districts_id" class="form-control">
                                    <option v-for="district in districts" :value="district.id">@{{ district.name }}
                                    </option>
                                </select>
                                <select v-else class="form-control"></select>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="villages_id">Kelurahan</label>
                                <select name="villages_id" required id="villages_id" v-if="villages" v-model="villages_id"
                                    class="form-control">
                                    <option v-for="village in villages" :value="village.id">@{{ village.name }}
                                    </option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="zip_code">Postal Code</label>
                                <input type="number" required class="form-control" name="zip_code"
                                    placeholder="ex : 40328" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="phone_number">Mobile Number</label>
                                <input type="number" required class="form-control" name="phone_number"
                                    value="{{ Auth::user()->phone_number }}" />
                            </div>
                        </div>


                    </div>
                    <div class="row mt-4" data-aos="fade-up" data-aos-delay="150">
                        @php
                            $ongkir = 200000;
                        @endphp
                        <div class="col-12">
                            <h5>Payment Informations</h5>
                        </div>
                        <div class="col-4 col-md-4">
                            <div v-if="regencies_id != 3573">
                                <div class="title text-success">+ Rp {{ number_format($ongkir) }}</div>
                                <div class="subtitle">Biaya Pengiriman</div>
                                <small class="text-muted">*di luar Kota Malang dikenakan biaya</small>
                            </div>
                            <div v-else>
                                <div class="title text-success">FREE ONGKIR</div>
                                <div class="subtitle">Biaya Pengiriman</div>
                                <small class="text-muted">*Khusus Wilayah Kota Malang</small>
                            </div>

                        </div>
                        <div class="col-4 col-md-2 mt-3 mt-md-0">
                            <div class="title text-success">Rp {{ number_format($totalPrice) }}</div>
                            <div class="subtitle">Total Belanja</div>
                        </div>
                        <div class="col-4 col-md-2 mt-3 mt-md-0">
                            <div class="title text-success">Rp @{{ getTotalFinal }}</div>
                            <div class="subtitle">Total Keseluruhan</div>
                        </div>
                        <div class="col-8 col-md-3 d-flex align-items-center mt-3 mt-md-0 ml-auto">
                            @php
                                $cart = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                            @endphp

                            @if ($cart > 0)
                                <button type="submit" class="btn btn-danger btn-block px-4">Checkout Now</button>
                            @else
                                <button type="#" disabled class="btn btn-danger btn-block px-4">Checkout Now</button>
                            @endif

                        </div>
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
                villages_id: null,
                kota: ''

            },
            computed: {
                getTotalFinal() {

                    if (this.regencies_id != 3573) {
                        var ongkir = 200000
                    } else {
                        var ongkir = 0
                    }


                    var totalBelanja = "{{ $totalPrice }}"
                    var totalFinal = parseInt(totalBelanja) + ongkir

                    return totalFinal
                }
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
