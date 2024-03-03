<?php require_once("../controller/script.php");

require_once __DIR__ . '/../assets/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$id = valid($conn, $_GET['id']);
$suket_usaha = "SELECT suket_usaha.*, desa.desa, kecamatan.kecamatan, kabupaten.kabupaten, provinsi.provinsi 
  FROM suket_usaha 
  JOIN desa ON suket_usaha.id_desa=desa.id_desa
  JOIN kecamatan ON desa.id_kecamatan=kecamatan.id_kecamatan
  JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten
  JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi
  WHERE suket_usaha.id_suket_usaha='$id'
  ORDER BY suket_usaha.id_suket_usaha DESC
";
$views_suket_usaha = mysqli_query($conn, $suket_usaha);
$data = mysqli_fetch_assoc($views_suket_usaha);
$id_rt = valid($conn, $data['id_rt']);
$check_rt = "SELECT rt.*, rw.rw, desa.desa, kecamatan.kecamatan, kabupaten.kabupaten, provinsi.provinsi 
  FROM rt 
  JOIN rw ON rt.id_rw=rw.id_rw
  JOIN desa ON rw.id_desa=desa.id_desa
  JOIN kecamatan ON desa.id_kecamatan=kecamatan.id_kecamatan
  JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten
  JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi 
  WHERE rt.id_rt='$id_rt'
";
$take_rt = mysqli_query($conn, $check_rt);
$data_rt = mysqli_fetch_assoc($take_rt);
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
  <h4 style="text-align: center; text-decoration: underline;">SURAT KETERANGAN USAHA</h4>
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
    <tr>
  </table>
');

$mpdf->WriteHTML('
  <p style="text-indent: 2em; text-align: justify;">Adalah benar-benar warga Desa ' . $data['desa'] . ', Kecamatan ' . $data['kecamatan'] . ', Kabupaten ' . $data['kabupaten'] . ', dan berdasarkan pengamatan   kami  memang benar yang bersangkutan mempunyai usaha dalam hal ini ' . $data['ket_p2'] . ' yang berlokasi di RT ' . $data_rt['rt'] . '/RW ' . $data_rt['rw'] . ', Desa ' . $data_rt['desa'] . ', Kecamatan ' . $data_rt['kecamatan'] . '.</p>
  <p style="text-indent: 2em; text-align: justify;">Demikian Surat Keterangan ini dibuat dengan sebenar-benarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
');

$mpdf->WriteHTML('
  <div style="width: 300px; margin-top: 20px; float: right; text-align: right;">
    <p style="text-align: center;">' . $data['desa'] . ', ' . $tgl_surat . '</p>
    <p style="text-align: center; padding-top: -15px;">' . $data['jabatan_p1'] . '</p>
    <h4 style="padding-top: 50px; text-decoration: underline; text-align: center;">' . $data['nama_p1'] . '</h4>
  </div>
');

$mpdf->Output();
