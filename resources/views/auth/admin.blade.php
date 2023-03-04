<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('template') }}/node_modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/components.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</head>

<body>

    <div class="row min-vh-100 justify-content-end"
        style="background-repeat: no-repeat;background-size: cover;background-image:linear-gradient(#000000ad,#000000ad), url({{ asset('bg.jpeg') }}) ">
        <div class="col-md-8 p-md-5 d-flex flex-column align-items-center justify-content-center ">
            {{-- <h1 class="text-white mt-5 pt-5 text-md-start text-center">Selamat datang <br> di aplikasi Absen Siswa --}}
            <h1 style="font-family: Arial, Helvetica, sans-serif"
                class="text-white mt-md-5 pt-md-5 display-4 font-weight-bold fw-bold p-3 text-md-start text-center">
                USPBK
                <b>
                    {{ date('Y') }}
                </b>
            </h1>

        </div>
        <div class="col-md-4 bg-white ">
            <form action="/admin" class="p-md-2 px-3 pt-md-5 mt-5" method="POST">
                @csrf
                {{-- <img src="{{ asset('assets/images/satu.jpg') }}" class="gambar" style="width:40%;"> --}}
                <div class="text">
                    <h2 class="text-center"><b>Login Admin</b></h2>
                    <p class="text-center">Masuk Sebagai Admin Atau Operator</p>
                    <br>
                    <label class="form-label" for="form3Example3">Username :</label>
                    <div class="form-outline mb-4">
                        <input type="text" id="form3Example3" name="username" class=" py-2 form-control form-control"
                            placeholder="Masukkan username" />
                    </div>
                    <label class="form-label" for="form3Example3">password :</label>
                    <div class="form-outline mb-4">
                        <input type="password" id="form3Example3" name="password" class="py-2 form-control form-control"
                            placeholder="Masukkan password" />
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" class="btn w-100 py-2 btn-primary btn-sm"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Masuk</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('template') }}/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('template') }}/assets/js/scripts.js"></script>
    <script src="{{ asset('template') }}/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>
