<?php
require_once __DIR__ . "/../inc/config.php";
require_once __DIR__ . "/../inc/auth.php";
require_admin();

$id = $_GET['id'] ?? '';
$message = '';

if ($id) {
    // Fetch room details
    $stmt = $conn->prepare("SELECT * FROM rooms WHERE id=? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $room = $result->fetch_assoc();
    $stmt->close();

    if (!$room) {
        die("Room not found.");
    }
} else {
    die("No room ID specified.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['room_type'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? '';

    if ($name && $description && $price) {
        $stmt = $conn->prepare("UPDATE rooms SET name=?, description=?, price=? WHERE id=?");
        $stmt->bind_param("ssdi", $name, $description, $price, $id);
        if ($stmt->execute()) {
            $message = "Room updated successfully!";
            // Refresh room data
            $room['name'] = $name;
            $room['description'] = $description;
            $room['price'] = $price;
        } else {
            $message = "Error updating room: " . $conn->error;
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
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Edit Room</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <main>
    <h1>Edit Room</h1>
    <?php if ($message): ?>
      <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form action="editrooms.php?id=<?php echo $id; ?>" method="post">
      <table>
        <tr>
          <th>Room Type</th>
          <th>Description</th>
          <th>Price</th>
        </tr>
        <tr>
          <td>
            <select name="room_type" required>
              <option value="Single" <?php if($room['name']=='Single') echo 'selected'; ?>>Standard Room</option>
              <option value="Double" <?php if($room['name']=='Double') echo 'selected'; ?>>Deluxe Room</option>
              <option value="Suite" <?php if($room['name']=='Suite') echo 'selected'; ?>>Family Suite</option>
            </select>
          </td>
          <td><input type="text" name="description" value="<?php echo htmlspecialchars($room['description']); ?>" required></td>
          <td><input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($room['price']); ?>" required></td>
        </tr>
      </table>
      <button type="submit">Update Room</button>
    </form>
  </main>
  <footer>© <?php echo date('Y'); ?> Eurotel HRMS </footer>
</body>
</html>