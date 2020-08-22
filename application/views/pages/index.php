<?php $this->load->view('partials/header') ?>

  <body>

    <div class="page">
      <div class="flex-fill">
        <div class="my-3 my-md-5">

          <div class="container">

            <div class="row">
              <div class="col-6">
                <div class="my-5">
                  <h3 class="m-0"> <a href="./">Data Mahasiwa</a></h3>
                  ITB Stikom Bali - Sistem Informasi
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
              <?php if(!$users){ _empty(); }else{ ?>
              <div class="card">
                <table class="table table-striped m-0">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Nim</th>
                      <th>Nama Mahasiswa</th>
                      <th>Tempat & Tgl Lahir</th>
                      <th>Jenis Kelamin</th>
                      <th>Alamat</th>
                      <th>No. Telepon</th>
                      <th class="text-center"> <i class="fe fe-settings"></i> </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      foreach ($users as $key => $value) { $no++;
                        $x = ($page - 1) * 5 + $no;

                        $img = './assets/images/img-placeholder.jpg';
                        $tl = _date($value['tanggal_lahir']);

                        echo "
                          <tr>
                            <th class='text-center'>$x</th>
                            <th>$value[nim]</th>
                            <th>$value[nama]</th>
                            <th>$value[tempat_lahir], $tl</th>
                            <th>$value[jenis_kelamin]</th>
                            <th>$value[alamat]</th>
                            <th>$value[telepon]</th>
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
      $this->load->view('pages/modals/new-data');
      $this->load->view('pages/modals/edit-data');
      $this->load->view('partials/script');
    ?>

    <script type="text/javascript">

      // create
      function new_product(f){
        fn.new(f, {url: 'admin/index/new'});
        return false;
      }

      // update
      function _edit(a, id){
        let m = $('#edit-data');

        let data = fn.get(a, 'admin/index/get/'+id, m);
        if(data){
          m.modal('show');
        }

        // set form edit
        fn.edit({
          form: m.find('form')[0],
          url: 'admin/index/edit/'+id,
        });
      }

      // delete
      function _delete(id){
        fn.del({
          url: 'admin/index/delete/'+id
        });
      }

      // search
      function search(f){
        let input = $(f).find('input').val();
        location.href = '?q='+input;
        return false;
      }

      // set pagination
      function setPagination(){
        let url = new URLSearchParams(window.location.search);
        let page = url.get('page');
        let q = url.get('q');

        $.ajax({
          url: 'admin/index/pagination',
          type: 'post', data: {q: q},
          success: function(res){
            let d = JSON.parse(res);

            for (let i = 1; i <= Math.ceil(d.num_product / 5); i++) {

              let btn = 'btn-outline-primary', disabled = '';
              if(page == i || !page && i == 1){
                btn = 'btn-primary', disabled = 'disabled';
              }

              $('#paginate .btn-group').append(
                '<a href="?page='+i+'&perPage=5" class="btn '+btn+' '+disabled+'">'+i+'</a>'
              )
            }

          }, error: function(err){
            toast(err.status+' - '+err.statusText);
            btn.html(btnLabel).disf();
          }
        })
      }

      setPagination();

    </script>

  </body>
</html>
