<?php
include_once('connection.php');

$error = '';

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];
    $birth_date = $_POST['birth_date'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];

    $checkUserQuery = "SELECT * FROM `tbl_user` WHERE `username` = '$username'";
    $checkUserResult = mysqli_query($conn, $checkUserQuery);

    if(mysqli_num_rows($checkUserResult) > 0) {
        $error = 'User Already Exist';
    } elseif ($password !== $repeat_password) {
        $error = 'Passwords do not match';
    } elseif (empty($name)) {
        $error = 'Please Fill Name';
    } elseif (empty($username)) {
        $error = 'Please Fill Email';
    } elseif (empty($password)) {
        $error = 'Please Fill Password';
    } elseif (empty($birth_date)) {
        $error = 'Please Choose Birth Date';
    } elseif (empty($city)) {
        $error = 'Please Choose City';
    } elseif (empty($gender)) {
        $error = 'Please Choose Gender';
    } else {
        $password = md5($password);

        $sql = "INSERT INTO `tbl_user` (`name`, `username`, `password`, `birth_date`, `city`, `gender`) VALUES ('$name', '$username', '$password', '$birth_date', '$city', '$gender')";

        if (mysqli_query($conn, $sql)) {
            header('location:index.php');
            exit;
        } else {
            $error = 'Error: ' . mysqli_error($conn);
        }
    }

    if (!empty($error)) {
        header('location:register.php?error=' . urlencode($error));
        exit;
    }
}
?>
