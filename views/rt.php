<?php require_once("../controller/script.php");
$_SESSION["project_sistem_informasi_desa"]["name_page"] = "RT";
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
              <th class="text-center">RT</th>
              <th class="text-center">RW</th>
              <th class="text-center">Desa</th>
              <th class="text-center">Kecamatan</th>
              <th class="text-center">Kabupaten</th>
              <th class="text-center">Provinsi</th>
              <th class="text-center" style="width: 200px;">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">RT</th>
              <th class="text-center">RW</th>
              <th class="text-center">Desa</th>
              <th class="text-center">Kecamatan</th>
              <th class="text-center">Kabupaten</th>
              <th class="text-center">Provinsi</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($views_rt as $data) { ?>
              <tr>
                <td><?= $data['rt'] ?></td>
                <td><?= $data['rw'] ?></td>
                <td><?= $data['desa'] ?></td>
                <td><?= $data['kecamatan'] ?></td>
                <td><?= $data['kabupaten'] ?></td>
                <td><?= $data['provinsi'] ?></td>
                <td class="text-center">
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $data['id_rt'] ?>">
                    <i class="bi bi-pencil-square"></i> Ubah
                  </button>
                  <div class="modal fade" id="ubah<?= $data['id_rt'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $data['rt'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_rt" value="<?= $data['id_rt'] ?>">
                          <input type="hidden" name="rtOld" value="<?= $data['rt'] ?>">
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="rt">rt</label>
                              <input type="number" name="rt" value="<?= $data['rt'] ?>" class="form-control" id="rt" minlength="3" required>
                            </div>
                            <div class="form-group">
                              <label for="id_rw">RW</label>
                              <select name="id_rw" class="form-control" id="id_rw" required>
                                <?php $id_rw = $data['id_rw'];
                                foreach ($views_rw as $data_rw) {
                                  $selected = ($data_rw['id_rw'] == $id_rw) ? 'selected' : ''; ?>
                                  <option value="<?= $data_rw['id_rw'] ?>" <?= $selected ?>><?= $data_rw['rw'] . ", " . $data_rw['desa'] . ", " . $data_rw['kecamatan'] . ", " . $data_rw['kabupaten'] . ", " . $data_rw['provinsi'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="edit_rt" class="btn btn-warning btn-sm">Ubah</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['id_rt'] ?>">
                    <i class="bi bi-trash3"></i> Hapus
                  </button>
                  <div class="modal fade" id="hapus<?= $data['id_rt'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['rt'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_rt" value="<?= $data['id_rt'] ?>">
                          <input type="hidden" name="rt" value="<?= $data['rt'] ?>">
                          <div class="modal-body">
                            <p>Jika anda yakin ingin menghapus <?= $data['rt'] ?> klik Hapus!</p>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_rt" class="btn btn-danger btn-sm">hapus</button>
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
          <h5 class="modal-title" id="tambahLabel">Tambah RT</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="rt">RT</label>
              <input type="number" name="rt" class="form-control" id="rt" minlength="3" required>
            </div>
            <div class="form-group">
              <label for="id_rw">RW</label>
              <select name="id_rw" class="form-control" id="id_rw" required>
                <option value="" selected>Pilih RW</option>
                <?php foreach ($views_rw as $data_rw) { ?>
                  <option value="<?= $data_rw['id_rw'] ?>"><?= $data_rw['rw'] . ", " . $data_rw['desa'] . ", " . $data_rw['kecamatan'] . ", " . $data_rw['kabupaten'] . ", " . $data_rw['provinsi'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_rt" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>