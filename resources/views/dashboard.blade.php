<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>RENTALBOSS</title>
    <link rel="icon" type="image/x-icon" href="{{asset('startbootstrap-grayscale-gh-pages/assets/favicon.ico')}}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('startbootstrap-grayscale-gh-pages/css/styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('shoppers-gh-pages/fonts/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('shoppers-gh-pages/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('shoppers-gh-pages/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('shoppers-gh-pages/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('shoppers-gh-pages/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('shoppers-gh-pages/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('shoppers-gh-pages/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('shoppers-gh-pages/css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: black;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
            /* Adjust the width to move buttons further away */
        }

        .carousel-control-prev {
            left: -5%;
            /* Move the left button further left */
        }

        .carousel-control-next {
            right: -5%;
            /* Move the right button further right */
        }

        body {
            background: white;
        }

        .gtco-testimonials {
            position: relative;
            margin-top: 30px;

            h2 {
                font-size: 30px;
                text-align: center;
                color: #333333;
                margin-bottom: 50px;
            }

            .owl-stage-outer {
                padding: 30px 0;
            }

            .owl-nav {
                display: none;
            }

            .owl-dots {
                text-align: center;

                span {
                    position: relative;
                    height: 10px;
                    width: 10px;
                    border-radius: 50%;
                    display: block;
                    background: #fff;
                    border: 2px solid #01b0f8;
                    margin: 0 5px;
                }

                .active {
                    box-shadow: none;

                    span {
                        background: #01b0f8;
                        box-shadow: none;
                        height: 12px;
                        width: 12px;
                        margin-bottom: -1px;
                    }
                }
            }

            .card {
                background: #fff;
                box-shadow: 0 8px 30px -7px #c9dff0;
                margin: 0 20px;
                padding: 0 10px;
                border-radius: 20px;
                border: 0;

                .card-img-top {
                    max-width: 100px;
                    border-radius: 50%;
                    margin: 15px auto 0;
                    box-shadow: 0 8px 20px -4px #95abbb;
                    width: 100px;
                    height: 100px;
                }

                h5 {
                    color: #01b0f8;
                    font-size: 21px;
                    line-height: 1.3;

                    span {
                        font-size: 18px;
                        color: #666666;
                    }
                }

                p {
                    font-size: 18px;
                    color: #555;
                    padding-bottom: 15px;
                }
            }

            .active {
                opacity: 0.5;
                transition: all 0.3s;
            }

            .center {
                opacity: 1;

                h5 {
                    font-size: 24px;

                    span {
                        font-size: 20px;
                    }
                }

                .card-img-top {
                    max-width: 100%;
                    height: 120px;
                    width: 120px;
                }
            }
        }

        @media (max-width: 767px) {
            .gtco-testimonials {
                margin-top: 20px;
            }
        }

        .owl-carousel {
            .owl-nav button {

                &.owl-next,
                &.owl-prev {
                    outline: 0;
                }
            }

            button.owl-dot {
                outline: 0;
            }
        }
    </style>
</head>
<x-app-layout>
</x-app-layout>

<body id="page-top">
    <!-- Navigation-->


    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase">RentalBoss</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">Tugas Besar Desain Pemograman Web</h2>

                </div>
            </div>
        </div>
    </header>
    <!-- About-->
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-white mb-4">Perkenalan diri</h2>
                    <p class="text-white-50">
                        Perkenalkan nama saya Abdurrahman Rauf Budiman dari kelas C2
                    </p>
                </div>
            </div>
            {{-- <img class="img-fluid" src="{{asset('startbootstrap-grayscale-gh-pages/assets/img/ipad.png')}}"
                alt="..." /> --}}
        </div>
    </section>
    <!-- Motivation Card -->
    <figure class="note note-secondary p-4">
        <blockquote class="blockquote">
            <p class="pb-2" style="text-align: center">
                "Musuh terbesar dari pengetahuan bukanlah ketidakpedulian, tetapi ilusi mengenai pengetahuan."
            </p>
        </blockquote>
        <figcaption class="blockquote-footer mb-0" style="text-align: center">
            Stephen Hawking
        </figcaption>
    </figure>

    {{-- testimonial --}}
    <div class="gtco-testimonials">
        <h2>Terbukti Website Keren</h2>
        <div class="owl-carousel owl-carousel1 owl-theme">
            <div>
                <div class="card text-center"><img class="card-img-top"
                        src="{{ asset('images/deddycorubir.jpg') }}"
                        alt="">
                    <div class="card-body">
                        <h5>Daddy<br />
                            <span> Presenter </span>
                        </h5>
                        <p class="card-text">“ keren banget cuy, saya bangga ” </p>
                    </div>
                </div>
            </div>
            <div>
                <div class="card text-center"><img class="card-img-top"
                        src="{{ asset('images/komeng.jpg') }}"
                        alt="">
                    <div class="card-body">
                        <h5>Mengko<br />
                            <span> Pimpinan </span>
                        </h5>
                        <p class="card-text">“ jadi pengen camping ” </p>
                    </div>
                </div>
            </div>
            <div>
                <div class="card text-center"><img class="card-img-top"
                        src="{{ asset('images/radit.jpeg') }}"
                        alt="">
                    <div class="card-body">
                        <h5>Radit<br />
                            <span> Komedian </span>
                        </h5>
                        <p class="card-text">“ rentalboss sudah terverifikasi oleh saya ” </p>
                    </div>
                </div>
            </div>
            <div>
                <div class="card text-center"><img class="card-img-top"
                        src="{{ asset('images/dea.jpeg') }}"
                        alt="">
                    <div class="card-body">
                        <h5>Rizal<br />
                            <span> Programmer </span>
                        </h5>
                        <p class="card-text">“ panutan saya ini ” </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Section -->
    <div class="site-section block-3 site-blocks-2 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Produk yang dijual</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="nonloop-block-3 owl-carousel">
                        @foreach ($barangs as $index => $barang)
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="{{ asset('images/' . $barang->foto_barang) }}"
                                        alt="{{ $barang->nama_barang }}" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3>{{ $barang->nama_barang }}</h3>
                                    <p class="text-black-50 mb-0">Harga: Rp {{ number_format($barang->harga_barang, 2)
                                        }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer-->
    <footer class="footer bg-black small text-center text-white-50">
        <div class="container px-4 px-lg-5">&copy; RENTALBOSS 2024</div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{asset('startbootstrap-grayscale-gh-pages/js/scripts.js')}}"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{asset('shoppers-gh-pages/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('shoppers-gh-pages/js/jquery-ui.js')}}"></script>
    <script src="{{asset('shoppers-gh-pages/js/popper.min.js')}}"></script>
    <script src="{{asset('shoppers-gh-pages/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('shoppers-gh-pages/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('shoppers-gh-pages/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('shoppers-gh-pages/js/aos.js')}}"></script>

    <script src="{{asset('shoppers-gh-pages/js/main.js')}}"></script>
    <script>
        (function () {
    "use strict";

    var carousels = function () {
        $(".owl-carousel1").owlCarousel({
        loop: true,
        center: true,
        margin: 0,
        responsiveClass: true,
        nav: false,
        responsive: {
            0: {
            items: 1,
            nav: false
            },
            680: {
            items: 2,
            nav: false,
            loop: false
            },
            1000: {
            items: 3,
            nav: true
            }
        }
        });
    };

    (function ($) {
        carousels();
    })(jQuery);
    })();
    </script>
</body>

</html>