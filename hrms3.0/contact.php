<?php require_once __DIR__ . "/inc/config.php"; ?>
<!doctype html>
<html>
    <head>
        <meta charset='utf-8'><meta name='viewport' content='width=device-width,initial-scale=1'>
        <title>Contact</title>
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

        .hero-text h1,
        .hero-text p {
            color: #fff !important;
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
        .contact-section {
        padding: 60px 20px;
        background-color: #fff;
        font-family: Arial, sans-serif;
    }

        .contact-container {
        display: flex;
        flex-wrap: wrap;
        max-width: 1200px;
        margin: 0 auto;
        gap: 40px;
        }

        .contact-info,
        .contact-form {
        flex: 1 1 500px;
        }

        .contact-info h2,
        .contact-form h2 {
        font-size: 28px;
        margin-bottom: 15px;
        font-family: 'Georgia', serif;
        }

        .contact-info p,
        .contact-form p {
        font-size: 15px;
        color: #555;
        line-height: 1.6;
        margin-bottom: 20px;
        }

        .contact-details {
        list-style: none;
        padding: 0;
        margin: 0 0 20px 0;
        }

        .contact-details li {
        font-size: 15px;
        margin-bottom: 10px;
        }

        .social-icons a img {
        width: 24px;
        height: 24px;
        margin-right: 15px;
        transition: transform 0.2s;
        }

        .social-icons a:hover img {
        transform: scale(1.1);
        }

        .contact-form form input,
        .contact-form form textarea {
        width: 100%;
        padding: 12px 14px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        }

        .contact-form form textarea {
        resize: vertical;
        }

        .consent-label {
        display: flex;
        flex-direction: column; /* para yung text sa taas, checkbox sa baba */
        font-size: 12px;
        color: #444;
        max-width: 700px;
        position: relative;
        padding-left: 25px; /* space para sa checkbox */
        line-height: 1.4;
        }

        .consent-label input[type="checkbox"] {
        position: absolute;
        left: 4px;  /* konting space from left */
        bottom: 20px; /* konting space from bottom */
        transform: none; /* no centering */
        width: 16px;
        height: 14px;
        }

        
        .send-btn {
        background-color: #9e7c2e;
        color: #fff;
        border: none;
        padding: 12px 25px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
        }

        .send-btn:hover {
        background-color: #84671e;
        }
        .form-buttons {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 10px;
        flex-wrap: wrap;
        }

        .or-text {
        font-weight: bold;
        color: #444;
        }

        .reserve-btn {
        background-color: #555;
        color: #fff;
        padding: 12px 25px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 16px;
        transition: background-color 0.2s ease-in-out;
        }

        .reserve-btn:hover {
        background-color: #333;
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
        /* Responsive */
        @media (max-width: 768px) {
        .contact-container {
            flex-direction: column;
        }
        }
        h1, h2, h3, h4, h5, h6 {
        font-family: 'Georgia', serif;
        }
        p, li, a, span, input, textarea, button {
        font-family: Arial, sans-serif;
        }
        a {
        text-decoration: none;
        color: inherit;
        }
        button {
        cursor: pointer;
        }
        /* End of Global Styles */
        /* Specific Styles */
        .hero-text h1 {
        font-size: 48px;
        margin-bottom: 10px;
        }
        .hero-text p {
        font-size: 20px;
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
            <a href="promos.php">Promos & Deals</a>
            <a class="active" href="contact.php">Contact Us</a>
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
        <h1>Contact Us</h1>
        <p>Get in touch with our team. Reservew Now </p>
        </div>
    </section>
    <section class="contact-section">
    <div class="contact-container">
        <!-- Left Column: Contact Info -->
        <div class="contact-info">
            <h2>Get in touch</h2>
            <p>Need a reservation? Get in touch with our team. We will be happy to assist you with your query. We are also active in social media. You can find us on below address.</p>

            <ul class="contact-details">
                <li><span>📍</span> #49 Bulacan St. Brgy. Bungad, Quezon City</li>
                <li><span>📞</span> 8376-7097 / 8376-7098 / 8376-7099 / 09364652951</li>
                <li><span>📧</span> e05.northedsa@eurotel-hotel.com</li>
            </ul>
        </div>

        <!-- Right Column: Contact Form -->
        <div class="contact-form">
        <h2>Send a Message</h2>
        <p>Do you have anything in your mind to tell us? Please don’t hesitate to get in touch to us via our contact form.</p>
        <form action="#" method="post">
            <input type="text" name="name" placeholder="Full Name *" required>
            <input type="email" name="email" placeholder="Your Email *" required>
            <input type="text" name="subject" placeholder="Subject *" required>
            <textarea name="message" rows="5" placeholder="Your Message *" required></textarea>
            
            <label class="consent-label">
            <input type="checkbox" required >
            I hereby agree and consent that Eurotel Hotel, on behalf of GCG Corporation, may collect use, disclose and process my personal information set out in this form to help with my inquiry/reservation/request for proposal.
            </label>

            <div class="form-buttons">
                <button type="submit" class="send-btn">Send</button>

                <?php if(!isset($_SESSION['guest_name'])): ?>
                    <span class="or-text">or</span>
                    <a class="btn reserve-trigger" href="#" data-roomid="">Reserve Now</a>
                <?php else: ?>
                   <a href="#" class="btn reserve-trigger" data-roomid="">Reserve Now</a>
                <?php endif; ?>


            </div>


        </form>
        </div>
    </div>
    </section>
    <?php include __DIR__ . '/inc/login-modal.php'; ?>
</body>
</html>
