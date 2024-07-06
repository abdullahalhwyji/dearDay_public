<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dearDay";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Default SQL query to fetch all users
$sql = "SELECT * FROM tbl_user WHERE 1=1";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if search parameter is set
    if (isset($_GET['search'])) {
        $search = $conn->real_escape_string($_GET['search']);
        // Modify the SQL query to include search functionality
        $sql .= " AND name LIKE '%" . $search . "%'";
    }

    // Check if gender filter parameter is set
    if (isset($_GET['gender']) && $_GET['gender'] != 'all') {
        $gender = $conn->real_escape_string($_GET['gender']);
        // Modify the SQL query to include gender filter
        $sql .= " AND gender = '" . $gender . "'";
    }

    // Check if city filter parameter is set
    if (isset($_GET['city']) && $_GET['city'] != 'all') {
        $city = $conn->real_escape_string($_GET['city']);
        // Modify the SQL query to include city filter
        $sql .= " AND city = '" . $city . "'";
    }

    // Check if timestamp filter parameter is set
    if (isset($_GET['timestamp']) && $_GET['timestamp'] != 'all') {
        $timestamp = $conn->real_escape_string($_GET['timestamp']);
        // Modify the SQL query to include timestamp filter
        $sql .= " AND timestamp = '" . $timestamp . "'";
    }

    // Sorting options based on birth date
    $sort_options = [
        'none' => 'None',
        'asc' => 'Oldest to Youngest',
        'desc' => 'Youngest to Oldest'
    ];

    // Default sorting order
    $order_by = 'none';

    // Check if sort parameter is set
    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        if (array_key_exists($sort, $sort_options)) {
            $order_by = $sort;
        }
    }

    // Modify SQL query based on sorting option
    switch ($order_by) {
        case 'asc':
            $sql .= " ORDER BY birth_date ASC";
            break;
        case 'desc':
            $sql .= " ORDER BY birth_date DESC";
            break;
        default:
            // No sorting applied
            break;
    }
}

// Debugging: Output the final SQL query to check correctness
// echo "SQL Query: " . $sql; // Uncomment this line to see the SQL query

// Execute SQL query
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title style="color: #86469C;">User Management</title>
    <style>
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #86469C;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #86469C;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #dcdcdc;
        }
    </style>
</head>
<body>

<h2>User Management</h2>

<form method="GET" action="users.php">
    <input type="text" name="search" placeholder="Search by name" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">

    <select name="gender">
        <option value="all">All Genders</option>
        <option value="Male" <?php echo isset($_GET['gender']) && $_GET['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
        <option value="Female" <?php echo isset($_GET['gender']) && $_GET['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
        <option value="Other" <?php echo isset($_GET['gender']) && $_GET['gender'] == 'Other' ? 'selected' : ''; ?>>Other</option>
    </select>

    <select name="city">
        <option value="all">All Cities</option>
        <!-- Dynamically populated options will be added below -->
        <?php
        // SQL query to retrieve distinct cities based on current search criteria
        $sql_cities = "SELECT DISTINCT city FROM tbl_user";
        if (isset($_GET['search'])) {
            $search = $conn->real_escape_string($_GET['search']);
            $sql_cities .= " WHERE name LIKE '%" . $search . "%'";
        }
        $result_cities = $conn->query($sql_cities);

        // Output options for cities based on search results
        if ($result_cities->num_rows > 0) {
            while ($row_city = $result_cities->fetch_assoc()) {
                $selected = isset($_GET['city']) && $_GET['city'] == $row_city['city'] ? 'selected' : '';
                echo "<option value='" . $row_city['city'] . "' " . $selected . ">" . $row_city['city'] . "</option>";
            }
        }
        ?>
    </select>

    <select name="sort">
        <?php
        // Output sorting options
        foreach ($sort_options as $key => $value) {
            $selected = ($key == $order_by) ? 'selected' : '';
            echo "<option value='" . $key . "' " . $selected . ">" . $value . "</option>";
        }
        ?>
    </select>

    <input type="submit" value="Apply Filters">
</form>

<?php
// Debugging: Output received parameters to check correctness
// echo "<pre>"; print_r($_GET); echo "</pre>"; // Uncomment this line to see received parameters

// Display search results in a table
if ($result->num_rows > 0) {
    echo "<table><tr><th>User ID</th><th>Name</th><th>Username</th><th>Birth Date</th><th>City</th><th>Gender</th><th>Registration Date</th></tr>";
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["user_id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["username"] . "</td><td>" . $row["birth_date"] . "</td><td>" . $row["city"] . "</td><td>" . $row["gender"] . "</td><td>" . $row["timestamp"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No results found";
}

// Close connection
$conn->close();
?>

</body>
</html>
