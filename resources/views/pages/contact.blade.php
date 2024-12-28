@extends('layouts.default')
@section('content')
    <section class="hero-wrap hero-wrap-2"
        style="background-image: url('uploads/images/logo.jpg');"
        data-stellar-background-ratio="0.8">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="{{ route('home') }}">Beranda <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Contact <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-0 bread">Kontak Kami</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0">
                <div class="section-title mb-5">
                    <strong class="subtitle aos-init aos-animate" data-aos="fade-up" data-aos-delay="0">Contact Us</strong>
                    <h2 class="heading aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">Let's have a talk</h2>
                </div>
                <form class="contact-form" action="" enctype="multipart/form-data" id="contact-form"
                    autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="text-black" for="name">Full Name</label>
                                <input type="text" placeholder="John Doe" class="form-control" id="name"
                                    name="name" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="text-black" for="nim">NIM</label>
                                <input type="text" placeholder="2020xxxxxxx" class="form-control" id="nim"
                                    name="nim" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="text-black" for="email">Email Address</label>
                                <input type="email" placeholder="mimin@student.esaunggul.ac.id" class="form-control"
                                    name="email" id="email" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="text-black" for="hp">No. HP/WhatsApp</label>
                                <input type="number" placeholder="0822xxxxxxxx" class="form-control" name="hp"
                                    id="hp" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-black" for="message">Message</label>
                        <textarea name="message" placeholder="Isi Pesan disini" class="form-control" id="message" cols="30"
                            rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#contact-form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('api.v1.contact-form', []) }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 'success') {
                            alert(response.message);
                            $('#contact-form')[0].reset();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText);
                    }
                })
            });
        });
    </script>
@endsection
@endsection
