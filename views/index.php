<?php require_once("../controller/script.php");
$_SESSION["project_sistem_informasi_desa"]["name_page"] = "";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->
  <div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2" onclick="window.location.href='users'" style="cursor: pointer;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Users</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?= mysqli_num_rows($views_users); ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                Surat Keterangan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                $count_surat_domisili = mysqli_num_rows($views_suket_domisili);
                $count_surat_kelahiran = mysqli_num_rows($views_suket_kelahiran);
                $count_surat_kematian = mysqli_num_rows($views_suket_kematian);
                $count_surat_non_kk = mysqli_num_rows($views_suket_non_kk);
                $count_surat_tidak_mampu = mysqli_num_rows($views_suket_tidak_mampu);
                $count_surat_usaha = mysqli_num_rows($views_suket_usaha);
                echo $count_surat_domisili + $count_surat_kelahiran + $count_surat_kematian + $count_surat_non_kk + $count_surat_tidak_mampu + $count_surat_usaha;
                ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-file fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2" onclick="window.location.href='kontak'" style="cursor: pointer;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                Kontak</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= mysqli_num_rows($views_kontak); ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Buat Surat
              </div>
              <div class="row no-gutters align-items-center">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#buat-surat">
                  <i class="bi bi-file-earmark-plus"></i> Buat
                </button>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->

  <div class="row">

    <div class="col-xl-8 col-lg-7">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Surat Keterangan <?php if (isset($_POST['suket'])) {
                                                                            if ($_POST['suket'] == "domisili") {
                                                                              echo "Domisili";
                                                                            }
                                                                            if ($_POST['suket'] == "kelahiran") {
                                                                              echo "Kelahiran";
                                                                            }
                                                                            if ($_POST['suket'] == "kematian") {
                                                                              echo "Kematian";
                                                                            }
                                                                            if ($_POST['suket'] == "non-kk") {
                                                                              echo "Belum Memiliki KK";
                                                                            }
                                                                            if ($_POST['suket'] == "tidak-mampu") {
                                                                              echo "Tidak Mampu";
                                                                            }
                                                                            if ($_POST['suket'] == "usaha") {
                                                                              echo "Usaha";
                                                                            }
                                                                          } else {
                                                                            echo "Domisili";
                                                                          } ?>
          </h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Surat Keterangan:</div>
              <form action="" method="post">
                <button type="submit" name="suket" value="domisili" class="dropdown-item" id="domisili">Domisili</button>
                <button type="submit" name="suket" value="kelahiran" class="dropdown-item" id="kelahiran">Kelahiran</button>
                <button type="submit" name="suket" value="kematian" class="dropdown-item" id="kematian">Kematian</button>
                <button type="submit" name="suket" value="non-kk" class="dropdown-item" id="non-kk">Belum Memiliki KK</button>
                <button type="submit" name="suket" value="tidak-mampu" class="dropdown-item" id="tidak-mampu">Tidak Mampu</button>
                <button type="submit" name="suket" value="usaha" class="dropdown-item" id="usaha">Usaha</button>
              </form>
            </div>
          </div>
        </div>
        <?php if (isset($_POST['suket'])) {
          if ($_POST['suket'] == "domisili") { ?>
            <div class="card-body dataTable" id="domisili">
              <?php require_once("add-domisili.php") ?>
            </div>
          <?php }
          if ($_POST['suket'] == "kelahiran") { ?>
            <div class="card-body dataTable" id="kelahiran">
              <?php require_once("add-kelahiran.php") ?>
            </div>
          <?php }
          if ($_POST['suket'] == "kematian") { ?>
            <div class="card-body dataTable" id="kematian">
              <?php require_once("add-kematian.php") ?>
            </div>
          <?php }
          if ($_POST['suket'] == "non-kk") { ?>
            <div class="card-body dataTable" id="non-kk">
              <?php require_once("add-non-kk.php") ?>
            </div>
          <?php }
          if ($_POST['suket'] == "tidak-mampu") { ?>
            <div class="card-body dataTable" id="tidak-mampu">
              <?php require_once("add-tidak-mampu.php") ?>
            </div>
          <?php }
          if ($_POST['suket'] == "usaha") { ?>
            <div class="card-body dataTable" id="usaha">
              <?php require_once("add-usaha.php") ?>
            </div>
          <?php }
        } else { ?>
          <div class="card-body dataTable" id="domisili">
            <?php require_once("add-domisili.php") ?>
          </div>
        <?php } ?>
      </div>
    </div>

    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Chart</h6>
        </div>
        <div class="card-body">
          <div class="chart-pie pt-4 pb-2">
            <canvas id="myPieChart"></canvas>
            <?php
            $count_surat_domisili = mysqli_num_rows($views_suket_domisili);
            $count_surat_kelahiran = mysqli_num_rows($views_suket_kelahiran);
            $count_surat_kematian = mysqli_num_rows($views_suket_kematian);
            $count_surat_non_kk = mysqli_num_rows($views_suket_non_kk);
            $count_surat_tidak_mampu = mysqli_num_rows($views_suket_tidak_mampu);
            $count_surat_usaha = mysqli_num_rows($views_suket_usaha);
            ?>

            <script>
              // Inisialisasi data dari PHP ke JavaScript di dalam tag script
              var chartData = {
                labels: ["Domisili", "Kelahiran", "Kematian", "Belum Memiliki KK", "Tidak Mampu", "Usaha"],
                datasets: [{
                  data: [
                    <?php echo $count_surat_domisili; ?>,
                    <?php echo $count_surat_kelahiran; ?>,
                    <?php echo $count_surat_kematian; ?>,
                    <?php echo $count_surat_non_kk; ?>,
                    <?php echo $count_surat_tidak_mampu; ?>,
                    <?php echo $count_surat_usaha; ?>
                  ],
                  backgroundColor: [
                    'rgba(0, 123, 255, 0.9)',
                    'rgba(40, 167, 69, 0.9)',
                    'rgba(220, 53, 69, 0.9)',
                    'rgba(255, 193, 7, 0.9)',
                    'rgba(108, 117, 125, 0.9)',
                    'rgba(23, 162, 184, 0.9)'
                  ]
                }]
              };
            </script>

            <script src="chart.js"></script>
          </div>
          <div class="mt-4 text-center small">
            <!-- Tampilkan legenda -->
            <span class="mr-2">
              <i class="fas fa-circle text-primary"></i> Domisili
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-success"></i> Kelahiran
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-danger"></i> Kematian
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-warning"></i> Belum Memiliki KK
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-secondary"></i> Tidak Mampu
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-info"></i> Usaha
            </span>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>
