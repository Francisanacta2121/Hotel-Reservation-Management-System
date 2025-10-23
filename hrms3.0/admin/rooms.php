<?php
require_once __DIR__ . "/../inc/config.php";
require_once __DIR__ . "/../inc/auth.php";
require_once __DIR__ . '/inc/functions.php';
require_admin();

$result = $conn->query("SELECT * FROM rooms");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Rooms List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f7fa;
      margin: 0;
      padding: 0;
    }

    .sidebar {
      width: 220px;
      height: 100%;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #123c2f;
      color: #fff;
      padding-top: 20px;
    }

    .content {
      margin-left: 240px;
      padding: 40px;
    }

    main {
      background: #ffffff;
      padding: 40px;
      border-radius: 14px;
      box-shadow: 0 6px 14px rgba(0,0,0,0.08);
      max-width: 1300px; /* mas malaki */
      width: 100%;
    }

    h1 {
      color: #123c2f;
      margin-bottom: 28px;
      font-size: 28px;
      border-bottom: 2px solid #e0e6e4;
      padding-bottom: 14px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
    }

    th {
      background-color: #123c2f;
      color: white;
      padding: 18px;
      text-align: left;
      font-size: 16px;
    }

    td {
      padding: 18px;
      border-bottom: 1px solid #e0e6e4;
      font-size: 15px;
      color: #333;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #eef5f2;
    }

    .edit-btn {
      background-color: #123c2f;
      color: white !important;
      padding: 8px 16px;
      text-decoration: none;
      border-radius: 6px;
      font-size: 14px;
      transition: background 0.2s ease;
    }

    .edit-btn:hover {
      background-color: #0f2e25;
    }

    footer {
      margin-top: 30px;
      text-align: center;
      font-size: 0.95em;
      color: #666;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: relative;
        width: 100%;
        height: auto;
      }
      .content {
        margin-left: 0;
        padding: 20px;
      }
      main {
        max-width: 100%;
      }
      table, thead, tbody, th, td, tr {
        display: block;
      }
      th {
        display: none;
      }
      tr {
        margin-bottom: 15px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
      }
      td {
        border: none;
        display: flex;
        justify-content: space-between;
        padding: 10px;
      }
      td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #123c2f;
      }
    }
  </style>
</head>
<body>
  <?php include 'sidebar.php'; ?>
  <div class="content">
    <main>
      <h1>Rooms List</h1>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Room Type</th>
            <th>Description</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td data-label="ID"><?php echo htmlspecialchars($row['id']); ?></td>
            <td data-label="Room Type"><?php echo htmlspecialchars($row['name']); ?></td>
            <td data-label="Description"><?php echo htmlspecialchars($row['description']); ?></td>
            <td data-label="Price">₱<?php echo number_format($row['price'], 2); ?></td>
            <td data-label="Action">
              <a class="edit-btn" href="editrooms.php?id=<?php echo $row['id']; ?>">Edit</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </main>
    <footer>© <?php echo date('Y'); ?> Eurotel HRMS</footer>
  </div>
</body>
</html>
s