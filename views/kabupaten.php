<?php require_once("../controller/script.php");
$_SESSION["project_sistem_informasi_desa"]["name_page"] = "Kabupaten";
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
              <th class="text-center">Kabupaten</th>
              <th class="text-center">Provinsi</th>
              <th class="text-center" style="width: 200px;">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">Kabupaten</th>
              <th class="text-center">Provinsi</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($views_kabupaten as $data) { ?>
              <tr>
                <td><?= $data['kabupaten'] ?></td>
                <td><?= $data['provinsi'] ?></td>
                <td class="text-center">
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $data['id_kabupaten'] ?>">
                    <i class="bi bi-pencil-square"></i> Ubah
                  </button>
                  <div class="modal fade" id="ubah<?= $data['id_kabupaten'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $data['kabupaten'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_kabupaten" value="<?= $data['id_kabupaten'] ?>">
                          <input type="hidden" name="kabupatenOld" value="<?= $data['kabupaten'] ?>">
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="kabupaten">kabupaten</label>
                              <input type="text" name="kabupaten" value="<?= $data['kabupaten'] ?>" class="form-control" id="kabupaten" minlength="3" required>
                            </div>
                            <div class="form-group">
                              <label for="id_provinsi">Provinsi</label>
                              <select name="id_provinsi" class="form-control" id="id_provinsi" required>
                                <?php $id_provinsi = $data['id_provinsi'];
                                foreach ($views_provinsi as $data_provinsi) {
                                  $selected = ($data_provinsi['id_provinsi'] == $id_provinsi) ? 'selected' : ''; ?>
                                  <option value="<?= $data_provinsi['id_provinsi'] ?>" <?= $selected ?>><?= $data_provinsi['provinsi'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="edit_kabupaten" class="btn btn-warning btn-sm">Ubah</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['id_kabupaten'] ?>">
                    <i class="bi bi-trash3"></i> Hapus
                  </button>
                  <div class="modal fade" id="hapus<?= $data['id_kabupaten'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['kabupaten'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_kabupaten" value="<?= $data['id_kabupaten'] ?>">
                          <input type="hidden" name="kabupaten" value="<?= $data['kabupaten'] ?>">
                          <div class="modal-body">
                            <p>Jika anda yakin ingin menghapus <?= $data['kabupaten'] ?> klik Hapus!</p>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_kabupaten" class="btn btn-danger btn-sm">hapus</button>
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
          <h5 class="modal-title" id="tambahLabel">Tambah Kabupaten</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="kabupaten">Kabupaten</label>
              <input type="text" name="kabupaten" class="form-control" id="kabupaten" minlength="3" required>
            </div>
            <div class="form-group">
              <label for="id_provinsi">Provinsi</label>
              <select name="id_provinsi" class="form-control" id="id_provinsi" required>
                <option value="" selected>Pilih Provinsi</option>
                <?php foreach ($views_provinsi as $data_provinsi) { ?>
                  <option value="<?= $data_provinsi['id_provinsi'] ?>"><?= $data_provinsi['provinsi'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_kabupaten" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>