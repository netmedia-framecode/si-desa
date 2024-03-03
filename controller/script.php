<?php if (!isset($_SESSION[""])) {
  session_start();
}
error_reporting(~E_NOTICE & ~E_DEPRECATED);
require_once("db_connect.php");
require_once("../models/sql.php");
require_once("functions.php");

$messageTypes = ["success", "info", "warning", "danger", "dark"];

$baseURL = "http://$_SERVER[HTTP_HOST]/apps/tugas/si_desa/";
$name_website = "Sistem Informasi Desa";

$select_auth = "SELECT * FROM auth";
$views_auth = mysqli_query($conn, $select_auth);

if (!isset($_SESSION["project_sistem_informasi_desa"]["users"])) {
  if (isset($_SESSION["project_sistem_informasi_desa"]["time_message"]) && (time() - $_SESSION["project_sistem_informasi_desa"]["time_message"]) > 2) {
    foreach ($messageTypes as $type) {
      if (isset($_SESSION["project_sistem_informasi_desa"]["message_$type"])) {
        unset($_SESSION["project_sistem_informasi_desa"]["message_$type"]);
      }
    }
    unset($_SESSION["project_sistem_informasi_desa"]["time_message"]);
  }
  if (isset($_POST["register"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (register($conn, $validated_post, $action = 'insert') > 0) {
      header("Location: verification?en=" . $_SESSION['data_auth']['en_user']);
      exit();
    }
  }
  if (isset($_POST["re_verifikasi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (re_verifikasi($conn, $validated_post, $action = 'update') > 0) {
      $message = "Kode token yang baru telah dikirim ke email anda.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: verification?en=" . $_SESSION['data_auth']['en_user']);
      exit();
    }
  }
  if (isset($_POST["verifikasi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (verifikasi($conn, $validated_post, $action = 'update') > 0) {
      $message = "Akun anda berhasil di verifikasi.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST["forgot_password"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (forgot_password($conn, $validated_post, $action = 'update', $baseURL) > 0) {
      $message = "Kami telah mengirim link ke email anda untuk melakukan reset kata sandi.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST["new_password"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (new_password($conn, $validated_post, $action = 'update') > 0) {
      $message = "Kata sandi anda telah berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST["login"])) {
    if (login($conn, $_POST) > 0) {
      header("Location: ../views/");
      exit();
    }
  }
}

if (isset($_SESSION["project_sistem_informasi_desa"]["users"])) {
  $id_user = valid($conn, $_SESSION["project_sistem_informasi_desa"]["users"]["id"]);
  $id_role = valid($conn, $_SESSION["project_sistem_informasi_desa"]["users"]["id_role"]);
  $role = valid($conn, $_SESSION["project_sistem_informasi_desa"]["users"]["role"]);
  $email = valid($conn, $_SESSION["project_sistem_informasi_desa"]["users"]["email"]);
  $name = valid($conn, $_SESSION["project_sistem_informasi_desa"]["users"]["name"]);
  if (isset($_SESSION["project_sistem_informasi_desa"]["users"]["time_message"]) && (time() - $_SESSION["project_sistem_informasi_desa"]["users"]["time_message"]) > 2) {
    foreach ($messageTypes as $type) {
      if (isset($_SESSION["project_sistem_informasi_desa"]["users"]["message_$type"])) {
        unset($_SESSION["project_sistem_informasi_desa"]["users"]["message_$type"]);
      }
    }
    unset($_SESSION["project_sistem_informasi_desa"]["users"]["time_message"]);
  }

  $jenis_kelamin = array("Laki-laki", "Perempuan");
  $agama = array("Islam", "Kristen", "Katolik", "Hindu", "Buddha", "Konghucu");
  $pekerjaan = array("Pegawai Swasta", "Pegawai Negeri Sipil (PNS)", "Wiraswasta", "Mahasiswa", "Ibu Rumah Tangga", "Lainnya");

  $select_profile = "SELECT users.*, user_role.role, user_status.status 
                      FROM users
                      JOIN user_role ON users.id_role=user_role.id_role 
                      JOIN user_status ON users.id_active=user_status.id_status 
                      WHERE users.id_user='$id_user'
                    ";
  $view_profile = mysqli_query($conn, $select_profile);
  if (isset($_POST["edit_profil"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (profil($conn, $validated_post, $action = 'update', $id_user) > 0) {
      $message = "Profil Anda berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: profil");
      exit();
    }
  }
  if (isset($_POST["setting"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (setting($conn, $validated_post, $action = 'update') > 0) {
      $message = "Setting pada system login berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: setting");
      exit();
    }
  }

  $select_users = "SELECT users.*, user_role.role, user_status.status 
                    FROM users
                    JOIN user_role ON users.id_role=user_role.id_role 
                    JOIN user_status ON users.id_active=user_status.id_status
                  ";
  $views_users = mysqli_query($conn, $select_users);
  $select_user_role = "SELECT * FROM user_role";
  $views_user_role = mysqli_query($conn, $select_user_role);
  if (isset($_POST["edit_users"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (users($conn, $validated_post, $action = 'update') > 0) {
      $message = "data users berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: users");
      exit();
    }
  }
  if (isset($_POST["add_role"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (role($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Role baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: role");
      exit();
    }
  }
  if (isset($_POST["edit_role"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (role($conn, $validated_post, $action = 'update') > 0) {
      $message = "Role " . $_POST['roleOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: role");
      exit();
    }
  }
  if (isset($_POST["delete_role"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (role($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Role " . $_POST['role'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: role");
      exit();
    }
  }

  $select_menu = "SELECT * 
                    FROM user_menu 
                    ORDER BY menu ASC
                  ";
  $views_menu = mysqli_query($conn, $select_menu);
  if (isset($_POST["add_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Menu baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu");
      exit();
    }
  }
  if (isset($_POST["edit_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu($conn, $validated_post, $action = 'update') > 0) {
      $message = "Menu " . $_POST['menuOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu");
      exit();
    }
  }
  if (isset($_POST["delete_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Menu " . $_POST['menu'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu");
      exit();
    }
  }

  $select_sub_menu = "SELECT user_sub_menu.*, user_menu.menu, user_status.status 
                        FROM user_sub_menu 
                        JOIN user_menu ON user_sub_menu.id_menu=user_menu.id_menu 
                        JOIN user_status ON user_sub_menu.id_active=user_status.id_status 
                        ORDER BY user_sub_menu.title ASC
                      ";
  $views_sub_menu = mysqli_query($conn, $select_sub_menu);
  $select_user_status = "SELECT * 
                          FROM user_status
                        ";
  $views_user_status = mysqli_query($conn, $select_user_status);
  if (isset($_POST["add_sub_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu($conn, $validated_post, $action = 'insert', $baseURL) > 0) {
      $message = "Sub Menu baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu");
      exit();
    }
  }
  if (isset($_POST["edit_sub_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu($conn, $validated_post, $action = 'update', $baseURL) > 0) {
      $message = "Sub Menu " . $_POST['titleOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu");
      exit();
    }
  }
  if (isset($_POST["delete_sub_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu($conn, $validated_post, $action = 'delete', $baseURL) > 0) {
      $message = "Sub Menu " . $_POST['title'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu");
      exit();
    }
  }

  $select_user_access_menu = "SELECT user_access_menu.*, user_role.role, user_menu.menu
                                FROM user_access_menu 
                                JOIN user_role ON user_access_menu.id_role=.user_role.id_role 
                                JOIN user_menu ON user_access_menu.id_menu=user_menu.id_menu
                              ";
  $views_user_access_menu = mysqli_query($conn, $select_user_access_menu);
  $select_menu_check = "SELECT user_menu.* 
                    FROM user_menu 
                    ORDER BY user_menu.menu ASC
                  ";
  $views_menu_check = mysqli_query($conn, $select_menu_check);
  if (isset($_POST["add_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu_access($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Akses ke menu berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu-access");
      exit();
    }
  }
  if (isset($_POST["edit_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu_access($conn, $validated_post, $action = 'update') > 0) {
      $message = "Akses menu " . $_POST['menu'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu-access");
      exit();
    }
  }
  if (isset($_POST["delete_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu_access($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Akses menu " . $_POST['menu'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu-access");
      exit();
    }
  }

  $select_user_access_sub_menu = "SELECT user_access_sub_menu.*, user_role.role, user_sub_menu.title
                                FROM user_access_sub_menu 
                                JOIN user_role ON user_access_sub_menu.id_role=.user_role.id_role 
                                JOIN user_sub_menu ON user_access_sub_menu.id_sub_menu=user_sub_menu.id_sub_menu
                              ";
  $views_user_access_sub_menu = mysqli_query($conn, $select_user_access_sub_menu);
  $select_sub_menu_check = "SELECT user_sub_menu.*, user_menu.menu
                              FROM user_sub_menu 
                              JOIN user_menu ON user_sub_menu.id_menu=user_menu.id_menu
                              ORDER BY user_menu.menu ASC
                            ";
  $views_sub_menu_check = mysqli_query($conn, $select_sub_menu_check);
  if (isset($_POST["add_sub_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu_access($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Akses ke sub menu berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu-access");
      exit();
    }
  }
  if (isset($_POST["edit_sub_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu_access($conn, $validated_post, $action = 'update') > 0) {
      $message = "Akses sub menu " . $_POST['title'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu-access");
      exit();
    }
  }
  if (isset($_POST["delete_sub_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu_access($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Akses sub menu " . $_POST['title'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu-access");
      exit();
    }
  }

  // ==> Struktur Pemerintahan
  $provinsi = "SELECT * FROM provinsi";
  $views_provinsi = mysqli_query($conn, $provinsi);
  if (isset($_POST["add_provinsi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (provinsi($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Nama provinsi berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: provinsi");
      exit();
    }
  }
  if (isset($_POST["edit_provinsi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (provinsi($conn, $validated_post, $action = 'update') > 0) {
      $message = "Nama provinsi " . $_POST['provinsiOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: provinsi");
      exit();
    }
  }
  if (isset($_POST["delete_provinsi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (provinsi($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Provinsi " . $_POST['provinsi'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: provinsi");
      exit();
    }
  }

  $kabupaten = "SELECT kabupaten.*, provinsi.provinsi 
    FROM kabupaten 
    JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi
  ";
  $views_kabupaten = mysqli_query($conn, $kabupaten);
  if (isset($_POST["add_kabupaten"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kabupaten($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Nama kabupaten berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kabupaten");
      exit();
    }
  }
  if (isset($_POST["edit_kabupaten"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kabupaten($conn, $validated_post, $action = 'update') > 0) {
      $message = "Nama kabupaten " . $_POST['kabupatenOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kabupaten");
      exit();
    }
  }
  if (isset($_POST["delete_kabupaten"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kabupaten($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Kabupaten " . $_POST['kabupaten'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kabupaten");
      exit();
    }
  }

  $kecamatan = "SELECT kecamatan.*, kabupaten.kabupaten, provinsi.provinsi 
    FROM kecamatan 
    JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten
    JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi
  ";
  $views_kecamatan = mysqli_query($conn, $kecamatan);
  if (isset($_POST["add_kecamatan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kecamatan($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Nama kecamatan berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kecamatan");
      exit();
    }
  }
  if (isset($_POST["edit_kecamatan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kecamatan($conn, $validated_post, $action = 'update') > 0) {
      $message = "Nama kecamatan " . $_POST['kecamatanOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kecamatan");
      exit();
    }
  }
  if (isset($_POST["delete_kecamatan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kecamatan($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Kecamatan " . $_POST['kecamatan'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kecamatan");
      exit();
    }
  }

  $desa = "SELECT desa.*, kecamatan.kecamatan, kabupaten.kabupaten, provinsi.provinsi 
    FROM desa 
    JOIN kecamatan ON desa.id_kecamatan=kecamatan.id_kecamatan
    JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten
    JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi
  ";
  $views_desa = mysqli_query($conn, $desa);
  if (isset($_POST["add_desa"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (desa($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Nama desa berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: desa");
      exit();
    }
  }
  if (isset($_POST["edit_desa"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (desa($conn, $validated_post, $action = 'update') > 0) {
      $message = "Nama desa " . $_POST['desaOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: desa");
      exit();
    }
  }
  if (isset($_POST["delete_desa"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (desa($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Desa " . $_POST['desa'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: desa");
      exit();
    }
  }

  $rw = "SELECT rw.*, desa.desa, kecamatan.kecamatan, kabupaten.kabupaten, provinsi.provinsi 
    FROM rw 
    JOIN desa ON rw.id_desa=desa.id_desa
    JOIN kecamatan ON desa.id_kecamatan=kecamatan.id_kecamatan
    JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten
    JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi
  ";
  $views_rw = mysqli_query($conn, $rw);
  if (isset($_POST["add_rw"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (rw($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Nama RW berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: rw");
      exit();
    }
  }
  if (isset($_POST["edit_rw"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (rw($conn, $validated_post, $action = 'update') > 0) {
      $message = "Nama RW " . $_POST['rwOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: rw");
      exit();
    }
  }
  if (isset($_POST["delete_rw"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (rw($conn, $validated_post, $action = 'delete') > 0) {
      $message = "RW " . $_POST['rw'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: rw");
      exit();
    }
  }

  $rt = "SELECT rt.*, rw.rw, desa.desa, kecamatan.kecamatan, kabupaten.kabupaten, provinsi.provinsi 
    FROM rt 
    JOIN rw ON rt.id_rw=rw.id_rw
    JOIN desa ON rw.id_desa=desa.id_desa
    JOIN kecamatan ON desa.id_kecamatan=kecamatan.id_kecamatan
    JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten
    JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi
  ";
  $views_rt = mysqli_query($conn, $rt);
  if (isset($_POST["add_rt"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (rt($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Nama RT berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: rt");
      exit();
    }
  }
  if (isset($_POST["edit_rt"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (rt($conn, $validated_post, $action = 'update') > 0) {
      $message = "Nama RT " . $_POST['rtOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: rt");
      exit();
    }
  }
  if (isset($_POST["delete_rt"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (rt($conn, $validated_post, $action = 'delete') > 0) {
      $message = "RT " . $_POST['rt'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: rt");
      exit();
    }
  }

  // ==> Surat Keterangan
  $suket_domisili = "SELECT suket_domisili.*, desa.desa, kecamatan.kecamatan, kabupaten.kabupaten, provinsi.provinsi 
  FROM suket_domisili 
  JOIN desa ON suket_domisili.id_desa=desa.id_desa
  JOIN kecamatan ON desa.id_kecamatan=kecamatan.id_kecamatan
  JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten
  JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi
  ORDER BY suket_domisili.id_suket_domisili DESC
  ";
  $views_suket_domisili = mysqli_query($conn, $suket_domisili);
  if (isset($_POST['add_suket_domisili'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (domisili($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Surat domisili berhasil dibuat.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: domisili");
      exit();
    }
  }
  if (isset($_POST['edit_suket_domisili'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (domisili($conn, $validated_post, $action = 'update') > 0) {
      $message = "Surat domisili berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: domisili");
      exit();
    }
  }
  if (isset($_POST['delete_suket_domisili'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (domisili($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Surat domisili berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: domisili");
      exit();
    }
  }

  $suket_kelahiran = "SELECT suket_kelahiran.*, desa.desa, kecamatan.kecamatan, kabupaten.kabupaten, provinsi.provinsi 
  FROM suket_kelahiran 
  JOIN desa ON suket_kelahiran.id_desa=desa.id_desa
  JOIN kecamatan ON desa.id_kecamatan=kecamatan.id_kecamatan
  JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten
  JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi
  ORDER BY suket_kelahiran.id_suket_kelahiran DESC
  ";
  $views_suket_kelahiran = mysqli_query($conn, $suket_kelahiran);
  if (isset($_POST['add_suket_kelahiran'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kelahiran($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Surat kelahiran berhasil dibuat.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kelahiran");
      exit();
    }
  }
  if (isset($_POST['edit_suket_kelahiran'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kelahiran($conn, $validated_post, $action = 'update') > 0) {
      $message = "Surat kelahiran berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kelahiran");
      exit();
    }
  }
  if (isset($_POST['delete_suket_kelahiran'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kelahiran($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Surat kelahiran berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kelahiran");
      exit();
    }
  }

  $suket_kematian = "SELECT suket_kematian.*, desa.desa, kecamatan.kecamatan, kabupaten.kabupaten, provinsi.provinsi 
  FROM suket_kematian 
  JOIN desa ON suket_kematian.id_desa=desa.id_desa
  JOIN kecamatan ON desa.id_kecamatan=kecamatan.id_kecamatan
  JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten
  JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi
  ORDER BY suket_kematian.id_suket_kematian DESC
  ";
  $views_suket_kematian = mysqli_query($conn, $suket_kematian);
  if (isset($_POST['add_suket_kematian'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kematian($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Surat kematian berhasil dibuat.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kematian");
      exit();
    }
  }
  if (isset($_POST['edit_suket_kematian'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kematian($conn, $validated_post, $action = 'update') > 0) {
      $message = "Surat kematian berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kematian");
      exit();
    }
  }
  if (isset($_POST['delete_suket_kematian'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kematian($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Surat kematian berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kematian");
      exit();
    }
  }

  $suket_non_kk = "SELECT suket_non_kk.*, desa.desa, kecamatan.kecamatan, kabupaten.kabupaten, provinsi.provinsi 
  FROM suket_non_kk 
  JOIN desa ON suket_non_kk.id_desa=desa.id_desa
  JOIN kecamatan ON desa.id_kecamatan=kecamatan.id_kecamatan
  JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten
  JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi
  ORDER BY suket_non_kk.id_suket_non_kk DESC
  ";
  $views_suket_non_kk = mysqli_query($conn, $suket_non_kk);
  if (isset($_POST['add_suket_non_kk'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (non_kk($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Surat belum memiliki kk berhasil dibuat.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: belum-memiliki-kk");
      exit();
    }
  }
  if (isset($_POST['edit_suket_non_kk'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (non_kk($conn, $validated_post, $action = 'update') > 0) {
      $message = "Surat belum memiliki kk berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: belum-memiliki-kk");
      exit();
    }
  }
  if (isset($_POST['delete_suket_non_kk'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (non_kk($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Surat belum memiliki kk berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: belum-memiliki-kk");
      exit();
    }
  }

  $suket_tidak_mampu = "SELECT suket_tidak_mampu.*, desa.desa, kecamatan.kecamatan, kabupaten.kabupaten, provinsi.provinsi 
  FROM suket_tidak_mampu 
  JOIN desa ON suket_tidak_mampu.id_desa=desa.id_desa
  JOIN kecamatan ON desa.id_kecamatan=kecamatan.id_kecamatan
  JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten
  JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi
  ORDER BY suket_tidak_mampu.id_suket_tidak_mampu DESC
  ";
  $views_suket_tidak_mampu = mysqli_query($conn, $suket_tidak_mampu);
  if (isset($_POST['add_suket_tidak_mampu'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (tidak_mampu($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Surat tidak mampu berhasil dibuat.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: tidak-mampu");
      exit();
    }
  }
  if (isset($_POST['edit_suket_tidak_mampu'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (tidak_mampu($conn, $validated_post, $action = 'update') > 0) {
      $message = "Surat tidak mampu berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: tidak-mampu");
      exit();
    }
  }
  if (isset($_POST['delete_suket_tidak_mampu'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (tidak_mampu($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Surat tidak mampu berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: tidak-mampu");
      exit();
    }
  }

  $suket_usaha = "SELECT suket_usaha.*, desa.desa, kecamatan.kecamatan, kabupaten.kabupaten, provinsi.provinsi 
  FROM suket_usaha 
  JOIN desa ON suket_usaha.id_desa=desa.id_desa
  JOIN kecamatan ON desa.id_kecamatan=kecamatan.id_kecamatan
  JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten
  JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi
  ORDER BY suket_usaha.id_suket_usaha DESC
  ";
  $views_suket_usaha = mysqli_query($conn, $suket_usaha);
  if (isset($_POST['add_suket_usaha'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (usaha($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Surat usaha berhasil dibuat.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: usaha");
      exit();
    }
  }
  if (isset($_POST['edit_suket_usaha'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (usaha($conn, $validated_post, $action = 'update') > 0) {
      $message = "Surat usaha berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: usaha");
      exit();
    }
  }
  if (isset($_POST['delete_suket_usaha'])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (usaha($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Surat usaha berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: usaha");
      exit();
    }
  }

  $chat = "SELECT * FROM chat";
  $views_chat = mysqli_query($conn, $chat);
}
