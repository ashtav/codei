<div class="header py-4">
  <div class="container">
    <div class="d-flex">
      <a class="header-brand" href="./index.html">
        <h2 class="m-0">Medic.</h2>
      </a>
      <div class="d-flex order-lg-2 ml-auto">
        <!-- SEARCH -->
        <div class="col-lg-3 ml-auto d-block d-lg-none">
          <!-- <form class="input-icon">
            <input type="search" class="form-control header-search br-20p _search" size="6" style="border-radius:50px" placeholder="Search&hellip;" tabindex="1">
            <div class="input-icon-addon">
              <i class="fe fe-search"></i>
            </div>
          </form> -->
        </div>
        
        <div class="dropdown">
          <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
            <span class="avatar" style="background-image: url('./storage/images/')"></span>
            <span class="ml-2 d-none d-lg-block">
              <span class="text-default"><?= auth('nama') ?></span>
              <small class="text-muted d-block mt-1"><?= auth('role') ?></small>
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            <a class="dropdown-item" href="<?= url('dashboard/profil') ?>">
              <i class="dropdown-icon fe fe-user"></i> Profil
            </a>
            <a class="dropdown-item" href="jscript:void(0)">
              <i class="dropdown-icon fe fe-info"></i> Tentang Aplikasi
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= url('signout') ?>">
              <i class="dropdown-icon fe fe-log-out"></i> Keluar
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<div style="position:relative">
  <div class="header d-lg-flex p-0" id="zL-nav">
    <div class="container">
      <div class="row align-items-center">

        <div class="col-lg-3 ml-auto d-none d-lg-block">
          <!-- <form class="input-icon my-3 my-lg-0">
            <input type="search" class="form-control header-search br-20p _search" style="border-radius:50px" placeholder="Search&hellip;" tabindex="1">
            <div class="input-icon-addon">
              <i class="fe fe-search"></i>
            </div>
          </form> -->
        </div>

        <div class="col-lg order-lg-first">
          <ul class="nav nav-tabs border-0 zL-nav" id="nav">
            <li class="nav-item">
              <a href="<?= url('dashboard') ?>" class="nav-link"><i class="fe fe-home"></i> <span class="d-none d-md-block">Beranda</span></a>
            </li>

            <li class="nav-item <?= auth('role') != 'admin' ? 'd-none' : '' ?>">
              <a href="<?= url('/dashboard/users') ?>" class="nav-link"><i class="fe fe-users"></i> <span class="d-none d-md-block">Pengguna</span></a>
            </li>

            <li class="nav-item">
              <a href="<?= url('/dashboard/rumah-sakit') ?>" class="nav-link"><i class="fe fe-git-branch"></i> <span class="d-none d-md-block">Rumah Sakit</span></a>
            </li>

            <li class="nav-item">
              <a href="<?= url('/dashboard/rumah-sakit') ?>" class="nav-link"><i class="fe fe-bell"></i> <span class="d-none d-md-block">Pemberitahuan</span></a>
            </li>

            

            <!-- <li class="nav-item dropdown">
              <a href="<?= url('pemberitahuan') ?>" class="nav-link"><i class="fe fe-bell"></i> <span class="d-none d-md-block">Pemberitahuan</span> <span class="tag tag-red ml-2">5</span> </a>
            </li> -->
          
            <li class="nav-item dropdown">
              <a href="<?= url('/dashboard/profil') ?>" class="nav-link"><i class="fe fe-user"></i> <span class="d-none d-md-block">Profil</span></a>
            </li>
          </ul>

        </div>

      </div>
    </div>
  </div>
</div>