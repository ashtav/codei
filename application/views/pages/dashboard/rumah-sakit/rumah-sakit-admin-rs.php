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
                  <div class="card-body p-0">
                      <ul class="list-group borderless">
                        
                        <?php foreach ($dokter as $key => $value) {
                          
                        ?>

                        <li class="list-group-item">

                          <div class="btn-group pull-right">
                            <button class="btn btn-primary btn-sm" onclick='_editDokter(<?= json_encode($value) ?>)'> <i class="fe fe-edit-2"></i> </button>
                            <button class="btn btn-danger btn-sm" onclick="_deleteDokter(<?= $value['id'] ?>)"> <i class="fe fe-trash"></i> </button>
                          </div>

                          <div class="media">
                            <span class="avatar avatar-xxl mr-5" style="min-width: 80px; width: 80px; height: 80px; min-height: 80px; background-image: url(<?= url('images/'.$value['foto']) ?>)"></span>
                            <div class="media-body">
                              <h4 class="m-0"><?= $value['nama'] ?></h4>
                              <p class="text-muted mb-0"><?= $value['spesialis'] ?></p>
                              <p class="text-muted mb-0"><?= $value['jadwal_hari'] ?></p>
                              <p class="text-muted mb-0"><?= $value['jam_buka'].' - '.$value['jam_tutup'] ?></p>
                            </div>
                          </div>
                        </li>

                        <?php } ?>

                      </ul>
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Daftar Laboratorium</h3>
                    <div class="card-options">
                      <a href="jscript:void(0)" onclick="_newDokter()" class="btn btn-outline-primary">Tambah</a>
                    </div>
                  </div>
                  <div class="card-body p-0">
                      <ul class="list-group borderless">
                        
                        <?php foreach ($dokter as $key => $value) {
                          
                        ?>

                        <li class="list-group-item">

                          <div class="btn-group pull-right">
                            <button class="btn btn-primary btn-sm" onclick='_editDokter(<?= json_encode($value) ?>)'> <i class="fe fe-edit-2"></i> </button>
                            <button class="btn btn-danger btn-sm" onclick="_deleteDokter(<?= $value['id'] ?>)"> <i class="fe fe-trash"></i> </button>
                          </div>

                          <div class="media">
                            <span class="avatar avatar-xxl mr-5" style="min-width: 80px; width: 80px; height: 80px; min-height: 80px; background-image: url(<?= url('images/'.$value['foto']) ?>)"></span>
                            <div class="media-body">
                              <h4 class="m-0"><?= $value['nama'] ?></h4>
                              <p class="text-muted mb-0"><?= $value['spesialis'] ?></p>
                              <p class="text-muted mb-0"><?= $value['jadwal_hari'] ?></p>
                              <p class="text-muted mb-0"><?= $value['jam_buka'].' - '.$value['jam_tutup'] ?></p>
                            </div>
                          </div>
                        </li>

                        <?php } ?>

                      </ul>
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

      $(document).ready(function(){
        $('#form-dokter').find('input').not('input[type=file],input[type=checkbox]').prop('required',true)
      })

      function _newDokter(){
        fn.modal({
          id: 'form-dokter',
          title: 'Tambahkan Dokter',
          submit: (e) => {
            fn.request({
                url: 'dokter/store/',
                data: new FormData($(e).find('form')[0]),
                spiner:  $(e).find('button[type=submit]'),
                success: (res) => {
                    toast('Berhasil ditambahkan')
                    reload()
                }
            })

            return false
          }
        })
      }

      function _editDokter(data){
        fn.modal({
          id: 'form-dokter',
          title: 'Edit Dokter',
          data: data,
          script: (e) => {
            $(e).find('input[type=checkbox]').prop('checked',false)

            $(e).find('img').attr('src', BASEURL+'/images/'+data.foto) // set foto
            $(e).find('input[type=checkbox]').each(function(){
              let hari = data.jadwal_hari.split(',')

              if(hari.indexOf($(this).val()) > -1){
                $(this).prop('checked',true)
              }
            })
          },
          submit: (e) => {
            fn.request({
                url: 'dokter/update/'+data.id,
                data: new FormData($(e).find('form')[0]),
                spiner:  $(e).find('button[type=submit]'),
                success: (res) => {
                    toast('Berhasil diperbarui')
                    reload()
                }
            })

            return false
          }
        })
      }

      function _deleteDokter(id){
        fn.confirm({
            message: 'Yakin ingin menghapus data dokter ini?',
            textConfirm: 'Ya',
            confirm: (e) => {
                fn.request({
                    url: 'dokter/delete/'+id,
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
