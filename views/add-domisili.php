<div class="table-responsive">
  <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th class="text-center" rowspan="2">#</th>
        <th class="text-center" rowspan="2">No. Surat</th>
        <th class="text-center" colspan="4">Yang bertandatangan dibawah ini</th>
        <th class="text-center" colspan="6">Menerangkan dengan sebenarnya bahwa</th>
        <th class="text-center" rowspan="2">Aksi</th>
      </tr>
      <tr>
        <th class="text-center">Nama</th>
        <th class="text-center">Jabatan</th>
        <th class="text-center">Jenis Kelamin</th>
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
        <th class="text-center" colspan="4">Yang bertandatangan dibawah ini</th>
        <th class="text-center" colspan="6">Menerangkan dengan sebenarnya bahwa</th>
        <th class="text-center" rowspan="2">Aksi</th>
      </tr>
      <tr>
        <th class="text-center">Nama</th>
        <th class="text-center">Jabatan</th>
        <th class="text-center">Jenis Kelamin</th>
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
      foreach ($views_suket_domisili as $data) { ?>
        <tr>
          <td><?= $no ?></td>
          <td><?= $data['no_surat'] ?></td>
          <td><?= $data['nama_p1'] ?></td>
          <td><?= $data['jabatan_p1'] ?></td>
          <td><?= $data['jk_p1'] ?></td>
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
            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $data['id_suket_domisili'] ?>">
              <i class="bi bi-pencil-square"></i> Ubah
            </button>
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['id_suket_domisili'] ?>">
              <i class="bi bi-trash3"></i> Hapus
            </button>
            <a href="export-domisili?id=<?= $data['id_suket_domisili'] ?>" target="_blank" class="btn btn-primary btn-sm" rel="noopener noreferrer"><i class="bi bi-printer"></i> Cetak</a>

            <div class="modal fade" id="ubah<?= $data['id_suket_domisili'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header border-bottom-0 shadow">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $data['no_surat'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="" method="post">
                    <input type="hidden" name="id_suket_domisili" value="<?= $data['id_suket_domisili'] ?>">
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
                          foreach ($views_rt as $data_rt) {
                            $selected = ($alamat_p1 == "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi']) ? 'selected' : ''; ?>
                            <option value="<?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>" <?= $selected ?>>
                              <?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>
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
                        <select name="pekerjaan_p2" class="form-control" id="pekerjaan_p2<?= $data['id_suket_domisili'] ?>" onchange="showInput<?= $data['id_suket_domisili'] ?>()">
                          <?php $pekerjaan_p2 = $data['pekerjaan_p2'];
                          foreach ($pekerjaan as $pkr) {
                            $selected = ($pkr == $pekerjaan_p2) ? 'selected' : '';  ?>
                            <option value="<?= $pkr ?>" <?= $selected ?>><?= $pkr ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group" id="inputManual<?= $data['id_suket_domisili'] ?>" style="display: none;">
                        <label for="pekerjaan_p2_other">Pekerjaan Lainnya</label>
                        <input type="text" name="pekerjaan_p2_other" value="<?= $data['pekerjaan_p2'] ?>" class="form-control" id="pekerjaan_p2_other" minlength="3">
                      </div>
                      <script>
                        function showInput<?= $data['id_suket_domisili'] ?>() {
                          var select = document.getElementById("pekerjaan_p2<?= $data['id_suket_domisili'] ?>");
                          var inputManual = document.getElementById("inputManual<?= $data['id_suket_domisili'] ?>");

                          if (select.value === "Lainnya") {
                            inputManual.style.display = "block";
                          } else {
                            inputManual.style.display = "none";
                          }
                        }
                      </script>
                      <hr>
                      <p>Yang bersangkutan benar-benar warga masyarakat yang berdomisili di desa:</p>
                      <div class="form-group">
                        <select name="id_desa" class="form-control" id="id_desa" required>
                          <option value="" disabled selected>Pilih Desa</option>
                          <?php $id_desa = $data['id_desa'];
                          foreach ($views_desa as $data_desa) {
                            $selected = ($data_desa['id_desa'] == $id_desa) ? 'selected' : '';  ?>
                            <option value="<?= $data_desa['id_desa'] ?>" <?= $selected ?>><?= "Desa " . $data_desa['desa'] . ", Kec. " . $data_desa['kecamatan'] . ", Kab. " . $data_desa['kabupaten'] . ", Prov. " . $data_desa['provinsi'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <p>sejak tanggal:</p>
                      <div class="form-group">
                        <input type="date" name="sejak_tgl_p2" value="<?= $data['sejak_tgl_p2'] ?>" class="form-control" id="sejak_tgl_p2" minlength="3" required>
                      </div>
                      <p>dan pada hari ini tanggal:</p>
                      <div class="form-group">
                        <input type="date" name="tgl_surat_p2" value="<?= $data['tgl_surat_p2'] ?>" class="form-control" id="tgl_surat_p2" minlength="3" required>
                      </div>
                      <div class="form-group">
                        <label for="ket_p2">Keterangan Domilisi</label>
                        <textarea class="form-control" name="ket_p2" rows="3"><?= $data['ket_p2'] ?></textarea>
                        <small>Contoh: akan melanjutkan studi ke Kupang di SMK Negeri 3 Kupang</small>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-center border-top-0">
                      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                      <button type="submit" name="edit_suket_domisili" class="btn btn-warning btn-sm">Ubah</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="modal fade" id="hapus<?= $data['id_suket_domisili'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header border-bottom-0 shadow">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['no_surat'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="" method="post">
                    <input type="hidden" name="id_suket_domisili" value="<?= $data['id_suket_domisili'] ?>">
                    <div class="modal-body">
                      <p>Jika anda yakin ingin menghapus <?= $data['no_surat'] ?> klik Hapus!</p>
                    </div>
                    <div class="modal-footer justify-content-center border-top-0">
                      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                      <button type="submit" name="delete_suket_domisili" class="btn btn-danger btn-sm">hapus</button>
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