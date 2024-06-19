<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>User Information</h1>
    
    <!-- Filter Form -->
    <form method="GET" action="">
        <label for="gender">Filter by Gender:</label>
        <select name="gender" id="gender">
            <option value="">All</option>
            <option value="Male" <?php if (isset($_GET['gender']) && $_GET['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if (isset($_GET['gender']) && $_GET['gender'] == 'Female') echo 'selected'; ?>>Female</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <table id="userTable">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>City</th>
                <th>Birth Date</th>
                <th>Gender</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "dearday";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Initialize the query
            $sql = "SELECT user_id, name, username, birth_date, city, gender FROM tbl_user";
            
            // Check if a gender filter is set
            if (isset($_GET['gender']) && $_GET['gender'] != '') {
                $gender = $_GET['gender'];
                $sql .= " WHERE gender = '$gender'";
            }

            $result = $conn->query($sql);

            // Check if there are results and loop through the data
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['user_id']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['username']}</td>";
                    echo "<td>{$row['city']}</td>";
                    echo "<td>{$row['birth_date']}</td>";
                    echo "<td>{$row['gender']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
            }

            // Close connection
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
