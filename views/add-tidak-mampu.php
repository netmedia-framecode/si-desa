<div class="table-responsive">
  <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th class="text-center" rowspan="2">#</th>
        <th class="text-center" rowspan="2">No. Surat</th>
        <th class="text-center" colspan="3">Yang bertandatangan dibawah ini</th>
        <th class="text-center" colspan="5">Ayah</th>
        <th class="text-center" colspan="5">Ibu</th>
        <th class="text-center" colspan="9">Anak</th>
        <th class="text-center" rowspan="2">Aksi</th>
      </tr>
      <tr>
        <th class="text-center">Nama</th>
        <th class="text-center">Jabatan</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Nama</th>
        <th class="text-center">Umur</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Pekerjaan</th>
        <th class="text-center">Agama</th>
        <th class="text-center">Nama</th>
        <th class="text-center">Umur</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Pekerjaan</th>
        <th class="text-center">Agama</th>
        <th class="text-center">Nama</th>
        <th class="text-center">Tgl Lahir</th>
        <th class="text-center">NIK</th>
        <th class="text-center">No. KK</th>
        <th class="text-center">Jenis Kelamin</th>
        <th class="text-center">Umur</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Pekerjaan</th>
        <th class="text-center">Agama</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th class="text-center" rowspan="2">#</th>
        <th class="text-center" rowspan="2">No. Surat</th>
        <th class="text-center" colspan="3">Yang bertandatangan dibawah ini</th>
        <th class="text-center" colspan="5">Ayah</th>
        <th class="text-center" colspan="5">Ibu</th>
        <th class="text-center" colspan="9">Anak</th>
        <th class="text-center" rowspan="2">Aksi</th>
      </tr>
      <tr>
        <th class="text-center">Nama</th>
        <th class="text-center">Jabatan</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Nama</th>
        <th class="text-center">Umur</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Pekerjaan</th>
        <th class="text-center">Agama</th>
        <th class="text-center">Nama</th>
        <th class="text-center">Umur</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Pekerjaan</th>
        <th class="text-center">Agama</th>
        <th class="text-center">Nama</th>
        <th class="text-center">Tgl Lahir</th>
        <th class="text-center">NIK</th>
        <th class="text-center">No. KK</th>
        <th class="text-center">Jenis Kelamin</th>
        <th class="text-center">Umur</th>
        <th class="text-center">Alamat</th>
        <th class="text-center">Pekerjaan</th>
        <th class="text-center">Agama</th>
      </tr>
      </thead>
    </tfoot>
    <tbody>
      <?php $no = 1;
      foreach ($views_suket_tidak_mampu as $data) { ?>
        <tr>
          <td><?= $no ?></td>
          <td><?= $data['no_surat'] ?></td>
          <td><?= $data['nama_p1'] ?></td>
          <td><?= $data['jabatan_p1'] ?></td>
          <td><?= $data['alamat_p1'] ?></td>
          <td><?= $data['nama_ayah'] ?></td>
          <td><?= $data['umur_ayah'] ?> tahun</td>
          <td><?= $data['alamat_ayah'] ?></td>
          <td><?= $data['pekerjaan_ayah'] ?></td>
          <td><?= $data['agama_ayah'] ?></td>
          <td><?= $data['nama_ibu'] ?></td>
          <td><?= $data['umur_ibu'] ?> tahun</td>
          <td><?= $data['alamat_ibu'] ?></td>
          <td><?= $data['pekerjaan_ibu'] ?></td>
          <td><?= $data['agama_ibu'] ?></td>
          <td><?= $data['nama_anak'] ?></td>
          <td><?php $tgl_lahir_anak = date_create($data["tgl_lahir_anak"]);
              $tgl_lahir_anak = date_format($tgl_lahir_anak, "d M Y");
              echo $data['tempat_lahir_anak'] . ", " . $tgl_lahir_anak; ?></td>
          <td><?= $data['nik_anak'] ?></td>
          <td><?= $data['no_kk_anak'] ?></td>
          <td><?= $data['jk_anak'] ?></td>
          <td><?= $data['umur_anak'] ?> tahun</td>
          <td><?= $data['alamat_anak'] ?></td>
          <td><?= $data['pekerjaan_anak'] ?></td>
          <td><?= $data['agama_anak'] ?></td>
          <td class="text-center">
            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $data['id_suket_tidak_mampu'] ?>">
              <i class="bi bi-pencil-square"></i> Ubah
            </button>
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['id_suket_tidak_mampu'] ?>">
              <i class="bi bi-trash3"></i> Hapus
            </button>
            <a href="export-tidak-mampu?id=<?= $data['id_suket_tidak_mampu'] ?>" target="_blank" class="btn btn-primary btn-sm" rel="noopener noreferrer"><i class="bi bi-printer"></i> Cetak</a>

            <div class="modal fade" id="ubah<?= $data['id_suket_tidak_mampu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header border-bottom-0 shadow">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $data['no_surat'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="" method="post">
                    <input type="hidden" name="id_suket_tidak_mampu" value="<?= $data['id_suket_tidak_mampu'] ?>">
                    <input type="hidden" name="no_suratOld" value="<?= $data['no_surat'] ?>">
                    <div class="modal-body text-dark">
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
                      <h6 class="font-weight-bold">Nama Orang Tua</h6>
                      <h6 class="font-weight-bold">1. Ayah</h6>
                      <div class="form-group">
                        <label for="nama_ayah">Nama</label>
                        <input type="text" name="nama_ayah" value="<?= $data['nama_ayah'] ?>" class="form-control" id="nama_ayah" minlength="3" required>
                      </div>
                      <div class="form-group">
                        <label for="umur_ayah">Umur</label>
                        <input type="number" name="umur_ayah" value="<?= $data['umur_ayah'] ?>" class="form-control" id="umur_ayah" min="1" required>
                      </div>
                      <div class="form-group">
                        <label for="alamat_ayah">Alamat</label>
                        <select name="alamat_ayah" class="form-control" id="alamat_ayah" required>
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
                        <select name="pekerjaan_ayah" class="form-control" id="pekerjaan_ayah<?= $data['id_suket_tidak_mampu'] ?>" onchange="showInput_ayah<?= $data['id_suket_tidak_mampu'] ?>()">
                          <?php $pekerjaan_p2 = $data['pekerjaan_p2'];
                          foreach ($pekerjaan as $pkr) {
                            $selected = ($pkr == $pekerjaan_p2) ? 'selected' : '';  ?>
                            <option value="<?= $pkr ?>" <?= $selected ?>><?= $pkr ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group" id="inputManual_ayah<?= $data['id_suket_tidak_mampu'] ?>" style="display: none;">
                        <label for="pekerjaan_ayah_other">Pekerjaan Lainnya</label>
                        <input type="text" name="pekerjaan_ayah_other" value="<?= $data['pekerjaan_ayah'] ?>" class="form-control" id="pekerjaan_ayah_other" minlength="3">
                      </div>
                      <script>
                        function showInput_ayah<?= $data['id_suket_tidak_mampu'] ?>() {
                          var select = document.getElementById("pekerjaan_ayah<?= $data['id_suket_tidak_mampu'] ?>");
                          var inputManual_ayah = document.getElementById("inputManual_ayah<?= $data['id_suket_tidak_mampu'] ?>");

                          if (select.value === "Lainnya") {
                            inputManual_ayah.style.display = "block";
                          } else {
                            inputManual_ayah.style.display = "none";
                          }
                        }
                      </script>
                      <div class="form-group">
                        <label for="agama_ayah">Agama</label>
                        <select name="agama_ayah" class="form-control" id="agama_ayah" required>
                          <?php $agama_ayah = $data['agama_ayah'];
                          foreach ($agama as $agm) {
                            $selected = ($agm == $agama_ayah) ? 'selected' : '';  ?>
                            <option value="<?= $agm ?>" <?= $selected ?>><?= $agm ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <h6 class="font-weight-bold">2. Ibu</h6>
                      <div class="form-group">
                        <label for="nama_ibu">Nama</label>
                        <input type="text" name="nama_ibu" value="<?= $data['nama_ibu'] ?>" class="form-control" id="nama_ibu" minlength="3" required>
                      </div>
                      <div class="form-group">
                        <label for="umur_ibu">Umur</label>
                        <input type="number" name="umur_ibu" value="<?= $data['umur_ibu'] ?>" class="form-control" id="umur_ibu" min="1" required>
                      </div>
                      <div class="form-group">
                        <label for="alamat_ibu">Alamat</label>
                        <select name="alamat_ibu" class="form-control" id="alamat_ibu" required>
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
                        <select name="pekerjaan_ibu" class="form-control" id="pekerjaan_ibu<?= $data['id_suket_tidak_mampu'] ?>" onchange="showInput_ibu<?= $data['id_suket_tidak_mampu'] ?>()">
                          <?php $pekerjaan_p2 = $data['pekerjaan_p2'];
                          foreach ($pekerjaan as $pkr) {
                            $selected = ($pkr == $pekerjaan_p2) ? 'selected' : '';  ?>
                            <option value="<?= $pkr ?>" <?= $selected ?>><?= $pkr ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group" id="inputManual_ibu<?= $data['id_suket_tidak_mampu'] ?>" style="display: none;">
                        <label for="pekerjaan_ibu_other">Pekerjaan Lainnya</label>
                        <input type="text" name="pekerjaan_ibu_other" value="<?= $data['pekerjaan_ibu'] ?>" class="form-control" id="pekerjaan_ibu_other" minlength="3">
                      </div>
                      <script>
                        function showInput_ibu<?= $data['id_suket_tidak_mampu'] ?>() {
                          var select = document.getElementById("pekerjaan_ibu<?= $data['id_suket_tidak_mampu'] ?>");
                          var inputManual_ibu = document.getElementById("inputManual_ibu<?= $data['id_suket_tidak_mampu'] ?>");

                          if (select.value === "Lainnya") {
                            inputManual_ibu.style.display = "block";
                          } else {
                            inputManual_ibu.style.display = "none";
                          }
                        }
                      </script>
                      <div class="form-group">
                        <label for="agama_ibu">Agama</label>
                        <select name="agama_ibu" class="form-control" id="agama_ibu" required>
                          <?php $agama_ibu = $data['agama_ibu'];
                          foreach ($agama as $agm) {
                            $selected = ($agm == $agama_ibu) ? 'selected' : '';  ?>
                            <option value="<?= $agm ?>" <?= $selected ?>><?= $agm ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <h6 class="font-weight-bold">3. Nama Anak</h6>
                      <div class="form-group">
                        <label for="nama_anak">Nama</label>
                        <input type="text" name="nama_anak" value="<?= $data['nama_anak'] ?>" class="form-control" id="nama_anak" minlength="3" required>
                      </div>
                      <div class="form-group">
                        <label for="tempat_lahir_anak">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir_anak" value="<?= $data['tempat_lahir_anak'] ?>" class="form-control" id="tempat_lahir_anak" minlength="3" required>
                      </div>
                      <div class="form-group">
                        <label for="tgl_lahir_anak">Tgl Lahir</label>
                        <input type="date" name="tgl_lahir_anak" value="<?= $data['tgl_lahir_anak'] ?>" class="form-control" id="tgl_lahir_anak" minlength="3" required>
                      </div>
                      <div class="form-group">
                        <label for="nik_anak">NIK</label>
                        <input type="number" name="nik_anak" value="<?= $data['nik_anak'] ?>" class="form-control" id="nik_anak" min="16" required>
                      </div>
                      <div class="form-group">
                        <label for="no_kk_anak">No Kartu Keluarga</label>
                        <input type="number" name="no_kk_anak" value="<?= $data['no_kk_anak'] ?>" class="form-control" id="no_kk_anak" min="16" required>
                      </div>
                      <div class="form-group">
                        <label for="jk_anak">Jenis Kelamin</label>
                        <select name="jk_anak" class="form-control" id="jk_anak" required>
                          <?php $jk_anak = $data['jk_anak'];
                          foreach ($jenis_kelamin as $jk) {
                            $selected = ($jk == $jk_anak) ? 'selected' : ''; ?>
                            <option value="<?= $jk ?>" <?= $selected ?>><?= $jk ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="umur_anak">Umur</label>
                        <input type="number" name="umur_anak" value="<?= $data['umur_anak'] ?>" class="form-control" id="umur_anak" min="1" required>
                      </div>
                      <div class="form-group">
                        <label for="alamat_anak">Alamat</label>
                        <select name="alamat_anak" class="form-control" id="alamat_anak" required>
                          <?php $alamat_anak = $data['alamat_anak'];
                          foreach ($views_rt as $data_rt) {
                            $selected = ($alamat_anak == "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi']) ? 'selected' : ''; ?>
                            <option value="<?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>" <?= $selected ?>>
                              <?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>
                            </option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="pekerjaan_anak">Pekerjaan</label>
                        <select name="pekerjaan_anak" class="form-control" id="pekerjaan_anak<?= $data['id_suket_tidak_mampu'] ?>" onchange="showInput_anak<?= $data['id_suket_tidak_mampu'] ?>()">
                          <?php $pekerjaan_anak = $data['pekerjaan_anak'];
                          foreach ($pekerjaan as $pkr) {
                            $selected = ($pkr == $pekerjaan_anak) ? 'selected' : '';  ?>
                            <option value="<?= $pkr ?>" <?= $selected ?>><?= $pkr ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group" id="inputManual_anak<?= $data['id_suket_tidak_mampu'] ?>" style="display: none;">
                        <label for="pekerjaan_anak_other">Pekerjaan Lainnya</label>
                        <input type="text" name="pekerjaan_anak_other" value="<?= $data['pekerjaan_anak'] ?>" class="form-control" id="pekerjaan_anak_other" minlength="3">
                      </div>
                      <script>
                        function showInput_anak<?= $data['id_suket_tidak_mampu'] ?>() {
                          var select = document.getElementById("pekerjaan_anak<?= $data['id_suket_tidak_mampu'] ?>");
                          var inputManual_anak = document.getElementById("inputManual_anak<?= $data['id_suket_tidak_mampu'] ?>");

                          if (select.value === "Lainnya") {
                            inputManual_anak.style.display = "block";
                          } else {
                            inputManual_anak.style.display = "none";
                          }
                        }
                      </script>
                      <div class="form-group">
                        <label for="agama_anak">Agama</label>
                        <select name="agama_anak" class="form-control" id="agama_anak" required>
                          <?php $agama_anak = $data['agama_anak'];
                          foreach ($agama as $agm) {
                            $selected = ($agm == $agama_anak) ? 'selected' : '';  ?>
                            <option value="<?= $agm ?>" <?= $selected ?>><?= $agm ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <hr>
                      <p>Warga Desa</p>
                      <div class="form-group">
                        <select name="id_desa" class="form-control" id="id_desa" required>
                          <?php $id_desa = $data['id_desa'];
                          foreach ($views_desa as $data_desa) {
                            $selected = ($data_desa['id_desa'] == $id_desa) ? 'selected' : ''; ?>
                            <option value="<?= $data_desa['id_desa'] ?>" <?= $selected ?>><?= "Desa " . $data_desa['desa'] . ", Kec. " . $data_desa['kecamatan'] . ", Kab. " . $data_desa['kabupaten'] . ", Prov. " . $data_desa['provinsi'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-center border-top-0">
                      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                      <button type="submit" name="edit_suket_tidak_mampu" class="btn btn-warning btn-sm">Ubah</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="modal fade" id="hapus<?= $data['id_suket_tidak_mampu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header border-bottom-0 shadow">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['no_surat'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="" method="post">
                    <input type="hidden" name="id_suket_tidak_mampu" value="<?= $data['id_suket_tidak_mampu'] ?>">
                    <div class="modal-body">
                      <p>Jika anda yakin ingin menghapus <?= $data['no_surat'] ?> klik Hapus!</p>
                    </div>
                    <div class="modal-footer justify-content-center border-top-0">
                      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                      <button type="submit" name="delete_suket_tidak_mampu" class="btn btn-danger btn-sm">hapus</button>
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