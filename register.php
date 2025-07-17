<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Akun | Greenovate Unimus</title>
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <div class="container">
      <div class="left">
        <img src="images/Sign up.png" alt="Ilustrasi Daftar" />
      </div>
      <div class="right">
        <h2 class="title">Selamat Datang.</h2>
        <form onsubmit="submitDaftar(event)">
          <label for="fullname">Nama Lengkap</label>
          <input
            type="text"
            id="fullname"
            placeholder="Nama Lengkap"
            required
          />

          <label for="username">Username</label>
          <input type="text" id="username" placeholder="Username" required />

          <label for="email">Email</label>
          <input type="email" id="email" placeholder="Email" required />

          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            placeholder="Password"
            required
          />

          <div class="checkbox-group">
            <input type="checkbox" id="terms" />
            <label for="terms"
              >Saya setuju dengan Ketentuan Layanan dan Kebijakan Privasi
              platform</label
            >
          </div>

          <button type="submit" class="btn-register">Daftar</button>
        </form>
        <div class="login-link">
          Sudah punya akun? <a href="login.html">Masuk</a>
        </div>
      </div>
    </div>

    <script>
      function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
      }

      function submitDaftar(event) {
        event.preventDefault(); // Mencegah form reload

        const fullname = document.getElementById("fullname").value.trim();
        const username = document.getElementById("username").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        const termsChecked = document.getElementById("terms").checked;

        if (!fullname || !username || !email || !password) {
          alert("Harap isi semua kolom!");
          return;
        }

        if (!termsChecked) {
          alert(
            "Anda harus menyetujui Ketentuan Layanan dan Kebijakan Privasi!"
          );
          return;
        }

        if (!validateEmail(email)) {
          alert("Format email tidak valid!");
          return;
        }

        if (password.length < 6) {
          alert("Password minimal 6 karakter!");
          return;
        }

        const users = JSON.parse(localStorage.getItem("users")) || [];

        const userExists = users.some(
          (user) =>
            user.username.toLowerCase() === username.toLowerCase() ||
            user.email.toLowerCase() === email.toLowerCase()
        );

        if (userExists) {
          alert("Username atau Email sudah terdaftar!");
          return;
        }

        users.push({ fullname, username, email, password });
        localStorage.setItem("users", JSON.stringify(users));

        alert("Pendaftaran berhasil! Silakan login.");
        window.location.href = "login.php";
      }
    </script>
  </body>
</html>
