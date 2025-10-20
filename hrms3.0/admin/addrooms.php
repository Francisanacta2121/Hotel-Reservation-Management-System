<?php
require_once __DIR__ . "/../inc/config.php";
require_once __DIR__ . "/../inc/auth.php";
require_admin();

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['room_type'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? '';

    if ($name && $description && $price) {
        $stmt = $conn->prepare("INSERT INTO rooms (name, description, price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $name, $description, $price);
        if ($stmt->execute()) {
            $message = "Room added successfully!";
        } else {
            $message = "Error adding room: " . $conn->error;
        }
        $stmt->close();
    } else {
        $message = "Please fill in all fields.";
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Add Room</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #123c2f;
      margin: 0;
      padding: 0;
    }

    main {
      max-width: 900px;
      margin: 40px auto;
      background: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    h1 {
      color: #123c2f;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th, td {
      padding: 12px;
      text-align: left;
    }

    th {
      background-color: #123c2f;
      color: white;
      font-weight: 600;
    }

    input[type="text"],
    input[type="number"],
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
      background-color: #f9f9f9;
    }

    button {
      background-color: #123c2f;
      color: white;
      padding: 12px 24px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      font-size: 15px;
    }

    button:hover {
      background-color: #0f2f26;
    }

    .message {
      padding: 12px;
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
      border-radius: 6px;
      margin-bottom: 20px;
    }

    footer {
      text-align: center;
      padding: 20px;
      font-size: 0.9em;
      color: #888;
    }
  </style>
</head>
<body>
<main>
  <h1>Add New Room</h1>

  <?php if (!empty($message)): ?>
    <div class="message"><?php echo htmlspecialchars($message); ?></div>
  <?php endif; ?>

  <form action="addrooms.php" method="post">
    <table>
      <tr>
        <th>Room Type</th>
        <th>Description</th>
        <th>Price</th>
      </tr>
      <tr>
        <td>
          <select name="room_type" required>
            <option value="">Select type</option>
            <option value="Single">Standard Room</option>
            <option value="Double">Deluxe Room</option>
            <option value="Suite">Family Suite</option>
          </select>
        </td>
        <td><input type="text" name="description" required></td>
        <td><input type="number" name="price" step="0.01" required></td>
      </tr>
    </table>
    <button type="submit">Add Room</button>
  </form>
</main>
<footer>© <?php echo date('Y'); ?> Eurotel HRMS</footer>
</body>
</html>
