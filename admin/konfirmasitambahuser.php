<?php

include('../koneksi/koneksi.php');
$nama = $_POST['nama'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];
$foto = $_POST['foto'];

if (empty($nama)) {
    header("Location:tambahuser.php?notif=tambahkosong&jenis=nama");
} else if (empty($email)) {
    header("Location:tambahuser.php?notif=tambahkosong&jenis=email");
} else if (empty($username)) {
    header("Location:tambahuser.php?notif=tambahkosong&jenis=username");
} else if (empty($password)) {
    header("Location:tambahuser.php?notif=tambahkosong&jenis=password");
} else if (empty($level)) {
    header("Location:tambahuser.php?notif=tambahkosong&jenis=level");
} else {

    $allowed_extension = array('png', 'jpg');
    $lokasi_file = $_FILES['foto']['tmp_name'];
    $nama_file = $_FILES['foto']['name'];
    $direktori = 'foto/' . $nama_file;
    if (move_uploaded_file($lokasi_file, $direktori)) {
        $sql = "insert into `user` (`nama`,`email`, `username`, `password`, `level`, `foto`)
	    values ('$nama', '$email', '$username', '$password', '$level', '$nama_file')";

        //echo $sql;
        mysqli_query($koneksi, $sql);
    }
    header("Location:user.php?notif=tambahberhasil");
}
