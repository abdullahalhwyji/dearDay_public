<?php
include_once('../connection.php');

$sql = "SELECT city, COUNT(*) as count FROM tbl_user GROUP BY city";
$result = mysqli_query($conn, $sql);

$data = [];
while($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>
