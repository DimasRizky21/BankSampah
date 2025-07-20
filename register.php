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
        <form method="POST" action="" id="registerForm">
          <label for="fullname">Nama Lengkap</label>
          <input type="text" name="fullname" id="fullname" placeholder="Nama Lengkap" required />

          <label for="username">Username</label>
          <input type="text" name="username" id="username" placeholder="Username" required />

          <label for="email">Email</label>
          <input type="email" name="email" id="email" placeholder="Email" required />

          <label for="nim">NIM</label>
          <input type="text" name="nim" id="nim" placeholder="NIM" required />

          <label for="password">Password</label>
          <input type="password" name="password" id="password" placeholder="Password" required />

          <div class="checkbox-group">
            <input type="checkbox" id="terms" required />
            <label for="terms">
              Saya setuju dengan Ketentuan Layanan dan Kebijakan Privasi platform
            </label>
          </div>

          <button type="submit" class="btn-register">Daftar</button>
        </form>
        <div class="login-link">
          Sudah punya akun? <a href="login.php">Masuk</a>
        </div>
      </div>
    </div>

    <script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const fullname = document.getElementById('fullname').value.trim();
        const username = document.getElementById('username').value.trim();
        const email = document.getElementById('email').value.trim();
        const nim = document.getElementById('nim').value.trim();
        const password = document.getElementById('password').value.trim();
        const termsChecked = document.getElementById('terms').checked;

        if (!fullname || !username || !email || !nim || !password) {
            alert("Harap isi semua kolom!");
            return;
        }

        if (!termsChecked) {
            alert("Anda harus menyetujui Ketentuan Layanan dan Kebijakan Privasi!");
            return;
        }

        fetch('proses_daftar.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `fullname=${encodeURIComponent(fullname)}&username=${encodeURIComponent(username)}&email=${encodeURIComponent(email)}&nim=${encodeURIComponent(nim)}&password=${encodeURIComponent(password)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                window.location.href = 'login.php';
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
