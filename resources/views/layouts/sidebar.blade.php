<aside class="main-sidebar sidebar-dark-primary {{ (auth()->user()->type !== 'Administrator') ? 'position-fixed' : '' }} elevation-4 bg-primary">
    <!-- Brand Logo -->
    <a href="/assets/index3.html" class="brand-link border-0 bg-primary shadow">
      <img src="/img/logo/kab-cirebon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8;">
      <span class="brand-text font-weight-light">Puskesmas Pabedilan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel my-2 rounded py-2 border-0 bg-primary shadow-sm d-flex">
        <div class="image">
          <img src="/img/users/{{ auth()->user()->photo }}" class="img-circle elevation-2" alt="{{ auth()->user()->name }}">
        </div>
        <div class="info">
          <a href="/dashboard/user/{{ auth()->user()->id }}" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="/dashboard" class="nav-link">
                <i class="nav-icon fa fa-home fa-fw"></i>
                <p>
                  Home
                </p>
              </a>
            </li>
            @can('profile')
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-address-card"></i>
                <p>
                  Profile
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/profile/sp3" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>SP3</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/profile/laporan-tahunan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Tahunan</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan
            @can('rekam_medis')
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-building-o"></i>
                <p>
                  Rekam Medis
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/Kartu-RM" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kartu RM</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/Pasien" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pasien</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan
            @can('rawat_jalan')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-sitemap"></i>
              <p>
                Rawat Jalan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/rawat-jalan/pendaftaran" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendaftaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/rawat-jalan/poli-umum" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Poli Umum</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/rawat-jalan/poli-gigi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Poli Gigi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/rawat-jalan/poli-kia" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Poli KIA</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/rawat-jalan/poli-lansia" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Poli Lansia</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/rawat-jalan/ruang-konseling" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ruang Konseling</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/rawat-jalan/poli-tb" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Poli TB</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/rawat-jalan/poli-laboratorium" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Poli Laboratorium</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/rawat-jalan/parmasi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Farmasi</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan
          @can('rawat_inap')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-bed"></i>
              <p>
                Rawat Inap
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/rawat-inap/perawatan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Perawatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/rawat-inap/poned" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Poned</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/rawat-inap/ugd" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>UGD</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan
          @can('admin')
          <li class="nav-item">
            <a href="/dashboard/users" class="nav-link">
              <i class="nav-icon fa fa-user-circle"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          @endcan
          <li class="nav-item">
            <a href="logout" class="nav-link confirm-logout">
              <i class="nav-icon fa fa-sign-out"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<script>
  $(document).ready(function(){
    $('.confirm-logout').click(function(e){
        e.preventDefault();
        Swal.fire({
            title: '',
            text: 'Apakah Anda yakin ingin logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Logout'
        }).then((result) => {
            if(result.isConfirmed){
              // mengubah lingkup sweetalert
              location.href = '/logout';
            }
        })
    })
  })
</script>