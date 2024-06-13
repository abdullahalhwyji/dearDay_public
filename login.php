<?php
session_start();
include_once('connection.php');

$error = '';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) && empty($password)) {
        $error = 'Please Fill Username and Password';
    } elseif (empty($password)) {
        $error = 'Please Fill Password';
    } elseif (empty($username)) {
        $error = 'Please Fill Username';
    } else {
        $password = md5($password);
        $sql = "SELECT * FROM `tbl_user` WHERE `username`='$username' AND `password`='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $name = $row['name'];
            $username = $row['username'];
            $password = $row['password'];

            $_SESSION['name'] = $name;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header('location: interface/interface.php');
            exit;
        } else {
            $error = 'Invalid Username or Password';
        }
    }

    if (!empty($error)) {
        header('location:index.php?error=' . urlencode($error));
        exit;
    }
}
?>
