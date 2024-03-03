<?php require_once("../controller/script.php");

require_once __DIR__ . '/../assets/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$id = valid($conn, $_GET['id']);
$suket_tidak_mampu = "SELECT suket_tidak_mampu.*, desa.desa, kecamatan.kecamatan, kabupaten.kabupaten, provinsi.provinsi 
  FROM suket_tidak_mampu 
  JOIN desa ON suket_tidak_mampu.id_desa=desa.id_desa
  JOIN kecamatan ON desa.id_kecamatan=kecamatan.id_kecamatan
  JOIN kabupaten ON kecamatan.id_kabupaten=kabupaten.id_kabupaten
  JOIN provinsi ON kabupaten.id_provinsi=provinsi.id_provinsi
  WHERE suket_tidak_mampu.id_suket_tidak_mampu='$id'
  ORDER BY suket_tidak_mampu.id_suket_tidak_mampu DESC
";
$views_suket_tidak_mampu = mysqli_query($conn, $suket_tidak_mampu);
$data = mysqli_fetch_assoc($views_suket_tidak_mampu);
$tgl_lahir_anak = date_create($data["tgl_lahir_anak"]);
$tgl_lahir_anak = date_format($tgl_lahir_anak, "d M Y");
$ttl = $data['tempat_lahir_anak'] . ", " . $tgl_lahir_anak;
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
  <h4 style="text-align: center; text-decoration: underline;">SURAT KETERANGAN TIDAK MAMPU</h4>
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
  <p style="font-weight: bold;">Nama Orang Tua</p>
  <table style="width:100%;">
    <tr>
      <td style="width: 10px; font-weight: bold;">1.</td>
      <td style="width: 150px; font-weight: bold;">Ayah</td>
      <td style="width: 10px; font-weight: bold;">:</td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td>Nama</td>
      <td>:</td>
      <td>' . $data['nama_ayah'] . '</td>
    </tr>
    <tr>
      <td></td>
      <td>Umur</td>
      <td>:</td>
      <td>' . $data['umur_ayah'] . ' tahun</td>
    </tr>
    <tr>
      <td></td>
      <td>Alamat</td>
      <td>:</td>
      <td>' . $data['alamat_ayah'] . '</td>
    </tr>
    <tr>
      <td></td>
      <td>Pekerjaan</td>
      <td>:</td>
      <td>' . $data['pekerjaan_ayah'] . '</td>
    </tr>
    <tr>
      <td></td>
      <td>Agama</td>
      <td>:</td>
      <td>' . $data['agama_ayah'] . '</td>
    </tr>
    <tr>
      <td style="width: 10px; font-weight: bold;">2.</td>
      <td style="width: 150px; font-weight: bold;">Ibu</td>
      <td style="width: 10px; font-weight: bold;">:</td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td>Nama</td>
      <td>:</td>
      <td>' . $data['nama_ibu'] . '</td>
    </tr>
    <tr>
      <td></td>
      <td>Umur</td>
      <td>:</td>
      <td>' . $data['umur_ibu'] . ' tahun</td>
    </tr>
    <tr>
      <td></td>
      <td>Alamat</td>
      <td>:</td>
      <td>' . $data['alamat_ibu'] . '</td>
    </tr>
    <tr>
      <td></td>
      <td>Pekerjaan</td>
      <td>:</td>
      <td>' . $data['pekerjaan_ibu'] . '</td>
    </tr>
    <tr>
      <td></td>
      <td>Agama</td>
      <td>:</td>
      <td>' . $data['agama_ibu'] . '</td>
    </tr>
    <tr>
      <td style="width: 10px; font-weight: bold;">3.</td>
      <td style="width: 150px; font-weight: bold;">Nama Anak</td>
      <td style="width: 10px; font-weight: bold;">:</td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td>Nama</td>
      <td>:</td>
      <td>' . $data['nama_anak'] . '</td>
    </tr>
    <tr>
      <td></td>
      <td>Tgl lahir</td>
      <td>:</td>
      <td>' . $ttl . '</td>
    </tr>
    <tr>
      <td></td>
      <td>NIK</td>
      <td>:</td>
      <td>' . $data['nik_anak'] . '</td>
    </tr>
    <tr>
      <td></td>
      <td>No Kartu Keluarga</td>
      <td>:</td>
      <td>' . $data['no_kk_anak'] . '</td>
    </tr>
    <tr>
      <td></td>
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td>' . $data['jk_anak'] . '</td>
    </tr>
    <tr>
      <td></td>
      <td>Umur</td>
      <td>:</td>
      <td>' . $data['umur_anak'] . ' tahun</td>
    </tr>
    <tr>
      <td></td>
      <td>Alamat</td>
      <td>:</td>
      <td>' . $data['alamat_anak'] . '</td>
    </tr>
    <tr>
      <td></td>
      <td>Pekerjaan</td>
      <td>:</td>
      <td>' . $data['pekerjaan_anak'] . '</td>
    </tr>
    <tr>
      <td></td>
      <td>Agama</td>
      <td>:</td>
      <td>' . $data['agama_anak'] . '</td>
    </tr>
  </table>
');

$mpdf->WriteHTML('
  <p style="text-indent: 2em; text-align: justify;">Menerangkan dengan sebenarnya bahwa  menurut pengamatan kami Pihak Pemerintah Desa bahwa Keluarga ini termasuk  Keluarga yang Tidak Mampu dalam menunjang kebutuhan ekonomi.</p>
  <p style="text-indent: 2em; text-align: justify;">Demikian surat keterangan ini dibuat dengan sebenarnya dan dapat dipergunakan sebagaimana mestinya.</p>
');

$mpdf->WriteHTML('
  <div style="width: 300px; margin-top: 20px; float: right; text-align: right;">
    <p style="text-align: center;">' . $data['desa'] . ', ' . $tgl_surat . '</p>
    <p style="text-align: center; padding-top: -15px;">An. ' . $data['jabatan_p1'] . '</p>
    <h4 style="padding-top: 50px; text-decoration: underline; text-align: center;">' . $data['nama_p1'] . '</h4>
  </div>
');

$mpdf->Output();
