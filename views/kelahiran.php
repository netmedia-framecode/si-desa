<?php require_once("../controller/script.php");
$_SESSION["project_sistem_informasi_desa"]["name_page"] = "Kelahiran";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_sistem_informasi_desa"]["name_page"] ?></h1>
    <?php if ($id_role == 1) { ?>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambah"><i class="bi bi-plus-lg"></i> Tambah</a>
    <?php } ?>
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <?php require_once("add-kelahiran.php") ?>
    </div>
  </div>

  <?php if ($id_role == 1) { ?>
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header border-bottom-0 shadow">
            <h5 class="modal-title" id="tambahLabel">Tambah Surat Keterangan Kelahiran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" method="post">
            <div class="modal-body">
              <div class="form-group">
                <label for="no_surat">Nomor</label>
                <input type="text" name="no_surat" class="form-control" id="no_surat" minlength="3" required>
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
                  <?php foreach ($views_desa as $data_desa) { ?>
                    <option value="<?= "Desa " . $data_desa['desa'] . ", Kec. " . $data_desa['kecamatan'] . ", Kab. " . $data_desa['kabupaten'] . ", Prov. " . $data_desa['provinsi'] ?>">
                      <?= "Desa " . $data_desa['desa'] . ", Kec. " . $data_desa['kecamatan'] . ", Kab. " . $data_desa['kabupaten'] . ", Prov. " . $data_desa['provinsi'] ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <hr>
              <p>Menerangkan dengan sebenarnya bahwa telah lahir seorang anak :</p>
              <div class="form-group">
                <label for="nama_p2">Nama</label>
                <input type="text" name="nama_p2" class="form-control" id="nama_p2" minlength="3" required>
              </div>
              <div class="form-group">
                <label for="jk_p2">Jenis Kelamin</label>
                <select name="jk_p2" class="form-control" id="jk_p2" required>
                  <option value="" disabled selected>Pilih Jenis Kelamin</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="tempat_lahir_p2">Tempat Lahir</label>
                <input type="text" name="tempat_lahir_p2" class="form-control" id="tempat_lahir_p2" minlength="3" required>
              </div>
              <div class="form-group">
                <label for="tgl_lahir_p2">Tgl Lahir</label>
                <input type="date" name="tgl_lahir_p2" class="form-control" id="tgl_lahir_p2" required>
              </div>
              <div class="form-group">
                <label for="alamat_p2">Alamat</label>
                <select name="alamat_p2" class="form-control" id="alamat_p2" required>
                  <option value="" disabled selected>Pilih Alamat</option>
                  <?php foreach ($views_rt as $data_rt) { ?>
                    <option value="<?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>">
                      <?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="anak_ke_p2">Anak yang ke</label>
                <input type="text" name="anak_ke_p2" class="form-control" id="anak_ke_p2" required>
              </div>
              <p>Yakni benar-benar anak dari pasangan Suami Isteri :</p>
              <div class="form-group">
                <label for="nama_ayah">Nama Ayah</label>
                <input type="text" name="nama_ayah" class="form-control" id="nama_ayah">
              </div>
              <div class="form-group">
                <label for="umur_ayah">Umur</label>
                <input type="number" name="umur_ayah" class="form-control" id="umur_ayah">
              </div>
              <div class="form-group">
                <label for="alamat_ayah">Alamat</label>
                <select name="alamat_ayah" class="form-control" id="alamat_ayah">
                  <option value="" disabled selected>Pilih Alamat</option>
                  <?php foreach ($views_rt as $data_rt) { ?>
                    <option value="<?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>">
                      <?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                <select name="pekerjaan_ayah" class="form-control" id="pekerjaan_ayah" onchange="showInput_pekerjaan_ayah()">
                  <option value="" disabled selected>Pilih Pekerjaan</option>
                  <option value="Pegawai Swasta">Pegawai Swasta</option>
                  <option value="PNS">Pegawai Negeri Sipil (PNS)</option>
                  <option value="Wiraswasta">Wiraswasta</option>
                  <option value="Mahasiswa">Mahasiswa</option>
                  <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
              </div>
              <div class="form-group" id="inputManual_ayah" style="display: none;">
                <label for="pekerjaan_ayah_other">Pekerjaan Lainnya</label>
                <input type="text" name="pekerjaan_ayah_other" class="form-control" id="pekerjaan_ayah_other" minlength="3">
              </div>
              <script>
                function showInput_pekerjaan_ayah() {
                  var select = document.getElementById("pekerjaan_ayah");
                  var inputManual = document.getElementById("inputManual_ayah");

                  if (select.value === "Lainnya") {
                    inputManual.style.display = "block";
                  } else {
                    inputManual.style.display = "none";
                  }
                }
              </script>
              <div class="form-group mt-5">
                <label for="nama_ibu">Nama Ibu</label>
                <input type="text" name="nama_ibu" class="form-control" id="nama_ibu">
              </div>
              <div class="form-group">
                <label for="umur_ibu">Umur</label>
                <input type="number" name="umur_ibu" class="form-control" id="umur_ibu">
              </div>
              <div class="form-group">
                <label for="alamat_ibu">Alamat</label>
                <select name="alamat_ibu" class="form-control" id="alamat_ibu">
                  <option value="" disabled selected>Pilih Alamat</option>
                  <?php foreach ($views_rt as $data_rt) { ?>
                    <option value="<?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>">
                      <?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                <select name="pekerjaan_ibu" class="form-control" id="pekerjaan_ibu" onchange="showInput_pekerjaan_ibu()">
                  <option value="" disabled selected>Pilih Pekerjaan</option>
                  <option value="Pegawai Swasta">Pegawai Swasta</option>
                  <option value="PNS">Pegawai Negeri Sipil (PNS)</option>
                  <option value="Wiraswasta">Wiraswasta</option>
                  <option value="Mahasiswa">Mahasiswa</option>
                  <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
              </div>
              <div class="form-group" id="inputManual_ibu" style="display: none;">
                <label for="pekerjaan_ibu_other">Pekerjaan Lainnya</label>
                <input type="text" name="pekerjaan_ibu_other" class="form-control" id="pekerjaan_ibu_other" minlength="3">
              </div>
              <script>
                function showInput_pekerjaan_ibu() {
                  var select = document.getElementById("pekerjaan_ibu");
                  var inputManual = document.getElementById("inputManual_ibu");

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
                  <?php foreach ($views_desa as $data_desa) { ?>
                    <option value="<?= $data_desa['id_desa'] ?>"><?= "Desa " . $data_desa['desa'] . ", Kec. " . $data_desa['kecamatan'] . ", Kab. " . $data_desa['kabupaten'] . ", Prov. " . $data_desa['provinsi'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <hr>
              <div class="form-group">
                <label for="email">Email Pemohon</label>
                <input type="email" name="email" class="form-control" id="email" minlength="3" required>
              </div>
            </div>
            <div class="modal-footer justify-content-center border-top-0">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
              <button type="submit" name="add_suket_kelahiran" class="btn btn-primary btn-sm">Tambah</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php } ?>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>