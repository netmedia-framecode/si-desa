<div class="table-responsive">
  <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th class="text-center" rowspan="2">#</th>
        <th class="text-center" rowspan="2">No. Surat</th>
        <th class="text-center" colspan="3">Yang bertandatangan dibawah ini</th>
        <th class="text-center" colspan="6">Menerangkan dengan sebenarnya bahwa</th>
        <th class="text-center" rowspan="2">Aksi</th>
      </tr>
      <tr>
        <th class="text-center">Nama</th>
        <th class="text-center">Jabatan</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Nama</th>
        <th class="text-center">TTL</th>
        <th class="text-center">Jenis Kelamin</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Agama</th>
        <th class="text-center">Pekerjaan</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th class="text-center" rowspan="2">#</th>
        <th class="text-center" rowspan="2">No. Surat</th>
        <th class="text-center" colspan="3">Yang bertandatangan dibawah ini</th>
        <th class="text-center" colspan="6">Menerangkan dengan sebenarnya bahwa</th>
        <th class="text-center" rowspan="2">Aksi</th>
      </tr>
      <tr>
        <th class="text-center">Nama</th>
        <th class="text-center">Jabatan</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Nama</th>
        <th class="text-center">TTL</th>
        <th class="text-center">Jenis Kelamin</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Agama</th>
        <th class="text-center">Pekerjaan</th>
      </tr>
    </tfoot>
    <tbody>
      <?php $no = 1;
      foreach ($views_suket_kematian as $data) { ?>
        <tr>
          <td><?= $no ?></td>
          <td><?= $data['no_surat'] ?></td>
          <td><?= $data['nama_p1'] ?></td>
          <td><?= $data['jabatan_p1'] ?></td>
          <td><?= $data['alamat_p1'] ?></td>
          <td><?= $data['nama_p2'] ?></td>
          <td><?php $tgl_lahir_p2 = date_create($data["tgl_lahir_p2"]);
              $tgl_lahir_p2 = date_format($tgl_lahir_p2, "d M Y");
              echo $data['tempat_lahir_p2'] . ", " . $tgl_lahir_p2; ?></td>
          <td><?= $data['jk_p2'] ?></td>
          <td><?= $data['alamat_p2'] ?></td>
          <td><?= $data['agama_p2'] ?></td>
          <td><?= $data['pekerjaan_p2'] ?></td>
          <td class="text-center">
            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $data['id_suket_kematian'] ?>">
              <i class="bi bi-pencil-square"></i> Ubah
            </button>
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['id_suket_kematian'] ?>">
              <i class="bi bi-trash3"></i> Hapus
            </button>
            <a href="export-kematian?id=<?= $data['id_suket_kematian'] ?>" target="_blank" class="btn btn-primary btn-sm" rel="noopener noreferrer"><i class="bi bi-printer"></i> Cetak</a>

            <div class="modal fade" id="ubah<?= $data['id_suket_kematian'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header border-bottom-0 shadow">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $data['no_surat'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="" method="post">
                    <input type="hidden" name="id_suket_kematian" value="<?= $data['id_suket_kematian'] ?>">
                    <input type="hidden" name="no_suratOld" value="<?= $data['no_surat'] ?>">
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="no_surat">Nomor</label>
                        <input type="text" name="no_surat" value="<?= $data['no_surat'] ?>" class="form-control" id="no_surat" minlength="3" required>
                      </div>
                      <hr>
                      <p>Yang bertandatangan di bawah ini:</p>
                      <div class="form-group">
                        <label for="nama_p1">Nama</label>
                        <input type="text" name="nama_p1" value="<?= $data['nama_p1'] ?>" class="form-control" id="nama_p1" minlength="3" required>
                      </div>
                      <div class="form-group">
                        <label for="jabatan_p1">Jabatan</label>
                        <input type="text" name="jabatan_p1" value="<?= $data['jabatan_p1'] ?>" class="form-control" id="jabatan_p1" minlength="3" required>
                      </div>
                      <div class="form-group">
                        <label for="jk_p1">Jenis Kelamin</label>
                        <select name="jk_p1" class="form-control" id="jk_p1" required>
                          <?php $jk_p1 = $data['jk_p1'];
                          foreach ($jenis_kelamin as $jk) {
                            $selected = ($jk == $jk_p1) ? 'selected' : ''; ?>
                            <option value="<?= $jk ?>" <?= $selected ?>><?= $jk ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="alamat_p1">Alamat</label>
                        <select name="alamat_p1" class="form-control" id="alamat_p1" required>
                          <?php $alamat_p1 = $data['alamat_p1'];
                          foreach ($views_desa as $data_desa) {
                            $selected = ($alamat_p1 == "Desa " . $data_desa['desa'] . ", Kec. " . $data_desa['kecamatan'] . ", Kab. " . $data_desa['kabupaten'] . ", Prov. " . $data_desa['provinsi']) ? 'selected' : ''; ?>
                            <option value="<?= "Desa " . $data_desa['desa'] . ", Kec. " . $data_desa['kecamatan'] . ", Kab. " . $data_desa['kabupaten'] . ", Prov. " . $data_desa['provinsi'] ?>" <?= $selected ?>>
                              <?= "Desa " . $data_desa['desa'] . ", Kec. " . $data_desa['kecamatan'] . ", Kab. " . $data_desa['kabupaten'] . ", Prov. " . $data_desa['provinsi'] ?>
                            </option>
                          <?php } ?>
                        </select>
                      </div>
                      <hr>
                      <p>Menerangkan dengan sebenarnya bahwa :</p>
                      <div class="form-group">
                        <label for="nama_p2">Nama</label>
                        <input type="text" name="nama_p2" value="<?= $data['nama_p2'] ?>" class="form-control" id="nama_p2" minlength="3" required>
                      </div>
                      <div class="form-group">
                        <label for="tempat_lahir_p2">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir_p2" value="<?= $data['tempat_lahir_p2'] ?>" class="form-control" id="tempat_lahir_p2" minlength="3" required>
                      </div>
                      <div class="form-group">
                        <label for="tgl_lahir_p2">Tgl Lahir</label>
                        <input type="date" name="tgl_lahir_p2" value="<?= $data['tgl_lahir_p2'] ?>" class="form-control" id="tgl_lahir_p2" minlength="3" required>
                      </div>
                      <div class="form-group">
                        <label for="jk_p2">Jenis Kelamin</label>
                        <select name="jk_p2" class="form-control" id="jk_p2" required>
                          <?php $jk_p2 = $data['jk_p2'];
                          foreach ($jenis_kelamin as $jk) {
                            $selected = ($jk == $jk_p2) ? 'selected' : ''; ?>
                            <option value="<?= $jk ?>" <?= $selected ?>><?= $jk ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="alamat_p2">Alamat</label>
                        <select name="alamat_p2" class="form-control" id="alamat_p2" required>
                          <?php $alamat_p2 = $data['alamat_p2'];
                          foreach ($views_rt as $data_rt) {
                            $selected = ($alamat_p2 == "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi']) ? 'selected' : ''; ?>
                            <option value="<?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>" <?= $selected ?>>
                              <?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>
                            </option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="agama_p2">Agama</label>
                        <select name="agama_p2" class="form-control" id="agama_p2" required>
                          <?php $agama_p2 = $data['agama_p2'];
                          foreach ($agama as $agm) {
                            $selected = ($agm == $agama_p2) ? 'selected' : '';  ?>
                            <option value="<?= $agm ?>" <?= $selected ?>><?= $agm ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="pekerjaan_p2">Pekerjaan</label>
                        <select name="pekerjaan_p2" class="form-control" id="pekerjaan_p2<?= $data['id_suket_kematian'] ?>" onchange="showInput<?= $data['id_suket_kematian'] ?>()">
                          <?php $pekerjaan_p2 = $data['pekerjaan_p2'];
                          foreach ($pekerjaan as $pkr) {
                            $selected = ($pkr == $pekerjaan_p2) ? 'selected' : '';  ?>
                            <option value="<?= $pkr ?>" <?= $selected ?>><?= $pkr ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group" id="inputManual<?= $data['id_suket_kematian'] ?>" style="display: none;">
                        <label for="pekerjaan_p2_other">Pekerjaan Lainnya</label>
                        <input type="text" name="pekerjaan_p2_other" value="<?= $data['pekerjaan_p2'] ?>" class="form-control" id="pekerjaan_p2_other" minlength="3">
                      </div>
                      <script>
                        function showInput<?= $data['id_suket_kematian'] ?>() {
                          var select = document.getElementById("pekerjaan_p2<?= $data['id_suket_kematian'] ?>");
                          var inputManual = document.getElementById("inputManual<?= $data['id_suket_kematian'] ?>");

                          if (select.value === "Lainnya") {
                            inputManual.style.display = "block";
                          } else {
                            inputManual.style.display = "none";
                          }
                        }
                      </script>
                      <hr>
                      <div class="form-group">
                        <label for="id_desa">Tempat Domisili</label>
                        <select name="id_desa" class="form-control" id="id_desa" required>
                          <?php $id_desa = $data['id_desa'];
                          foreach ($views_desa as $data_desa) {
                            $selected = ($data_desa['id_desa'] == $id_desa) ? 'selected' : ''; ?>
                            <option value="<?= $data_desa['id_desa'] ?>" <?= $selected ?>><?= "Desa " . $data_desa['desa'] . ", Kec. " . $data_desa['kecamatan'] . ", Kab. " . $data_desa['kabupaten'] . ", Prov. " . $data_desa['provinsi'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="id_desa_kematian">Lokasi Meninggal Dunia</label>
                        <select name="id_desa_kematian" class="form-control" id="id_desa_kematian" required>
                          <?php $id_desa_kematian = $data['id_desa_kematian'];
                          foreach ($views_desa as $data_desa) {
                            $selected = ($data_desa['id_desa'] == $id_desa_kematian) ? 'selected' : ''; ?>
                            <option value="<?= $data_desa['id_desa'] ?>" <?= $selected ?>><?= "Desa " . $data_desa['desa'] . ", Kec. " . $data_desa['kecamatan'] . ", Kab. " . $data_desa['kabupaten'] . ", Prov. " . $data_desa['provinsi'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="tgl_kematian">Tgl Kematian</label>
                            <input type="date" name="tgl_kematian" value="<?= $data['tgl_kematian'] ?>" class="form-control" id="tgl_kematian" required>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="waktu_kematian">Waktu Kematian</label>
                            <input type="time" name="waktu_kematian" value="<?= $data['waktu_kematian'] ?>" class="form-control" id="waktu_kematian" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-center border-top-0">
                      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                      <button type="submit" name="edit_suket_kematian" class="btn btn-warning btn-sm">Ubah</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="modal fade" id="hapus<?= $data['id_suket_kematian'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header border-bottom-0 shadow">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['no_surat'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="" method="post">
                    <input type="hidden" name="id_suket_kematian" value="<?= $data['id_suket_kematian'] ?>">
                    <div class="modal-body">
                      <p>Jika anda yakin ingin menghapus <?= $data['no_surat'] ?> klik Hapus!</p>
                    </div>
                    <div class="modal-footer justify-content-center border-top-0">
                      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                      <button type="submit" name="delete_suket_kematian" class="btn btn-danger btn-sm">hapus</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          </td>
        </tr>
      <?php $no++;
      } ?>
    </tbody>
  </table>
</div>