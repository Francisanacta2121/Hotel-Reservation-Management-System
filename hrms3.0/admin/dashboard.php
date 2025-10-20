<?php
require_once __DIR__ . "/../inc/config.php";

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
   
    .sidebar {
      height: 100%;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #333;
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
      padding: 40px 20px;
      font-family: Arial, sans-serif;
    }

    .dashboard-card {
      background-color: #f9f9f9;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 800px;
      margin: auto;
    }

    .dashboard-card h1 {
      color: #1c3a2e;
      margin-bottom: 20px;
    }

    .dashboard-card p {
      font-size: 16px;
      color: #444;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: relative;
        width: 100%;
      }

      .content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
  
  <div class="content">
    <div class="dashboard-card">
      <h1>Welcome to the Admin Dashboard!</h1>
      <p>You can manage your reservations, view reports, and perform admin tasks from this panel.</p>
    </div>
  </div>

</body>
</html>
