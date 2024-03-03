<?php require_once("../controller/script.php");

require_once __DIR__ . '/../assets/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$id = valid($conn, $_GET['id']);
$suket_domisili = "SELECT suket_domisili.*, desa.desa, kecamatan.kecamatan, kabupaten.kabupaten, provinsi.provinsi 
  FROM suket_domisili 
  JOIN desa ON suket_domisili.id_desa=desa.id_desa
  JOIN kecamatan ON desa.id_kecamatan=kecamatan.id_kecamatan
  JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten
  JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi
  WHERE suket_domisili.id_suket_domisili='$id'
  ORDER BY suket_domisili.id_suket_domisili DESC
";
$views_suket_domisili = mysqli_query($conn, $suket_domisili);
$data = mysqli_fetch_assoc($views_suket_domisili);
$tgl_lahir_p2 = date_create($data["tgl_lahir_p2"]);
$tgl_lahir_p2 = date_format($tgl_lahir_p2, "d M Y");
$ttl = $data['tempat_lahir_p2'] . ", " . $tgl_lahir_p2;
$sejak_tgl_p2 = date_create($data["sejak_tgl_p2"]);
$sejak_tgl_p2 = date_format($sejak_tgl_p2, "d M Y");
$tgl_surat_p2 = date_create($data["tgl_surat_p2"]);
$tgl_surat_p2 = date_format($tgl_surat_p2, "d M Y");

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
  <h4 style="text-align: center; text-decoration: underline;">SURAT KETERANGAN BERDOMISILI</h4>
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
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td>' . $data['jk_p1'] . '</td>
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
  <p style="text-indent: 2em; text-align: justify;">Yang bersangkutan benar-benar warga masyarakat yang berdomisili di Desa ' . $data['desa'] . ' Kecamatan ' . $data['kecamatan'] . ' Kabupaten ' . $data['kabupaten'] . ' sejak tanggal ' . $sejak_tgl_p2 . ' dan pada hari ini tanggal ' . $tgl_surat_p2 . ' akan ' . $data['ket_p2'] . '.</p>
  <p style="text-indent: 2em; text-align: justify;">Demikian surat keterangan ini dibuat atas dasar yang sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
');

$mpdf->WriteHTML('
  <div style="width: 300px; margin-top: 20px; float: right; text-align: right;">
    <p style="text-align: center;">' . $data['desa'] . ', ' . $tgl_surat_p2 . '</p>
    <p style="text-align: center; padding-top: -15px;">An. Kepala Desa ' . $data['desa'] . '</p>
    <p style="text-align: center; padding-top: -15px;">' . $data['jabatan_p1'] . '</p>
    <h4 style="padding-top: 50px; text-decoration: underline; text-align: center;">' . $data['nama_p1'] . '</h4>
  </div>
');

$mpdf->Output();
