<?php $this->load->view('partials/header') ?>

  <body class="">
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                <!-- <img src="./demo/brand/tabler.svg" class="h-6" alt=""> -->
              </div>

              <form class="card" onsubmit="return _submit(this)">
                <div class="card-body p-6">
                  <div class="card-title">Buat Akun</div>

                  <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Inputkan nama" autocomplete="off">
                  </div>

                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Inputkan tempat lahir" autocomplete="off">
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" autocomplete="off">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="form-label">Jenis Kelamin</div>
                    <div class="custom-controls-stacked">
                      <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="jenis_kelamin" value="Laki-laki" checked>
                        <span class="custom-control-label">Laki-laki</span>
                      </label>
                      <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="jenis_kelamin" value="Perempuan">
                        <span class="custom-control-label">Perempuan</span>
                      </label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Inputkan email" autocomplete="off">
                  </div>

                  <div class="form-group">
                    <label class="form-label">
                      Password
                    </label>
                    <input type="password" name="password" class="form-control" placeholder="Inputkan password">
                  </div>
                 
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                  </div>

                  <div class="text-center text-muted mt-3">
                    Sudah punya akun? <a href="./">Masuk</a>
                  </div>

                </div>
              </form>

              <div class="text-center text-muted">
                &copy; 2020 &bull; Medic
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
      $this->load->view('partials/script');
    ?>

    <script>
      $(document).ready(function(){
        $('input').attr('required', true) // set required ke semua input
      })

      function _submit(f){ // submit form data
        
        // fungsi request ke server
        fn.request({
          url: 'register/register', // url controller
          data: new FormData($(f)[0]), // form data yang dikirim
          spiner: $(f).find('button[type=submit]'), // loading tombol submit
          success: () => { // jika berhasil
            toast('Pendaftaran berhasil, tunggu konfirmasi dari admin.') // pesan
            $(f)[0].reset() // reset form
          }
        })

        return false

      }

    </script>

  </body>
</html>