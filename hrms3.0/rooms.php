<?php 
require_once __DIR__ . "/inc/config.php"; 
require_once __DIR__ . "/inc/functions.php"; 
require_once __DIR__ . '/inc/functions.php';
if (!function_exists('esc')) {
    function esc($str) {
        return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
    }
}
$rooms = find_rooms($conn); 

?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Rooms</title>
    <link rel="stylesheet" href="assets/css/style.css">
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
          <a href="index.php">Home</a>
          <a class="active" href="rooms.php">Rooms</a>
          <a href="promos.php">Promos & Deals</a>
          <a href="contact.php">Contact Us</a>
          <span style="flex:1"></span>
          <?php if(isset($_SESSION['guest_name'])): ?>
            <span>Welcome: <?php echo htmlspecialchars(explode('@', $_SESSION['guest_name'])[0]); ?></span>
          <?php else: ?>
            <a href="#" id="loginTrigger">Guest Login</a>
          <?php endif; ?>
        </div>
      </header>
      <div class="hero-text">
        <h1>Accommodations</h1>
      </div>
    </section>
    <div class="container">
      <h1>Rooms</h1>
      <div class="grid grid-3">
        <?php foreach($rooms as $r): ?>
          <div class="card">
            <h3>Room <?php echo esc($r['name']); ?></h3>
            <p>Type: <?php echo esc($r['description']); ?></p>
            <strong>₱<?php echo number_format($r['price'], 2); ?>/night</strong>

            <?php if(isset($_SESSION['guest_name'])): ?>
              <a class="btn" href="/guest/reserve.php?room_id=<?php echo $r['id']; ?>">Reserve</a>
            <?php else: ?>
              <!-- Open login modal with room_id in data attribute -->
              <a href="#" class="btn reserve-trigger" data-roomid="<?php echo $r['id']; ?>">Reserve</a>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>


      </div>
    </div>
    <?php include __DIR__ . '/inc/login-modal.php'; ?>
  </body>
</html>
