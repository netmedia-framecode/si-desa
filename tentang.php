<?php require_once("templates/top.php"); ?>

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
            implementasi Undang – Undang Desa No.6 Tahun 2016. UU Desa Pasal 86 tentang Sistem Informasi Pembangunan Desa dan Pembangunan Kawasan Perdesaan jelas disebutkan bahwa desa berhak mendapatkan akses informasi melalui sistem informasi yang dikembangkan oleh Pemerintah Daerah Kabupaten atau Kota. Teknolgi informasi dan komunikasi memberikan banyak manfaat bagi kehidupan manusia salah satunya adalah mempermudah hal-hal seperti surat menyurat sosial media dan promosi hasil pertanian bisa dilakukan dengan bantuan teknologi informasi sehingga informasi yang disampaikan bisa diakses dengan mudah baik oleh masyarakt desa dan perkotaan. Pencatatan dan pengolahan data penduduk merupakan tanggung jawab pemerintah kabupaten/kota, dimana pelaksanaannya diawali dari kelurahan selaku ujung tombak pendaftaran penduduk.
          </p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <p class="text-justify">
          Pelayanan tersebut perlu dilakukan dengan cepat dan tepat untuk mendapatkan suatu informasi. Tetapi pada kenyataannya,pengolahan data pada kelurahan atau desa masih dilakukan dalam bentuk pembukuan atau arsip – arsip, sehingga seringkali terjadi kesalahan bahkan ada arsip data yang hilang atau rusak karena terlalu banyaknya arsip yang ada. Maka dari itu dengan adanya Sistem Informasi Pelayanan Kependudukan ini di harapkan dapat membantu mempermudah dalam proses kegiatan pelayanan permohonan surat-surat kependudukan di tingkat desa. Bagi desa, di harapkan sistem ini dapat mempermudah aparat desa dalam pengumpulan data penduduk desa dan mempermudah melayani penduduk atau warga dalam permohonan surat-surat.
        </p>
      </div>
    </div>
  </div>
</section>

<section class="about_section layout_padding long_section">
  <div class="container">
    <div class="row flex-row-reverse">
      <div class="col-md-6">
        <div class="img-box">
          <img src="assets/img/visi.jpg" alt="">
        </div>
      </div>
      <div class="col-md-6">
        <div class="detail-box">
          <div class="heading_container">
            <h2>
              Visi
            </h2>
          </div>
          <?php foreach ($views_visi as $data_visi) {
            echo $data_visi['visi'];
          } ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="about_section layout_padding long_section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="img-box">
          <img src="assets/img/misi.jpg" alt="">
        </div>
      </div>
      <div class="col-md-6">
        <div class="detail-box">
          <div class="heading_container">
            <h2>
              Misi
            </h2>
          </div>
          <?php foreach ($views_misi as $data_misi) {
            echo $data_misi['misi'];
          } ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once("templates/bottom.php"); ?>