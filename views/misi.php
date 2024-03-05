<?php require_once("../controller/script.php");
$_SESSION["project_sistem_informasi_desa"]["name_page"] = "Misi";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_sistem_informasi_desa"]["name_page"] ?></h1>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card shadow">
        <div class="card-body">
          <?php foreach ($views_misi as $data) { ?>
            <form action="" method="post">
              <div class="form-group">
                <label for="deskripsi">Deskripsi Misi</label>
                <textarea class="form-control" name="misi" id="deskripsi" rows="3"><?= $data['misi'] ?></textarea>
              </div>
              <button type="submit" name="edit_misi" class="btn btn-warning">Edit</button>
            </form>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>