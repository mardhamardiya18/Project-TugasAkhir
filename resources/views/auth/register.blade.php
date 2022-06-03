@extends('layouts.app') @section('title')
    Mebel 54 - Register
@endsection
@section('content')
    <div class="page-content page-auth" id="register">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h2>Memulai untuk jual beli dengan cara terbaru</h2>

                    <a href="{{ route('auth-google') }}" class="btn btn-outline-dark d-block mx-auto mt-5"><i
                            class="bx bxl-google"></i> Daftar Menggunakan Google</a>
                    <p class="text-center mt-4">atau</p>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" v-model="name" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" autocomplete="name" required
                                autofocus />
                            @error('name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email Aktif</label>
                            <input type="email" @change="emailCheck()" v-model="email" name="email"
                                value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror"
                                autocomplete="email" :class="{ 'is-invalid': this.email_available }" required />
                            @error('email')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" />
                            @error('password')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password Konfirmasi</label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror" />
                            @error('password_confirmation')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" :disabled="this.email_available" class="btn btn-danger btn-block mt-5">
                            Sign Up Now
                        </button>
                        <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-3">Back to Sign In</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection @push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        Vue.use(Toasted);
        var app = new Vue({
            el: "#register",
            mounted() {
                AOS.init();

            },
            methods: {
                emailCheck() {
                    var self = this
                    axios.get('{{ route('auth-check') }}', {
                            params: {
                                email: this.email
                            }
                        })
                        .then(function(response) {
                            if (response.data == 'Available') {
                                self.$toasted.success(
                                    "Email tersedia!, Silakah melanjutkan untuk mendaftar😙", {
                                        position: "top-center",
                                        duration: "2000",
                                    });
                                self.email_available = false;
                            } else {
                                self.$toasted.error("Email sudah terdaftar!, Silahkan ganti😠", {
                                    position: "top-center",
                                    duration: "2000",
                                });
                                self.email_available = true;
                            }
                            console.log(response);
                        })
                }
            },
            data: {
                name: "",
                email: "",
                password: "",
                email_available: false,

            }
        });
    </script>
@endpush
