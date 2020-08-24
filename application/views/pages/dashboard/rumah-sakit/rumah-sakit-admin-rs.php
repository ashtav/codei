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
                  <span>Kelola Rumah Sakit Anda</span>
                </div>
              </div>
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
                      <th class="text-center"> <i class="fe fe-settings"></i> </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      foreach ($data as $key => $value) { $no++;
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
                            <th class='text-center'>
                              <div class='btn-group'>
                                <button type='button' class='btn btn-sm btn-primary' onclick='_edit(".json_encode($value).")'> <i class='fe fe-edit-2'></i> </button>
                              </div>
                            </th>
                          </tr>
                        ";

                      }
                    ?>

                  </tbody>
                </table>
              </div>

              <?php } ?>

            </div>

            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Daftar Dokter</h3>
                    <div class="card-options">
                      <a href="jscript:void(0)" onclick="_newDokter()" class="btn btn-outline-primary">Tambah</a>
                    </div>
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto ullam laborum autem ipsam officia? Esse, quo eos facere veritatis sint, incidunt officia molestiae consequatur dolor officiis perspiciatis omnis asperiores quas!
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
      $this->load->view('pages/dashboard/rumah-sakit/modals/form-dokter');

    ?>

    <script>

      function _newDokter(){
        fn.modal({
          id: 'form-dokter',
          title: 'Tambahkan Dokter',
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
