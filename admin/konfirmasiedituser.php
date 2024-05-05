<?php

session_start();
include('../koneksi/koneksi.php');
if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    //get foto 
    $sql = "select `foto` from `user` where `id_user` = '$id_user'";
    $query = mysqli_query($koneksi, $sql);
    while ($data = mysqli_fetch_row($query)) {
        $foto = $data[0];
    }

    if (empty($nama)) {
        header("Location:edituser.php?notif=editkosong&jenis=nama");
    } else if (empty($email)) {
        header("Location:edituser.php?notif=editkosong&jenis=email");
    } else if (empty($username)) {
        header("Location:edituser.php?notif=editkosong&jenis=username");
    } else if (empty($password)) {
        header("Location:edituser.php?notif=editkosong&jenis=password");
    } else if (empty($level)) {
        header("Location:edituser.php?notif=editkosong&jenis=level");
    } else {
        $lokasi_file = $_FILES['foto']['tmp_name'];
        $nama_file = $_FILES['foto']['name'];
        $direktori = 'foto/' . $nama_file;
        if (move_uploaded_file($lokasi_file, $direktori)) {
            if (!empty($foto)) {
                unlink("foto/$foto");
            }
            $sql_f = "update `user` set `nama` = '$nama', `email` = '$email', `username` = '$username', `password` = '$password', `level` = '$level', `foto` = '$nama_file' where `id_user` = '$id_user'";
            mysqli_query($koneksi, $sql_f);
        } else {
            $sql_f = "update `user` set `nama` = '$nama', `email` = '$email', `username` = '$username', `password` = '$password', `level` = '$level' where `id_user` = '$id_user'";
            mysqli_query($koneksi, $sql_f);
        }
        header("Location:user.php?notif=editberhasil");
    }
}
