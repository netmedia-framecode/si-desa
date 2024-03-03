<?php require_once("../controller/script.php");
$_SESSION["project_sistem_informasi_desa"]["name_page"] = "Desa";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_sistem_informasi_desa"]["name_page"] ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambah"><i class="bi bi-plus-lg"></i> Tambah</a>
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">Desa</th>
              <th class="text-center">Kecamatan</th>
              <th class="text-center">Kabupaten</th>
              <th class="text-center">Provinsi</th>
              <th class="text-center" style="width: 200px;">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">Desa</th>
              <th class="text-center">Kecamatan</th>
              <th class="text-center">Kabupaten</th>
              <th class="text-center">Provinsi</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($views_desa as $data) { ?>
              <tr>
                <td><?= $data['desa'] ?></td>
                <td><?= $data['kecamatan'] ?></td>
                <td><?= $data['kabupaten'] ?></td>
                <td><?= $data['provinsi'] ?></td>
                <td class="text-center">
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $data['id_desa'] ?>">
                    <i class="bi bi-pencil-square"></i> Ubah
                  </button>
                  <div class="modal fade" id="ubah<?= $data['id_desa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $data['desa'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_desa" value="<?= $data['id_desa'] ?>">
                          <input type="hidden" name="desaOld" value="<?= $data['desa'] ?>">
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="desa">desa</label>
                              <input type="text" name="desa" value="<?= $data['desa'] ?>" class="form-control" id="desa" minlength="3" required>
                            </div>
                            <div class="form-group">
                              <label for="id_kecamatan">Kecamatan</label>
                              <select name="id_kecamatan" class="form-control" id="id_kecamatan" required>
                                <?php $id_kecamatan = $data['id_kecamatan'];
                                foreach ($views_kecamatan as $data_kecamatan) {
                                  $selected = ($data_kecamatan['id_kecamatan'] == $id_kecamatan) ? 'selected' : ''; ?>
                                  <option value="<?= $data_kecamatan['id_kecamatan'] ?>" <?= $selected ?>><?= $data_kecamatan['kecamatan'] . ", " . $data_kecamatan['kabupaten'] . ", " . $data_kecamatan['provinsi'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="edit_desa" class="btn btn-warning btn-sm">Ubah</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['id_desa'] ?>">
                    <i class="bi bi-trash3"></i> Hapus
                  </button>
                  <div class="modal fade" id="hapus<?= $data['id_desa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['desa'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_desa" value="<?= $data['id_desa'] ?>">
                          <input type="hidden" name="desa" value="<?= $data['desa'] ?>">
                          <div class="modal-body">
                            <p>Jika anda yakin ingin menghapus <?= $data['desa'] ?> klik Hapus!</p>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_desa" class="btn btn-danger btn-sm">hapus</button>
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
          <h5 class="modal-title" id="tambahLabel">Tambah Desa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="desa">Desa</label>
              <input type="text" name="desa" class="form-control" id="desa" minlength="3" required>
            </div>
            <div class="form-group">
              <label for="id_kecamatan">Kecamatan</label>
              <select name="id_kecamatan" class="form-control" id="id_kecamatan" required>
                <option value="" selected>Pilih Kecamatan</option>
                <?php foreach ($views_kecamatan as $data_kecamatan) { ?>
                  <option value="<?= $data_kecamatan['id_kecamatan'] ?>"><?= $data_kecamatan['kecamatan'] . ", " . $data_kecamatan['kabupaten'] . ", " . $data_kecamatan['provinsi'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_desa" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>