<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Login Admin - Bank Sampah</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body, html {
      height: 100%;
      font-family: 'Poppins', sans-serif;
      background-color: #ebfbee;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .wrapper {
      display: flex;
      width: 90%;
      max-width: 900px;
      background-color: #fff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .left {
      flex: 1;
      background: linear-gradient(135deg, #1abc61, #15803d);
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 40px;
    }
    .left img {
      width: 120px;
      max-width: 70%;
      height: auto;
      margin-bottom: 20px;
    }
    .left h1 {
      font-size: 24px;
      margin-bottom: 10px;
      text-align: center;
    }
    .left p {
      font-size: 14px;
      text-align: center;
    }
    .right {
      flex: 1;
      background-color: #f0fdf4;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px;
    }
    .login-box {
      background-color: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      width: 100%;
      max-width: 300px;
    }
    .login-box h2 {
      text-align: center;
      color: #14532d;
      margin-bottom: 20px;
      font-size: 18px;
    }
    .login-box input {
      width: 100%;
      padding: 12px 14px;
      margin: 8px 0;
      border-radius: 8px;
      border: 1px solid #ccc;
      background-color: #f9f9f9;
      font-size: 14px;
      outline: none;
      transition: border-color 0.3s ease, background-color 0.3s ease;
    }
    .login-box input:focus {
      border-color: #16a34a;
      background-color: #fff;
    }
    .login-box button {
      width: 100%;
      padding: 12px;
      background-color: #1abc61;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      font-size: 15px;
      cursor: pointer;
      margin-top: 10px;
      transition: background-color 0.3s ease, transform 0.1s ease;
    }
    .login-box button:hover {
      background-color: #84cc16;
      transform: translateY(-2px);
    }
    .custom-notify {
      font-size: 13px;
      color: #b30000;
      background-color: #ffe6e6;
      padding: 8px;
      border-radius: 6px;
      text-align: center;
      margin-top: 8px;
    }
    @media (max-width: 768px) {
      .wrapper {
        flex-direction: column;
      }
      .left, .right {
        flex: none;
        width: 100%;
        padding: 20px;
      }
      .left img {
        width: 60px;
      }
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="left">
      <img src="../images/logohp.png" alt="Logo Bank Sampah" />
      <h1>Selamat Datang Kembali</h1>
      <p>Silahkan Login Untuk Ketampilan Dashboard</p>
    </div>
    <div class="right">
      <div class="login-box">
        <h2>Masuk Sebagai Admin</h2>
        <form action="login_process.php" method="POST">
          <input type="text" name="username" placeholder="Username" required />
          <input type="password" name="password" placeholder="Password" required />
          <button type="submit">Login</button>
        </form>
        <?php if (isset($_GET['error'])): ?>
          <p class="custom-notify">Username atau password salah.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>
