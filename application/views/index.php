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

              <form class="card" onsubmit="return _signin(this)">
                <div class="card-body p-6">
                  <div class="card-title">Login to your account</div>
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
                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                  </div>

                  <div class="text-center text-muted mt-3">
                    Belum punya akun? <a href="./register">Daftar Disini</a>
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

      function _signin(f){

        fn.signin({
          url: 'main/signin',
          data: new FormData($(f)[0]),
          spiner: $(f).find('button[type=submit]'), // loading tombol submit
          success: () => { // jika berhasil
            to('dashboard')
          }
        })

        return false
      }

      
      

        // function _submit(f){
        //     let btn = $(f).find('button[type=submit]'), def = btn.html()
        //     btn.html('<i class="fa fa-spin fa-spinner"></i>')

        //     $.ajax({
        //         url: 'signin',
        //         type: 'post',
        //         data: new FormData($(f)[0]),
        //         contentType: false,
        //         processData: false,
        //         success: function(res){
        //             let data = JSON.parse(res);
        //             if(data.status == 200){
        //                 location.href = 'dashboard';
        //             }else{
        //                 alert('Login gagal')
        //             }

        //             btn.html(def)
        //         }
        //     })

        //     return false;
        // }

    </script>

  </body>
</html>