<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="img/svg" href="/images/logo-icon.svg" />

    <title>@yield('title')</title>

    {{-- style --}}
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
</head>

<body>

    <section class="page-content page-success align-items-center justify-content-center d-flex">
        <div class="container">
            <div class="row justify-content-center align-items-center text-center" data-aos="zoom-in">
                <div class="col-md-6">
                    <img src="images/success.svg" class="mb-5 img-fluid" alt="" />
                    <h2>Transaction Processed!</h2>
                    <p class="mt-3">
                        Silahkan tunggu konfirmasi email dari kami dan kami akan
                        menginformasikan resi secept mungkin!
                    </p>
                    <div class="btn-sukses">
                        <a href="{{ route('dashboard-home') }}" class="btn btn-danger w-50 mt-5">My Dashboard</a>
                        <a href="{{ route('homepage') }}" class="btn btn-signup w-50 mt-3">Go to Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    @include('includes.footer')

    {{-- Script --}}
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
</body>

</html>
