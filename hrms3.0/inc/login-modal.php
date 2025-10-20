<div id="loginModal" class="modal" style="display:none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center;">
  <div style="background: #154734; padding: 20px; border-radius: 10px; max-width: 400px; width: 90%; position: relative; color: #f0f0f0;">
    <button id="closeModal" style="position: absolute; top: 10px; right: 10px; background:none; border:none; font-size: 20px; cursor:pointer; color: #fff;">&times;</button>

    <h2 style="color: #ffffff;">Guest Login</h2>

    
    <p id="loginError" style="color: #ff6b6b; display: none; font-weight: bold; margin-top: 10px;">Invalid username or password.</p>

    <form id="loginForm" method="post" action="/guest/login.php">
      <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect_to ?? 'reserve.php'); ?>">

      <label style="color: #ccc;">Username</label><br>
      <input name="username" required style="width: 100%; padding: 8px; border-radius: 5px; border: none; margin-bottom: 10px;"><br>

      <label style="color: #ccc;">Password</label><br>
      <input type="password" name="password" required style="width: 100%; padding: 8px; border-radius: 5px; border: none; margin-bottom: 10px;"><br>

      <button type="submit" class="btn" style="width: 100%;">Login</button>
    </form>

    <p style="color: #aaa; text-align:center; margin-top: 10px;">No account? <a href="/guest/register.php" style="color: #4cd137;">Register</a></p>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
  const loginTrigger = document.getElementById('loginTrigger');
  const loginModal = document.getElementById('loginModal');
  const closeModal = document.getElementById('closeModal');
  const loginForm = document.getElementById('loginForm');
  const loginError = document.getElementById('loginError');

  function openLoginModal(redirectUrl = '') {
    const redirectInput = loginModal.querySelector('input[name="redirect"]');
    if (redirectInput) {
      redirectInput.value = redirectUrl;
    }
    loginError.style.display = 'none';
    loginModal.style.display = 'flex';
  }

  if (loginTrigger && loginModal && closeModal) {
    loginTrigger.addEventListener('click', function (e) {
      e.preventDefault();
      openLoginModal('reserve.php');
    });

    closeModal.addEventListener('click', function () {
      loginModal.style.display = 'none';
    });

    loginModal.addEventListener('click', function (e) {
      if (e.target === loginModal) {
        loginModal.style.display = 'none';
      }
    });
  }

 
  if (loginForm) {
    loginForm.addEventListener('submit', function (e) {
      e.preventDefault();

      loginError.style.display = 'none'; 

      const formData = new FormData(loginForm);

      fetch(loginForm.action, {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            window.location.href = data.redirect || 'reserve.php';
          } else {
            loginError.textContent = "Invalid username or password.";
            loginError.style.display = 'block';
          }
        })
        .catch(() => {
          loginError.textContent = "Something went wrong. Please try again.";
          loginError.style.display = 'block';
        });
    });
  }

 
  document.querySelectorAll('.reserve-trigger').forEach(el => {
    el.addEventListener('click', function (e) {
      e.preventDefault();
      const roomId = this.getAttribute('data-roomid');
      const redirectUrl = `reserve.php?room_id=${roomId}`;
      openLoginModal(redirectUrl);
    });
  });
});
</script>
