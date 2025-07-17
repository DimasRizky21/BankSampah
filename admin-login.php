<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Login Admin - Bank Sampah</title>
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
    .login-box {
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
    .custom-notify {
      font-size: 16px;
      background-color: #ffe6e6 !important;
      color: #b30000 !important;
      border-radius: 8px;
      position: relative;
  }

  </style>
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h2>Login Admin</h2>
      <input type="text" id="username" placeholder="Username"/>
      <input type="password" id="password" placeholder="Password"/>
      <button onclick="loginAdmin()">Login</button>
      <div class="link">
        Belum punya akun admin? <a href="admin-register.php">Daftar di sini</a>
      </div>
    </div>
  </div>

  <script>
  function loginAdmin() {
      const usernameInput = document.getElementById("username");
      const passwordInput = document.getElementById("password");

      const username = usernameInput.value.trim();
      const password = passwordInput.value.trim();

      const admins = JSON.parse(localStorage.getItem("adminAccounts")) || {};

      if (admins[username] && admins[username] === password) {
        localStorage.setItem("user", JSON.stringify({ username }));

        const saldoKey = "saldo_" + username;
        if (!localStorage.getItem(saldoKey)) {
          localStorage.setItem(saldoKey, "0");
        }

        window.location.href = "admin-dashboard.php";
      } else {
        PNotify.alert({
          text: 'Username atau password salah.',
          type: 'error',
          delay: 500,
          addClass: 'custom-notify',
          closer: true,
          sticker: false,
        });

        usernameInput.value = "";
        passwordInput.value = "";
        usernameInput.focus();
      }
    }
</script>
  <link href="https://cdn.jsdelivr.net/npm/@pnotify/core@5.2.0/dist/PNotify.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/@pnotify/core@5.2.0/dist/PNotify.js"></script>
  <!-- style pnotify -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@pnotify/core/dist/PNotify.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@pnotify/bootstrap4/dist/PNotifyBootstrap4.css">
  <script src="https://cdn.jsdelivr.net/npm/@pnotify/core/dist/PNotify.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@pnotify/bootstrap4/dist/PNotifyBootstrap4.js"></script>

</body>
</html>
