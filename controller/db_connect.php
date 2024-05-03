<?php
$conn=mysqli_connect("localhost","root","Netmedia040700_","sistem_informasi_desa");
// $conn=mysqli_connect("localhost","zjxtorpv_client","Netmedia040700_","zjxtorpv_100168");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
