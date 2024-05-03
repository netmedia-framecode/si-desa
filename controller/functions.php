<?php

function handle_error($errno, $errstr, $errfile, $errline)
{
  // Create error log file path based on the file where the error occurred
  $errorLog = dirname(__FILE__) . '/error_log.log'; // Error log file location within the project folder

  // Format error message with additional information
  $error_message = "[" . date("Y-m-d H:i:s") . "] Error [$errno]: $errstr in $errfile on line $errline" . PHP_EOL;

  // Attempt to open the error log file in append mode, creating it if it doesn't exist
  $file_handle = fopen($errorLog, 'a');
  if ($file_handle !== false) {
    // Write error message to the log file
    fwrite($file_handle, $error_message);
    // Close the file handle
    fclose($file_handle);
  }

  // Save error message in session
  $_SESSION['error_message'] = $error_message;

  // Redirect user back to the same page only if there is no error
  if (!isset($_SESSION['error_flag'])) {
    // Set error flag to prevent infinite redirection loop
    $_SESSION['error_flag'] = true;
    // Redirect user back to the same page
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit(); // Stop further execution
  }
}

function valid($conn, $value)
{
  $valid = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $value))));
  return $valid;
}

function separateAlphaNumeric($string)
{
  $alpha = "";
  $numeric = "";
  // Mengiterasi setiap karakter dalam string
  for ($i = 0; $i < strlen($string); $i++) {
    // Memeriksa apakah karakter adalah huruf
    if (ctype_alpha($string[$i])) {
      $alpha .= $string[$i];
    }
    // Memeriksa apakah karakter adalah angka
    if (ctype_digit($string[$i])) {
      $numeric .= $string[$i];
    }
  }
  // Mengembalikan array yang berisi huruf dan angka terpisah
  return array(
    "alpha" => $alpha,
    "numeric" => $numeric
  );
}

function generateToken()
{
  // Generate a random 6-digit number
  $token = mt_rand(100000, 999999);
  return $token;
}

function compressImage($source, $destination, $quality)
{
  // mendapatkan info image
  $imgInfo = getimagesize($source);
  $mime = $imgInfo['mime'];
  // membuat image baru
  switch ($mime) {
      // proses kode memilih tipe tipe image 
    case 'image/jpeg':
      $image = imagecreatefromjpeg($source);
      break;
    case 'image/png':
      $image = imagecreatefrompng($source);
      break;
    default:
      $image = imagecreatefromjpeg($source);
  }

  // Menyimpan image dengan ukuran yang baru
  imagejpeg($image, $destination, $quality);

  // Return image
  return $destination;
}

function kontak($conn, $data, $action, $pesan)
{
  if ($action == "insert") {
    $sql = "INSERT INTO kontak(username,email,phone,pesan) VALUES('$data[username]','$data[email]','$data[phone]','$pesan')";
  }

  if ($action == "delete") {
    $sql = "DELETE FROM kontak WHERE id_kontak='$data[id_kontak]'";
  }

  mysqli_query($conn, $sql);
  return mysqli_affected_rows($conn);
}

