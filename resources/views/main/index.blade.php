<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">

    {{-- mycss --}}
    {{-- <link rel="stylesheet" href="/css/mystyle.css"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
      .sky{
        color: #a8d2f0;
      }
      .secon{
        color: #364d48;
      }
      .font{
        font-family: 'Quicksand', sans-serif;
      }
      .dary{
        color: #ccd8d9;
      }
    </style>

    <title>Puskesmas Pabedilan</title>
  </head>
  <body class="bg-info">
  
  {{-- message --}}
  <div id="failed" data-failed="{{ session('failed') }}"></div>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-info shadow fixed-top">
        <div class="container">
          <a class="navbar-brand" href="#">
            <img src="/img/logo/kab-cirebon.png" width="30" class="d-inline-block align-top" alt="">
            PUSKESMAS PABEDILAN
          </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="" class="btn btn-outline-warning btn-sm rounded-pill px-5 shadow-none mt-3 mt-md-0" data-toggle="modal" data-target="#loginModal">Login</a>
                </li>
            </ul>
            </div>
        </div>
      </nav>

      <div class="container py-5 mt-5">
        <div class="row mb-5">
          <div class="col-md-6 d-flex justify-content-center flex-column mb-5">
            <h5 class="mb-0">Puskesmas Pabedilan</h5>
            <h1 class="text-white display-4 mb-0 font" style="font-weight: bold;">Kesehatanmu No 1</h1>
            <p class="sky">“Dia yang memiliki kesehatan memiliki harapan; dan dia yang memiliki harapan, memiliki segalanya.”  Thomas Carlyle</p>
          </div>
          <div class="col-md-6">
            <img src="/img/logo/healt.png" class="img-fluid" alt="">
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-8 mb-2">
            <div class="card p-3 bg-info border-0 shadow">
              <h3 class="text-center mb-3 secon">Visi</h3>
              <p class="dary text-center">Sebagai Pusat Pelayanan Kesehatan Unggulan Kebanggaan Masyarakat</p>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-8 mb-2">
            <div class="card p-3 bg-info border-0 shadow">
              <h3 class="text-center mb-3 secon">Misi</h3>
              <ol type="1" class="p-3 dary">
                <li>Memberikan Pelayanan Kesehatan dasar yang berkualitas, ramah, aman dan nyaman dengan sumber daya yang profesional.</li>
                <li>Memberikan kemudahan pelayanan kesehatan kepada masyarakat.</li>
                <li>Meningkatkan kerjasama lintas program dan lintas sektoral dalam melaksanakan program kesehatan.</li>
                <li>Meningkatkan kemandirian masyarakat dalam rangka pembangunan kesehatan.</li>
              </ol>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-8 mb-2">
            <div class="card p-3 bg-info border-0 shadow">
              <h3 class="text-center mb-3 secon">Tujuan</h3>
              <ol type="1" class="p-3 dary">
                <li>Masyarakat memiliki kesadaran, memauan dan kemampuan untuk berprilaku hidup bersih dan sehat.</li>
                <li>Tersedianya pelayanan kesehatan yang bermutu bagi masyarakat.</li>
                <li>Membantu masyarakat untuk menciptakan lingkungan sehat.</li>
                <li>Meningkatkan derajat kesehatan masyarakat yang optimal baik individu, keluarga, kelompok dan masyarakat.</li>
              </ol>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-8 mb-2">
            <div class="card p-3 bg-info border-0 shadow">
              <h3 class="text-center mb-3 secon">Tata Nilai</h3>
              <table class="dary">
                <tr>
                  <td class="align-top text-center" width="20px">K</td>
                  <td class="align-top text-center" width="20px">:</td>
                  <td class="align-top">KOMUNIKATIF</td>
                  <td class="align-top text-center" width="20px">:</td>
                  <td class="align-top">Dapat berkomunikasi dengan baik sehingga pesan yang disampaikan dapat dipahami dan dimengerti.</td>
                </tr>
                <tr>
                  <td class="align-top text-center" width="20px">A</td>
                  <td class="align-top text-center" width="20px">:</td>
                  <td class="align-top">AMAN</td>
                  <td class="align-top text-center" width="20px">:</td>
                  <td class="align-top">Aman buat petugas, pasien dan lingkungan.</td>
                </tr>
                <tr>
                  <td class="align-top text-center" width="20px">S</td>
                  <td class="align-top text-center" width="20px">:</td>
                  <td class="align-top">SANTUN</td>
                  <td class="align-top text-center" width="20px">:</td>
                  <td class="align-top">Memberikan pelayanan secara humanis kepada pelanggan.</td>
                </tr>
                <tr>
                  <td class="align-top text-center" width="20px">I</td>
                  <td class="align-top text-center" width="20px">:</td>
                  <td class="align-top">INOVATIF</td>
                  <td class="align-top text-center" width="20px">:</td>
                  <td class="align-top">Dapat menghasilkan solusi dan gagasan untuk mempermudah pelayanan.</td>
                </tr>
                <tr>
                  <td class="align-top text-center" width="20px">H</td>
                  <td class="align-top text-center" width="20px">:</td>
                  <td class="align-top">HARMONIS</td>
                  <td class="align-top text-center" width="20px">:</td>
                  <td class="align-top">Dapat bekerjasama dengan lintas program dan lintas sektoral.</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>

      <footer class="bg-dark p-4 mt-5">
        <p class="sky text-center"><small>&copy;PuskesmasPabedilan_{{ date('Y') }}</small></p>
      </footer>
  
  <!-- Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="d-flex justify-content-end mr-3 mt-2">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h5 class="modal-title text-center mb-4" id="loginModalLabel">Login Here</h5>
            <form action="/login" method="post">
                @csrf
                <div class="form-group mb-3">
                  <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                  <label for="email">masukan email</label>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                  <label for="password">Password</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm">Login</button>
            </div>
        </form>
      </div>
    </div>
  </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    {{-- SweetAlert --}}
    <script src="/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script>
      $(document).ready(function(){
          // sweetalert
          let failed = $('#failed').data('failed');
          console.log(failed);
          if(failed){
            Swal.fire({
              icon: 'error',
              title: 'Oops...' + ' ' + failed,
              text: 'Pastikan email dan password benar.',
            })
          }
      })
  </script>

  </body>
</html>