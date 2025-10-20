<?php
require_once __DIR__ . "/../inc/config.php";
require_once __DIR__ . "/../inc/auth.php";
require_admin();

$id = $_GET['id'] ?? '';
$message = '';

if ($id) {
 
    $stmt = $conn->prepare("
    SELECT 
        r.*, 
        u.username, 
        rm.name AS room_name
    FROM reservations r
    LEFT JOIN users u ON r.user_id = u.id
    LEFT JOIN rooms rm ON r.room_id = rm.id
    WHERE r.id = ? 
    LIMIT 1
    ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $reservation = $result->fetch_assoc();
    $stmt->close();

    if (!$reservation) {
        die("Reservation not found.");
    }
} else {
    die("No reservation ID specified.");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel'])) {
    $stmt = $conn->prepare("UPDATE reservations SET status='cancelled' WHERE id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Cancelled Successfully');window.location.href='reservations.php';</script>";
        exit;
    } else {
        $message = "Error cancelling reservation: " . $conn->error;
    }
    $stmt->close();
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Reservation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 20px;
    }
    main {
      max-width: 600px;
      margin: auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    h1 {
      font-size: 24px;
      margin-bottom: 20px;
      color: #1b3d2f;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    th {
      text-align: left;
      padding: 10px 0;
      color: #333;
      width: 30%;
    }
    td {
      padding: 10px 0;
      color: #555;
    }
    .btn {
      background-color: #14452f;
      color: white;
      padding: 10px 18px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .btn:hover {
      background-color: #0f3824;
    }
    .badge {
      display: inline-block;
      padding: 5px 12px;
      border-radius: 12px;
      font-size: 0.85em;
      font-weight: bold;
      background-color: #e0f3e0;
      color: #155724;
      border: 1px solid #c6e6c6;
    }
    .cancelled {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
    footer {
      text-align: center;
      margin-top: 40px;
      font-size: 14px;
      color: #888;
    }
  </style>
</head>
<body>
  <main>
    <h1>Edit Reservation</h1>
    <?php if ($message): ?>
      <p style="color:red;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <table>
      <tr><th>ID</th><td><?php echo htmlspecialchars($reservation['id']); ?></td></tr>
      <tr><th>User</th><td><?php echo htmlspecialchars($reservation['username'] ?? 'N/A'); ?></td></tr>
      <tr><th>Room</th><td><?php echo htmlspecialchars($reservation['room_name'] ?? 'N/A'); ?></td></tr>
      <tr><th>Check-in</th><td><?php echo htmlspecialchars($reservation['check_in']); ?></td></tr>
      <tr><th>Check-out</th><td><?php echo htmlspecialchars($reservation['check_out']); ?></td></tr>
      <tr><th>Guests</th><td><?php echo htmlspecialchars($reservation['guests']); ?></td></tr>
      <tr>
        <th>Status</th>
        <td>
          <span class="badge <?php echo $reservation['status'] === 'cancelled' ? 'cancelled' : ''; ?>">
            <?php echo htmlspecialchars($reservation['status']); ?>
          </span>
        </td>
      </tr>
    </table>

    <?php if ($reservation['status'] !== 'cancelled'): ?>
      <form method="post">
        <button type="submit" name="cancel" class="btn">Cancel Booking</button>
      </form>
    <?php else: ?>
      <p style="color: red; font-weight: bold;">This booking is already cancelled.</p>
    <?php endif; ?>
  </main>
  <footer>© <?php echo date('Y'); ?> Eurotel HRMS</footer>
</body>
</html>
