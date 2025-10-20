<?php 
require_once __DIR__ . "/../inc/config.php"; 
require_once __DIR__ . "/../inc/auth.php"; 
require_once __DIR__ . "/../inc/functions.php"; 

require_guest_login();

$rooms = find_rooms($conn);
$me = current_user();

$err = '';


$selected_room_id = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_room_id = intval($_POST['room_id'] ?? 0);
} else {
    $selected_room_id = intval($_GET['room_id'] ?? 0);
}


$selected_room = null;
if ($selected_room_id > 0) {
    foreach ($rooms as $r) {
        if ($r['id'] == $selected_room_id) {
            $selected_room = $r;
            break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check_in_date = $_POST['check_in_date'] ?? '';
    $check_in_time = $_POST['check_in_time'] ?? '';
    $check_out_date = $_POST['check_out_date'] ?? '';
    $check_out_time = $_POST['check_out_time'] ?? '';

    $check_in = trim("$check_in_date $check_in_time");
    $check_out = trim("$check_out_date $check_out_time");

    $data = [
        'user_id' => $me['id'],
        'room_id' => $selected_room_id,
        'check_in' => $check_in,
        'check_out' => $check_out,
        'guests' => intval($_POST['guests'] ?? 1),
        'notes' => trim($_POST['notes'] ?? '')
    ];

    if (create_reservation($conn, $data)) {
        header("Location: thankyou.php");
        exit;
    } else {
        $err = "Failed to create reservation";
    }
}

?>

<!doctype html>
<html>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width,initial-scale=1'>
    <title>Reserve</title>
    <link rel='stylesheet' href='../assets/css/style.css'>
  </head>
<body>
  <div class='container' style='max-width:760px'>
    <h1>Reserve a Room</h1>
    <?php if (!empty($err)) echo '<div class="alert">'.esc($err).'</div>'; ?>

    <form method='post'>
      <div class='row'>
        <div>
          <label>Room</label>
          <?php if ($selected_room): ?>
            <input type="text" value="<?php echo esc($selected_room['name'] . " — ₱" . number_format($selected_room['price'], 2) . "/night"); ?>" readonly>
            <input type="hidden" name="room_id" value="<?php echo $selected_room['id']; ?>">
          <?php else: ?>
            <select name='room_id' required>
              <option value=''>Select a room</option>
              <?php foreach ($rooms as $r): ?>
                <option value='<?php echo $r['id']; ?>'><?php echo esc($r['name'] . " — ₱" . number_format($r['price'], 2) . "/night"); ?></option>
              <?php endforeach; ?>
            </select>
          <?php endif; ?>
        </div>
        <div>
          <label>Check-in Date</label>
          <input type='date' name='check_in_date' required>
        </div>
        <div>
          <label>Check-in Time</label>
          <input type='time' name='check_in_time' required>
        </div>
        <div>
          <label>Check-out Date</label>
          <input type='date' name='check_out_date' required>
        </div>
        <div>
          <label>Check-out Time</label>
          <input type='time' name='check_out_time' required>
        </div>

      </div>
      <label>Notes</label>
      <textarea name='notes' rows='3'></textarea>
      <button class='btn' type='submit'>Submit Reservation</button>
    </form>
  </div>
</body>
</html>
