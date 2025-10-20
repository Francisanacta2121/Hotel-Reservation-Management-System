<?php
require_once __DIR__ . "/../inc/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username'] ?? '');
    $p = $_POST['password'] ?? '';

    if (strlen($u) < 3) {
        $err = "Username too short";
    } else {
        
        $stmt_check = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt_check->bind_param("s", $u);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $err = "Username already exists";
        } else {
            
            $hash = password_hash($p, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'guest')");
            $stmt->bind_param("ss", $u, $hash);

            if ($stmt->execute()) {
                
                $_SESSION['user'] = ['id' => $stmt->insert_id, 'username' => $u, 'role' => 'guest'];
                $success_msg = "Account created successfully! You can now log in.";
            } else {
                $err = "An error occurred while creating your account.";
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="contain" style="max-width:520px">
            <h1>Create Account</h1>
            <?php if (!empty($err)) echo '<div class="alert error">' . esc($err) . '</div>'; ?>
            <?php if (!empty($success_msg)) echo '<div class="alert success">' . esc($success_msg) . '</div>'; ?>

            <form method="post">
                <label>Username</label>
                <input name="username" required>
                <label>Password</label>
                <input type="password" name="password" required>
                <button class="btn" type="submit">Create</button>
            </form>
        </div>
    </div>
</body>
</html>
