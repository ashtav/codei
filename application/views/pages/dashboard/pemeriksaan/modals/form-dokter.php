<div class="modal fade" id="form-dokter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Title</h5>
        <button type="button" class="close no-outline" data-dismiss="modal" aria-label="Close"></button>
      </div>

      <form>
        <div class="modal-body">

          <div class="row">
            <div class="col-md-4">
              <img src="<?= url('assets/images/profile.png') ?>" alt="" id="img" style="border-radius: 3px">
              <div class="mt-2">
                <input type="file" name="file" class="d-none" id="file" onchange="fn.onFile(this, 'img')">
                <button type="button" onclick="$('#file').click()" class="btn btn-outline-primary btn-block">Pilih Foto</button>
              </div>
            </div>
            <div class="col-md-8">

              <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <div class="input-icon">
                  <input type="text" class="form-control" placeholder="Nama lengkap" name="nama" autocomplete="off">
                </div>
              </div>

              <div class="form-group">
                <label class="form-label">Spesialis</label>
                <div class="input-icon">
                  <input type="text" class="form-control" placeholder="Spesialis" name="spesialis" autocomplete="off">
                </div>
              </div>

              <div class="form-group">
                <label class="form-label">No. Telepon</label>
                <div class="input-icon">
                  <input type="tel" class="form-control" placeholder="No. telepon" name="telepon" autocomplete="off">
                </div>
              </div>
            
            </div>
          </div>

          <div class="form-group">
            <div class="form-label">Jadwal Hari</div>
            <div class="custom-controls-stacked">
              <?php
                $checks = ['senin','selasa','rabu','kamis','jumat','sabtu','minggu'];

                for ($i=0; $i < count($checks); $i++) { 
              ?>
                <label class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" class="custom-control-input" name="jadwal_hari[]" value="<?= $checks[$i] ?>" checked>
                  <span class="custom-control-label"><?= ucwords($checks[$i]) ?></span>
                </label>
              <?php } ?>
              
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Jadwal Waktu</label>
            <div class="row">
              <div class="col-6">
                <input type="time" class="form-control" name="jam_buka" autocomplete="off">
              </div>
              <div class="col-6">
                <input type="time" class="form-control" name="jam_tutup" autocomplete="off">
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-outline-primary">Simpan</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
