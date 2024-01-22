<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'vaccinated_db');

// Check if user is logged in
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if (!isset($_SESSION['Hospitaluserdata'])) {
        header("Location: index.php");
        exit();
    }
}

// Retrieve the hospital's assigned users
$hospitalUsername = $_SESSION['Hospitaluserdata'];
$assignedUsersQuery = "SELECT u.user_id, u.name, u.email, u.phone FROM users u INNER JOIN vaccine_history_list v ON u.user_id = v.user_id INNER JOIN hospital h ON v.location_id = h.hospital_id WHERE h.hospitalUsername = '$hospitalUsername'";
$assignedUsersResult = mysqli_query($conn, $assignedUsersQuery);

// Display the assigned users
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Assigned Users</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($assignedUsersResult)) : ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
