<?php require_once("templates/top.php");
$_SESSION["page_name"] = "Kontak"; ?>

<section class="contact_section  long_section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="form_container">
          <div class="heading_container">
            <h2>
              Kontak
            </h2>
          </div>
          <form action="" method="post">
            <div>
              <input type="text" name="username" class="shadow" placeholder="Nama" required />
            </div>
            <div>
              <input type="email" name="email" class="shadow" placeholder="Email" required />
            </div>
            <div>
              <input type="number" name="phone" class="shadow" placeholder="No. Handphone" required />
            </div>
            <div>
              <textarea name="pesan" class="form-control border-0 shadow rounded-0 mb-4" id="pesan" rows="3" placeholder="Pesan" required></textarea>
            </div>
            <div class="btn_box">
              <button type="submit" name="add_kontak" class="shadow">
                Kirim
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="map_container">
          <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d52783.68815941726!2d121.86548105022487!3d-10.48717505897636!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c51ee7c2c016665%3A0xa528c473151ccad3!2sDelo%2C%20Kec.%20Sabu%20Bar.%2C%20Kabupaten%20Sabu%20Raijua%2C%20Nusa%20Tenggara%20Tim.!5e0!3m2!1sid!2sid!4v1709607693355!5m2!1sid!2sid" style="border:0;width: 100%;height: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once("templates/bottom.php"); ?>