-- Active: 1709030200372@@127.0.0.1@3306@sistem_informasi_desa
CREATE TABLE provinsi(
  id_provinsi INT AUTO_INCREMENT PRIMARY KEY,
  provinsi VARCHAR(75),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE kabupaten(
  id_kabupaten INT AUTO_INCREMENT PRIMARY KEY,
  id_provinsi INT,
  kabupaten VARCHAR(75),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_provinsi) REFERENCES provinsi(id_provinsi) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE kecamatan(
  id_kecamatan INT AUTO_INCREMENT PRIMARY KEY,
  id_kabupaten INT,
  kecamatan VARCHAR(75),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_kabupaten) REFERENCES kabupaten(id_kabupaten) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE desa(
  id_desa INT AUTO_INCREMENT PRIMARY KEY,
  id_kecamatan INT,
  desa VARCHAR(75),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_kecamatan) REFERENCES kecamatan(id_kecamatan) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE rw(
  id_rw INT AUTO_INCREMENT PRIMARY KEY,
  id_desa INT,
  rw CHAR(10),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_desa) REFERENCES desa(id_desa) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE rt(
  id_rt INT AUTO_INCREMENT PRIMARY KEY,
  id_rw INT,
  rt CHAR(10),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_rw) REFERENCES rw(id_rw) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE suket_usaha(
  id_suket_usaha INT AUTO_INCREMENT PRIMARY KEY,
  id_desa INT,
  id_rt INT,
  id_user INT,
  no_surat VARCHAR(75),
  nama_p1 VARCHAR(75),
  jabatan_p1 VARCHAR(50),
  alamat_p1 VARCHAR(225),
  nama_p2 VARCHAR(75),
  tempat_lahir_p2 VARCHAR(50),
  tgl_lahir_p2 DATE,
  alamat_p2 VARCHAR(225),
  pekerjaan_p2 VARCHAR(50),
  ket_p2 TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_desa) REFERENCES desa(id_desa) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (id_rt) REFERENCES rt(id_rt) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (id_user) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE suket_tidak_mampu(
  id_suket_tidak_mampu INT AUTO_INCREMENT PRIMARY KEY,
  id_desa INT,
  id_user INT,
  no_surat VARCHAR(75),
  nama_p1 VARCHAR(75),
  jabatan_p1 VARCHAR(50),
  alamat_p1 VARCHAR(225),
  nama_ayah VARCHAR(75),
  umur_ayah INT,
  alamat_ayah VARCHAR(225),
  pekerjaan_ayah VARCHAR(50),
  agama_ayah VARCHAR(50),
  nama_ibu VARCHAR(75),
  umur_ibu INT,
  alamat_ibu VARCHAR(225),
  pekerjaan_ibu VARCHAR(50),
  agama_ibu VARCHAR(50),
  nama_anak VARCHAR(75),
  tempat_lahir_anak VARCHAR(50),
  tgl_lahir_anak DATE,
  nik_anak CHAR(20),
  no_kk_anak CHAR(20),
  jk_anak VARCHAR(35),
  umur_anak INT,
  alamat_anak VARCHAR(225),
  pekerjaan_anak VARCHAR(50),
  agama_anak VARCHAR(50),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_desa) REFERENCES desa(id_desa) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (id_user) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE suket_kematian(
  id_suket_kematian INT AUTO_INCREMENT PRIMARY KEY,
  id_desa INT,
  id_desa_kematian INT,
  id_user INT,
  no_surat VARCHAR(75),
  nama_p1 VARCHAR(75),
  jabatan_p1 VARCHAR(50),
  alamat_p1 VARCHAR(225),
  nama_p2 VARCHAR(75),
  tempat_lahir_p2 VARCHAR(35),
  tgl_lahir_p2 DATE,
  jk_p2 VARCHAR(35),
  alamat_p2 VARCHAR(225),
  agama_p2 VARCHAR(35),
  tgl_kematian DATE,
  waktu_kematian TIME,
  pekerjaan_p2 VARCHAR(50),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_desa) REFERENCES desa(id_desa) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (id_desa_kematian) REFERENCES desa(id_desa) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (id_user) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE suket_kelahiran(
  id_suket_kelahiran INT AUTO_INCREMENT PRIMARY KEY,
  id_desa INT,
  id_user INT,
  no_surat VARCHAR(75),
  nama_p1 VARCHAR(75),
  jabatan_p1 VARCHAR(50),
  alamat_p1 VARCHAR(225),
  nama_p2 VARCHAR(75),
  jk_p2 VARCHAR(35),
  tempat_lahir_p2 VARCHAR(35),
  tgl_lahir_p2 DATE,
  alamat_p2 VARCHAR(225),
  anak_ke_p2 INT,
  nama_ayah VARCHAR(75),
  umur_ayah INT,
  alamat_ayah VARCHAR(225),
  pekerjaan_ayah VARCHAR(50),
  nama_ibu VARCHAR(75),
  umur_ibu INT,
  alamat_ibu VARCHAR(225),
  pekerjaan_ibu VARCHAR(50),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_desa) REFERENCES desa(id_desa) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (id_user) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE suket_domisili(
  id_suket_domisili INT AUTO_INCREMENT PRIMARY KEY,
  id_desa INT,
  id_user INT,
  no_surat VARCHAR(75),
  nama_p1 VARCHAR(75),
  jabatan_p1 VARCHAR(50),
  jk_p1 VARCHAR(35),
  alamat_p1 VARCHAR(225),
  nama_p2 VARCHAR(75),
  tempat_lahir_p2 VARCHAR(35),
  tgl_lahir_p2 DATE,
  jk_p2 VARCHAR(35),
  alamat_p2 VARCHAR(225),
  agama_p2 VARCHAR(35),
  pekerjaan_p2 VARCHAR(50),
  sejak_tgl_p2 DATE,
  tgl_surat_p2 DATE DEFAULT CURRENT_TIMESTAMP,
  ket_p2 TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_desa) REFERENCES desa(id_desa) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (id_user) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE suket_non_kk(
  id_suket_non_kk INT AUTO_INCREMENT PRIMARY KEY,
  id_desa INT,
  id_user INT,
  no_surat VARCHAR(75),
  nama_p1 VARCHAR(75),
  jabatan_p1 VARCHAR(50),
  alamat_p1 VARCHAR(225),
  nama_p2 VARCHAR(75),
  jk_p2 VARCHAR(35),
  tempat_lahir_p2 VARCHAR(35),
  tgl_lahir_p2 DATE,
  pekerjaan_p2 VARCHAR(50),
  agama_p2 VARCHAR(35),
  kewarganegaraan VARCHAR(50),
  alamat_p2 VARCHAR(225),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_desa) REFERENCES desa(id_desa) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (id_user) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE kontak (
  id_kontak INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(75),
  email VARCHAR(50),
  phone CHAR(12),
  pesan TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE visi(
  id INT AUTO_INCREMENT PRIMARY KEY,
  visi TEXT
);

CREATE TABLE misi(
  id INT AUTO_INCREMENT PRIMARY KEY,
  misi TEXT
);