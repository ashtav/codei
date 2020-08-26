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
                  <h3 class="m-0"> <a href="./">Profil Saya</a></h3>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-4">
                <div class="card p-2">
                  <ul class="list-group">
                    <?php

                      $labels = ['Nama Lengkap','Tempat & Tanggal Lahir','Jenis Kelamin','Alamat','No. Telepon'];
                      $values = [
                        $auth['nama'],
                        $auth['tempat_lahir'].', '.$auth['tanggal_lahir'],
                        $auth['jenis_kelamin'],
                        $auth['alamat'] ?? '-',
                        $auth['telepon'] ?? '-',
                      ];

                      for ($i=0; $i < count($labels); $i++) { 
                        echo "
                          <li class='list-group-item'>
                            <b>$labels[$i]</b> <br> $values[$i]
                          </li>
                        ";
                      }

                    ?>
                  </ul>

                  <button onclick='_edit(<?= json_encode($auth) ?>)' class="btn btn-outline-primary mt-2"> Edit Profil </button>

                </div>
              </div>

              <div class="col-lg-4">
                <div class="card p-2">
                  <ul class="list-group">
                    <?php

                      $labels = ['Email','Password'];
                      $values = [
                        $auth['email'],
                        '******'
                      ];

                      for ($i=0; $i < count($labels); $i++) { 
                        echo "
                          <li class='list-group-item'>
                            <b>$labels[$i]</b> <br> $values[$i]
                          </li>
                        ";
                      }

                    ?>
                  </ul>

                  <button onclick='_editAccount(<?= json_encode($auth) ?>)' class="btn btn-outline-primary mt-2"> Edit Akun </button>

                </div>
              </div>

              <div class="col-lg-4">
                <div class="card p-2">

                  <img src="<?= $auth['foto'] == null ? url('assets/images/profile.png') : url('images/'.$auth['foto']) ?>" alt="" id="img" style="border-radius: 3px">

                  <div class="btn-group">
                    <button onclick="$('#file').click()" class="btn btn-outline-primary mt-2"> Edit Foto </button>
                    <button onclick="$('#form').submit()" id="submit" class="btn btn-outline-primary mt-2"> Simpan </button>
                  </div>

                  <form onsubmit="return _saveFoto(this)" id="form" class="d-none" >
                    <input type="file" id="file" name="file" onchange="fn.onFile(this, 'img')">
                  </form>

                </div>
              </div>

            </div>

          </div>

        </div>
      </div>
    </div>

    <?php
      $this->load->view('partials/script');
      $this->load->view('pages/dashboard/users/modals/form-user');
      $this->load->view('pages/dashboard/users/modals/form-account');

    ?>

    <script>

        function _edit(data){
          fn.modal({
            id: 'form-user',
            title: 'Edit Profil',
            data: data,
            submit: (e) => {
              fn.request({
                  url: 'users/update/'+data.id,
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

        function _editAccount(data){
          fn.modal({
            id: 'form-account',
            title: 'Edit Akun',
            data: data,
            submit: (e) => {
              let pass = $(e).find('input[type=password]')

              if(pass[0].value != pass[1].value){
                toast('Konfirmasi password tidak sama')
                return false
              }

              fn.request({
                  url: 'users/update_account/'+data.id,
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

        function _saveFoto(f){
          fn.request({
            url: 'users/update_foto',
            data: new FormData($(f)[0]),
            spiner:  $('#submit'),
            success: () => {
                toast('Berhasil diperbarui')
                reload()
            }
          })

          return false
        }

    </script>

  </body>
</html>
