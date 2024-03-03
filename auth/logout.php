<?php if (!isset($_SESSION)) {
  session_start();
}
require_once("../controller/script.php");
if (isset($_SESSION["project_sistem_informasi_desa"])) {
  unset($_SESSION["project_sistem_informasi_desa"]);
  header("Location: ./");
  exit();
}
