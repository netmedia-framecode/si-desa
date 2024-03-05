<?php require_once("controller/script.php"); ?>

<!DOCTYPE html>
<html>

<head>
  <?php require_once("sections/head.php"); ?>
</head>

<body>
  <?php foreach ($messageTypes as $type) {
    if (isset($_SESSION["project_sistem_informasi_desa"]["message_$type"])) {
      echo "<div class='message-$type' data-message-$type='{$_SESSION["project_sistem_informasi_desa"]["message_$type"]}'></div>";
    }
  } ?>

  <div class="hero_area">
    <header class="header_section long_section px-0">
      <?php require_once("sections/navbar.php"); ?>
    </header>