<div class="modal fade" id="form-lab" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Title</h5>
        <button type="button" class="close no-outline" data-dismiss="modal" aria-label="Close"></button>
      </div>

      <form>
        <div class="modal-body">

          <div class="form-group">
            <label class="form-label">Nama Laboratorium</label>
            <div class="input-icon">
              <input type="text" class="form-control" placeholder="Nama lengkap" name="nama_lab" autocomplete="off">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Pilih Dokter</label>
            <div class="input-icon">
              <select name="id_dokter" class="form-control">
                <?php
                  foreach ($dokter as $key => $value) {
                    echo "<option value='$value[id]'>$value[nama]</option>";
                  }
                ?>
              </select>
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
