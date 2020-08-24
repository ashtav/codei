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
                  <h3 class="m-0"> <a href="./">Rumah Sakit</a></h3>
                  Jumlah rumah sakit (<?= $jumlah_rs ?>)
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
                      <th>Nama Rumah Sakit</th>
                      <th>Alamat</th>
                      <th>No. Telepon</th>
                      <th>Email</th>
                      <th>Waktu Operasional</th>
                      <th>Didaftarkan Oleh</th>
                      <th class="text-center"> <i class="fe fe-settings"></i> </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      foreach ($waiting as $key => $value) { $no++;
                        // $x = ($page - 1) * 5 + $no;

                        $img = './assets/images/img-placeholder.jpg';

                        echo "
                          <tr>
                            <th class='text-center'>$no</th>
                            <th>$value[nama]</th>
                            <th>$value[alamat]</th>
                            <th>$value[telepon]</th>
                            <th>$value[email]</th>
                            <th>$value[jam_buka] - $value[jam_tutup]</th>
                            <th>$value[un]</th>
                            <th class='text-center'>
                              <div class='btn-group'>
                                <button type='button' class='btn btn-sm btn-success' onclick='_confirm(this, $value[id], $value[created_by])'> <i class='fe fe-check'></i> </button>
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
                      <th>Nama Rumah Sakit</th>
                      <th>Alamat</th>
                      <th>No. Telepon</th>
                      <th>Email</th>
                      <th>Waktu Operasional</th>
                      <th>Didaftarkan Oleh</th>
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
                            <th>$value[alamat]</th>
                            <th>$value[telepon]</th>
                            <th>$value[email]</th>
                            <th>$value[jam_buka] - $value[jam_tutup]</th>
                            <th>$value[un]</th>
                            <th class='text-center'>
                              <div class='btn-group'>
                                <button type='button' class='btn btn-sm btn-primary' onclick='_edit(".json_encode($value).")'> <i class='fe fe-edit-2'></i> </button>
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
      $this->load->view('pages/dashboard/rumah-sakit/modals/form-rumah-sakit');

    ?>

    <script>

        function _confirm(e, id, uid){
          fn.request({
              url: 'rumahsakit/confirm/'+id+'/'+uid,
              spiner: e,
              success: (res) => {
                  toast('Berhasil dikonfirmasi')
                  reload()
              }
          })
        }

        function _rejected(id){
          fn.confirm({
              message: 'Yakin ingin menolak pendaftaran ini?',
              textConfirm: 'Ya',
              confirm: (e) => {
                  fn.request({
                      url: 'rumahsakit/rejected/'+id,
                      spiner: e,
                      success: () => {
                          toast('Berhasil dihapus')
                          reload()
                      }
                  })
              }
          })
        }

        function _delete(id){
          fn.confirm({
              message: 'Yakin ingin menghapus rumah sakit ini?',
              textConfirm: 'Ya',
              confirm: (e) => {
                  fn.request({
                      url: 'rumahsakit/delete/'+id,
                      spiner: e,
                      success: () => {
                          toast('Berhasil dihapus')
                          reload()
                      }
                  })
              }
          })
        }

        function _edit(data){
          fn.modal({
            id: 'form-rs',
            title: 'Edit Rumah Sakit',
            data: data,
            submit: (e) => {
              fn.request({
                  url: 'rumahsakit/update/'+data.id,
                  data: new FormData($(e).find('form')[0]),
                  spiner:  $(e).find('button[type=submit]'),
                  success: () => {
                      toast('Berhasil diperbarui')
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
