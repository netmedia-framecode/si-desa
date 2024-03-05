<?php require_once("templates/top.php"); ?>

<section class="slider_section long_section">
  <div id="customCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container ">
          <div class="row">
            <div class="col-md-5">
              <div class="detail-box">
                <h1>
                  Pelayanan Kependudkan <br>
                  Desa Delo, Kec. Sabu Barat, Kab. Sabu Raijua
                </h1>
                <p>
                  Dapat menyimpan data penduduk secara dinamis serta dapat melayani dan mengajuhkan permohonan surat kependudukan kapan saja dan dimana saja tanpa harus memakan waktu dan tenaga yang cukup lama.
                </p>
                <div class="btn-box">
                  <a href="kontak" class="btn1">
                    Kontak
                  </a>
                  <a href="surat" class="btn2">
                    Surat
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-7">
              <div class="img-box">
                <img src="assets/img/header.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>

<?php if (mysqli_num_rows($views_menu_surat_keterangan) > 0) { ?>
  <section class="furniture_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Surat Keterangan
        </h2>
      </div>
      <div class="row">
        <?php while ($data = mysqli_fetch_assoc($views_menu_surat_keterangan)) { ?>
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
      <div class="text-center mt-5">
        <a href="surat" class="btn btn-primary">Lihat Lebih</a>
      </div>
    </div>
  </section>
<?php } ?>

<section class="about_section layout_padding long_section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="img-box">
          <img src="assets/img/tentang.jpg" alt="">
        </div>
      </div>
      <div class="col-md-6">
        <div class="detail-box">
          <div class="heading_container">
            <h2>
              Tentang
            </h2>
          </div>
          <p class="text-justify">
            Sistem Informasi Desa adalah bagian tak terpisahkan dalam
            implementasi Undang – Undang Desa No.6 Tahun 2016. UU Desa Pasal 86 tentang Sistem Informasi Pembangunan Desa dan Pembangunan Kawasan Perdesaan jelas disebutkan bahwa desa berhak mendapatkan akses informasi melalui sistem informasi yang dikembangkan oleh Pemerintah Daerah Kabupaten atau Kota. Teknolgi informasi dan komuni...
          </p>
          <a href="tentang" class="btn btn-primary">
            Baca Lebih
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once("templates/bottom.php"); ?>