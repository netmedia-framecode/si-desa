<?php require_once("../controller/script.php");

require_once __DIR__ . '/../assets/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$id = valid($conn, $_GET['id']);
$suket_kelahiran = "SELECT suket_kelahiran.*, desa.desa, kecamatan.kecamatan, kabupaten.kabupaten, provinsi.provinsi 
  FROM suket_kelahiran 
  JOIN desa ON suket_kelahiran.id_desa=desa.id_desa
  JOIN kecamatan ON desa.id_kecamatan=kecamatan.id_kecamatan
  JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten
  JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi
  WHERE suket_kelahiran.id_suket_kelahiran='$id'
  ORDER BY suket_kelahiran.id_suket_kelahiran DESC
";
$views_suket_kelahiran = mysqli_query($conn, $suket_kelahiran);
$data = mysqli_fetch_assoc($views_suket_kelahiran);
$tgl_lahir_p2 = date_create($data["tgl_lahir_p2"]);
$tgl_lahir_p2 = date_format($tgl_lahir_p2, "d M Y");
$ttl = $data['tempat_lahir_p2'] . ", " . $tgl_lahir_p2;
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
  <h4 style="text-align: center; text-decoration: underline;">SURAT KETERANGAN KELAHIRAN</h4>
  <p style="text-align: center; padding-top: -15px;">NO : ' . $data['no_surat'] . '</p>
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
  <p>Menerangkan dengan sebenarnya bahwa telah lahir seorang anak :</p>
  <table style="width:100%;">
    <tr>
      <td style="width: 150px;">Nama</td>
      <td style="width: 10px;">:</td>
      <td>' . $data['nama_p2'] . '</td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td>' . $data['jk_p2'] . '</td>
    </tr>
    <tr>
      <td>Tempat Tanggal Lahir</td>
      <td>:</td>
      <td>' . $ttl . '</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td>' . $data['alamat_p2'] . '</td>
    </tr>
    <tr>
      <td>Anak yang ke</td>
      <td>:</td>
      <td>' . $data['anak_ke_p2'] . '</td>
    </tr>
  </table>
  <p>Yakni benar-benar anak dari pasangan Suami Isteri :</p>
  <table style="width:100%;">
    <tr>
      <td style="width: 150px;">Nama Ayah</td>
      <td style="width: 10px;">:</td>
      <td>' . $data['nama_ayah'] . '</td>
    </tr>
    <tr>
      <td>Umur</td>
      <td>:</td>
      <td>' . $data['umur_ayah'] . '</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td>' . $data['alamat_ayah'] . '</td>
    </tr>
    <tr>
      <td>Pekerjaan</td>
      <td>:</td>
      <td>' . $data['pekerjaan_ayah'] . '</td>
    </tr>
  </table>
  <table style="width:100%;">
    <tr>
      <td style="width: 150px;">Nama Ibu</td>
      <td style="width: 10px;">:</td>
      <td>' . $data['nama_ibu'] . '</td>
    </tr>
    <tr>
      <td>Umur</td>
      <td>:</td>
      <td>' . $data['umur_ibu'] . '</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td>' . $data['alamat_ibu'] . '</td>
    </tr>
    <tr>
      <td>Pekerjaan</td>
      <td>:</td>
      <td>' . $data['pekerjaan_ibu'] . '</td>
    </tr>
  </table>
');

$mpdf->WriteHTML('
  <p style="text-indent: 2em; text-align: justify;">Demikian Surat Keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
');

$mpdf->WriteHTML('
  <div style="width: 300px; float: right; text-align: right;">
    <p style="text-align: center;">' . $data['desa'] . ', ' . $tgl_surat . '</p>
    <p style="text-align: center; padding-top: -15px;">' . $data['jabatan_p1'] . ' ' . $data['desa'] . '</p>
    <h4 style="padding-top: 50px; text-decoration: underline; text-align: center;">' . $data['nama_p1'] . '</h4>
  </div>
');

$mpdf->Output();
