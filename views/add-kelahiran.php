<div class="table-responsive">
  <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th class="text-center" rowspan="2">#</th>
        <th class="text-center" rowspan="2">No. Surat</th>
        <th class="text-center" colspan="3">Yang bertandatangan dibawah ini</th>
        <th class="text-center" colspan="5">Menerangkan dengan sebenarnya bahwa telah lahir seorang anak</th>
        <th class="text-center" colspan="8">Yakni benar-benar anak dari pasangan Suami Isteri</th>
        <th class="text-center" rowspan="2">Aksi</th>
      </tr>
      <tr>
        <th class="text-center">Nama</th>
        <th class="text-center">Jabatan</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Nama</th>
        <th class="text-center">Jenis Kelamin</th>
        <th class="text-center">TTL</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Anak yang ke</th>
        <th class="text-center">Nama Ayah</th>
        <th class="text-center">Umur</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Pekerjaan</th>
        <th class="text-center">Nama Ayah</th>
        <th class="text-center">Umur</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Pekerjaan</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th class="text-center" rowspan="2">#</th>
        <th class="text-center" rowspan="2">No. Surat</th>
        <th class="text-center" colspan="3">Yang bertandatangan dibawah ini</th>
        <th class="text-center" colspan="5">Menerangkan dengan sebenarnya bahwa telah lahir seorang anak</th>
        <th class="text-center" colspan="8">Yakni benar-benar anak dari pasangan Suami Isteri</th>
        <th class="text-center" rowspan="2">Aksi</th>
      </tr>
      <tr>
        <th class="text-center">Nama</th>
        <th class="text-center">Jabatan</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Nama</th>
        <th class="text-center">Jenis Kelamin</th>
        <th class="text-center">TTL</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Anak yang ke</th>
        <th class="text-center">Nama Ayah</th>
        <th class="text-center">Umur</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Pekerjaan</th>
        <th class="text-center">Nama Ayah</th>
        <th class="text-center">Umur</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Pekerjaan</th>
      </tr>
    </tfoot>
    <tbody>
      <?php $no = 1;
      foreach ($views_suket_kelahiran as $data) { ?>
        <tr>
          <td><?= $no ?></td>
          <td><?= $data['no_surat'] ?></td>
          <td><?= $data['nama_p1'] ?></td>
          <td><?= $data['jabatan_p1'] ?></td>
          <td><?= $data['alamat_p1'] ?></td>
          <td><?= $data['nama_p2'] ?></td>
          <td><?= $data['jk_p2'] ?></td>
          <td><?php $tgl_lahir_p2 = date_create($data["tgl_lahir_p2"]);
              $tgl_lahir_p2 = date_format($tgl_lahir_p2, "d M Y");
              echo $data['tempat_lahir_p2'] . ", " . $tgl_lahir_p2; ?></td>
          <td><?= $data['alamat_p2'] ?></td>
          <td><?= $data['anak_ke_p2'] ?></td>
          <td><?= $data['nama_ayah'] ?></td>
          <td><?= $data['umur_ayah'] ?></td>
          <td><?= $data['alamat_ayah'] ?></td>
          <td><?= $data['pekerjaan_ayah'] ?></td>
          <td><?= $data['nama_ibu'] ?></td>
          <td><?= $data['umur_ibu'] ?></td>
          <td><?= $data['alamat_ibu'] ?></td>
          <td><?= $data['pekerjaan_ibu'] ?></td>
          <td class="text-center">
            <?php if (empty($data['no_surat'])) { ?>
              <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $data['id_suket_kelahiran'] ?>">
                <i class="bi bi-pencil-square"></i> Ubah
              </button>
              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['id_suket_kelahiran'] ?>">
                <i class="bi bi-trash3"></i> Hapus
              </button>
            <?php } ?>
            <a href="export-kelahiran?id=<?= $data['id_suket_kelahiran'] ?>" target="_blank" class="btn btn-primary btn-sm" rel="noopener noreferrer"><i class="bi bi-printer"></i> Cetak</a>

            <?php if (empty($data['no_surat'])) { ?>
              <div class="modal fade" id="ubah<?= $data['id_suket_kelahiran'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header border-bottom-0 shadow">
                      <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $data['no_surat'] ?></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="" method="post">
                      <input type="hidden" name="id_suket_kelahiran" value="<?= $data['id_suket_kelahiran'] ?>">
                      <input type="hidden" name="email" value="<?= $data['email'] ?>">
                      <div class="modal-body">
                        <?php if ($id_role == 1) { ?>
                          <input type="hidden" name="no_suratOld" value="<?= $data['no_surat'] ?>">
                          <div class="form-group">
                            <label for="no_surat">Nomor</label>
                            <input type="text" name="no_surat" value="<?= $data['no_surat'] ?>" class="form-control" id="no_surat" minlength="3" required>
                          </div>
                          <hr>
                          <p>Yang bertandatangan di bawah ini:</p>
                          <div class="form-group">
                            <label for="nama_p1">Nama</label>
                            <input type="text" name="nama_p1" value="<?= $name ?>" class="form-control" id="nama_p1" minlength="3" required>
                          </div>
                          <div class="form-group">
                            <label for="jabatan_p1">Jabatan</label>
                            <input type="text" name="jabatan_p1" value="<?= $role ?>" class="form-control" id="jabatan_p1" minlength="3" required>
                          </div>
                          <div class="form-group">
                            <label for="alamat_p1">Alamat</label>
                            <select name="alamat_p1" class="form-control" id="alamat_p1" required>
                              <option value="" disabled selected>Pilih Alamat</option>
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
                        <?php } else if ($id_role == 2) { ?>
                          <input type="hidden" name="no_surat" value="<?= $data['no_surat'] ?>">
                          <input type="hidden" name="nama_p1" value="<?= $data['nama_p1'] ?>">
                          <input type="hidden" name="jabatan_p1" value="<?= $data['jabatan_p1'] ?>">
                          <input type="hidden" name="alamat_p1" value="<?= $data['alamat_p1'] ?>">
                        <?php } ?>
                        <p>Menerangkan dengan sebenarnya bahwa telah lahir seorang anak :</p>
                        <div class="form-group">
                          <label for="nama_p2">Nama</label>
                          <input type="text" name="nama_p2" value="<?= $data['nama_p2'] ?>" class="form-control" id="nama_p2" minlength="3" required>
                        </div>
                        <div class="form-group">
                          <label for="jk_p2">Jenis Kelamin</label>
                          <select name="jk_p2" class="form-control" id="jk_p2" required>
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <?php $jk_p2 = $data['jk_p2'];
                            foreach ($jenis_kelamin as $jk) {
                              $selected = ($jk == $jk_p2) ? 'selected' : ''; ?>
                              <option value="<?= $jk ?>" <?= $selected ?>><?= $jk ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="tempat_lahir_p2">Tempat Lahir</label>
                          <input type="text" name="tempat_lahir_p2" value="<?= $data['tempat_lahir_p2'] ?>" class="form-control" id="tempat_lahir_p2" minlength="3" required>
                        </div>
                        <div class="form-group">
                          <label for="tgl_lahir_p2">Tgl Lahir</label>
                          <input type="date" name="tgl_lahir_p2" value="<?= $data['tgl_lahir_p2'] ?>" class="form-control" id="tgl_lahir_p2" required>
                        </div>
                        <div class="form-group">
                          <label for="alamat_p2">Alamat</label>
                          <select name="alamat_p2" class="form-control" id="alamat_p2" required>
                            <option value="" disabled selected>Pilih Alamat</option>
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
                          <label for="anak_ke_p2">Anak yang ke</label>
                          <input type="text" name="anak_ke_p2" value="<?= $data['anak_ke_p2'] ?>" class="form-control" id="anak_ke_p2" required>
                        </div>
                        <p>Yakni benar-benar anak dari pasangan Suami Isteri :</p>
                        <div class="form-group">
                          <label for="nama_ayah">Nama Ayah</label>
                          <input type="text" name="nama_ayah" value="<?= $data['nama_ayah'] ?>" class="form-control" id="nama_ayah">
                        </div>
                        <div class="form-group">
                          <label for="umur_ayah">Umur</label>
                          <input type="number" name="umur_ayah" value="<?= $data['umur_ayah'] ?>" class="form-control" id="umur_ayah">
                        </div>
                        <div class="form-group">
                          <label for="alamat_ayah">Alamat</label>
                          <select name="alamat_ayah" class="form-control" id="alamat_ayah">
                            <option value="" disabled selected>Pilih Alamat</option>
                            <?php $alamat_ayah = $data['alamat_ayah'];
                            foreach ($views_rt as $data_rt) {
                              $selected = ($alamat_ayah == "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi']) ? 'selected' : ''; ?>
                              <option value="<?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>" <?= $selected ?>>
                                <?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>
                              </option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="pekerjaan_ayah">Pekerjaan</label>
                          <select name="pekerjaan_ayah" class="form-control" id="pekerjaan_ayah<?= $data['id_suket_kelahiran'] ?>" onchange="showInput_pekerjaan_ayah<?= $data['id_suket_kelahiran'] ?>()">
                            <option value="" disabled selected>Pilih Pekerjaan</option>
                            <?php $pekerjaan_ayah = $data['pekerjaan_ayah'];
                            foreach ($pekerjaan as $pkr) {
                              $selected = ($pkr == $pekerjaan_ayah) ? 'selected' : '';  ?>
                              <option value="<?= $pkr ?>" <?= $selected ?>><?= $pkr ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group" id="inputManual_ayah<?= $data['id_suket_kelahiran'] ?>" style="display: none;">
                          <label for="pekerjaan_ayah_other">Pekerjaan Lainnya</label>
                          <input type="text" name="pekerjaan_ayah_other" value="<?= $data['pekerjaan_ayah'] ?>" class="form-control" id="pekerjaan_ayah_other" minlength="3">
                        </div>
                        <script>
                          function showInput_pekerjaan_ayah<?= $data['id_suket_kelahiran'] ?>() {
                            var select = document.getElementById("pekerjaan_ayah<?= $data['id_suket_kelahiran'] ?>");
                            var inputManual = document.getElementById("inputManual_ayah<?= $data['id_suket_kelahiran'] ?>");

                            if (select.value === "Lainnya") {
                              inputManual.style.display = "block";
                            } else {
                              inputManual.style.display = "none";
                            }
                          }
                        </script>
                        <div class="form-group mt-5">
                          <label for="nama_ibu">Nama Ibu</label>
                          <input type="text" name="nama_ibu" value="<?= $data['nama_ibu'] ?>" class="form-control" id="nama_ibu">
                        </div>
                        <div class="form-group">
                          <label for="umur_ibu">Umur</label>
                          <input type="number" name="umur_ibu" value="<?= $data['umur_ibu'] ?>" class="form-control" id="umur_ibu">
                        </div>
                        <div class="form-group">
                          <label for="alamat_ibu">Alamat</label>
                          <select name="alamat_ibu" class="form-control" id="alamat_ibu">
                            <option value="" disabled selected>Pilih Alamat</option>
                            <?php $alamat_ibu = $data['alamat_ibu'];
                            foreach ($views_rt as $data_rt) {
                              $selected = ($alamat_ibu == "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi']) ? 'selected' : ''; ?>
                              <option value="<?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>" <?= $selected ?>>
                                <?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>
                              </option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="pekerjaan_ibu">Pekerjaan</label>
                          <select name="pekerjaan_ibu" class="form-control" id="pekerjaan_ibu<?= $data['id_suket_kelahiran'] ?>" onchange="showInput_pekerjaan_ibu<?= $data['id_suket_kelahiran'] ?>()">
                            <option value="" disabled selected>Pilih Pekerjaan</option>
                            <?php $pekerjaan_ibu = $data['pekerjaan_ibu'];
                            foreach ($pekerjaan as $pkr) {
                              $selected = ($pkr == $pekerjaan_ibu) ? 'selected' : '';  ?>
                              <option value="<?= $pkr ?>" <?= $selected ?>><?= $pkr ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group" id="inputManual_ibu<?= $data['id_suket_kelahiran'] ?>" style="display: none;">
                          <label for="pekerjaan_ibu_other">Pekerjaan Lainnya</label>
                          <input type="text" name="pekerjaan_ibu_other" value="<?= $data['pekerjaan_ibu'] ?>" class="form-control" id="pekerjaan_ibu_other" minlength="3">
                        </div>
                        <script>
                          function showInput_pekerjaan_ibu<?= $data['id_suket_kelahiran'] ?>() {
                            var select = document.getElementById("pekerjaan_ibu<?= $data['id_suket_kelahiran'] ?>");
                            var inputManual = document.getElementById("inputManual_ibu<?= $data['id_suket_kelahiran'] ?>");

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
                            <option value="" disabled selected>Pilih Tempat Domisili</option>
                            <?php $id_desa = $data['id_desa'];
                            foreach ($views_desa as $data_desa) {
                              $selected = ($data_desa['id_desa'] == $id_desa) ? 'selected' : '';  ?>
                              <option value="<?= $data_desa['id_desa'] ?>" <?= $selected ?>><?= "Desa " . $data_desa['desa'] . ", Kec. " . $data_desa['kecamatan'] . ", Kab. " . $data_desa['kabupaten'] . ", Prov. " . $data_desa['provinsi'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-center border-top-0">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                        <button type="submit" name="edit_suket_kelahiran" class="btn btn-warning btn-sm">Ubah</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="hapus<?= $data['id_suket_kelahiran'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header border-bottom-0 shadow">
                      <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['no_surat'] ?></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="" method="post">
                      <input type="hidden" name="id_suket_kelahiran" value="<?= $data['id_suket_kelahiran'] ?>">
                      <div class="modal-body">
                        <p>Jika anda yakin ingin menghapus <?= $data['no_surat'] ?> klik Hapus!</p>
                      </div>
                      <div class="modal-footer justify-content-center border-top-0">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                        <button type="submit" name="delete_suket_kelahiran" class="btn btn-danger btn-sm">hapus</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            <?php } ?>

          </td>
        </tr>
      <?php $no++;
      } ?>
    </tbody>
  </table>
</div>