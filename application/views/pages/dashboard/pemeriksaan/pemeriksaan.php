<?php $this->load->view('partials/header') ?>

<style>

  .text-danger td{
    color: red !important
  }
</style>

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
                  Riwayat Pemeriksaan (<?= $jml ?>)
                </div>
              </div>
              <div class="col-6">
                <div class="form-group pull-right my-5">
                  <div class="btn-group">
                    <button type="button" onclick="_request()" class="btn btn-primary btn-block"> <i class="fe fe-calendar"></i> Request Jadwal </button>
                  </div>
                  <div class="btn-group ml-2">
                    <button type="button" onclick="_new()" class="btn btn-primary btn-block"> <i class="fe fe-plus"></i> Buat Pemeriksaan </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="table-responsive">
              <?php if(!$data){  }else{ ?>
              <div class="card">
                <table class="table table-striped m-0">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Nama Rumah Sakit</th>
                      <th>Jenis Pemeriksaan</th>
                      <th>Dokter</th>
                      <th>Laboratorium</th>
                      <th>Hari</th>
                      <th>Waktu</th>
                      <th>Status</th>
                      <th>Keterangan</th>
                      <th class="text-center"> <i class="fe fe-settings"></i> </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      foreach ($data as $key => $value) { $no++;
                        // $x = ($page - 1) * 5 + $no;

                        // $img = './assets/images/img-placeholder.jpg';
                        // $tl = _date($value['tanggal_lahir']);

                        // echo json_encode($value);

                        $lab = _getwhere('laboratorium', ['id' => $value['id_lab']])->row_array() ?? ['nama_lab' => '-'];

                        echo "
                          <tr class='".($value['sp'] == 'ditolak' ? 'text-danger' : '')."'>
                            <td class='text-center'>$no</td>
                            <td>$value[rsn]</td>
                            <td>$value[jenis]</td>
                            <td>".($value['jenis'] == 'dokter' ? $value['nama'] : '-')."</td>
                            <td>$lab[nama_lab]</td>
                            <td>$value[jh]</td>
                            <td>$value[jadwal_jam]</td>
                            <td>$value[sp]</td>
                            <td>$value[keterangan]</td>
                            
                            <td class='text-center'>
                              <div class=''>
                                <button type='button' class='btn btn-sm btn-danger'  style='".($value['sp'] != 'menunggu' ? 'display:none' : 'block')."' onclick='_delete($value[idp])'> <i class='fe fe-trash'></i> </button>
                                <button type='button' class='btn btn-sm btn-success' style='".($value['notif_ke'] != auth('id') ? 'display:none' : 'block')."' onclick='_seen($value[idp])'> <i class='fe fe-eye'></i> </button>
                              </div>
                            </td>
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

        let listDokter = [], id_rumahsakit = 0, tipe = 0

        function _new(){
          fn.modal({
            id: 'form-pemeriksaan',
            title: 'Form Pemeriksaan',
            script: () => {
              tipe = 0
              $('#hari').html('<span class="text-muted">Pilih rumah sakit</span>')
              $('#jb,#jt').prop('disabled', true)
            },
            submit: (e) => {
              fn.request({
                  url: 'pemeriksaan/store',
                  data: new FormData($(e).find('form')[0]),
                  spiner:  $(e).find('button[type=submit]'),
                  success: (res) => {
                      toast('Berhasil dikirim')
                      reload()
                  }
              })

              return false
            }
          })
        }

        function _request(){
          fn.modal({
            id: 'form-pemeriksaan',
            title: 'Form Permohonan Jadwal',
            script: () => {
              tipe = 1

              $('#jb,#jt').prop('disabled', false)
              $('#hari').html('')

              let jadwal = ['senin','selasa','rabu','kamis','jumat','sabtu','minggu']
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
            },
            submit: (e) => {
              fn.request({
                  url: 'pemeriksaan/store',
                  data: new FormData($(e).find('form')[0]),
                  spiner:  $(e).find('button[type=submit]'),
                  success: (res) => {
                      toast('Berhasil dikirim')
                      reload()
                  }
              })

              return false
            }
          })
        }

        function _getDokter(e){
          let id = e.value
          id_rumahsakit = id

          if(tipe == 0){
            $('#hari').html('<span class="text-muted" id="pilih">Pilih dokter</span>')
          }

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

          if(tipe == 0){

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

          $('#pilih').html('Pilih dokter')

          if($(e).is(':checked')){
            $('#doc').hide()
            $('#lab').show()

            $('#pilih').html('Pilih laboratorium')
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
              message: 'Yakin ingin membatalkan dan menghapus permiksaan ini?',
              textConfirm: 'Ya',
              confirm: (e) => {
                  fn.request({
                      url: 'pemeriksaan/delete/'+id,
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

        function _seen(id){
          
          fn.request({
              url: 'pemeriksaan/seen/'+id,
              success: (res) => {
                  reload()
              }
          })

        }

    </script>

  </body>
</html>
