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
      <form action="login_process.php" method="POST">
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
      </form>
      <!-- <div class="link">
        Belum punya akun admin? <a href="register.php">Daftar di sini</a>
      </div> -->
      <?php
      if (isset($_GET['error'])) {
        echo "<p class='custom-notify'>Username atau password salah.</p>";
      }
      ?>
    </div>
  </div>
</body>
</html>
