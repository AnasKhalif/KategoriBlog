<?php

include('../koneksi/koneksi.php');
$nama = $_POST['nama'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];

if (empty($nama)) {
    header("Location:tambahuser.php?notif=tambahkosong&jenis=nama");
} else if (empty($email)) {
    header("Location:tambahuser.php?notif=tambahkosong&jenis=email");
} else if (empty($username)) {
    header("Location:tambahuser.php?notif=tambahkosong&jenis=username");
} else if (empty($password)) {
    header("Location:tambahuser.php?notif=tambahkosong&jenis=password");
} else if (empty($jurusan)) {
    header("Location:tambahuser.php?notif=tambahkosong&jenis=jurusan");
} else {
    $sql = "insert into `user` (`nama`,`email`, `username`, `password`, `level`)
	values ('$nama', '$email', '$username', '$password', '$level')";
    mysqli_query($koneksi, $sql);
    header("Location:user.php?notif=tambahberhasil");
}
