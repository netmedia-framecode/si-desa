<?php require_once("../controller/script.php");
$_SESSION["project_sistem_informasi_desa"]["name_page"] = "Daftar";
require_once("../templates/auth_top.php");
?>

<div class="card o-hidden border-0 shadow-lg my-5">
  <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
      <?php foreach ($views_auth as $data) { ?>
        <div class="col-lg-6 d-none d-lg-block" style="background: url('../assets/img/auth/<?= $data['image'] ?>'); background-position: center; background-size: cover;"></div>
      <?php } ?>
      <div class="col-lg-6">
        <div class="p-5">
          <div class="text-center">
            <?php if (!isset($_GET['obj'])) { ?>
              <h1 class="h4 text-gray-900 mb-4">Buat sebuah akun!</h1>
            <?php } else if (isset($_GET['obj'])) { ?>
              <h1 class="h4 text-gray-900 mb-4">Pengajuan Surat Keterangan <?= $_GET['obj'] ?></h1>
            <?php } ?>
          </div>
          <form method="post">
            <h6 class="font-weight-bold">Data Akun :</h6>
            <div class="form-group">
              <input type="text" name="name" class="form-control form-control-user" id="name" placeholder="Nama" required>
            </div>
            <div class="form-group">
              <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Email" required>
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password" required>
              </div>
              <div class="col-sm-6">
                <input type="password" name="re_password" class="form-control form-control-user" id="re_password" placeholder="Konfirmasi Password" required>
              </div>
            </div>
            <?php if (isset($_GET['obj'])) { ?>
              <hr>
              <input type="hidden" name="obj" value="<?= $_GET['obj'] ?>">
              <h6 class="font-weight-bold">Data Surat :</h6>
              <?php if ($_GET['obj'] == "Domisili") { ?>
                <div class="form-group">
                  <label for="nama_p2">Nama</label>
                  <input type="text" name="nama_p2" class="form-control" id="nama_p2" minlength="3" required>
                </div>
                <div class="form-group">
                  <label for="tempat_lahir_p2">Tempat Lahir</label>
                  <input type="text" name="tempat_lahir_p2" class="form-control" id="tempat_lahir_p2" minlength="3" required>
                </div>
                <div class="form-group">
                  <label for="tgl_lahir_p2">Tgl Lahir</label>
                  <input type="date" name="tgl_lahir_p2" class="form-control" id="tgl_lahir_p2" minlength="3" required>
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
                  <label for="agama_p2">Agama</label>
                  <select name="agama_p2" class="form-control" id="agama_p2" required>
                    <option value="" disabled selected>Pilih Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="pekerjaan_p2">Pekerjaan</label>
                  <select name="pekerjaan_p2" class="form-control" id="pekerjaan_p2" onchange="showInput()">
                    <option value="" disabled selected>Pilih Pekerjaan</option>
                    <option value="Pegawai Swasta">Pegawai Swasta</option>
                    <option value="PNS">Pegawai Negeri Sipil (PNS)</option>
                    <option value="Wiraswasta">Wiraswasta</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>
                <div class="form-group" id="inputManual" style="display: none;">
                  <label for="pekerjaan_p2_other">Pekerjaan Lainnya</label>
                  <input type="text" name="pekerjaan_p2_other" class="form-control" id="pekerjaan_p2_other" minlength="3">
                </div>
                <script>
                  function showInput() {
                    var select = document.getElementById("pekerjaan_p2");
                    var inputManual = document.getElementById("inputManual");

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
                    <?php foreach ($views_desa as $data_desa) { ?>
                      <option value="<?= $data_desa['id_desa'] ?>"><?= "Desa " . $data_desa['desa'] . ", Kec. " . $data_desa['kecamatan'] . ", Kab. " . $data_desa['kabupaten'] . ", Prov. " . $data_desa['provinsi'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <p>sejak tanggal:</p>
                <div class="form-group">
                  <input type="date" name="sejak_tgl_p2" class="form-control" id="sejak_tgl_p2" minlength="3" required>
                </div>
                <div class="form-group">
                  <label for="ket_p2">Keterangan Domilisi</label>
                  <textarea class="form-control" name="ket_p2" rows="3">akan ...</textarea>
                  <small>Contoh: akan melanjutkan studi ke Kupang di SMK Negeri 3 Kupang</small>
                </div>
              <?php } else if ($_GET['obj'] == "Kelahiran") { ?>
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
              <?php } else if ($_GET['obj'] == "Kematian") { ?>
                <div class="form-group">
                  <label for="nama_p2">Nama</label>
                  <input type="text" name="nama_p2" class="form-control" id="nama_p2" minlength="3" required>
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
                  <label for="jk_p2">Jenis Kelamin</label>
                  <select name="jk_p2" class="form-control" id="jk_p2" required>
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
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
                  <label for="agama_p2">Agama</label>
                  <select name="agama_p2" class="form-control" id="agama_p2" required>
                    <option value="" disabled selected>Pilih Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="pekerjaan_p2">Pekerjaan</label>
                  <select name="pekerjaan_p2" class="form-control" id="pekerjaan_p2" onchange="showInput()">
                    <option value="" disabled selected>Pilih Pekerjaan</option>
                    <option value="Pegawai Swasta">Pegawai Swasta</option>
                    <option value="PNS">Pegawai Negeri Sipil (PNS)</option>
                    <option value="Wiraswasta">Wiraswasta</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>
                <div class="form-group" id="inputManual" style="display: none;">
                  <label for="pekerjaan_p2_other">Pekerjaan Lainnya</label>
                  <input type="text" name="pekerjaan_p2_other" class="form-control" id="pekerjaan_p2_other" minlength="3">
                </div>
                <script>
                  function showInput() {
                    var select = document.getElementById("pekerjaan_p2");
                    var inputManual = document.getElementById("inputManual");

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
                <div class="form-group">
                  <label for="id_desa_kematian">Lokasi Meninggal Dunia</label>
                  <select name="id_desa_kematian" class="form-control" id="id_desa_kematian" required>
                    <option value="" disabled selected>Pilih Lokasi Meninggal Dunia</option>
                    <?php foreach ($views_desa as $data_desa) { ?>
                      <option value="<?= $data_desa['id_desa'] ?>"><?= "Desa " . $data_desa['desa'] . ", Kec. " . $data_desa['kecamatan'] . ", Kab. " . $data_desa['kabupaten'] . ", Prov. " . $data_desa['provinsi'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tgl_kematian">Tgl Kematian</label>
                      <input type="date" name="tgl_kematian" class="form-control" id="tgl_kematian" required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="waktu_kematian">Waktu Kematian</label>
                      <input type="time" name="waktu_kematian" class="form-control" id="waktu_kematian" required>
                    </div>
                  </div>
                </div>
              <?php } else if ($_GET['obj'] == "Belum Memiliki KK") { ?>
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
                  <label for="pekerjaan_p2">Pekerjaan</label>
                  <select name="pekerjaan_p2" class="form-control" id="pekerjaan_p2" onchange="showInput()">
                    <option value="" disabled selected>Pilih Pekerjaan</option>
                    <option value="Pegawai Swasta">Pegawai Swasta</option>
                    <option value="PNS">Pegawai Negeri Sipil (PNS)</option>
                    <option value="Wiraswasta">Wiraswasta</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>
                <div class="form-group" id="inputManual" style="display: none;">
                  <label for="pekerjaan_p2_other">Pekerjaan Lainnya</label>
                  <input type="text" name="pekerjaan_p2_other" class="form-control" id="pekerjaan_p2_other" minlength="3">
                </div>
                <script>
                  function showInput() {
                    var select = document.getElementById("pekerjaan_p2");
                    var inputManual = document.getElementById("inputManual");

                    if (select.value === "Lainnya") {
                      inputManual.style.display = "block";
                    } else {
                      inputManual.style.display = "none";
                    }
                  }
                </script>
                <div class="form-group">
                  <label for="agama_p2">Agama</label>
                  <select name="agama_p2" class="form-control" id="agama_p2" required>
                    <option value="" disabled selected>Pilih Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="kewarganegaraan">Kewarganegaraan</label>
                  <input type="text" name="kewarganegaraan" value="Indonesia" class="form-control" id="kewarganegaraan" minlength="3" required>
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
                <hr>
                <p>Adalah benar-benar warga Desa</p>
                <div class="form-group">
                  <select name="id_desa" class="form-control" id="id_desa" required>
                    <option value="" disabled selected>Pilih Desa</option>
                    <?php foreach ($views_desa as $data_desa) { ?>
                      <option value="<?= $data_desa['id_desa'] ?>"><?= "Desa " . $data_desa['desa'] . ", Kec. " . $data_desa['kecamatan'] . ", Kab. " . $data_desa['kabupaten'] . ", Prov. " . $data_desa['provinsi'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              <?php } else if ($_GET['obj'] == "Tidak Mampu") { ?>
                <h6 class="font-weight-bold">Nama Orang Tua</h6>
                <h6 class="font-weight-bold">1. Ayah</h6>
                <div class="form-group">
                  <label for="nama_ayah">Nama</label>
                  <input type="text" name="nama_ayah" class="form-control" id="nama_ayah" minlength="3" required>
                </div>
                <div class="form-group">
                  <label for="umur_ayah">Umur</label>
                  <input type="number" name="umur_ayah" class="form-control" id="umur_ayah" min="1" required>
                </div>
                <div class="form-group">
                  <label for="alamat_ayah">Alamat</label>
                  <select name="alamat_ayah" class="form-control" id="alamat_ayah" required>
                    <option value="" disabled selected>Pilih Alamat</option>
                    <?php foreach ($views_rt as $data_rt) { ?>
                      <option value="<?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>">
                        <?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="pekerjaan_ayah">Pekerjaan</label>
                  <select name="pekerjaan_ayah" class="form-control" id="pekerjaan_ayah" onchange="showInput_ayah()">
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
                  function showInput_ayah() {
                    var select = document.getElementById("pekerjaan_ayah");
                    var inputManual_ayah = document.getElementById("inputManual_ayah");

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
                    <option value="" disabled selected>Pilih Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                  </select>
                </div>
                <h6 class="font-weight-bold">2. Ibu</h6>
                <div class="form-group">
                  <label for="nama_ibu">Nama</label>
                  <input type="text" name="nama_ibu" class="form-control" id="nama_ibu" minlength="3" required>
                </div>
                <div class="form-group">
                  <label for="umur_ibu">Umur</label>
                  <input type="number" name="umur_ibu" class="form-control" id="umur_ibu" min="1" required>
                </div>
                <div class="form-group">
                  <label for="alamat_ibu">Alamat</label>
                  <select name="alamat_ibu" class="form-control" id="alamat_ibu" required>
                    <option value="" disabled selected>Pilih Alamat</option>
                    <?php foreach ($views_rt as $data_rt) { ?>
                      <option value="<?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>">
                        <?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="pekerjaan_ibu">Pekerjaan</label>
                  <select name="pekerjaan_ibu" class="form-control" id="pekerjaan_ibu" onchange="showInput_ibu()">
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
                  function showInput_ibu() {
                    var select = document.getElementById("pekerjaan_ibu");
                    var inputManual_ibu = document.getElementById("inputManual_ibu");

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
                    <option value="" disabled selected>Pilih Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                  </select>
                </div>
                <h6 class="font-weight-bold">3. Nama Anak</h6>
                <div class="form-group">
                  <label for="nama_anak">Nama</label>
                  <input type="text" name="nama_anak" class="form-control" id="nama_anak" minlength="3" required>
                </div>
                <div class="form-group">
                  <label for="tempat_lahir_anak">Tempat Lahir</label>
                  <input type="text" name="tempat_lahir_anak" class="form-control" id="tempat_lahir_anak" minlength="3" required>
                </div>
                <div class="form-group">
                  <label for="tgl_lahir_anak">Tgl Lahir</label>
                  <input type="date" name="tgl_lahir_anak" class="form-control" id="tgl_lahir_anak" required>
                </div>
                <div class="form-group">
                  <label for="nik_anak">NIK</label>
                  <input type="number" name="nik_anak" class="form-control" id="nik_anak" min="16" required>
                </div>
                <div class="form-group">
                  <label for="no_kk_anak">No Kartu Keluarga</label>
                  <input type="number" name="no_kk_anak" class="form-control" id="no_kk_anak" min="16" required>
                </div>
                <div class="form-group">
                  <label for="jk_anak">Jenis Kelamin</label>
                  <select name="jk_anak" class="form-control" id="jk_anak" required>
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="umur_anak">Umur</label>
                  <input type="number" name="umur_anak" class="form-control" id="umur_anak" min="1" required>
                </div>
                <div class="form-group">
                  <label for="alamat_anak">Alamat</label>
                  <select name="alamat_anak" class="form-control" id="alamat_anak" required>
                    <option value="" disabled selected>Pilih Alamat</option>
                    <?php foreach ($views_rt as $data_rt) { ?>
                      <option value="<?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>">
                        <?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="pekerjaan_anak">Pekerjaan</label>
                  <select name="pekerjaan_anak" class="form-control" id="pekerjaan_anak" onchange="showInput_anak()">
                    <option value="" disabled selected>Pilih Pekerjaan</option>
                    <option value="Pegawai Swasta">Pegawai Swasta</option>
                    <option value="PNS">Pegawai Negeri Sipil (PNS)</option>
                    <option value="Wiraswasta">Wiraswasta</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="anak Rumah Tangga">anak Rumah Tangga</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>
                <div class="form-group" id="inputManual_anak" style="display: none;">
                  <label for="pekerjaan_anak_other">Pekerjaan Lainnya</label>
                  <input type="text" name="pekerjaan_anak_other" class="form-control" id="pekerjaan_anak_other" minlength="3">
                </div>
                <script>
                  function showInput_anak() {
                    var select = document.getElementById("pekerjaan_anak");
                    var inputManual_anak = document.getElementById("inputManual_anak");

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
                    <option value="" disabled selected>Pilih Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                  </select>
                </div>
                <hr>
                <p>Warga Desa</p>
                <div class="form-group">
                  <select name="id_desa" class="form-control" id="id_desa" required>
                    <option value="" disabled selected>Pilih Desa</option>
                    <?php foreach ($views_desa as $data_desa) { ?>
                      <option value="<?= $data_desa['id_desa'] ?>"><?= "Desa " . $data_desa['desa'] . ", Kec. " . $data_desa['kecamatan'] . ", Kab. " . $data_desa['kabupaten'] . ", Prov. " . $data_desa['provinsi'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              <?php } else if ($_GET['obj'] == "Usaha") { ?>
                <div class="form-group">
                  <label for="nama_p2">Nama</label>
                  <input type="text" name="nama_p2" class="form-control" id="nama_p2" minlength="3" required>
                </div>
                <div class="form-group">
                  <label for="tempat_lahir_p2">Tempat Lahir</label>
                  <input type="text" name="tempat_lahir_p2" class="form-control" id="tempat_lahir_p2" minlength="3" required>
                </div>
                <div class="form-group">
                  <label for="tgl_lahir_p2">Tgl Lahir</label>
                  <input type="date" name="tgl_lahir_p2" class="form-control" id="tgl_lahir_p2" minlength="3" required>
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
                  <label for="agama_p2">Agama</label>
                  <select name="agama_p2" class="form-control" id="agama_p2" required>
                    <option value="" disabled selected>Pilih Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="pekerjaan_p2">Pekerjaan</label>
                  <select name="pekerjaan_p2" class="form-control" id="pekerjaan_p2" onchange="showInput()">
                    <option value="" disabled selected>Pilih Pekerjaan</option>
                    <option value="Pegawai Swasta">Pegawai Swasta</option>
                    <option value="PNS">Pegawai Negeri Sipil (PNS)</option>
                    <option value="Wiraswasta">Wiraswasta</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>
                <div class="form-group" id="inputManual" style="display: none;">
                  <label for="pekerjaan_p2_other">Pekerjaan Lainnya</label>
                  <input type="text" name="pekerjaan_p2_other" class="form-control" id="pekerjaan_p2_other" minlength="3">
                </div>
                <script>
                  function showInput() {
                    var select = document.getElementById("pekerjaan_p2");
                    var inputManual = document.getElementById("inputManual");

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
                    <?php foreach ($views_desa as $data_desa) { ?>
                      <option value="<?= $data_desa['id_desa'] ?>"><?= "Desa " . $data_desa['desa'] . ", Kec. " . $data_desa['kecamatan'] . ", Kab. " . $data_desa['kabupaten'] . ", Prov. " . $data_desa['provinsi'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="id_rt">Lokasi Usaha</label>
                  <select name="id_rt" class="form-control" id="id_rt" required>
                    <?php foreach ($views_rt as $data_rt) { ?>
                      <option value="<?= $data_rt['id_rt'] ?>"><?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kec. " . $data_rt['kecamatan'] . ", Kab. " . $data_rt['kabupaten'] . ", Prov. " . $data_rt['provinsi'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ket_p2">Keterangan Usaha</label>
                  <textarea class="form-control" name="ket_p2" rows="3"></textarea>
                  <small>Contoh: Pedagang Kaki Lima dengan jenis usaha hasil pertanian</small>
                </div>
            <?php }
            } ?>
            <button type="submit" name="register" class="btn btn-primary btn-user btn-block mt-4">
              Daftarkan Akun
            </button>
          </form>
          <hr>
          <div class="text-center">
            <a class="small" href="./">Sudah memiliki akun? Masuk!</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once("../templates/auth_bottom.php"); ?>