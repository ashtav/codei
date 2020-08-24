<?php $this->load->view('partials/header') ?>

  <body>

    <div class="page">
      <div class="flex-fill">

        <?php $this->load->view('pages/dashboard/partials/navbar') ?>

        <div class="my-3 my-md-5">

          <div class="container">

            <div class="row">
              <div class="col-6">
                <div class="my-5">
                  <h3 class="m-0"> <a href="./">Dashboard</a></h3>
                  Hai! Welcome to Medic. <?= auth('nama') ?>
                </div>
              </div>
            </div>

            <div class="alert <?= $terdaftar > 0 ? 'alert-success' : 'alert-info' ?>">
              <?= $terdaftar > 0 ? 'Pendaftaran rumah sakit Anda sedang diproses.' : 'Ingin mendaftarkan klinik atau rumah sakit Anda?' ?>

              <a href="jscript:void(0)" class="<?= $terdaftar > 0 ? 'd-none' : '' ?>" onclick="_new()"> <b class="pull-right">Daftar Disini</b> </a>
            </div>

            <div class="row row-cards">
              <div class="col-6 col-sm-4">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                      6%
                      <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h1 m-0">43</div>
                    <div class="text-muted mb-4">New Tickets</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-sm-4">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-red">
                      -3%
                      <i class="fe fe-chevron-down"></i>
                    </div>
                    <div class="h1 m-0">17</div>
                    <div class="text-muted mb-4">Closed Today</div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          

        </div>
      </div>

      

    </div>

    <?php
      $this->load->view('partials/script');
      $this->load->view('pages/dashboard/rumah-sakit/modals/form-rumah-sakit');
    ?>

    <script>

      function _new(){
        fn.modal({
          id: 'form-rs',
          title: 'Daftar Rumah Sakit',
          submit: (e) => {
            fn.request({
                url: 'rumahsakit/register',
                data: new FormData($(e).find('form')[0]),
                spiner:  $(e).find('button[type=submit]'),
                success: () => {
                    toast('Berhasil mendaftar, mohon menunggu konfirmasi.')
                    reload()
                }
            })

            return false
          }
        })
      }

    </script>

  </body>
</html>
