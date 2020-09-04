<div class="modal fade" id="form-pemeriksaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Title</h5>
        <button type="button" class="close no-outline" data-dismiss="modal" aria-label="Close"></button>
      </div>

      <form>
        <div class="modal-body">

          <div class="form-group">
            <label class="form-label">Pilih Rumah Sakit</label>
            <div class="input-icon">
              <select name="id_rumahsakit" class="form-control" onchange="_getDokter(this)" required>
                <option value="">Pilih Rumah Sakit</option>
                <?php
                  foreach ($rumahsakit as $key => $value) {
                    echo "<option value='$value[id]'>$value[nama]</option>";
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="custom-switch p-0">
              <input type="checkbox" name="jenis" value="1" class="custom-switch-input" onclick="_switch(this)">
              <span class="custom-switch-indicator"></span>
              <span class="custom-switch-description">Saya ingin cek laboratorium</span>
            </label>
          </div>

          <div class="form-group" id="doc">
            <label class="form-label">Pilih Dokter</label>
            <div class="input-icon">
              <select name="id_dokter" class="form-control" id="listdokter" onchange="_getJadwal(this)">
                  <option value="">Pilih Dokter</option>
              </select>
            </div>
          </div>

          <div class="form-group" id="lab" style="display: none">
            <label class="form-label">Pilih Laboratorium</label>
            <div class="input-icon">
              <select name="id_lab" class="form-control" id="listLab" onchange="_getJadwal(this)">
                  <option value="">Pilih Laboratorium</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label">Pilih Hari</div>
            <div class="custom-controls-stacked" id="hari">
              <span class="text-muted">Pilih rumah sakit</span>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Waktu</label>
            <div class="row">
              <div class="col-6">
                <input type="time" class="form-control" name="jam_buka" id="jb" autocomplete="off" disabled>
              </div>
              <div class="col-6">
                <input type="time" class="form-control" name="jam_tutup" id="jt" autocomplete="off" disabled>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-outline-primary">Kirim</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