if (!isset($_SESSION["project_sistem_informasi_desa"]["users"])) {
  function register($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkEmail = "SELECT * FROM users WHERE email='$data[email]'";
      $checkEmail = mysqli_query($conn, $checkEmail);
      if (mysqli_num_rows($checkEmail) > 0) {
        $message = "Maaf, email yang anda masukan sudah terdaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        if ($data['password'] !== $data['re_password']) {
          $message = "Maaf, konfirmasi password yang anda masukan belum sama.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        } else {
          $checkIDAkun = "SELECT * FROM users ORDER BY id_user DESC LIMIT 1";
          $takeIDAkun = mysqli_query($conn, $checkIDAkun);
          if (mysqli_num_rows($takeIDAkun) > 0) {
            $data_akun = mysqli_fetch_assoc($takeIDAkun);
            $id_user = $data_akun['id_user'] + 1;
          } else {
            $id_user = 1;
          }
          $password = password_hash($data['password'], PASSWORD_DEFAULT);
          $token = generateToken();
          $en_user = password_hash($token, PASSWORD_DEFAULT);
          $en_user = str_replace("$", "", $en_user);
          $en_user = str_replace("/", "", $en_user);
          $en_user = str_replace(".", "", $en_user);
          require_once("mail.php");
          $to       = $data['email'];
          $subject  = "Account Verification - Sistem Informasi Desa";
          $message  = "<!doctype html>
          <html>
            <head>
                <meta name='viewport' content='width=device-width'>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                <title>Account Verification</title>
                <style>
                    @media only screen and (max-width: 620px) {
                        table[class='body'] h1 {
                            font-size: 28px !important;
                            margin-bottom: 10px !important;}
                        table[class='body'] p,
                        table[class='body'] ul,
                        table[class='body'] ol,
                        table[class='body'] td,
                        table[class='body'] span,
                        table[class='body'] a {
                            font-size: 16px !important;}
                        table[class='body'] .wrapper,
                        table[class='body'] .article {
                            padding: 10px !important;}
                        table[class='body'] .content {
                            padding: 0 !important;}
                        table[class='body'] .container {
                            padding: 0 !important;
                            width: 100% !important;}
                        table[class='body'] .main {
                            border-left-width: 0 !important;
                            border-radius: 0 !important;
                            border-right-width: 0 !important;}
                        table[class='body'] .btn table {
                            width: 100% !important;}
                        table[class='body'] .btn a {
                            width: 100% !important;}
                        table[class='body'] .img-responsive {
                            height: auto !important;
                            max-width: 100% !important;
                            width: auto !important;}}
                    @media all {
                        .ExternalClass {
                            width: 100%;}
                        .ExternalClass,
                        .ExternalClass p,
                        .ExternalClass span,
                        .ExternalClass font,
                        .ExternalClass td,
                        .ExternalClass div {
                            line-height: 100%;}
                        .apple-link a {
                            color: inherit !important;
                            font-family: inherit !important;
                            font-size: inherit !important;
                            font-weight: inherit !important;
                            line-height: inherit !important;
                            text-decoration: none !important;
                        .btn-primary table td:hover {
                            background-color: #d5075d !important;}
                        .btn-primary a:hover {
                            background-color: #000 !important;
                            border-color: #000 !important;
                            color: #fff !important;}}
                </style>
            </head>
            <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
                <tr>
                    <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                    <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                    <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
            
                        <!-- START CENTERED WHITE CONTAINER -->
                        <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
            
                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                            <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                                <tr>
                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $data['name'] . ",</p>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Selamat akun kamu sudah terdaftar, tinggal satu langkah lagi kamu sudah bisa menggunakan akun. Silakan salin kode token dibawah ini untuk memverifikasi akun kamu.</p>
                                    <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                    <tbody>
                                        <tr>
                                        <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                            <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                            <tbody>
                                                <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>" . $token . "</td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah mendaftar di Sistem Informasi Desa.</p>
                                    <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                                </td>
                                </tr>
                            </table>
                            </td>
                        </tr>
            
                        <!-- END MAIN CONTENT AREA -->
                        </table>
                        
                        <!-- START FOOTER -->
                        <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                        <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                            <tr>
                            <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                                <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                            </td>
                            </tr>
                            <tr>
                            <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                                Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                            </td>
                            </tr>
                        </table>
                        </div>
                        <!-- END FOOTER -->
            
                    <!-- END CENTERED WHITE CONTAINER -->
                    </div>
                    </td>
                    <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                </tr>
                </table>
            </body>
          </html>";
          smtp_mail($to, $subject, $message, "", "", 0, 0, true);
          $_SESSION['data_auth'] = ['en_user' => $en_user];
          $sql_account = "INSERT INTO users(id_user,en_user,token,name,email,password) VALUES('$id_user','$en_user','$token','$data[name]','$data[email]','$password')";
          mysqli_query($conn, $sql_account);
          if (isset($data['obj'])) {
            if ($data['obj'] == "Domisili") {
              if ($data['pekerjaan_p2'] == "Lainnya") {
                $pekerjaan_p2 = $data['pekerjaan_p2_other'];
              } else {
                $pekerjaan_p2 = $data['pekerjaan_p2'];
              }
              $sql_suket = "INSERT INTO suket_domisili(id_user,id_desa,nama_p2,tempat_lahir_p2,tgl_lahir_p2,jk_p2,alamat_p2,agama_p2,pekerjaan_p2,sejak_tgl_p2,tgl_surat_p2,ket_p2,email) VALUES('$id_user','$data[id_desa]','$data[nama_p2]','$data[tempat_lahir_p2]','$data[tgl_lahir_p2]','$data[jk_p2]','$data[alamat_p2]','$data[agama_p2]','$pekerjaan_p2','$data[sejak_tgl_p2]','$data[tgl_surat_p2]','$data[ket_p2]','$data[email]')";
              mysqli_query($conn, $sql_suket);
            } else if ($data['obj'] == "Kelahiran") {
              if (empty($data['pekerjaan_ayah'])) {
                $pekerjaan_ayah = "";
              } else if ($data['pekerjaan_ayah'] == "Lainnya") {
                $pekerjaan_ayah = $data['pekerjaan_ayah_other'];
              } else {
                $pekerjaan_ayah = $data['pekerjaan_ayah'];
              }
              if (empty($data['pekerjaan_ibu'])) {
                $pekerjaan_ibu = "";
              } else if ($data['pekerjaan_ibu'] == "Lainnya") {
                $pekerjaan_ibu = $data['pekerjaan_ibu_other'];
              } else {
                $pekerjaan_ibu = $data['pekerjaan_ibu'];
              }
              if (empty($data['alamat_ayah'])) {
                $alamat_ayah = "";
              } else {
                $alamat_ayah = $data['alamat_ayah'];
              }
              if (empty($data['alamat_ibu'])) {
                $alamat_ibu = "";
              } else {
                $alamat_ibu = $data['alamat_ibu'];
              }
              $sql_suket = "INSERT INTO suket_kelahiran(id_user,id_desa,nama_p2,jk_p2,tempat_lahir_p2,tgl_lahir_p2,alamat_p2,anak_ke_p2,nama_ayah,umur_ayah,alamat_ayah,pekerjaan_ayah,nama_ibu,umur_ibu,alamat_ibu,pekerjaan_ibu,email) VALUES('$id_user','$data[id_desa]','$data[no_surat]','$data[nama_p1]','$data[jabatan_p1]','$data[alamat_p1]','$data[nama_p2]','$data[jk_p2]','$data[tempat_lahir_p2]','$data[tgl_lahir_p2]','$data[alamat_p2]','$data[anak_ke_p2]','$data[nama_ayah]','$data[umur_ayah]','$alamat_ayah','$pekerjaan_ayah','$data[nama_ibu]','$data[umur_ibu]','$alamat_ibu','$pekerjaan_ibu','$data[email]')";
              mysqli_query($conn, $sql_suket);
            } else if ($data['obj'] == "Kematian") {
              if ($data['pekerjaan_p2'] == "Lainnya") {
                $pekerjaan_p2 = $data['pekerjaan_p2_other'];
              } else {
                $pekerjaan_p2 = $data['pekerjaan_p2'];
              }
              $sql_suket = "INSERT INTO suket_kematian(id_user,id_desa,id_desa_kematian,nama_p2,tempat_lahir_p2,tgl_lahir_p2,alamat_p2,tgl_kematian,waktu_kematian,pekerjaan_p2,email) VALUES('$id_user','$data[id_desa]','$data[id_desa_kematian]','$data[nama_p2]','$data[tempat_lahir_p2]','$data[tgl_lahir_p2]','$data[jk_p2]','$data[alamat_p2]','$data[tgl_kematian]','$data[waktu_kematian]','$pekerjaan_p2','$data[email]')";
              mysqli_query($conn, $sql_suket);
            } else if ($data['obj'] == "Belum Memiliki KK") {
              if ($data['pekerjaan_p2'] == "Lainnya") {
                $pekerjaan_p2 = $data['pekerjaan_p2_other'];
              } else {
                $pekerjaan_p2 = $data['pekerjaan_p2'];
              }
              $sql_suket = "INSERT INTO suket_non_kk(id_user,id_desa,nama_p2,jk_p2,tempat_lahir_p2,tgl_lahir_p2,pekerjaan_p2,agama_p2,kewarganegaraan,alamat_p2,email) VALUES('$id_user','$data[id_desa]','$data[nama_p2]','$data[jk_p2]','$data[tempat_lahir_p2]','$data[tgl_lahir_p2]','$pekerjaan_p2','$data[agama_p2]','$data[kewarganegaraan]','$data[alamat_p2]','$data[email]')";
              mysqli_query($conn, $sql_suket);
            } else if ($data['obj'] == "Tidak Mampu") {
              if ($data['pekerjaan_ayah'] == "Lainnya") {
                $pekerjaan_ayah = $data['pekerjaan_ayah_other'];
              } else {
                $pekerjaan_ayah = $data['pekerjaan_ayah'];
              }
              if ($data['pekerjaan_ibu'] == "Lainnya") {
                $pekerjaan_ibu = $data['pekerjaan_ibu_other'];
              } else {
                $pekerjaan_ibu = $data['pekerjaan_ibu'];
              }
              if ($data['pekerjaan_anak'] == "Lainnya") {
                $pekerjaan_anak = $data['pekerjaan_anak_other'];
              } else {
                $pekerjaan_anak = $data['pekerjaan_anak'];
              }
              $sql_suket = "INSERT INTO suket_tidak_mampu(id_user,id_desa,nama_ayah,umur_ayah,alamat_ayah,pekerjaan_ayah,agama_ayah,nama_ibu,umur_ibu,alamat_ibu,pekerjaan_ibu,agama_ibu,nama_anak,tempat_lahir_anak,tgl_lahir_anak,nik_anak,no_kk_anak,jk_anak,umur_anak,alamat_anak,pekerjaan_anak,agama_anak,email) VALUES('$id_user','$data[id_desa]','$data[nama_ayah]','$data[umur_ayah]','$data[alamat_ayah]','$pekerjaan_ayah','$data[agama_ayah]','$data[nama_ibu]','$data[umur_ibu]','$data[alamat_ibu]','$pekerjaan_ibu','$data[agama_ibu]','$data[nama_anak]','$data[tempat_lahir_anak]','$data[tgl_lahir_anak]','$data[nik_anak]','$data[no_kk_anak]','$data[jk_anak]','$data[umur_anak]','$data[alamat_anak]','$pekerjaan_anak','$data[agama_anak]','$data[email]')";
              mysqli_query($conn, $sql_suket);
            } else if ($data['obj'] == "Usaha") {
              if ($data['pekerjaan_p2'] == "Lainnya") {
                $pekerjaan_p2 = $data['pekerjaan_p2_other'];
              } else {
                $pekerjaan_p2 = $data['pekerjaan_p2'];
              }
              $sql_suket = "INSERT INTO suket_usaha(id_user,id_desa,id_rt,nama_p2,tempat_lahir_p2,tgl_lahir_p2,alamat_p2,agama_p2,pekerjaan_p2,ket_p2,email) VALUES('$id_user','$data[id_desa]','$data[id_rt]','$data[nama_p2]','$data[tempat_lahir_p2]','$data[tgl_lahir_p2]','$data[alamat_p2]','$data[agama_p2]','$pekerjaan_p2','$data[ket_p2]','$data[email]')";
              mysqli_query($conn, $sql_suket);
            }
          }
        }
      }
    }

    return mysqli_affected_rows($conn);
  }

  function re_verifikasi($conn, $data, $action)
  {
    if ($action == "update") {
      $checkEN = "SELECT * FROM users WHERE en_user='$data[en_user]'";
      $checkEN = mysqli_query($conn, $checkEN);
      if (mysqli_num_rows($checkEN) == 0) {
        $message = "Maaf, sepertinya ada kesalahan saat mendaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else if (mysqli_num_rows($checkEN) > 0) {
        $row = mysqli_fetch_assoc($checkEN);
        $name = $row['name'];
        $email = $row['email'];
        $token = generateToken();
        $reen_user = password_hash($token, PASSWORD_DEFAULT);
        $reen_user = str_replace("$", "", $reen_user);
        $reen_user = str_replace("/", "", $reen_user);
        $reen_user = str_replace(".", "", $reen_user);
        require_once("mail.php");
        $to       = $email;
        $subject  = "Account Verification - Sistem Informasi Desa";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Account Verification</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $name . ",</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Selamat akun kamu sudah terdaftar, tinggal satu langkah lagi kamu sudah bisa menggunakan akun. Silakan salin kode token dibawah ini untuk memverifikasi akun kamu.</p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                          <tbody>
                                              <tr>
                                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>" . $token . "</td>
                                              </tr>
                                          </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah mendaftar di Sistem Informasi Desa.</p>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
        $_SESSION['data_auth'] = ['en_user' => $reen_user];
        $sql = "UPDATE users SET en_user='$reen_user', token='$token', updated_at=current_timestamp WHERE en_user='$data[en_user]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function verifikasi($conn, $data, $action)
  {
    if ($action == "update") {
      $checkEN = "SELECT * FROM users WHERE en_user='$data[en_user]'";
      $checkEN = mysqli_query($conn, $checkEN);
      if (mysqli_num_rows($checkEN) == 0) {
        $message = "Maaf, sepertinya ada kesalahan saat mendaftar.";
        $message_type = "warning";
        alert($message, $message_type);
        return false;
      } else if (mysqli_num_rows($checkEN) > 0) {
        $row = mysqli_fetch_assoc($checkEN);
        $token_primary = $row['token'];
        $updated_at = strtotime($row['updated_at']);
        $current_time = time();
        if (($current_time - $updated_at) > (5 * 60)) {
          $message = "Maaf, waktu untuk verifikasi telah habis.";
          $message_type = "warning";
          alert($message, $message_type);
          $_SESSION["project_sistem_informasi_desa"] = [
            "message-warning" => "Maaf, waktu untuk verifikasi telah habis.",
            "time-message" => time()
          ];
          return false;
        }
        if ($data['token'] !== $token_primary) {
          $message = "Maaf, kode token yang anda masukan masih salah.";
          $message_type = "warning";
          alert($message, $message_type);
          return false;
        }
        $sql = "UPDATE users SET id_active='1', updated_at=current_timestamp WHERE en_user='$data[en_user]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function forgot_password($conn, $data, $action, $baseURL)
  {
    if ($action == "update") {
      $checkEmail = "SELECT * FROM users WHERE email='$data[email]'";
      $checkEmail = mysqli_query($conn, $checkEmail);
      if (mysqli_num_rows($checkEmail) === 0) {
        $message = "Maaf, email yang anda masukan belum terdaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $row = mysqli_fetch_assoc($checkEmail);
        $name = valid($conn, $row['name']);
        $token = generateToken();
        $en_user = password_hash($token, PASSWORD_DEFAULT);
        $en_user = str_replace("$", "", $en_user);
        $en_user = str_replace("/", "", $en_user);
        $en_user = str_replace(".", "", $en_user);
        require_once("mail.php");
        $to       = $data['email'];
        $subject  = "Reset password - Sistem Informasi Desa";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Reset password</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $name . ",</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Pesan ini secara otomatis dikirimkan kepada anda karena anda meminta untuk mereset kata sandi. Jika anda tidak sama sekali ingin mereset atau bukan anda yang ingin mereset abaikan saja. Klik tombol reset berikut untuk melanjutkan:</p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                          <tbody>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center;' valign='top' bgcolor='#ffffff' align='center'>
                                                  <a href='" . $baseURL . "auth/new-password?en=" . $en_user . "' target='_blank' style='background-color: #ffffff; border: solid 1px #000; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; border-color: #000; color: #000;'>Atur Ulang Kata Sandi</a> 
                                                </td>
                                              </tr>
                                          </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
        $sql = "UPDATE users SET en_user='$en_user', token='$token', updated_at=current_timestamp WHERE email='$data[email]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function new_password($conn, $data, $action)
  {
    if ($action == "update") {
      $lenght = strlen($data['password']);
      if ($lenght < 8) {
        $message = "Maaf, password yang anda masukan harus 8 digit atau lebih.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else if ($data['password'] !== $data['re_password']) {
        $message = "Maaf, konfirmasi password yang anda masukan belum sama.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password='$password' WHERE email='$data[email]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function login($conn, $data)
  {
    // check account
    $checkAccount = mysqli_query($conn, "SELECT * FROM users JOIN user_role ON users.id_role=user_role.id_role WHERE users.email='$data[email]'");
    if (mysqli_num_rows($checkAccount) == 0) {
      $message = "Maaf, akun yang anda masukan belum terdaftar.";
      $message_type = "danger";
      alert($message, $message_type);
      return false;
    } else if (mysqli_num_rows($checkAccount) > 0) {
      $row = mysqli_fetch_assoc($checkAccount);
      if (password_verify($data['password'], $row["password"])) {
        $_SESSION["project_sistem_informasi_desa"]["users"] = [
          "id" => $row["id_user"],
          "id_role" => $row["id_role"],
          "role" => $row["role"],
          "email" => $row["email"],
          "name" => $row["name"],
          "image" => $row["image"]
        ];
        return mysqli_affected_rows($conn);
      } else {
        $message = "Maaf, kata sandi yang anda masukan salah.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
    }
  }
}

if (isset($_SESSION["project_sistem_informasi_desa"]["users"])) {

  function profil($conn, $data, $action, $id_user)
  {
    if ($action == "update") {
      $path = "../assets/img/profil/";
      if (!empty($_FILES['image']["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["image"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $image = $fileName_encrypt . "." . $ekstensiGambar;
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      if (!empty($_FILES['image']["name"])) {
        $unwanted_characters = "../assets/img/profil/";
        $remove_image = str_replace($unwanted_characters, "", $data['imageOld']);
        if ($remove_image != "default.svg") {
          unlink($path . $remove_image);
        }
      } else if (empty($_FILE['image']["name"])) {
        $image = $data['imageOld'];
      }
      if (!empty($data['password'])) {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET name='$data[name]', image='$image', password='$password' WHERE id_user='$id_user'";
      } else {
        $sql = "UPDATE users SET name='$data[name]', image='$image' WHERE id_user='$id_user'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function setting($conn, $data, $action)
  {

    if ($action == "update") {
      $path = "../assets/img/auth/";
      if (!empty($_FILES['image']["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["image"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $image = $fileName_encrypt . "." . $ekstensiGambar;
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      if (!empty($_FILES['image']["name"])) {
        $unwanted_characters = "../assets/img/auth/";
        $remove_image = str_replace($unwanted_characters, "", $data['imageOld']);
        unlink($path . $remove_image);
      } else if (empty($_FILE['image']["name"])) {
        $image = $data['imageOld'];
      }
      $sql = "UPDATE auth SET image='$image', bg='$data[bg]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function users($conn, $data, $action)
  {

    if ($action == "update") {
      $sql = "UPDATE users SET id_role='$data[id_role]', id_active='$data[id_active]' WHERE id_user='$data[id_user]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function role($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkRole = "SELECT * FROM user_role WHERE role LIKE '%$data[role]%'";
      $checkRole = mysqli_query($conn, $checkRole);
      if (mysqli_num_rows($checkRole) > 0) {
        $message = "Maaf, role yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $sql = "INSERT INTO user_role(role) VALUES('$data[role]')";
      }
    }

    if ($action == "update") {
      if ($data['role'] !== $data['roleOld']) {
        $checkRole = "SELECT * FROM user_role WHERE role LIKE '%$data[role]%'";
        $checkRole = mysqli_query($conn, $checkRole);
        if (mysqli_num_rows($checkRole) > 0) {
          $message = "Maaf, role yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE user_role SET role='$data[role]' WHERE id_role='$data[id_role]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_role WHERE id_role='$data[id_role]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function menu($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkMenu = "SELECT * FROM user_menu WHERE menu='$data[menu]'";
      $checkMenu = mysqli_query($conn, $checkMenu);
      if (mysqli_num_rows($checkMenu) > 0) {
        $message = "Maaf, menu yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $sql = "INSERT INTO user_menu(menu) VALUES('$data[menu]')";
      }
    }

    if ($action == "update") {
      if ($data['menu'] !== $data['menuOld']) {
        $checkMenu = "SELECT * FROM user_menu WHERE menu='$data[menu]'";
        $checkMenu = mysqli_query($conn, $checkMenu);
        if (mysqli_num_rows($checkMenu) > 0) {
          $message = "Maaf, menu yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE user_menu SET menu='$data[menu]' WHERE id_menu='$data[id_menu]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_menu WHERE id_menu='$data[id_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function sub_menu($conn, $data, $action, $baseURL)
  {
    $url = strtolower($data['title']);
    $url = str_replace(" ", "-", $url);

    if ($action == "insert") {
      $checkSubMenu = "SELECT * FROM user_sub_menu WHERE title='$data[title]'";
      $checkSubMenu = mysqli_query($conn, $checkSubMenu);
      if (mysqli_num_rows($checkSubMenu) > 0) {
        $message = "Maaf, nama sub menu yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $file = fopen("../views/" . $url . ".php", "w");
        fwrite($file, '<?php require_once("../controller/script.php");
        $_SESSION["project_sistem_informasi_desa"]["name_page"] = "' . $data['title'] . '";
        require_once("../templates/views_top.php"); ?>
        
        <!-- Begin Page Content -->
        <div class="container-fluid">
        
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_sistem_informasi_desa"]["name_page"] ?></h1>
          </div>
        
          <!-- Mulai buatlah lembar kerja anda disini! -->
        
        </div>
        <!-- /.container-fluid -->
        
        <?php require_once("../templates/views_bottom.php") ?>
        ');
        fclose($file);
        $sql = "INSERT INTO user_sub_menu(id_menu,id_active,title,url,icon) VALUES('$data[id_menu]','$data[id_active]','$data[title]','$url','$data[icon]')";
      }
    }

    if ($action == "update") {
      if ($data['title'] !== $data['titleOld']) {
        $checkSubMenu = "SELECT * FROM user_sub_menu WHERE title='$data[title]'";
        $checkSubMenu = mysqli_query($conn, $checkSubMenu);
        if (mysqli_num_rows($checkSubMenu) > 0) {
          $message = "Maaf, nama sub menu yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE user_sub_menu SET id_menu='$data[id_menu]', id_active='$data[id_active]', title='$data[title]', url='$url', icon='$data[icon]' WHERE id_sub_menu='$data[id_sub_menu]'";
    }

    if ($action == "delete") {
      unlink("../views/" . $url . ".php");
      $sql = "DELETE FROM user_sub_menu WHERE id_sub_menu='$data[id_sub_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function menu_access($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO user_access_menu(id_role,id_menu) VALUES('$data[id_role]','$data[id_menu]')";
    }

    if ($action == "update") {
      $sql = "UPDATE user_access_menu SET id_role='$data[id_role]', id_menu='$data[id_menu]' WHERE id_access_menu='$data[id_access_menu]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_access_menu WHERE id_access_menu='$data[id_access_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function sub_menu_access($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO user_access_sub_menu(id_role,id_sub_menu) VALUES('$data[id_role]','$data[id_sub_menu]')";
    }

    if ($action == "update") {
      $sql = "UPDATE user_access_sub_menu SET id_role='$data[id_role]', id_sub_menu='$data[id_sub_menu]' WHERE id_access_sub_menu='$data[id_access_sub_menu]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_access_sub_menu WHERE id_access_sub_menu='$data[id_access_sub_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  // ==> Struktur Pemerintahan
  function provinsi($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO provinsi(provinsi) VALUES('$data[provinsi]')";
    }

    if ($action == "update") {
      $sql = "UPDATE provinsi SET provinsi='$data[provinsi]' WHERE id_provinsi='$data[id_provinsi]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM provinsi WHERE id_provinsi='$data[id_provinsi]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function kabupaten($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO kabupaten(id_provinsi,kabupaten) VALUES('$data[id_provinsi]','$data[kabupaten]')";
    }

    if ($action == "update") {
      $sql = "UPDATE kabupaten SET id_provinsi='$data[id_provinsi]', kabupaten='$data[kabupaten]' WHERE id_kabupaten='$data[id_kabupaten]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM kabupaten WHERE id_kabupaten='$data[id_kabupaten]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function kecamatan($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO kecamatan(id_kabupaten,kecamatan) VALUES('$data[id_kabupaten]','$data[kecamatan]')";
    }

    if ($action == "update") {
      $sql = "UPDATE kecamatan SET id_kabupaten='$data[id_kabupaten]', kecamatan='$data[kecamatan]' WHERE id_kecamatan='$data[id_kecamatan]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM kecamatan WHERE id_kecamatan='$data[id_kecamatan]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function desa($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO desa(id_kecamatan,desa) VALUES('$data[id_kecamatan]','$data[desa]')";
    }

    if ($action == "update") {
      $sql = "UPDATE desa SET id_kecamatan='$data[id_kecamatan]', desa='$data[desa]' WHERE id_desa='$data[id_desa]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM desa WHERE id_desa='$data[id_desa]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function rw($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO rw(id_desa,rw) VALUES('$data[id_desa]','$data[rw]')";
    }

    if ($action == "update") {
      $sql = "UPDATE rw SET id_desa='$data[id_desa]', rw='$data[rw]' WHERE id_rw='$data[id_rw]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM rw WHERE id_rw='$data[id_rw]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function rt($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO rt(id_rw,rt) VALUES('$data[id_rw]','$data[rt]')";
    }

    if ($action == "update") {
      $sql = "UPDATE rt SET id_rw='$data[id_rw]', rt='$data[rt]' WHERE id_rt='$data[id_rt]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM rt WHERE id_rt='$data[id_rt]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  // ==> Surat Keterangan
  function domisili($conn, $data, $action, $id_user, $id_role)
  {
    if ($action == "insert") {
      if ($data['pekerjaan_p2'] == "Lainnya") {
        $pekerjaan_p2 = $data['pekerjaan_p2_other'];
      } else {
        $pekerjaan_p2 = $data['pekerjaan_p2'];
      }
      $sql = "INSERT INTO suket_domisili(id_user,id_desa,nama_p2,tempat_lahir_p2,tgl_lahir_p2,jk_p2,alamat_p2,agama_p2,pekerjaan_p2,sejak_tgl_p2,tgl_surat_p2,ket_p2,email) VALUES('$id_user','$data[id_desa]','$data[nama_p2]','$data[tempat_lahir_p2]','$data[tgl_lahir_p2]','$data[jk_p2]','$data[alamat_p2]','$data[agama_p2]','$pekerjaan_p2','$data[sejak_tgl_p2]','$data[tgl_surat_p2]','$data[ket_p2]','$data[email]')";
    }

    if ($action == "update") {
      if ($id_role == 1) {
        if ($data['no_surat'] != $data['no_suratOld']) {
          $take_suket_domisili = "SELECT * FROM suket_domisili WHERE no_surat='$data[no_surat]'";
          $check_suket_domisili = mysqli_query($conn, $take_suket_domisili);
          if (mysqli_num_rows($check_suket_domisili) > 0) {
            $message = "Nomor surat domisili yang anda masukan sudah ada.";
            $message_type = "danger";
            alert($message, $message_type);
            return false;
          }
        }
      }
      if ($data['pekerjaan_p2'] == "Lainnya") {
        $pekerjaan_p2 = $data['pekerjaan_p2_other'];
      } else {
        $pekerjaan_p2 = $data['pekerjaan_p2'];
      }
      if (!empty($data['no_surat'])) {
        require_once("mail.php");
        $to       = $data['email'];
        $subject  = "Surat Keterangan - PELAYANAN KEPENDUDKAN DESA DELO, KEC. SABU BARAT, KAB. SABU RAIJUA";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Surat Keterangan - PELAYANAN KEPENDUDKAN
              DESA DELO, KEC. SABU BARAT, KAB. SABU RAIJUA</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $data['nama_p2'] . ",</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Kami ingin memberitahukan bahwa surat keterangan domisili anda telah berhasil atau selesai dibuat. Anda sudah bisa mengambil surat keterangan domisili dengan ringkasan data sebagai berikut : </p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                          <tbody>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>No. Surat</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['no_surat'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Nama</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['nama_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>TTL</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['tempat_lahir_p2'] . ", " . $data['tgl_lahir_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Jenis Kelamin</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['jk_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Alamat</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['alamat_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Agama</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['agama_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Pekerjaan</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $pekerjaan_p2 . "</td>
                                              </tr>
                                          </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah menggunakan Sistem Pelayanan Kependudukan Desa Delo.</p>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
      }
      $sql = "UPDATE suket_domisili SET id_desa='$data[id_desa]', no_surat='$data[no_surat]', nama_p1='$data[nama_p1]', jabatan_p1='$data[jabatan_p1]', jk_p1='$data[jk_p1]', alamat_p1='$data[alamat_p1]', nama_p2='$data[nama_p2]', tempat_lahir_p2='$data[tempat_lahir_p2]', tgl_lahir_p2='$data[tgl_lahir_p2]', jk_p2='$data[jk_p2]', alamat_p2='$data[alamat_p2]', agama_p2='$data[agama_p2]', pekerjaan_p2='$pekerjaan_p2', sejak_tgl_p2='$data[sejak_tgl_p2]', ket_p2='$data[ket_p2]' WHERE id_suket_domisili='$data[id_suket_domisili]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM suket_domisili WHERE id_suket_domisili='$data[id_suket_domisili]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function kelahiran($conn, $data, $action, $id_user, $id_role)
  {
    if ($action == "insert" || $action == "update") {
      if (empty($data['pekerjaan_ayah'])) {
        $pekerjaan_ayah = "";
      } else if ($data['pekerjaan_ayah'] == "Lainnya") {
        $pekerjaan_ayah = $data['pekerjaan_ayah_other'];
      } else {
        $pekerjaan_ayah = $data['pekerjaan_ayah'];
      }
      if (empty($data['pekerjaan_ibu'])) {
        $pekerjaan_ibu = "";
      } else if ($data['pekerjaan_ibu'] == "Lainnya") {
        $pekerjaan_ibu = $data['pekerjaan_ibu_other'];
      } else {
        $pekerjaan_ibu = $data['pekerjaan_ibu'];
      }
      if (empty($data['alamat_ayah'])) {
        $alamat_ayah = "";
      } else {
        $alamat_ayah = $data['alamat_ayah'];
      }
      if (empty($data['alamat_ibu'])) {
        $alamat_ibu = "";
      } else {
        $alamat_ibu = $data['alamat_ibu'];
      }
    }

    if ($action == "insert") {
      $sql = "INSERT INTO suket_kelahiran(id_user,id_desa,nama_p2,jk_p2,tempat_lahir_p2,tgl_lahir_p2,alamat_p2,anak_ke_p2,nama_ayah,umur_ayah,alamat_ayah,pekerjaan_ayah,nama_ibu,umur_ibu,alamat_ibu,pekerjaan_ibu,email) VALUES('$id_user','$data[id_desa]','$data[nama_p2]','$data[jk_p2]','$data[tempat_lahir_p2]','$data[tgl_lahir_p2]','$data[alamat_p2]','$data[anak_ke_p2]','$data[nama_ayah]','$data[umur_ayah]','$alamat_ayah','$pekerjaan_ayah','$data[nama_ibu]','$data[umur_ibu]','$alamat_ibu','$pekerjaan_ibu','$data[email]')";
    }

    if ($action == "update") {
      if ($id_role == 1) {
        if ($data['no_surat'] != $data['no_suratOld']) {
          $take_suket_kelahiran = "SELECT * FROM suket_kelahiran WHERE no_surat='$data[no_surat]'";
          $check_suket_kelahiran = mysqli_query($conn, $take_suket_kelahiran);
          if (mysqli_num_rows($check_suket_kelahiran) > 0) {
            $message = "Nomor surat kelahiran yang anda masukan sudah ada.";
            $message_type = "danger";
            alert($message, $message_type);
            return false;
          }
        }
      }
      if (!empty($data['no_surat'])) {
        require_once("mail.php");
        $to       = $data['email'];
        $subject  = "Surat Keterangan - PELAYANAN KEPENDUDKAN DESA DELO, KEC. SABU BARAT, KAB. SABU RAIJUA";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Surat Keterangan - PELAYANAN KEPENDUDKAN
              DESA DELO, KEC. SABU BARAT, KAB. SABU RAIJUA</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $data['nama_p2'] . ",</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Kami ingin memberitahukan bahwa surat keterangan kelahiran anda telah berhasil atau selesai dibuat. Anda sudah bisa mengambil surat keterangan kelahiran dengan ringkasan data sebagai berikut : </p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                          <tbody>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>No. Surat</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['no_surat'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Nama</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['nama_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Jenis Kelamin</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['jk_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>TTL</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['tempat_lahir_p2'] . ", " . $data['tgl_lahir_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Alamat</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['alamat_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Anak ke</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['anak_ke_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Nama Ayah</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['nama_ayah'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Nama Ibu</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['nama_ibu'] . "</td>
                                              </tr>
                                          </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah menggunakan Sistem Pelayanan Kependudukan Desa Delo.</p>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
      }
      $sql = "UPDATE suket_kelahiran SET id_desa='$data[id_desa]', no_surat='$data[no_surat]', nama_p1='$data[nama_p1]', jabatan_p1='$data[jabatan_p1]', alamat_p1='$data[alamat_p1]', nama_p2='$data[nama_p2]', jk_p2='$data[jk_p2]', tempat_lahir_p2='$data[tempat_lahir_p2]', tgl_lahir_p2='$data[tgl_lahir_p2]', alamat_p2='$data[alamat_p2]', anak_ke_p2='$data[anak_ke_p2]', nama_ayah='$data[nama_ayah]', umur_ayah='$data[umur_ayah]', alamat_ayah='$alamat_ayah', pekerjaan_ayah='$pekerjaan_ayah', nama_ibu='$data[nama_ibu]', umur_ibu='$data[umur_ibu]', alamat_ibu='$alamat_ibu', pekerjaan_ibu='$pekerjaan_ibu' WHERE id_suket_kelahiran='$data[id_suket_kelahiran]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM suket_kelahiran WHERE id_suket_kelahiran='$data[id_suket_kelahiran]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function kematian($conn, $data, $action, $id_user, $id_role)
  {
    if ($action == "insert" || $action == "update") {
      if ($data['pekerjaan_p2'] == "Lainnya") {
        $pekerjaan_p2 = $data['pekerjaan_p2_other'];
      } else {
        $pekerjaan_p2 = $data['pekerjaan_p2'];
      }
    }

    if ($action == "insert") {
      $sql = "INSERT INTO suket_kematian(id_user,id_desa,id_desa_kematian,nama_p2,tempat_lahir_p2,tgl_lahir_p2,jk_p2,alamat_p2,agama_p2,tgl_kematian,waktu_kematian,pekerjaan_p2,email) VALUES('$id_user','$data[id_desa]','$data[id_desa_kematian]','$data[nama_p2]','$data[tempat_lahir_p2]','$data[tgl_lahir_p2]','$data[jk_p2]','$data[alamat_p2]','$data[agama_p2]','$data[tgl_kematian]','$data[waktu_kematian]','$pekerjaan_p2','$data[email]')";
    }

    if ($action == "update") {
      if ($id_role == 1) {
        if ($data['no_surat'] != $data['no_suratOld']) {
          $take_suket_kematian = "SELECT * FROM suket_kematian WHERE no_surat='$data[no_surat]'";
          $check_suket_kematian = mysqli_query($conn, $take_suket_kematian);
          if (mysqli_num_rows($check_suket_kematian) > 0) {
            $message = "Nomor surat kematian yang anda masukan sudah ada.";
            $message_type = "danger";
            alert($message, $message_type);
            return false;
          }
        }
      }
      if (!empty($data['no_surat'])) {
        require_once("mail.php");
        $to       = $data['email'];
        $subject  = "Surat Keterangan - PELAYANAN KEPENDUDKAN DESA DELO, KEC. SABU BARAT, KAB. SABU RAIJUA";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Surat Keterangan - PELAYANAN KEPENDUDKAN
              DESA DELO, KEC. SABU BARAT, KAB. SABU RAIJUA</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi,</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Kami ingin memberitahukan bahwa surat keterangan Kematian anda telah berhasil atau selesai dibuat. Anda sudah bisa mengambil surat keterangan Kematian dengan ringkasan data sebagai berikut : </p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                            <tbody>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>No. Surat</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['no_surat'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Nama</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['nama_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>TTL</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['tempat_lahir_p2'] . ", " . $data['tgl_lahir_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Jenis Kelamin</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['jk_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Alamat</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['alamat_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Agama</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['agama_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Tgl Kematian</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['tgl_kematian'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Waktu</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['waktu_kematian'] . "</td>
                                              </tr>
                                            </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah menggunakan Sistem Pelayanan Kependudukan Desa Delo.</p>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
      }
      $sql = "UPDATE suket_kematian SET id_desa='$data[id_desa]', id_desa_kematian='$data[id_desa_kematian]', no_surat='$data[no_surat]', nama_p1='$data[nama_p1]', jabatan_p1='$data[jabatan_p1]', alamat_p1='$data[alamat_p1]', nama_p2='$data[nama_p2]', tempat_lahir_p2='$data[tempat_lahir_p2]', tgl_lahir_p2='$data[tgl_lahir_p2]', jk_p2='$data[jk_p2]', alamat_p2='$data[alamat_p2]', agama_p2='$data[agama_p2]', tgl_kematian='$data[tgl_kematian]', waktu_kematian='$data[waktu_kematian]', pekerjaan_p2='$pekerjaan_p2' WHERE id_suket_kematian='$data[id_suket_kematian]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM suket_kematian WHERE id_suket_kematian='$data[id_suket_kematian]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function non_kk($conn, $data, $action, $id_user, $id_role)
  {
    if ($action == "insert" || $action == "update") {
      if ($data['pekerjaan_p2'] == "Lainnya") {
        $pekerjaan_p2 = $data['pekerjaan_p2_other'];
      } else {
        $pekerjaan_p2 = $data['pekerjaan_p2'];
      }
    }

    if ($action == "insert") {
      $sql = "INSERT INTO suket_non_kk(id_user,id_desa,nama_p2,jk_p2,tempat_lahir_p2,tgl_lahir_p2,pekerjaan_p2,agama_p2,kewarganegaraan,alamat_p2,email) VALUES('$id_user','$data[id_desa]','$data[nama_p2]','$data[jk_p2]','$data[tempat_lahir_p2]','$data[tgl_lahir_p2]','$pekerjaan_p2','$data[agama_p2]','$data[kewarganegaraan]','$data[alamat_p2]','$data[email]')";
    }

    if ($action == "update") {
      if ($id_role == 1) {
        if ($data['no_surat'] != $data['no_suratOld']) {
          $take_suket_kematian = "SELECT * FROM suket_kematian WHERE no_surat='$data[no_surat]'";
          $check_suket_kematian = mysqli_query($conn, $take_suket_kematian);
          if (mysqli_num_rows($check_suket_kematian) > 0) {
            $message = "Nomor surat kematian yang anda masukan sudah ada.";
            $message_type = "danger";
            alert($message, $message_type);
            return false;
          }
        }
      }
      if (!empty($data['no_surat'])) {
        require_once("mail.php");
        $to       = $data['email'];
        $subject  = "Surat Keterangan - PELAYANAN KEPENDUDKAN DESA DELO, KEC. SABU BARAT, KAB. SABU RAIJUA";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Surat Keterangan - PELAYANAN KEPENDUDKAN
              DESA DELO, KEC. SABU BARAT, KAB. SABU RAIJUA</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi,</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Kami ingin memberitahukan bahwa surat keterangan belum memiliki KK anda telah berhasil atau selesai dibuat. Anda sudah bisa mengambil surat keterangan belum memiliki KK dengan ringkasan data sebagai berikut : </p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                            <tbody>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>No. Surat</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['no_surat'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Nama</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['nama_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Jenis Kelamin</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['jk_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>TTL</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['tempat_lahir_p2'] . ", " . $data['tgl_lahir_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Pekerjaan</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $pekerjaan_p2 . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Agama</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['agama_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Kewarganegaraan</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['kewarganegaraan'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Alamat</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['alamat_p2'] . "</td>
                                              </tr>
                                            </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah menggunakan Sistem Pelayanan Kependudukan Desa Delo.</p>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
      }
      $sql = "UPDATE suket_non_kk SET id_desa='$data[id_desa]', no_surat='$data[no_surat]', nama_p1='$data[nama_p1]', jabatan_p1='$data[jabatan_p1]', alamat_p1='$data[alamat_p1]', nama_p2='$data[nama_p2]', jk_p2='$data[jk_p2]', tempat_lahir_p2='$data[tempat_lahir_p2]', tgl_lahir_p2='$data[tgl_lahir_p2]', pekerjaan_p2='$pekerjaan_p2', agama_p2='$data[agama_p2]', kewarganegaraan='$data[kewarganegaraan]', alamat_p2='$data[alamat_p2]' WHERE id_suket_non_kk='$data[id_suket_non_kk]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM suket_non_kk WHERE id_suket_non_kk='$data[id_suket_non_kk]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function tidak_mampu($conn, $data, $action, $id_user, $id_role)
  {
    if ($action == "insert" || $action == "update") {
      if ($data['pekerjaan_ayah'] == "Lainnya") {
        $pekerjaan_ayah = $data['pekerjaan_ayah_other'];
      } else {
        $pekerjaan_ayah = $data['pekerjaan_ayah'];
      }
      if ($data['pekerjaan_ibu'] == "Lainnya") {
        $pekerjaan_ibu = $data['pekerjaan_ibu_other'];
      } else {
        $pekerjaan_ibu = $data['pekerjaan_ibu'];
      }
      if ($data['pekerjaan_anak'] == "Lainnya") {
        $pekerjaan_anak = $data['pekerjaan_anak_other'];
      } else {
        $pekerjaan_anak = $data['pekerjaan_anak'];
      }
    }

    if ($action == "insert") {
      $sql = "INSERT INTO suket_tidak_mampu(id_user,id_desa,nama_ayah,umur_ayah,alamat_ayah,pekerjaan_ayah,agama_ayah,nama_ibu,umur_ibu,alamat_ibu,pekerjaan_ibu,agama_ibu,nama_anak,tempat_lahir_anak,tgl_lahir_anak,nik_anak,no_kk_anak,jk_anak,umur_anak,alamat_anak,pekerjaan_anak,agama_anak,email) VALUES('$id_user','$data[id_desa]','$data[nama_ayah]','$data[umur_ayah]','$data[alamat_ayah]','$pekerjaan_ayah','$data[agama_ayah]','$data[nama_ibu]','$data[umur_ibu]','$data[alamat_ibu]','$pekerjaan_ibu','$data[agama_ibu]','$data[nama_anak]','$data[tempat_lahir_anak]','$data[tgl_lahir_anak]','$data[nik_anak]','$data[no_kk_anak]','$data[jk_anak]','$data[umur_anak]','$data[alamat_anak]','$pekerjaan_anak','$data[agama_anak]','$data[email]')";
    }

    if ($action == "update") {
      if ($id_role == 1) {
        if ($data['no_surat'] != $data['no_suratOld']) {
          $take_suket_kematian = "SELECT * FROM suket_kematian WHERE no_surat='$data[no_surat]'";
          $check_suket_kematian = mysqli_query($conn, $take_suket_kematian);
          if (mysqli_num_rows($check_suket_kematian) > 0) {
            $message = "Nomor surat kematian yang anda masukan sudah ada.";
            $message_type = "danger";
            alert($message, $message_type);
            return false;
          }
        }
      }
      if (!empty($data['no_surat'])) {
        require_once("mail.php");
        $to       = $data['email'];
        $subject  = "Surat Keterangan - PELAYANAN KEPENDUDKAN DESA DELO, KEC. SABU BARAT, KAB. SABU RAIJUA";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Surat Keterangan - PELAYANAN KEPENDUDKAN
              DESA DELO, KEC. SABU BARAT, KAB. SABU RAIJUA</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi,</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Kami ingin memberitahukan bahwa surat keterangan tidak mampu anda telah berhasil atau selesai dibuat. Anda sudah bisa mengambil surat keterangan tidak mampu dengan ringkasan data sebagai berikut : </p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                            <tbody>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>No. Surat</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['no_surat'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Nama Ayah</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['nama_ayah'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Umur Ayah</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['umur_ayah'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Pekerjaan Ayah</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['pekerjaan_ayah'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Nama Ibu</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['nama_ibu'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Umur Ibu</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['umur_ibu'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Pekerjaan Ibu</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['pekerjaan_ibu'] . "</td>
                                              </tr>
                                              <hr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>No. Kartu Keluarga</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['no_kk_anak'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>No. Induk Kependudukan</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['nik_anak'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Nama Anak</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['nama_anak'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>TTL</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['tempat_lahir_anak'] . ", " . $data['tgl_lahir_anak'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Jenis Kelamin</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['jk_anak'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Agama</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['agama_anak'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Alamat</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['alamat_anak'] . "</td>
                                              </tr>
                                            </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah menggunakan Sistem Pelayanan Kependudukan Desa Delo.</p>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
      }
      $sql = "UPDATE suket_tidak_mampu SET id_desa='$data[id_desa]', no_surat='$data[no_surat]', nama_p1='$data[nama_p1]', jabatan_p1='$data[jabatan_p1]', alamat_p1='$data[alamat_p1]', nama_ayah='$data[nama_ayah]', umur_ayah='$data[umur_ayah]', alamat_ayah='$data[alamat_ayah]', pekerjaan_ayah='$pekerjaan_ayah', agama_ayah='$data[agama_ayah]', nama_ibu='$data[nama_ibu]', umur_ibu='$data[umur_ibu]', alamat_ibu='$data[alamat_ibu]', pekerjaan_ibu='$pekerjaan_ibu', agama_ibu='$data[agama_ibu]', nama_anak='$data[nama_anak]', tempat_lahir_anak='$data[tempat_lahir_anak]', tgl_lahir_anak='$data[tgl_lahir_anak]', nik_anak='$data[nik_anak]', no_kk_anak='$data[no_kk_anak]', jk_anak='$data[jk_anak]', umur_anak='$data[umur_anak]', alamat_anak='$data[alamat_anak]', pekerjaan_anak='$pekerjaan_anak', agama_anak='$data[agama_anak]' WHERE id_suket_tidak_mampu='$data[id_suket_tidak_mampu]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM suket_tidak_mampu WHERE id_suket_tidak_mampu='$data[id_suket_tidak_mampu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function usaha($conn, $data, $action, $id_user, $id_role)
  {
    if ($action == "insert" || $action == "update") {
      if ($data['pekerjaan_p2'] == "Lainnya") {
        $pekerjaan_p2 = $data['pekerjaan_p2_other'];
      } else {
        $pekerjaan_p2 = $data['pekerjaan_p2'];
      }
    }

    if ($action == "insert") {
      $sql = "INSERT INTO suket_usaha(id_user,id_desa,id_rt,nama_p2,tempat_lahir_p2,tgl_lahir_p2,alamat_p2,agama_p2,pekerjaan_p2,ket_p2,email) VALUES('$id_user','$data[id_desa]','$data[id_rt]','$data[nama_p2]','$data[tempat_lahir_p2]','$data[tgl_lahir_p2]','$data[alamat_p2]','$data[agama_p2]','$pekerjaan_p2','$data[ket_p2]','$data[email]')";
    }

    if ($action == "update") {
      if ($id_role == 1) {
        if ($data['no_surat'] != $data['no_suratOld']) {
          $take_suket_kematian = "SELECT * FROM suket_kematian WHERE no_surat='$data[no_surat]'";
          $check_suket_kematian = mysqli_query($conn, $take_suket_kematian);
          if (mysqli_num_rows($check_suket_kematian) > 0) {
            $message = "Nomor surat kematian yang anda masukan sudah ada.";
            $message_type = "danger";
            alert($message, $message_type);
            return false;
          }
        }
      }
      if (!empty($data['no_surat'])) {
        require_once("mail.php");
        $to       = $data['email'];
        $subject  = "Surat Keterangan - PELAYANAN KEPENDUDKAN DESA DELO, KEC. SABU BARAT, KAB. SABU RAIJUA";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Surat Keterangan - PELAYANAN KEPENDUDKAN
              DESA DELO, KEC. SABU BARAT, KAB. SABU RAIJUA</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi,</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Kami ingin memberitahukan bahwa surat keterangan usaha anda telah berhasil atau selesai dibuat. Anda sudah bisa mengambil surat keterangan usaha dengan ringkasan data sebagai berikut : </p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                            <tbody>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>No. Surat</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['no_surat'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Nama</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['nama_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>TTL</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['tempat_lahir_p2'] . ", " . $data['tgl_lahir_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Alamat</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['alamat_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Agama</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['agama_p2'] . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Pekerjaan</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $pekerjaan_p2 . "</td>
                                              </tr>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;width: 200px;' valign='top' bgcolor='#ffffff' align='center'>Keterangan Usaha</td>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: left; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>: " . $data['ket_p2'] . "</td>
                                              </tr>
                                            </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah menggunakan Sistem Pelayanan Kependudukan Desa Delo.</p>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
      }
      $sql = "UPDATE suket_usaha SET id_desa='$data[id_desa]', id_rt='$data[id_rt]', no_surat='$data[no_surat]', nama_p1='$data[nama_p1]', jabatan_p1='$data[jabatan_p1]', alamat_p1='$data[alamat_p1]', nama_p2='$data[nama_p2]', tempat_lahir_p2='$data[tempat_lahir_p2]', tgl_lahir_p2='$data[tgl_lahir_p2]', alamat_p2='$data[alamat_p2]', agama_p2='$data[agama_p2]', pekerjaan_p2='$pekerjaan_p2', ket_p2='$data[ket_p2]' WHERE id_suket_usaha='$data[id_suket_usaha]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM suket_usaha WHERE id_suket_usaha='$data[id_suket_usaha]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function visi($conn, $data, $action)
  {
    if ($action == "update") {
      $sql = "UPDATE visi SET visi='$data[visi]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function misi($conn, $data, $action)
  {
    if ($action == "update") {
      $sql = "UPDATE misi SET misi='$data[misi]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function __name($conn, $data, $action)
  {
    if ($action == "insert") {
    }

    if ($action == "update") {
    }

    if ($action == "delete") {
    }

    // mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }
}
