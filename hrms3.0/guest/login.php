<?php
// ...existing code...
$cfg = __DIR__ . '/../inc/config.php';
if (!file_exists($cfg)) {
    die("config not found: $cfg");
}
require_once $cfg;


// ensure session started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$err = '';
$redirect_to = $_POST['redirect'] ?? 'reserve.php';

// detect AJAX/JSON requests
$isAjax = (
    (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
    || (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false)
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Username and password are required.']);
            exit;
        }
        $err = 'Username and password are required.';
    } else {
        // prepare and check credentials
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND role = 'guest' LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();
        $user = $res->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            // login success
            $_SESSION['user'] = $user;
            $_SESSION['guest_name'] = $user['name'] ?? $user['username'];

            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'redirect' => $redirect_to]);
                exit;
            } else {
                header('Location: ' . $redirect_to);
                exit;
            }
        } else {
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
                exit;
            }
            $err = 'Invalid username or password.';
        }
    }
}
?>


<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Guest Login</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/guest_login.css">
</head>
<body>
  <div class="container" style="max-width:480px">
    <h1>Guest Login</h1>
    <?php if(!empty($err)) echo '<div class="alert">'.htmlspecialchars($err).'</div>'; ?>
    <form method="post">
     
      <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect_to); ?>">
      
      <label>Username</label>
      <input name="username" required>
      
      <label>Password</label>
      <input type="password" name="password" required>
      
      <button class="btn" type="submit">Login</button>
    </form>
    <p>No account? <a href="register.php">Register</a></p>
  </div>
</body>
</html>
