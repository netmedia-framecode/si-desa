<?php require_once("../controller/script.php");
$_SESSION["project_sistem_informasi_desa"]["name_page"] = "Data Penduduk";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_sistem_informasi_desa"]["name_page"] ?></h1>
    <div class="col text-right">
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambah"><i class="bi bi-plus-lg"></i> Tambah</a>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#import"><i class="bi bi-plus-lg"></i> Import</a>
    </div>
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">Nama Lengkap</th>
              <th class="text-center">NIK</th>
              <th class="text-center">Jenis Kelamin</th>
              <th class="text-center">Tempat Lahir</th>
              <th class="text-center">Tanggal Lahir</th>
              <th class="text-center">Agama</th>
              <th class="text-center">Pendidikan</th>
              <th class="text-center">Jenis Pekerjaan</th>
              <th class="text-center">Status Perkawinan</th>
              <th class="text-center">Status Hubungan Dalam keluarga</th>
              <th class="text-center">Kewarganegaraan</th>
              <th class="text-center">Nama Ayah</th>
              <th class="text-center">Nama Ibu</th>
              <th class="text-center">RT</th>
              <th class="text-center">RW</th>
              <th class="text-center">Desa</th>
              <th class="text-center" style="width: 200px;">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">Nama Lengkap</th>
              <th class="text-center">NIK</th>
              <th class="text-center">Jenis Kelamin</th>
              <th class="text-center">Tempat Lahir</th>
              <th class="text-center">Tanggal Lahir</th>
              <th class="text-center">Agama</th>
              <th class="text-center">Pendidikan</th>
              <th class="text-center">Jenis Pekerjaan</th>
              <th class="text-center">Status Perkawinan</th>
              <th class="text-center">Status Hubungan Dalam keluarga</th>
              <th class="text-center">Kewarganegaraan</th>
              <th class="text-center">Nama Ayah</th>
              <th class="text-center">Nama Ibu</th>
              <th class="text-center">RT</th>
              <th class="text-center">RW</th>
              <th class="text-center">Desa</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($views_penduduk as $data) { ?>
              <tr>
                <td><?= $data['nama_lengkap'] ?></td>
                <td><?= $data['nik'] ?></td>
                <td><?= $data['jenis_kelamin'] ?></td>
                <td><?= $data['tempat_lahir'] ?></td>
                <td><?= $data['tanggal_lahir'] ?></td>
                <td><?= $data['agama'] ?></td>
                <td><?= $data['pendidikan'] ?></td>
                <td><?= $data['jenis_pekerjaan'] ?></td>
                <td><?= $data['status_perkawinan'] ?></td>
                <td><?= $data['status_hub_keluarga'] ?></td>
                <td><?= $data['kewarganegaraan'] ?></td>
                <td><?= $data['nama_ayah'] ?></td>
                <td><?= $data['nama_ibu'] ?></td>
                <td><?= $data['rt'] ?></td>
                <td><?= $data['rw'] ?></td>
                <td><?= $data['desa'] ?></td>
                <td class="text-center">
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $data['id_penduduk'] ?>">
                    <i class="bi bi-pencil-square"></i> Ubah
                  </button>
                  <div class="modal fade" id="ubah<?= $data['id_penduduk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $data['nama_lengkap'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_penduduk" value="<?= $data['id_penduduk'] ?>">
                          <input type="hidden" name="nama_lengkapOld" value="<?= $data['nama_lengkap'] ?>">
                          <input type="hidden" name="nikOld" value="<?= $data['nik'] ?>">
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="nama_lengkap">Nama Lengkap</label>
                              <input type="text" name="nama_lengkap" value="<?= $data['nama_lengkap'] ?>" class="form-control" id="nama_lengkap" minlength="3" required>
                            </div>
                            <div class="form-group">
                              <label for="nik">NIK</label>
                              <input type="number" name="nik" value="<?= $data['nik'] ?>" class="form-control" id="nik" minlength="16" required>
                            </div>
                            <div class="form-group">
                              <label for="jenis_kelamin">Jenis Kelamin</label>
                              <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                                <?php $d_jk = $data['jenis_kelamin'];
                                foreach ($jenis_kelamin as $jk) {
                                  $selected = ($jk == $d_jk) ? 'selected' : ''; ?>
                                  <option value="<?= $jk ?>" <?= $selected ?>><?= $jk ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="tempat_lahir">Tempat Lahir</label>
                              <input type="text" name="tempat_lahir" value="<?= $data['tempat_lahir'] ?>" class="form-control" id="tempat_lahir" minlength="3" required>
                            </div>
                            <div class="form-group">
                              <label for="tanggal_lahir">Tgl Lahir</label>
                              <input type="date" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>" class="form-control" id="tanggal_lahir" required>
                            </div>
                            <div class="form-group">
                              <label for="agama">Agama</label>
                              <select name="agama" class="form-control" id="agama" required>
                                <?php $d_agama = $data['agama'];
                                foreach ($agama as $agm) {
                                  $selected = ($agm == $d_agama) ? 'selected' : '';  ?>
                                  <option value="<?= $agm ?>" <?= $selected ?>><?= $agm ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="pendidikan">Pendidikan</label>
                              <input type="text" name="pendidikan" value="<?= $data['pendidikan'] ?>" class="form-control" id="pendidikan" minlength="2" required>
                            </div>
                            <div class="form-group">
                              <label for="pekerjaan">Pekerjaan</label>
                              <select name="pekerjaan" class="form-control" id="pekerjaan<?= $data['id_penduduk'] ?>" onchange="showInput<?= $data['id_penduduk'] ?>()">
                                <?php $d_pekerjaan = $data['jenis_pekerjaan'];
                                foreach ($pekerjaan as $pkr) {
                                  $selected = ($pkr == $d_pekerjaan) ? 'selected' : '';  ?>
                                  <option value="<?= $pkr ?>" <?= $selected ?>><?= $pkr ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group" id="inputManual<?= $data['id_penduduk'] ?>" style="display: none;">
                              <label for="pekerjaan_other">Pekerjaan Lainnya</label>
                              <input type="text" name="pekerjaan_other" value="<?= $data['jenis_pekerjaan'] ?>" class="form-control" id="pekerjaan_other" minlength="3">
                            </div>
                            <script>
                              function showInput<?= $data['id_penduduk'] ?>() {
                                var select = document.getElementById("pekerjaan<?= $data['id_penduduk'] ?>");
                                var inputManual = document.getElementById("inputManual<?= $data['id_penduduk'] ?>");

                                if (select.value === "Lainnya") {
                                  inputManual.style.display = "block";
                                } else {
                                  inputManual.style.display = "none";
                                }
                              }
                            </script>
                            <div class="form-group">
                              <label for="status_perkawinan">Status Perkawinan</label>
                              <select name="status_perkawinan" class="form-control" id="status_perkawinan" required>
                                <option value="" disabled selected>Pilih Status Perkawinan</option>
                                <?php
                                $status_perkawinan_pilihan = array("Kawin", "Belum Kawin");
                                $status_perkawinan_terpilih = $data['status_perkawinan'];
                                foreach ($status_perkawinan_pilihan as $status) {
                                  $selected = ($status == $status_perkawinan_terpilih) ? 'selected' : '';
                                  echo '<option value="' . $status . '" ' . $selected . '>' . $status . '</option>';
                                }
                                ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="status_hub_keluarga">Status Hubungan Dalam Keluarga</label>
                              <select name="status_hub_keluarga" class="form-control" id="status_hub_keluarga" required>
                                <option value="" disabled selected>Pilih Status Hubungan Dalam Keluarga</option>
                                <?php
                                $status_hubungan_pilihan = array("Kepala Keluarga", "Istri", "Anak");
                                $status_hubungan_terpilih = $data['status_hub_keluarga'];
                                foreach ($status_hubungan_pilihan as $status) {
                                  $selected = ($status == $status_hubungan_terpilih) ? 'selected' : '';
                                  echo '<option value="' . $status . '" ' . $selected . '>' . $status . '</option>';
                                }
                                ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="kewarganegaraan">Kewarganegaraan</label>
                              <select name="kewarganegaraan" class="form-control" id="kewarganegaraan" required>
                                <option value="" disabled selected>Pilih Kewarganegaraan</option>
                                <?php
                                $kewarganegaraan_pilihan = array("WNI", "WNA");
                                $kewarganegaraan_terpilih = $data['kewarganegaraan'];
                                foreach ($kewarganegaraan_pilihan as $kewarganegaraan) {
                                  $selected = ($kewarganegaraan == $kewarganegaraan_terpilih) ? 'selected' : '';
                                  echo '<option value="' . $kewarganegaraan . '" ' . $selected . '>' . $kewarganegaraan . '</option>';
                                }
                                ?>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="nama_ayah">Nama Ayah</label>
                              <input type="text" name="nama_ayah" value="<?= $data['nama_ayah'] ?>" class="form-control" id="nama_ayah" minlength="3" required>
                            </div>
                            <div class="form-group">
                              <label for="nama_ibu">Nama Ibu</label>
                              <input type="text" name="nama_ibu" value="<?= $data['nama_ibu'] ?>" class="form-control" id="nama_ibu" minlength="3" required>
                            </div>
                            <div class="form-group">
                              <label for="id_rt">RT</label>
                              <select name="id_rt" class="form-control" id="id_rt" required>
                                <option value="" selected>Pilih RT</option>
                                <?php $id_rt = $data['id_rt'];
                                foreach ($views_rt as $data_rt) {
                                  $selected = ($data_rt['id_rt'] == $id_rt) ? 'selected' : '';  ?>
                                  <option value="<?= $data_rt['id_rt'] ?>" <?= $selected ?>><?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kecamatan " . $data_rt['kecamatan'] . ", Kabupaten" . $data_rt['kabupaten'] . ", Provinsi " . $data_rt['provinsi'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="id_rw">RW</label>
                              <select name="id_rw" class="form-control" id="id_rw" required>
                                <option value="" selected>Pilih RW</option>
                                <?php $id_rw = $data['id_rw'];
                                foreach ($views_rw as $data_rw) {
                                  $selected = ($data_rw['id_rw'] == $id_rw) ? 'selected' : '';  ?>
                                  <option value="<?= $data_rw['id_rw'] ?>" <?= $selected ?>><?= "RW " . $data_rw['rw'] . ", Desa " . $data_rw['desa'] . ", Kecamatan " . $data_rw['kecamatan'] . ", Kabupaten" . $data_rw['kabupaten'] . ", Provinsi " . $data_rw['provinsi'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="id_desa">Desa</label>
                              <select name="id_desa" class="form-control" id="id_desa" required>
                                <option value="" selected>Pilih Desa</option>
                                <?php $id_desa = $data['id_desa'];
                                foreach ($views_desa as $data_desa) {
                                  $selected = ($data_desa['id_desa'] == $id_desa) ? 'selected' : '';  ?>
                                  <option value="<?= $data_desa['id_desa'] ?>" <?= $selected ?>><?= "Desa " . $data_desa['desa'] . ", Kecamatan " . $data_desa['kecamatan'] . ", Kabupaten" . $data_desa['kabupaten'] . ", Provinsi " . $data_desa['provinsi'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="edit_penduduk" class="btn btn-warning btn-sm">Ubah</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['id_penduduk'] ?>">
                    <i class="bi bi-trash3"></i> Hapus
                  </button>
                  <div class="modal fade" id="hapus<?= $data['id_penduduk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['nama_lengkap'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_penduduk" value="<?= $data['id_penduduk'] ?>">
                          <div class="modal-body">
                            <p>Jika anda yakin ingin menghapus data ini, klik Hapus!</p>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_penduduk" class="btn btn-danger btn-sm">hapus</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-bottom-0 shadow">
          <h5 class="modal-title" id="tambahLabel">Tambah Penduduk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="nama_lengkap">Nama Lengkap</label>
              <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" minlength="3" required>
            </div>
            <div class="form-group">
              <label for="nik">NIK</label>
              <input type="number" name="nik" class="form-control" id="nik" minlength="16" required>
            </div>
            <div class="form-group">
              <label for="jenis_kelamin">Jenis Kelamin</label>
              <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label for="tempat_lahir">Tempat Lahir</label>
              <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" minlength="3" required>
            </div>
            <div class="form-group">
              <label for="tanggal_lahir">Tgl Lahir</label>
              <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required>
            </div>
            <div class="form-group">
              <label for="agama">Agama</label>
              <select name="agama" class="form-control" id="agama" required>
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
              <label for="pendidikan">Pendidikan</label>
              <input type="text" name="pendidikan" class="form-control" id="pendidikan" minlength="2" required>
            </div>
            <div class="form-group">
              <label for="jenis_pekerjaan">Jenis Pekerjaan</label>
              <select name="jenis_pekerjaan" class="form-control" id="jenis_pekerjaan" onchange="showInput()">
                <option value="" disabled selected>Pilih Jenis Pekerjaan</option>
                <option value="Pegawai Swasta">Pegawai Swasta</option>
                <option value="PNS">Pegawai Negeri Sipil (PNS)</option>
                <option value="Wiraswasta">Wiraswasta</option>
                <option value="Mahasiswa">Mahasiswa</option>
                <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                <option value="Lainnya">Lainnya</option>
              </select>
            </div>
            <div class="form-group" id="inputManual" style="display: none;">
              <label for="pekerjaan_other">Jenis Pekerjaan Lainnya</label>
              <input type="text" name="pekerjaan_other" class="form-control" id="pekerjaan_other" minlength="3">
            </div>
            <script>
              function showInput() {
                var select = document.getElementById("jenis_pekerjaan");
                var inputManual = document.getElementById("inputManual");

                if (select.value === "Lainnya") {
                  inputManual.style.display = "block";
                } else {
                  inputManual.style.display = "none";
                }
              }
            </script>
            <div class="form-group">
              <label for="status_perkawinan">Status Perkawinan</label>
              <select name="status_perkawinan" class="form-control" id="status_perkawinan" required>
                <option value="" disabled selected>Pilih Status Perkawinan</option>
                <option value="Kawin">Kawin</option>
                <option value="Belum Kawin">Belum Kawin</option>
              </select>
            </div>
            <div class="form-group">
              <label for="status_hub_keluarga">Status Hubungan Dalam Keluarga</label>
              <select name="status_hub_keluarga" class="form-control" id="status_hub_keluarga" required>
                <option value="" disabled selected>Pilih Status Hubungan Dalam Keluarga</option>
                <option value="Kepala Keluarga">Kepala Keluarga</option>
                <option value="Istri">Istri</option>
                <option value="Anak">Anak</option>
              </select>
            </div>
            <div class="form-group">
              <label for="kewarganegaraan">Kewarganegaraan</label>
              <select name="kewarganegaraan" class="form-control" id="kewarganegaraan" required>
                <option value="" disabled selected>Pilih Kewarganegaraan</option>
                <option value="WNI">WNI</option>
                <option value="WNA">WNA</option>
              </select>
            </div>
            <div class="form-group">
              <label for="nama_ayah">Nama Ayah</label>
              <input type="text" name="nama_ayah" class="form-control" id="nama_ayah" minlength="3" required>
            </div>
            <div class="form-group">
              <label for="nama_ibu">Nama Ibu</label>
              <input type="text" name="nama_ibu" class="form-control" id="nama_ibu" minlength="3" required>
            </div>
            <div class="form-group">
              <label for="id_rt">RT</label>
              <select name="id_rt" class="form-control" id="id_rt" required>
                <option value="" selected>Pilih RT</option>
                <?php foreach ($views_rt as $data_rt) { ?>
                  <option value="<?= $data_rt['id_rt'] ?>"><?= "RT " . $data_rt['rt'] . ", RW " . $data_rt['rw'] . ", Desa " . $data_rt['desa'] . ", Kecamatan " . $data_rt['kecamatan'] . ", Kabupaten" . $data_rt['kabupaten'] . ", Provinsi " . $data_rt['provinsi'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="id_rw">RW</label>
              <select name="id_rw" class="form-control" id="id_rw" required>
                <option value="" selected>Pilih RW</option>
                <?php foreach ($views_rw as $data_rw) { ?>
                  <option value="<?= $data_rw['id_rw'] ?>"><?= "RW " . $data_rw['rw'] . ", Desa " . $data_rw['desa'] . ", Kecamatan " . $data_rw['kecamatan'] . ", Kabupaten" . $data_rw['kabupaten'] . ", Provinsi " . $data_rw['provinsi'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="id_desa">Desa</label>
              <select name="id_desa" class="form-control" id="id_desa" required>
                <option value="" selected>Pilih Desa</option>
                <?php foreach ($views_desa as $data_desa) { ?>
                  <option value="<?= $data_desa['id_desa'] ?>"><?= "Desa " . $data_desa['desa'] . ", Kecamatan " . $data_desa['kecamatan'] . ", Kabupaten" . $data_desa['kabupaten'] . ", Provinsi " . $data_desa['provinsi'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_penduduk" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-bottom-0 shadow">
          <h5 class="modal-title" id="exampleModalLabel">Import Data Penduduk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="modal-body text-left">
            <div class="mb-3">
              <label for="file_penduduk" class="form-label">File Data Penduduk</label>
              <input name="file_penduduk" class="form-control" type="file" id="file_penduduk" accept=".xls, .xlsx">
              <small class="text-danger">Hanya file excel yang diperbolehkan!</small>
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="import_penduduk" class="btn btn-success btn-sm">Import</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>