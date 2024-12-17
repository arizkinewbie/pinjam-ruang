@extends('layouts.default')
@section('content')

    <div class="hero-wrap js-fullheight" style="background-image: url('uploads/images/logo.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start"
                data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate">
                    <h2 class="subheading">Selamat datang di Pinjam Ruang Diskusi</h2>
                    <h1 class="mb-4">Pinjam ruangan perpustakaan mudah dan cepat</h1>
                    <p><a href="#" class="btn btn-primary">Pelajari lebih lanjut</a> <a href="{{ route('contact') }}"
                            class="btn btn-white">Hubungi kami</a></p>
                </div>
            </div>
        </div>
    </div>

    <section id="form-pinjam-ruang" class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-4">
                    <form method="POST" action="{{ route('api.v1.borrow-room-with-college-student', []) }}"
                        class="appointment-form" autocomplete="off">
                        @csrf
                        <h3 class="mb-3">Pinjam ruang disini</h3>
                        {{-- Show any errors --}}
                        @if ($errors->isNotEmpty())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $message)
                                    @if ($message == 'login_for_more_info')
                                        <a href="{{ route('admin.login') }}">Masuk</a> untuk meilihat aktivitas peminjaman.
                                    @else
                                        {{ $message }}<br>
                                    @endif
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Pinjam ruang berhasil, silahkan cek status peminjaman <a
                                    href="{{ route('admin.login') }}">disini</a>. Masuk menggunakan username dan password
                                NIM.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input name="full_name" value="{{ old('full_name') }}" type="text"
                                        class="form-control" placeholder="Nama Lengkap" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input name="email" value="{{ old('email') }}" type="email" class="form-control"
                                        placeholder="Email Aktif" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="nim" value="{{ old('nim') }}" type="text" class="form-control"
                                        placeholder="NIM" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                            <select name="study_program" id="study_program" class="form-control" required>
                                                <option value="" selected disabled>Pilih Prodi</option>
                                                @forelse ($data['prodi'] as $studyProgram)
                                                    <option value="{{ $studyProgram['code'] }}"
                                                        @if (old('study_program') == $studyProgram['code']) selected @endif>
                                                        {{ $studyProgram['name'] . ' (' . $studyProgram['degree'] . ')' }}
                                                    </option>
                                                @empty
                                                    <option value="" disabled>Belum ada prodi yang tersedia</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-wrap">
                                        <div class="icon"><span class="ion-md-calendar"></span></div>
                                        <input id="borrow_at" name="borrow_at" value="{{ old('borrow_at') }}"
                                            type="text"
                                            class="form-control appointment_date-check-in datetimepicker-input"
                                            placeholder="Tgl Mulai" data-toggle="datetimepicker" data-target="#borrow_at"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-wrap">
                                        <div class="icon"><span class="ion-md-calendar"></span></div>
                                        <input id="until_at" name="until_at" value="{{ old('until_at') }}" type="text"
                                            class="form-control appointment_date-check-out datetimepicker-input"
                                            placeholder="Tgl Selesai" data-toggle="datetimepicker" data-target="#until_at"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                            <select name="room" id="" class="form-control" required>
                                                <option value="" selected disabled>Pilih Ruangan</option>
                                                @forelse ($data['rooms'] as $room)
                                                    <option value="{{ $room->id }}"
                                                        @if (old('room') == $room->id) selected @endif>
                                                        {{ $room->room_type->name . ' - ' . $room->name }}
                                                    </option>
                                                @empty
                                                    <option value="" disabled>Belum ada ruangan yang tersedia
                                                    </option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" value="Pinjam Ruang Sekarang"
                                        class="btn btn-primary py-3 px-4">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section testimony-section bg-light">
        <div class="container">
            <div class="row justify-content-center pb-5 mb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h2>Tata Cara Peminjaman</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12 wrap-about">
                    <div class="text-center">
                        <img src="{{ asset('vendor/vonso/FlowchartV1.jpg') }}" class="img-fluid" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-6 wrap-about">
                    <div class="img img-2 mb-4"
                        style="background-image: url(vendor/technext/vacation-rental/images/about.jpg);">
                    </div>
                    <h2>The most recommended vacation rental</h2>
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a
                        paradisematic country, in which roasted parts of sentences fly into your mouth. Even the
                        all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One
                        day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World
                        of Grammar.</p>
                </div>
                <div class="col-md-6 wrap-about ftco-animate">
                    <div class="heading-section">
                        <div class="pl-md-5">
                            <h2 class="mb-2">Fasilitas yang disediakan</h2>
                        </div>
                    </div>
                    <div class="pl-md-5">
                        <p>Perpustakaan Universitas Esa Unggul berusaha menyediakan fasilitas yang memudahkan mahasiswa</p>
                        <div class="row">
                            <div class="services-2 col-lg-6 d-flex w-100">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-first"></span>
                                </div>
                                <div class="media-body pl-3">
                                    <h3 class="heading">Wifi</h3>
                                    <p>Menyediakan fasilitas wifi yang dapat diakses dan dijamin kecepatan tinggi</p>
                                </div>
                            </div>
                            <div class="services-2 col-lg-6 d-flex w-100">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-workout"></span>
                                </div>
                                <div class="media-body pl-3">
                                    <h3 class="heading">Hot Showers</h3>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                                </div>
                            </div>
                            <div class="services-2 col-lg-6 d-flex w-100">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-diet-1"></span>
                                </div>
                                <div class="media-body pl-3">
                                    <h3 class="heading">Laundry</h3>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                                </div>
                            </div>
                            <div class="services-2 col-lg-6 d-flex w-100">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-first"></span>
                                </div>
                                <div class="media-body pl-3">
                                    <h3 class="heading">Air Conditioning</h3>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                                </div>
                            </div>
                            <div class="services-2 col-lg-6 d-flex w-100">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-first"></span>
                                </div>
                                <div class="media-body pl-3">
                                    <h3 class="heading">Free Wifi</h3>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                                </div>
                            </div>
                            <div class="services-2 col-lg-6 d-flex w-100">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-first"></span>
                                </div>
                                <div class="media-body pl-3">
                                    <h3 class="heading">Kitchen</h3>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                                </div>
                            </div>
                            <div class="services-2 col-lg-6 d-flex w-100">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-first"></span>
                                </div>
                                <div class="media-body pl-3">
                                    <h3 class="heading">Ironing</h3>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                                </div>
                            </div>
                            <div class="services-2 col-lg-6 d-flex w-100">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-first"></span>
                                </div>
                                <div class="media-body pl-3">
                                    <h3 class="heading">Lovkers</h3>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="ftco-section testimony-section bg-light">
        <div class="container">
            <div class="row justify-content-center pb-5 mb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h2>Penilaian &amp; Umpan Balik</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel">
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="user-img"
                                    style="background-image: url(vendor/technext/vacation-rental/images/person_1.jpg)">
                                </div>
                                <div class="text pl-4">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="fa fa-quote-left"></i>
                                    </span>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                        Consonantia, there live the blind texts.</p>
                                    <p class="name">Racky Henderson</p>
                                    <span class="position">Father</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="user-img"
                                    style="background-image: url(vendor/technext/vacation-rental/images/person_2.jpg)">
                                </div>
                                <div class="text pl-4">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="fa fa-quote-left"></i>
                                    </span>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                        Consonantia, there live the blind texts.</p>
                                    <p class="name">Henry Dee</p>
                                    <span class="position">Businesswoman</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="user-img"
                                    style="background-image: url(vendor/technext/vacation-rental/images/person_3.jpg)">
                                </div>
                                <div class="text pl-4">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="fa fa-quote-left"></i>
                                    </span>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                        Consonantia, there live the blind texts.</p>
                                    <p class="name">Mark Huff</p>
                                    <span class="position">Businesswoman</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="user-img"
                                    style="background-image: url(vendor/technext/vacation-rental/images/person_4.jpg)">
                                </div>
                                <div class="text pl-4">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="fa fa-quote-left"></i>
                                    </span>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                        Consonantia, there live the blind texts.</p>
                                    <p class="name">Rodel Golez</p>
                                    <span class="position">Businesswoman</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="user-img"
                                    style="background-image: url(vendor/technext/vacation-rental/images/person_1.jpg)">
                                </div>
                                <div class="text pl-4">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="fa fa-quote-left"></i>
                                    </span>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                        Consonantia, there live the blind texts.</p>
                                    <p class="name">Ken Bosh</p>
                                    <span class="position">Businesswoman</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    @section('scripts')
        <script>
            // ready
            $(document).ready(function() {
                console.log('ready');
                // Datetimepicker
                $('.appointment_date-check-in-alt').datetimepicker({
                    format: 'DD-MM-YYYY HH:mm',
                });
                $('.appointment_date-check-out-alt').datetimepicker({
                    format: 'DD-MM-YYYY HH:mm',
                });
            });
        </script>

        <script>
            //triggered when modal is about to be shown
            $(document).on('click', '#buttonBorrowRoomModal', function() {

                var roomName = $(this).data('room-name');
                var roomId = $(this).data('room-id');

                // Change value room
                $('input[name="room"]').val(roomId);

                // change title modal
                $('#borrowRoomModalLabel').text('Pinjam Ruang Diskusi - ' + roomName);

                // Rest form modal
                resetBorrowRoomModalForm()
            });

            function resetBorrowRoomModalForm() {
                $('#borrowRoomModal').find('input[name="full_name"]').val('');
                $('#borrowRoomModal').find('input[name="borrow_at"]').val('');
                $('#borrowRoomModal').find('input[name="until_at"]').val('');
                $('#borrowRoomModal').find('input[name="nim"]').val('');
                $('#borrowRoomModal').find('select[name="study_program"]').val($('select[name="study_program"] option:first')
                    .val());
            }
        </script>

        {{-- If any error scroll to form --}}
        @if ($errors->isNotEmpty())
            <script>
                $(document).ready(function() {
                    // Scroll only in mobile device
                    if (/Android|webOS|iPhone|iPad|Mac|Macintosh|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator
                            .userAgent)) {
                        document.getElementById("form-pinjam-ruang").scrollIntoView();
                    }
                });
            </script>
        @endif
    @endsection
@endsection
