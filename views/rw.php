<?php require_once("../controller/script.php");
$_SESSION["project_sistem_informasi_desa"]["name_page"] = "RW";
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
              <th class="text-center">RW</th>
              <th class="text-center">Desa</th>
              <th class="text-center">Kecamatan</th>
              <th class="text-center">Kabupaten</th>
              <th class="text-center">Provinsi</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($views_rw as $data) { ?>
              <tr>
                <td><?= $data['rw'] ?></td>
                <td><?= $data['desa'] ?></td>
                <td><?= $data['kecamatan'] ?></td>
                <td><?= $data['kabupaten'] ?></td>
                <td><?= $data['provinsi'] ?></td>
                <td class="text-center">
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $data['id_rw'] ?>">
                    <i class="bi bi-pencil-square"></i> Ubah
                  </button>
                  <div class="modal fade" id="ubah<?= $data['id_rw'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $data['rw'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_rw" value="<?= $data['id_rw'] ?>">
                          <input type="hidden" name="rwOld" value="<?= $data['rw'] ?>">
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="rw">RW</label>
                              <input type="number" name="rw" value="<?= $data['rw'] ?>" class="form-control" id="rw" minlength="3" required>
                            </div>
                            <div class="form-group">
                              <label for="id_desa">Desa</label>
                              <select name="id_desa" class="form-control" id="id_desa" required>
                                <?php $id_desa = $data['id_desa'];
                                foreach ($views_desa as $data_desa) {
                                  $selected = ($data_desa['id_desa'] == $id_desa) ? 'selected' : ''; ?>
                                  <option value="<?= $data_desa['id_desa'] ?>" <?= $selected ?>><?= $data_desa['desa'] . ", " . $data_desa['kecamatan'] . ", " . $data_desa['kabupaten'] . ", " . $data_desa['provinsi'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="edit_rw" class="btn btn-warning btn-sm">Ubah</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['id_rw'] ?>">
                    <i class="bi bi-trash3"></i> Hapus
                  </button>
                  <div class="modal fade" id="hapus<?= $data['id_rw'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['rw'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_rw" value="<?= $data['id_rw'] ?>">
                          <input type="hidden" name="rw" value="<?= $data['rw'] ?>">
                          <div class="modal-body">
                            <p>Jika anda yakin ingin menghapus <?= $data['rw'] ?> klik Hapus!</p>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_rw" class="btn btn-danger btn-sm">hapus</button>
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
          <h5 class="modal-title" id="tambahLabel">Tambah RW</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="rw">RW</label>
              <input type="number" name="rw" class="form-control" id="rw" minlength="3" required>
            </div>
            <div class="form-group">
              <label for="id_desa">Desa</label>
              <select name="id_desa" class="form-control" id="id_desa" required>
                <option value="" selected>Pilih Desa</option>
                <?php foreach ($views_desa as $data_desa) { ?>
                  <option value="<?= $data_desa['id_desa'] ?>"><?= $data_desa['desa'] . ", " . $data_desa['kecamatan'] . ", " . $data_desa['kabupaten'] . ", " . $data_desa['provinsi'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_rw" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>