<?php require_once __DIR__ . "/../inc/config.php"; ?>
<?php
$login_success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $u = $_POST['username'] ?? '';
  $p = $_POST['password'] ?? '';
  $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND role='admin' LIMIT 1");
  $stmt->bind_param("s", $u);
  $stmt->execute();
  $res = $stmt->get_result();
  $user = $res->fetch_assoc();
  if ($user && password_verify($p, $user['password'])) {
    $_SESSION['user'] = $user;
    $login_success = true; 
  } else {
    $err = "Invalid admin credentials";
  }
}
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
      .wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f4f4f4;
      }

      .cont {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 420px;
      }

      .cont h1 {
        margin-bottom: 20px;
        font-family: 'Georgia', serif;
        color: #1c3a2e;
        text-align: center;
      }

      label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        color: #333;
      }

      input {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        font-size: 16px;
        border-radius: 6px;
        border: 1px solid #ccc;
      }

      .btn {
        background-color: #1c3a2e;
        color: #fff;
        padding: 10px;
        font-size: 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        width: 100%;
      }

      .btn:hover {
        background-color: #145c3f;
      }

      .alert {
        background-color: #f8d7da;
        color: #721c24;
        padding: 12px;
        border-radius: 6px;
        margin-bottom: 20px;
        border: 1px solid #f5c6cb;
        text-align: center;
      }

      /* Modal */
      .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
      }

      .modal-content {
        background: white;
        padding: 30px 20px;
        border-radius: 10px;
        max-width: 300px;
        margin: 20% auto;
        text-align: center;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        font-size: 20px;
        font-weight: bold;
        color: #1c3a2e;
      }
    </style>
  </head>
<body>

  <div class="wrapper">
    <div class="cont">
      <h1>Admin Login</h1>
      <?php if (!empty($err)): ?>
        <div class="alert"><?= esc($err); ?></div>
      <?php endif; ?>
      <form method="post">
        <label>Username</label>
        <input name="username" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button class="btn" type="submit">Login</button>
      </form>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal" id="successModal">
    <div class="modal-content">
      Login Successfully
    </div>
  </div>

  <?php if ($login_success): ?>
  <script>
    // Show modal
    document.getElementById('successModal').style.display = 'block';

    // Redirect to reservations.php after 2 seconds
    setTimeout(function () {
      window.location.href = "/admin/dashboard.php";
    }, 2000);
  </script>
  <?php endif; ?>
</body>
</html>
