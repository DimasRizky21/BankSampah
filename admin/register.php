<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Daftar Admin - Bank Sampah</title>
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #ebfbee;
    }
    .container {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .register-box {
      background-color: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }
    h2 {
      margin-bottom: 24px;
      color: #166534;
    }
    input {
  width: 100%;
  padding: 14px 16px;
  margin: 10px 0;
  border-radius: 10px;
  border: 1px solid #ccc;
  font-size: 15px;
  font-family: 'Poppins', sans-serif;
  outline: none;
  background-color: #f9f9f9;
  box-sizing: border-box;
  transition: border-color 0.3s ease;
}

input::placeholder {
  color: #aaa;
  font-weight: 400;
}

input:focus {
  border-color: #16a34a;
  background-color: #fff;
}
    button {
      background-color: #16a34a;
      color: #fff;
      border: none;
      padding: 12px;
      width: 100%;
      font-weight: bold;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 16px;
    }
    button:hover {
      background-color: #15803d;
    }
    .link {
      margin-top: 16px;
      font-size: 14px;
    }
    .link a {
      color: #166534;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="register-box">
      <h2>Daftar Admin</h2>
      <input type="text" id="username" placeholder="Email / NIM / Nama Admin" />
      <input type="password" id="password" placeholder="Password" />
      <button onclick="registerAdmin()">Daftar</button>
      <div class="link">
        Sudah punya akun admin? <a href="login.php">Login di sini</a>
      </div>
    </div>
  </div>

  <script>
    function registerAdmin() {
      const username = document.getElementById("username").value.trim();
      const password = document.getElementById("password").value;

      if (!username || !password) {
        alert("Semua field harus diisi!");
        return;
      }

      const admins = JSON.parse(localStorage.getItem("adminAccounts")) || {};

      if (admins[username]) {
        alert("Akun admin ini sudah terdaftar.");
      } else {
        admins[username] = password;
        localStorage.setItem("adminAccounts", JSON.stringify(admins));
        alert("Pendaftaran berhasil. Silakan login.");
        window.location.href = "login.php";
      }
    }
  </script>
</body>
</html>
