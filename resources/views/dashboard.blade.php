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
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                background-color: black;
            }
    
            .carousel-control-prev,
            .carousel-control-next {
                width: 5%; /* Adjust the width to move buttons further away */
            }
    
            .carousel-control-prev {
                left: -5%; /* Move the left button further left */
            }
    
            .carousel-control-next {
                right: -5%; /* Move the right button further right */
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
                        <a class="btn btn-primary btn-grey" href="{{route('list')}}">LETSS GOOOOOOO</a>

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
                {{-- <img class="img-fluid" src="{{asset('startbootstrap-grayscale-gh-pages/assets/img/ipad.png')}}" alt="..." /> --}}
            </div>
        </section>
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
                          <img src="{{ asset('images/' . $barang->foto_barang) }}" alt="{{ $barang->nama_barang }}" class="img-fluid">
                        </figure>
                        <div class="block-4-text p-4">
                          <h3>{{ $barang->nama_barang }}</h3>
                          <p class="text-black-50 mb-0">Harga: Rp {{ number_format($barang->harga_barang, 2) }}</p>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>

        <!-- Signup-->
        <section class="signup-section" id="signup">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-md-10 col-lg-8 mx-auto text-center">
                        <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                        <h2 class="text-white mb-5">Subscribe to receive updates!</h2>
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form class="form-signup" id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <!-- Email address input-->
                            <div class="row input-group-newsletter">
                                <div class="col"><input class="form-control" id="emailAddress" type="email" placeholder="Enter email address..." aria-label="Enter email address..." data-sb-validations="required,email" /></div>
                                <div class="col-auto"><button class="btn btn-primary disabled" id="submitButton" type="submit">Notify Me!</button></div>
                            </div>
                            <div class="invalid-feedback mt-2" data-sb-feedback="emailAddress:required">An email is required.</div>
                            <div class="invalid-feedback mt-2" data-sb-feedback="emailAddress:email">Email is not valid.</div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3 mt-2 text-white">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3 mt-2">Error sending message!</div></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact-->
        <section class="contact-section bg-black">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Address</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50">4923 Market Street, Orlando FL</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Email</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50"><a href="#!">hello@yourdomain.com</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Phone</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50">+1 (555) 902-8832</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social d-flex justify-content-center">
                    <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50"><div class="container px-4 px-lg-5">Copyright &copy; Your Website 2023</div></footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('startbootstrap-grayscale-gh-pages/js/scripts.js')}}"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="{{asset('shoppers-gh-pages/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('shoppers-gh-pages/js/jquery-ui.js')}}"></script>
        <script src="{{asset('shoppers-gh-pages/js/popper.min.js')}}"></script>
        <script src="{{asset('shoppers-gh-pages/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('shoppers-gh-pages/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('shoppers-gh-pages/js/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{asset('shoppers-gh-pages/js/aos.js')}}"></script>

        <script src="{{asset('shoppers-gh-pages/js/main.js')}}"></script>
    </body>
</html>
