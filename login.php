
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Greenovate Unimus</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="container">
      <div class="left">
        <img src="images/login.png" alt="Ilustrasi Login" />
      </div>
      <div class="right">
        <h2 class="title">Masuk</h2>
        <p class="subtitle">Masuk ke akun anda</p>
        <form onsubmit="login(event)">
          <label for="username">Username</label>
          <input type="text" id="username" placeholder="Username" />

          <label for="password">Password</label>
          <input type="password" id="password" placeholder="********" />

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
      function login(event) {
        event.preventDefault(); // Mencegah reload saat submit form

        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();

        if (!username || !password) {
          alert("Harap masukkan username dan password!");
          return;
        }

        const users = JSON.parse(localStorage.getItem("users")) || [];

        const user = users.find(
          (u) =>
            u.username.toLowerCase() === username.toLowerCase() &&
            u.password === password
        );

        if (!user) {
          alert("Username atau password salah!");
          return;
        }

        // Simpan data user aktif ke localStorage
        localStorage.setItem("user", JSON.stringify(user));

        alert("Login berhasil!");
        window.location.href = "dashboard.php";
      }
    </script>
  </body>
</html>
