<?php require_once __DIR__ . "/inc/config.php"; ?>
<!doctype html><html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width,initial-scale=1'>
        <title>Promos</title>
        <link rel='stylesheet' href='assets/css/style.css'>
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
        .promo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin: 40px auto;
            padding: 0 20px;
            max-width: 1100px;
        }

        .promo-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            transition: transform 0.2s ease-in-out;
        }

        .promo-card:hover {
            transform: translateY(-5px);
        }

        .promo-card img {
            width: 100%;
            display: block;
            height: auto;
        }

        .promo-card h3 {
            margin: 16px;
            font-size: 20px;
            color: #333;
        }

        .promo-card p {
            margin: 0 16px 16px;
            color: #555;
            font-size: 15px;
            line-height: 1.4;
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
            <a href="rooms.php">Rooms</a>
            <a class="active" href="promos.php">Promos & Deals</a>
            <a href="contact.php">Contact Us</a>
            <span style="flex:1"></span>
            <?php if(isset($_SESSION['guest_name'])): ?>
            <?php 
                $guest_name = $_SESSION['guest_name'];
                $guest_display = explode('@', $guest_name)[0];
            ?>
            <span>Welcome: <?php echo htmlspecialchars($guest_display); ?></span>
            <?php else: ?>
            <a href="#" id="loginTrigger">Guest Login</a>
            <?php endif; ?>
        </div>
        </header>
        <div class="hero-text">
        <h1>Promos & Deals</h1>
        </div>
    </section>

    <div class="container">
        <h1 style="text-align: center; margin-top: 40px;">Promos</h1>

        <div class="promo-grid">
            <!-- Promo 1 -->
            <div class="promo-card">
            <img src="assets/image/p&d1.png" alt="Rain Drops, Rate Drops">
            <h3>Rain Drops, Rate Drops!</h3>
            <p>
                The perfect room for this rainy season — at a special price! Avail of our Studio Room drops rate for only ₱1,699. Use promo code <strong>EURO-RD25</strong><br>
                <em>Booking until: Oct 15, 2025 | Stay: May 15 - Oct 15, 2025</em>
            </p>
            </div>

            <!-- Promo 2 -->
            <div class="promo-card">
            <img src="assets/image/p&d2.png" alt="Weekly and Monthly Rates">
            <h3>Weekly and Monthly Rates</h3>
            <p>
                Save up to 64%! Enjoy Eurotel comfort with long stay rates. As low as ₱1,000 per night. Limited rooms only!
            </p>
            </div>

            <!-- Promo 3 -->
            <div class="promo-card">
            <img src="assets/image/p&d3.jpg" alt="Trick or Treat Year 3">
            <h3>Trick or Treat Year 3</h3>
            <p>
                Join us on October 27 for a Halloween treat! With loot bags, a magic show, face painting, and more. Reserve your slot now!<br>
                <em>Oct 27, 2025 | Starts at 2:00 PM</em>
            </p>
            </div>
        </div>
    </div>
    <?php include __DIR__ . '/inc/login-modal.php'; ?>
</body>
</html>