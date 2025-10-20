<?php require_once __DIR__ . "/../inc/config.php"; ?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/guest_login.css">
    <style>
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #1c3a2e;
            padding-top: 20px;
            color: white;
        }

        .sidebar h2 {
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            margin: 5px 0;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .dashboard-container {
            max-width: 960px;
            margin: 0 auto;
        }

        .sidebar a {
            margin-left: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Admin</h2>
        <a href="/admin/dashboard.php">Dashboard</a>
        <a href="/admin/reservations.php">Reservations</a>
        <a href="rooms.php">Rooms</a>
        <a href="/admin/login.php">Logout</a>
    </div>
</body>
</html>
