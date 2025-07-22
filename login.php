<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | Greenovate Unimus</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="container">
      <div class="left">
        <img src="images/login.png" alt="Ilustrasi Login" />
      </div>
      <div class="right">
        <h2 class="title">Masuk</h2>
        <p class="subtitle">Masuk ke akun Anda</p>
        <form id="loginForm">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Username" required />

          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="********" required />

          <div class="options">
            <label><input type="checkbox" /> Ingat akun</label>
            <a href="#" class="forgot">Lupa Password?</a>
          </div>

          <button type="submit" class="btn-login">Masuk</button>

          <p class="register">
            Belum punya akun? <a href="register.php">Daftar</a>
          </p>
        </form>
      </div>
    </div>

    <script>
      document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();

        if (!username || !password) {
          alert("Harap masukkan username dan password!");
          return;
        }

        fetch('proses_login.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            alert(data.message);
            window.location.href = 'dashboard.php';
          } else {
            alert(data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Terjadi kesalahan. Silakan coba lagi.');
        });
      });
    </script>
  </body>
</html>
