<?php require_once("templates/top.php");

if (mysqli_num_rows($views_menu_surat_keterangan_all) > 0) { ?>
  <section class="furniture_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Surat Keterangan
        </h2>
      </div>
      <div class="row">
        <?php while ($data = mysqli_fetch_assoc($views_menu_surat_keterangan_all)) { ?>
          <div class="col-md-6 col-lg-4">
            <a href="surat-terpilih?id=<?= $data['id_sub_menu'] ?>">
              <div class="box shadow">
                <div class="img-box">
                  <img src="assets/img/letter.png" alt="">
                </div>
                <div class="detail-box">
                  <h5 class="text-dark">
                    <?= $data['title'] ?>
                  </h5>
                  <div class="price_box justify-content-start">
                    <a class="btn btn-primary text-white shadow" href="surat-terpilih?id=<?= $data['id_sub_menu'] ?>">
                      Pilih
                    </a>
                  </div>
                </div>
              </div>
            </a>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
<?php }

require_once("templates/bottom.php"); ?>