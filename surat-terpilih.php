<?php require_once("templates/top.php");
$_SESSION["page_name"] = "Surat Terpilih";

if (!isset($_GET['id'])) {
  header("Location: surat");
  exit;
} else {
  $id = valid($conn, $_GET['id']);
  $sub_menu = "SELECT * FROM user_sub_menu WHERE id_sub_menu = '$id'";
  $views_sub_menu = mysqli_query($conn, $sub_menu);
  $data = mysqli_fetch_assoc($views_sub_menu);
?>

  <section class="contact_section  long_section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <div class="heading_container">
              <h2>
                Surat Keterangan <?= $data['title'] ?>
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
                <textarea name="pesan" class="form-control border-0 shadow rounded-0 mb-4" id="pesan" rows="3" placeholder="Pesan" required>Saya ingin mengajukan Surat Keterangan <?= $data['title'] ?></textarea>
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
          <img src="assets/img/surat-terpilih.png" alt="">
        </div>
      </div>
    </div>
  </section>

<?php }
require_once("templates/bottom.php"); ?>