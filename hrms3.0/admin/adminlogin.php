<?php require_once __DIR__ . "/../inc/config.php"; ?>
<?php if($_SERVER['REQUEST_METHOD']==='POST'){
  $u = $_POST['username']??''; $p = $_POST['password']??'';
  $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND role='admin' LIMIT 1");
  $stmt->bind_param("s",$u); $stmt->execute(); $res=$stmt->get_result(); $user=$res->fetch_assoc();
  if($user && password_verify($p, $user['password'])){ $_SESSION['user']=$user; header("Location: reservations.php"); exit; }
  $err="Invalid admin credentials";
} ?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/guest_login.css">
  </head>
<body>
  <div class="container" style="max-width:480px">
    <h1>Admin Login</h1>
    <?php if(!empty($err)) echo '<div class="alert">'.esc($err).'</div>'; ?>
    <form method="post">
      <label>Username</label>
      <input name="username" required>
      <label>Password</label>
      <input type="password" name="password" required>  
      <button class="btn" type="submit">Login</button>
    </form>
  </div>
</body>
</html>
