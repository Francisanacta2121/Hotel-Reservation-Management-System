<?php
require_once __DIR__ . "/../inc/config.php";
require_once __DIR__ . "/../inc/auth.php";
require_admin();

if (isset($_GET['approve'])) {
    require_once __DIR__ . "/../inc/functions.php";
    approve_reservation($conn, intval($_GET['approve']));
    header("Location: reservations.php?ok=1");
    exit;
}

$rows = $conn->query("SELECT r.*, u.username, rm.name as room_name FROM reservations r 
    LEFT JOIN users u ON u.id = r.user_id 
    LEFT JOIN rooms rm ON rm.id = r.room_id 
    ORDER BY r.created_at DESC")->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin — Reservations</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <style>
    .sidebar {
      height: 100%;
      width: 220px;
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
      font-size: 16px;
      color: white;
      display: block;
      transition: background 0.3s;
    }
    .sidebar a:hover {
      background-color: #145c3f;
    }
    .content {
      margin-left: 230px;
      padding: 20px;
      width: calc(100% - 230px);
      max-width: none;
    }
    .container {
      width: 100% !important;
      max-width: none !important;
      margin: 0;
      padding: 0;
    }
    .container h1 {
      font-family: 'Georgia', serif;
      color: #1c3a2e;
      margin-bottom: 20px;
    }
    .table {
      background-color: #fff;
      border-radius: 12px;
      border: 1px solid #d1e2d1;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      width: 100% !important;
      table-layout: auto;
    }
    .table th {
      background-color: #1c3a2e;
      color: #fff;
      padding: 12px;
      font-weight: 600;
      font-size: 14px;
      text-align: left;
    }
    .table td {
      padding: 12px;
      color: #333;
      font-size: 14px;
      vertical-align: middle;
      background-color: #fafafa;
    }
    .table tr:nth-child(even) td {
      background-color: #f0f5f2;
    }
    .badge {
      padding: 4px 10px;
      font-size: 12px;
      border-radius: 999px;
      font-weight: bold;
      display: inline-block;
    }
    .badge.approved {
      background-color: #e2f3e6;
      color: #1c3a2e;
      border: 1px solid #b8dfc2;
    }
    .badge.pending {
      background-color: #fff3cd;
      color: #856404;
      border: 1px solid #ffeeba;
    }
    .badge.cancelled {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
    .btn {
      background-color: #1c3a2e;
      color: #fff !important;
      padding: 6px 12px;
      font-size: 13px;
      border-radius: 6px;
      text-decoration: none;
      transition: background-color 0.2s ease;
      display: inline-block;
    }
    .btn:hover {
      background-color: #145c3f;
    }
    .alert {
      background-color: #e6f4ea;
      border: 1px solid #b3d8bb;
      color: #1c3a2e;
      padding: 14px 18px;
      border-radius: 10px;
      margin: 20px 0;
      font-weight: bold;
    }
    #customButtonsWrapper {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 10px;
    }
    #customButtons {
      display: flex;
      gap: 10px;
    }
    .dataTables_wrapper {
      width: 100% !important;
      max-width: 100% !important;
      overflow-x: auto;
    }
    @media (max-width: 768px) {
      .sidebar {
        position: relative;
        width: 100%;
      }
      .content {
        margin-left: 0;
      }
      #customButtonsWrapper {
        justify-content: flex-start;
      }
      #customButtons {
        flex-direction: column;
        align-items: stretch;
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <?php include 'sidebar.php'; ?>
  <div class="content">
    <div class="container">
      <h1>Reservations</h1>
      <?php if (isset($_GET['ok'])): ?>
        <div class="alert">Reservation approved & email queued.</div>
      <?php endif; ?>
      <div id="customButtonsWrapper">
        <div id="customButtons">
          <a class="btn" href="/admin/rooms.php">Edit Rooms</a>
          <a class="btn" href="/admin/addrooms.php">Add Rooms</a>
        </div>
      </div>
      <table id="reservationsTable" class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Guest</th>
            <th>Room</th>
            <th>Dates</th>
            <th>Guests</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r): ?>
            <tr>
              <td><?= $r['id']; ?></td>
              <td><?= esc($r['username']); ?></td>
              <td><?= esc($r['room_name']); ?></td>
              <td><?= esc($r['check_in']) . " → " . esc($r['check_out']); ?></td>
              <td><?= esc($r['guests']); ?></td>
              <td><span class="badge <?= strtolower($r['status']); ?>"><?= esc($r['status']); ?></span></td>
              <td>
                <?php if ($r['status'] !== 'approved'): ?>
                  <a class="btn" href="?approve=<?= $r['id']; ?>">Approve</a>
                <?php else: ?>
                  —
                <?php endif; ?>
                <a class="btn" href="editreservation.php?id=<?= $r['id']; ?>" style="margin-left:6px;">Edit</a>
              </td>
            </tr>
          <?php endforeach; ?>
          <?php if (empty($rows)) echo "<tr><td colspan='7'>No reservations yet.</td></tr>"; ?>
        </tbody>
      </table>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      $('#reservationsTable').DataTable({
        pageLength: 10,
        autoWidth: true,
        scrollX: true
      });
    });
  </script>
</body>
</html>
