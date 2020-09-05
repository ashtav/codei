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
                  <h3 class="m-0"> <a href="./">Pemberitahuan</a></h3>
                  Jumlah Pemberitahuan
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
                      <th>Jenis Pemeriksaan</th>
                      <th>Dokter</th>
                      <th>Laboratorium</th>
                      <th>Hari</th>
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
                          <tr>
                            <td class='text-center'>$no</td>
                            <td>$value[jenis]</td>
                            <td>".($value['jenis'] == 'dokter' ? $value['nama'] : '-')."</td>
                            <td>$lab[nama_lab]</td>
                            <td>$value[jh]</td>
                            <td>$value[sp]</td>
                            <td>$value[keterangan]</td>
                            
                            <td class='text-center'>
                              <div class='btn-group' style='".($value['sp'] != 'menunggu' ? 'display:none' : 'block')."'>
                                <button type='button' class='btn btn-sm btn-success' onclick='_accept($value[idp])'> <i class='fe fe-check'></i> </button>
                                <button type='button' class='btn btn-sm btn-danger' onclick='_rejected($value[idp])'> <i class='fe fe-x'></i> </button>
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
      $this->load->view('pages/dashboard/pemberitahuan/modals/form-accept');
      $this->load->view('pages/dashboard/pemberitahuan/modals/form-reject');
    ?>

    <script>

        let listDokter = [], id_rumahsakit = 0

        function _accept(id){
          fn.modal({
            id: 'form-accept',
            title: 'Inputkan Keterangan',
            submit: (e) => {
              fn.request({
                  url: 'pemberitahuan/accept/'+id,
                  data: new FormData($(e).find('form')[0]),
                  spiner:  $(e).find('button[type=submit]'),
                  success: (res) => {
                      toast('Berhasil diterima')
                      reload()
                  }
              })

              return false
            }
          })
        }

        function _rejected(id){
          fn.modal({
            id: 'form-reject',
            title: 'Inputkan Keterangan',
            submit: (e) => {
              fn.request({
                  url: 'pemberitahuan/reject/'+id,
                  data: new FormData($(e).find('form')[0]),
                  spiner:  $(e).find('button[type=submit]'),
                  success: (res) => {
                      toast('Berhasil ditolak')
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
