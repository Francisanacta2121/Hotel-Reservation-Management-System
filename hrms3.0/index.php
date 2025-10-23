<?php require_once __DIR__ . "/inc/config.php"; ?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Hotel — Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/main.js" defer></script>
    <style>
      .hero {
        position: relative;
        background: url('assets/image/hm.jpg') no-repeat center center/cover;
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-shadow: 0 0 10px rgba(0,0,0,0.7);
      }
      .hero::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4); /* dark overlay */
        z-index: 1;
      }
      .hero-text {
        background: rgba(0, 0, 0, 0.4);
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        color: white;
      }

      header {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      background: transparent;
      color: white;
      z-index: 10;
      }

      .nav a {
      color: white;
      }

      .nav a.active,
      .nav a:hover {
        background: rgba(255, 255, 255, 0.2); 
      }

      .nav {
      position: fixed;
      top: 20px;                          /* Space from top */
      left: 50%;
      transform: translateX(-50%);       /* Center horizontally */

      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;

      width: 95%;
      max-width: 1100px;
      padding: 16px 30px;
      margin: 0 auto;

      background: rgba(0, 0, 0, 0.4);
      border-radius: 50px;
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      z-index: 999;
      }
      .logo-container {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .logo-img {
      height: 40px;
    }
    .logo-title {
      font-size: 18px;
      font-weight: bold;
      color: white;
    }
    .logo-subtitle {
      font-size: 14px;
      color: #b0b0b0;
    }
    
    </style>
</head>
<body>
  <section class="hero">
    <header>
      <div class="nav">
        <div class="logo-container">
          <img src="assets/image/logo.png" alt="Logo" class="logo-img" />
          <div class="logo-text">
            <div class="logo-title">Eurotel Hotel</div>
            <div class="logo-subtitle">North Edsa</div>
          </div>
        </div>
        <span style="flex:1"></span>
        <a class="active" href="index.php">Home</a>
        <a href="rooms.php">Rooms</a>
        <a href="promos.php">Promos & Deals</a>
        <a href="contact.php">Contact Us</a>
        <span style="flex:1"></span>
        <?php if(isset($_SESSION['guest_name'])): ?>
          <?php 
            $guest_name = $_SESSION['guest_name'];
            $guest_display = explode('@', $guest_name)[0];
          ?>
          <a href="/guest/logout.php" onclick="return confirm('Are you sure you want to log out?');">
            Welcome: <?php echo htmlspecialchars($guest_display); ?>
          </a>
          <?php else: ?>
            <a href="#" id="loginTrigger">Guest Login</a>
            <?php endif; ?>
      </div>
    </header>
    <div class="hero-text">
      <h1>Welcome to Eurotel North Edsa</h1>
      <p>Your comfort is our priority</p>
    </div>
  </section>

  <div class="container">
    <div class="grid grid-3">
      <div class="card">
        <h2>Welcome</h2>
        <p>Experience comfort and convenience in the heart of the city.</p>
        <a class="btn" href="rooms.php">Browse Rooms</a>
      </div>
      <div class="card">
        <h2>Deals</h2>
        <p>Check our latest promos and save more on your stay.</p>
        <a class="btn" href="promos.php">See Promos</a>
      </div>
      <div class="card">
        <h2>Reserve</h2>
        <p>Ready to book? Reserve a room in minutes.</p>
        <?php if(isset($_SESSION['guest_name'])): ?>
          <!-- User logged in -->
          <a class="btn" href="/guest/reserve.php">Reserve Now</a>
        <?php else: ?>
          <!-- User NOT logged in -->
              <a href="#" class="btn reserve-trigger" data-roomid="<?php echo $r['id']; ?>">Reserve Now</a>
        <?php endif; ?>
      </div>

    </div>
  </div>
  <footer>© <?php echo date('Y'); ?> Eurotel HRMS </footer>
  <?php include __DIR__ . '/inc/login-modal.php'; ?>
  <?php if (!empty($_GET['login_error'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const loginModal = document.getElementById('loginModal');
      const loginError = document.getElementById('loginError');

      if (loginError && loginModal) {
        loginError.textContent = "Invalid username or password.";
        loginError.style.display = 'block';
        loginModal.style.display = 'flex';
      }
    });
  </script>
  <?php endif; ?>

</body>
</html>
