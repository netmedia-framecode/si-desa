<?php require_once("../controller/script.php");

require_once __DIR__ . '/../assets/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$id = valid($conn, $_GET['id']);
$suket_kematian = "SELECT suket_kematian.*, desa.desa, kecamatan.kecamatan, kabupaten.kabupaten, provinsi.provinsi 
  FROM suket_kematian 
  JOIN desa ON suket_kematian.id_desa=desa.id_desa
  JOIN kecamatan ON desa.id_kecamatan=kecamatan.id_kecamatan
  JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten
  JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi
  WHERE suket_kematian.id_suket_kematian='$id'
  ORDER BY suket_kematian.id_suket_kematian DESC
";
$views_suket_kematian = mysqli_query($conn, $suket_kematian);
$data = mysqli_fetch_assoc($views_suket_kematian);
$id_desa_kematian = valid($conn, $data['id_desa_kematian']);
$desa_kematian = "SELECT desa.*, kecamatan.kecamatan, kabupaten.kabupaten, provinsi.provinsi 
  FROM desa 
  JOIN kecamatan ON desa.id_kecamatan=kecamatan.id_kecamatan
  JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten
  JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi
  WHERE desa.id_desa='$id_desa_kematian'
";
$views_desa_kematian = mysqli_query($conn, $desa_kematian);
$data_desa_kematian = mysqli_fetch_assoc($views_desa_kematian);
$tgl_lahir_p2 = date_create($data["tgl_lahir_p2"]);
$tgl_lahir_p2 = date_format($tgl_lahir_p2, "d M Y");
$ttl = $data['tempat_lahir_p2'] . ", " . $tgl_lahir_p2;
$tgl_kematian = date_create($data["tgl_kematian"]);
setlocale(LC_TIME, 'id_ID'); // Atur locale menjadi bahasa Indonesia
$tgl_kematian = strftime("%A, %d %B %Y", strtotime(date_format($tgl_kematian, "Y-m-d")));
$waktu_kematian = new DateTime($data['waktu_kematian']);
$waktu_kematian = $waktu_kematian->format("H:i");
$tgl_surat = date_create($data["created_at"]);
$tgl_surat = date_format($tgl_surat, "d M Y");

$mpdf->WriteHTML('
  <div style="border-bottom: 3px solid black;width: 100%;">
    <table border="0" style="width: 100%;">
      <tbody>
        <tr>
          <th style="text-align: center;">
            <img src="../assets/img/logo.png" alt="" style="width: 100px;height: 110px;">
          </th>
          <td style="text-align: center; line-height: 30px;">
            <h3 style="text-transform: uppercase;">PEMERINTAH KABUPATEN SABU RAIJUA<br>KECAMATAN SABU BARAT<br>DESA ' . $data['desa'] . '</h3>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
');

$mpdf->WriteHTML('
  <h4 style="text-align: center; text-decoration: underline;">SURAT KETERANGAN KEMATIAN</h4>
  <p style="text-align: center; padding-top: -15px;">NOMOR : ' . $data['no_surat'] . '</p>
');

$mpdf->WriteHTML('
  <p>Yang bertandatangan di bawah ini :</p>
  <table style="width:100%;">
    <tr>
      <td style="width: 150px;">Nama</td>
      <td style="width: 10px;">:</td>
      <td>' . $data['nama_p1'] . '</td>
    </tr>
    <tr>
      <td>Jabatan</td>
      <td>:</td>
      <td>' . $data['jabatan_p1'] . '</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td>' . $data['alamat_p1'] . '</td>
    </tr>
  </table>
  <p>Menerangkan dengan sebenarnya bahwa :</p>
  <table style="width:100%;">
    <tr>
      <td style="width: 150px;">Nama</td>
      <td style="width: 10px;">:</td>
      <td>' . $data['nama_p2'] . '</td>
    </tr>
    <tr>
      <td>Tempat dan Tanggal Lahir</td>
      <td>:</td>
      <td>' . $ttl . '</td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td>' . $data['jk_p2'] . '</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td>' . $data['alamat_p2'] . '</td>
    </tr>
    <tr>
      <td>Agama</td>
      <td>:</td>
      <td>' . $data['agama_p2'] . '</td>
    </tr>
    <tr>
      <td>Pekerjaan</td>
      <td>:</td>
      <td>' . $data['pekerjaan_p2'] . '</td>
    </tr>
  </table>
');

$mpdf->WriteHTML('
  <p style="text-indent: 2em; text-align: justify;">Adalah benar – benar warga Desa ' . $data['desa'] . ', Kecamatan ' . $data['kecamatan'] . ', dan telah Meninggal Dunia di Sabu Raijua, Desa ' . $data_desa_kematian['desa'] . ', Kecamatan ' . $data_desa_kematian['kecamatan'] . ', Kabupaten ' . $data_desa_kematian['kabupaten'] . ', pada hari ' . $tgl_kematian . ', Pukul ' . $waktu_kematian . ' Wita.</p>
  <p style="text-indent: 2em; text-align: justify;">Demikian surat keterangan kematian ini dibuat atas dasar yang sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
');

$mpdf->WriteHTML('
  <div style="width: 300px; margin-top: 20px; float: right; text-align: right;">
    <p style="text-align: center;">' . $data['desa'] . ', ' . $tgl_surat . '</p>
    <p style="text-align: center; padding-top: -15px;">' . $data['jabatan_p1'] . '</p>
    <h4 style="padding-top: 50px; text-decoration: underline; text-align: center;">' . $data['nama_p1'] . '</h4>
  </div>
');

$mpdf->Output();
