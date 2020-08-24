<div class="modal fade" id="form-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Title</h5>
        <button type="button" class="close no-outline" data-dismiss="modal" aria-label="Close"></button>
      </div>

      <form>
        <div class="modal-body">

          <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <div class="input-icon">
              <input type="text" class="form-control" placeholder="Nama lengkap" name="nama" autocomplete="off">
            </div>
          </div>

          <div class="row">
            <div class="col-7">
              <div class="form-group">
                <label class="form-label">Tempat & Tanggal Lahir</label>
                <div class="input-icon">
                  <input type="text" class="form-control" placeholder="Tempat lahir" name="tempat_lahir" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-5">
              <div class="form-group">
                <label class="form-label">&nbsp;</label>
                <div class="input-icon">
                  <input type="date" class="form-control" name="tanggal_lahir" autocomplete="off">
                </div>
              </div>

            </div>
          
          </div>

          <div class="form-group">
            <div class="form-label">Jenis Kelamin</div>
            <div class="custom-controls-stacked">
              <label class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" name="jenis_kelamin" value="Laki-laki" checked>
                <span class="custom-control-label">Laki-laki</span>
              </label>
              <label class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" name="jenis_kelamin" value="Perempuan">
                <span class="custom-control-label">Perempuan</span>
              </label>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Alamat</label>
            <div class="input-icon">
              <input type="text" class="form-control" placeholder="Alamat" name="alamat" autocomplete="off">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">No. Telepon</label>
            <div class="input-icon">
              <input type="tel" class="form-control" placeholder="No. telepon" name="telepon" autocomplete="off">
            </div>
          </div>

          <!-- <div id="account">
            <div class="form-group">
              <label class="form-label">Email</label>
              <div class="input-icon">
                <input type="email" class="form-control" placeholder="Inputkan email" name="email" autocomplete="off">
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Password</label>
              <div class="input-icon">
                <input type="password" class="form-control" placeholder="Inputkan password" name="password" autocomplete="off">
              </div>
            </div>
          </div> -->

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
