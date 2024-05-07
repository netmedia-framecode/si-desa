<?php
$conn=mysqli_connect("localhost","root","Netmedia040700_","sistem_informasi_desa");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
