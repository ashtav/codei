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
                  <h3 class="m-0"> <a href="./">Pemeriksaan</a></h3>
                  Riwayat Pemeriksaan ()
                </div>
              </div>
              <div class="col-6">
                <div class="form-group pull-right my-5">
                  <div class="btn-group">
                    <button type="button" onclick="_new()" class="btn btn-primary btn-block"> <i class="fe fe-calendar"></i> Request Jadwal </button>
                  </div>
                  <div class="btn-group">
                    <button type="button" onclick="_new()" class="btn btn-primary btn-block"> <i class="fe fe-plus"></i> Buat Pemeriksaan </button>
                  </div>
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
      $this->load->view('pages/dashboard/pemeriksaan/modals/form-pemeriksaan');

    ?>

    <script>

        let listDokter = [], id_rumahsakit = 0

        function _new(){
          fn.modal({
            id: 'form-pemeriksaan',
            title: 'Form Pemeriksaan',
            submit: (e) => {
              fn.request({
                  url: 'pemeriksaan/store',
                  data: new FormData($(e).find('form')[0]),
                  spiner:  $(e).find('button[type=submit]'),
                  success: (res) => {
                      // toast('Berhasil dikirim')
                      // reload()
                      consl(res)
                  }
              })

              return false
            }
          })
        }

        function _getDokter(e){
          let id = e.value
          id_rumahsakit = id

          $('#hari').html('<span class="text-muted">Pilih dokter</span>')

          _getLab()

          fn.request({
              url: 'dokter/list_dokter/'+id,
              method: 'get',
              success: (res) => {
                  let data = JSON.parse(res)

                  listDokter = data

                  $('#listdokter').html('<option value="">Pilih Dokter</option>')

                  for (let i = 0; i < data.length; i++) {
                    let dokter = data[i]
                    $('#listdokter').append(
                      '<option value='+dokter.id+'>'+dokter.nama+' ('+dokter.spesialis+')</option>'
                    )
                  }
              }
          })
        }

        function _getJadwal(e){
          let id = e.value
          let dokter = listDokter.find((item) => item.id == id)

          $('#jb').val(dokter.jam_buka)
          $('#jt').val(dokter.jam_tutup)

          let jadwal = dokter.jadwal_hari.split(',')
          $('#hari').html('')

          for (let i = 0; i < jadwal.length; i++) {
            let j = jadwal[i]
            
            $('#hari').append(
              `
                <label class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" name="jadwal_hari" value="`+j+`">
                  <span class="custom-control-label">`+fn.ucwords(j)+`</span>
                </label>
              `
            )
          }
        }

        function _getLab(){

          fn.request({
            url: 'laboratorium/list_lab/'+id_rumahsakit,
            method: 'get',
            success: (res) => {
                let data = JSON.parse(res)

                $('#listLab').html('<option value="">Pilih Laboratorium</option>')

                for (let i = 0; i < data.length; i++) {
                  let lab = data[i]
                  $('#listLab').append(
                    '<option value='+lab.id+'>'+lab.nama_lab+'</option>'
                  )
                }
            }
          })
        }

        function _switch(e){
          $('#lab').hide()
          $('#doc').show()

          if($(e).is(':checked')){
            $('#doc').hide()
            $('#lab').show()

            // _getLab()
          }
        }

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
