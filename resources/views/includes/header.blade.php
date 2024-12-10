<div class="wrap">
    <div class="container">
        <div class="row justify-content-between">
                <div class="col d-flex align-items-center">
                    <p class="mb-0 phone"><span class="mailus">No hp:</span> <a href="#">+62 1234 567</a> atau <span class="mailus">email:</span> <a href="mailto:polibatam.pinjamruang@gmail.com">polibatam.pinjamruang@gmail.com</a></p>
                </div>
                <div class="col d-flex justify-content-end">
                    <div class="social-media">
                    <p class="mb-0 d-flex">
                        <a href="https://twitter.com/PolibatamPirung" target="_blank" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
                        <a href="https://www.instagram.com/polibatam.pinjamruang" target="_blank" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                    </p>
            </div>
                </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
<div class="container">
    <a class="navbar-brand" href="#">Pinjam<span>Ruang</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="fa fa-bars"></span> Menu
  </button>
  <div class="collapse navbar-collapse" id="ftco-nav">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item @if(\Request::is('/')) active @endif"><a href="/" class="nav-link">Beranda</a></li>
        <li class="nav-item @if(\Request::is('rooms')) active @endif"><a href="{{ route('rooms') }}" class="nav-link">Daftar Ruangan</a></li>
        <li class="nav-item @if(\Request::is('contact')) active @endif"><a href="{{ route('contact') }}" class="nav-link">Kontak</a></li>
    </ul>
  </div>
</div>
</nav>
<!-- END nav -->
