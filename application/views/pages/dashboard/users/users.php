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
                  <h3 class="m-0"> <a href="./">Pengguna</a></h3>
                  Jumlah pengguna <?= $jumlah_user.' orang' ?>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group my-5">
                    <!-- <div class="col input-icon">
                      <form onsubmit="return search(this)">
                        <span class="input-icon-addon">
                          <i class="fe fe-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Search...">
                      </form>
                    </div> -->
                    <span class="pull-right">
                      <button type="button" data-toggle="modal" data-target="#new-product" class="btn btn-primary btn-block"> <i class="fe fe-plus"></i> New </button>
                    </span>
                </div>
              </div>
            </div>

            <div class="table-responsive">
              <?php if($waiting){ ?>

              <h5>Konfirmasi Pendaftaran</h5>
              <div class="card">
                <table class="table table-striped m-0">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Nama</th>
                      <th>Tempat & Tgl Lahir</th>
                      <th>Jenis Kelamin</th>
                      <th>Alamat</th>
                      <th>No. Telepon</th>
                      <th>Role</th>
                      <th class="text-center"> <i class="fe fe-settings"></i> </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      foreach ($waiting as $key => $value) { $no++;
                        // $x = ($page - 1) * 5 + $no;

                        $img = './assets/images/img-placeholder.jpg';
                        $tl = _date($value['tanggal_lahir']);

                        echo "
                          <tr>
                            <th class='text-center'>$no</th>
                            <th>$value[nama]</th>
                            <th>$value[tempat_lahir], $tl</th>
                            <th>$value[jenis_kelamin]</th>
                            <th></th>
                            <th></th>
                            <th>$value[role]</th>
                            <th class='text-center'>
                              <div class='btn-group'>
                                <button type='button' class='btn btn-sm btn-success' onclick='_confirm(this, $value[id])'> <i class='fe fe-check'></i> </button>
                                <button type='button' class='btn btn-sm btn-danger' onclick='_rejected($value[id])'> <i class='fe fe-x'></i> </button>
                              </div>
                            </th>
                          </tr>
                        ";

                      }
                    ?>

                  </tbody>
                </table>
              </div>

              <div class="text-center" id="paginate">
                <div class="btn-group"> </div>
              </div>

              <?php } ?>

            </div>

            <div class="table-responsive">
              <?php if(!$data){ _empty(); }else{ ?>
              <div class="card">
                <table class="table table-striped m-0">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Nama</th>
                      <th>Tempat & Tgl Lahir</th>
                      <th>Jenis Kelamin</th>
                      <th>Alamat</th>
                      <th>No. Telepon</th>
                      <th>Role</th>
                      <th class="text-center"> <i class="fe fe-settings"></i> </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      foreach ($data as $key => $value) { $no++;
                        // $x = ($page - 1) * 5 + $no;

                        $img = './assets/images/img-placeholder.jpg';
                        $tl = _date($value['tanggal_lahir']);

                        echo "
                          <tr>
                            <th class='text-center'>$no</th>
                            <th>$value[nama]</th>
                            <th>$value[tempat_lahir], $tl</th>
                            <th>$value[jenis_kelamin]</th>
                            <th></th>
                            <th></th>
                            <th>$value[role]</th>
                            <th class='text-center'>
                              <div class='btn-group'>
                                <button type='button' class='btn btn-sm btn-primary' onclick='_edit(this, $value[id])'> <i class='fe fe-edit-2'></i> </button>
                                <button type='button' class='btn btn-sm btn-danger' onclick='_delete($value[id])'> <i class='fe fe-trash'></i> </button>
                              </div>
                            </th>
                          </tr>
                        ";

                      }
                    ?>

                  </tbody>
                </table>
              </div>

              <div class="text-center" id="paginate">
                <div class="btn-group"> </div>
              </div>

              <?php } ?>

            </div>

          </div>

        </div>
      </div>

    </div>

    <?php
      $this->load->view('partials/script');
    ?>

    <script>

        function _confirm(e, id){

            fn.request({
                url: 'users/confirm/'+id,
                spiner: e,
                success: (res) => {
                    toast('Berhasil dikonfirmasi')
                    reload()
                }
            })

        }

        function test(){
            alert('ds')
        }

        function _rejected(id){

            fn.confirm({
                message: 'Yakin ingin menolak pendaftaran ini?',
                textConfirm: 'Ya',
                confirm: (e) => {
                    fn.request({
                        url: 'users/rejected/'+id,
                        spiner: e,
                        success: () => {
                            toast('Berhasil dihapus')
                            reload()
                        }
                    })
                }
            })
        }

    </script>

  </body>
</html>