<!-- /.container-fluid -->

<div class="modal fade" id="buat-surat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header border-bottom-0 shadow">
        <h5 class="modal-title" id="exampleModalLabel">Pilih Surat Keterangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-between">
          <div class="col-lg-4">
            <div class="card shadow border-0 mt-4">
              <img src="../assets/img/letter.png" class="card-img-top" style="width: 250px;margin: auto;" alt="...">
              <div class="card-body">
                <h5 class="card-title">Domisili</h5>
                <a href="domisili" class="btn btn-primary">Pilih</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card shadow border-0 mt-4">
              <img src="../assets/img/letter.png" class="card-img-top" style="width: 250px;margin: auto;" alt="...">
              <div class="card-body">
                <h5 class="card-title">Kelahiran</h5>
                <a href="kelahiran" class="btn btn-primary">Pilih</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card shadow border-0 mt-4">
              <img src="../assets/img/letter.png" class="card-img-top" style="width: 250px;margin: auto;" alt="...">
              <div class="card-body">
                <h5 class="card-title">Kematian</h5>
                <a href="kematian" class="btn btn-primary">Pilih</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card shadow border-0 mt-4">
              <img src="../assets/img/letter.png" class="card-img-top" style="width: 250px;margin: auto;" alt="...">
              <div class="card-body">
                <h5 class="card-title">Belum Memiliki KK</h5>
                <a href="belum-memiliki-kk" class="btn btn-primary">Pilih</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card shadow border-0 mt-4">
              <img src="../assets/img/letter.png" class="card-img-top" style="width: 250px;margin: auto;" alt="...">
              <div class="card-body">
                <h5 class="card-title">Tidak Mampu</h5>
                <a href="tidak-mampu" class="btn btn-primary">Pilih</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card shadow border-0 mt-4">
              <img src="../assets/img/letter.png" class="card-img-top" style="width: 250px;margin: auto;" alt="...">
              <div class="card-body">
                <h5 class="card-title">Usaha</h5>
                <a href="usaha" class="btn btn-primary">Pilih</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once("../templates/views_bottom.php") ?>