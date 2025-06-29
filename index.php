<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "banksampah"; // Sesuaikan dengan nama database kamu

$koneksi = mysqli_connect("localhost:3307", $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Greenovate Unimus</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Segoe UI", sans-serif;
      }

      body {
        background-color: #ffffff;
      }

      /* Navbar */
      .navbar {
        background-color: #1abc61;
        padding: 16px 10%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: white;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
      }

      .logo {
        font-size: 24px;
        font-weight: bold;
      }

      nav a {
        color: white;
        text-decoration: none;
        margin: 0 15px;
        font-weight: 500;
      }

      .btn-masuk {
        background-color: white;
        color: #1abc61;
        padding: 8px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
      }

      /* Hero Section */
      .hero {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 60px 10%;
        flex-wrap: wrap;
        padding-top: 200px;
      }

      .hero-text {
        flex: 1;
        max-width: 500px;
      }

      .hero-text h1 {
        font-size: 28px;
        margin-bottom: 16px;
        color: #333;
      }

      .hero-text p {
        font-size: 16px;
        color: #555;
        margin-bottom: 24px;
        line-height: 1.6;
      }

      .btn-mulai {
        background-color: #1abc61;
        color: white;
        padding: 10px 24px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
      }

      .hero-image {
        flex: 1;
        text-align: center;
      }

      .hero-image img {
        max-width: 100%;
        height: auto;
      }

      /* Pencapaian Section */
      .pencapaian {
        text-align: center;
        padding: 168px 10%;
        background-color: #f9f9f9;
      }

      .pencapaian h2 {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 16px;
      }

      .pencapaian p {
        max-width: 600px;
        margin: 0 auto 40px;
        font-size: 15px;
        color: #444;
      }

      .stats {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
      }

      .card {
        background-color: #1abc61;
        color: white;
        padding: 20px 30px;
        border-radius: 10px;
        width: 200px;
      }

      .card h3 {
        font-size: 24px;
        margin-bottom: 8px;
      }

      .card p {
        font-size: 14px;
      }

      /* FITUR */
      .fitur {
        padding: 168px 10%;
        text-align: center;
      }

      .fitur-container {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-top: 40px;
        flex-wrap: wrap;
      }

      .fitur-item {
        max-width: 300px;
      }

      .fitur-item img {
        width: 100px;
        margin-bottom: 10px;
      }

      /* JENIS SAMPAH */
      .jenis-sampah {
        padding: 90px 10%;
        text-align: center;
        background-color: #f9f9f9;
      }

      .jenis-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
      }

      .jenis-item {
        width: 120px;
        height: 120px;
        border: 1px solid #ccc;
        border-radius: 12px;
        padding: 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 30px;
      }

      .jenis-item img {
        width: 40px;
        height: 40px;
        margin-bottom: 10px;
      }

      .jenis-item span {
        font-size: 14px;
        font-weight: 500;
      }

      /* GREENOVATE CTA */
      .greenovate-cta {
        padding: 220px 10%;
        text-align: center;
      }

      .greenovate-cta .btn-cta {
        margin-top: 20px;
        display: inline-block;
        background-color: #1abc61;
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
      }

      /* FOOTER */
      .footer {
        background-color: #1abc61;
        color: #fff;
        padding: 50px 10%;
      }

      .footer-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: flex-start;
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
      }

      .footer-col {
        flex: 1;
        max-width: 300px;
      }

      .footer-col h3,
      .footer-col h4 {
        margin-bottom: 15px;
      }

      .footer-col p {
        font-size: 14px;
        line-height: 1.6;
      }

      .footer-col ul {
        list-style: none;
        padding: 0;
      }

      .footer-col ul li {
        margin-bottom: 10px;
      }

      .footer-col ul li a {
        color: #fff;
        text-decoration: none;
      }

      .footer-col .social-icons a img {
        width: 24px;
        margin-right: 10px;
      }

      .subscribe-form {
        margin-top: 15px;
      }

      .subscribe-form input[type="email"] {
        padding: 8px;
        border: none;
        border-radius: 4px;
        width: 70%;
      }

      .subscribe-form button {
        padding: 8px 12px;
        border: none;
        background-color: #fff;
        color: #1abc61;
        border-radius: 4px;
        margin-left: 5px;
        cursor: pointer;
        font-weight: bold;
      }

      .copyright {
        margin-top: 20px;
        font-size: 12px;
        opacity: 0.8;
      }

      /* Responsive */
      @media screen and (max-width: 768px) {
        .hero {
          flex-direction: column;
          text-align: center;
        }

        .hero-text,
        .hero-image {
          max-width: 100%;
        }
      }
    </style>
  </head>
  <body>
    <!-- Navbar -->
    <header>
      <div class="navbar">
        <div class="logo">GREENOVATE UNIMUS</div>
        <nav>
          <a href="#">Home</a>
          <a href="#">Informasi</a>
          <a href="#">Layanan</a>
        </nav>
        <a href="login.html" class="btn-masuk">MASUK</a>
      </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-text">
        <h1>Halo, Sahabat Greenovate UNIMUS!</h1>
        <p>
          Bersiaplah untuk menjadikan pengolahan sampah sebagai momen yang lebih
          menyenangkan. Ayo mulai perjalanan hijau kita! Jangan lupa untuk
          mengupload foto sampah dan mendaur ulangnya. Setiap tindakan kecil
          bisa akan membuat perubahan besar dalam menjaga lingkungan.
        </p>
        <a href="#" class="btn-mulai">Mulai</a>
      </div>
      <div class="hero-image">
        <img src="images/Petugas Sampah.png" alt="Ilustrasi Hero" />
      </div>
    </section>

    <!-- Section Pencapaian -->
    <section class="pencapaian">
      <h2>PENCAPAIAN GREENOVATE</h2>
      <p>
        Teknologi Greenovate dirancang untuk memilah sampah berdasarkan jenisnya
        melalui foto sampah yang diunggah, serta memberikan informasi tentang
        kapasitas, dan jadwal TPS/TPA di kawasan Kampus Universitas Muhammdiyah
        Semarang.
      </p>
      <div class="stats">
        <div class="card">
          <h3>1jt Kg+</h3>
          <p style="color: white">Sampah di Daur Ulang</p>
        </div>
        <div class="card">
          <h3>50+</h3>
          <p style="color: white">Penghargaan</p>
        </div>
        <div class="card">
          <h3>5 Tempat</h3>
          <p style="color: white">Lokasi TPS/TPA</p>
        </div>
        <div class="card">
          <h3>300+</h3>
          <p style="color: white">Pengguna</p>
        </div>
      </div>
    </section>

    <!-- FITUR SECTION -->
    <section class="fitur">
      <h2>FITUR</h2>
      <p>
        Inovasi daur ulang Greenovate untuk kalangan Mahasiswa Universitas
        Muhammadiyah Semarang.
      </p>
      <div class="fitur-container">
        <div class="fitur-item">
          <img src="images/setor sampah.png" alt="Pendekteksi Sampah" />
          <h4>PENDETEKSI SAMPAH</h4>
          <p>
            Bagikan foto sampah dari ulangmu ke Greenovate UNIMUS. AI kami akan
            mengidentifikasi jenis sampah dan mendeteksinya.
          </p>
        </div>
        <div class="fitur-item">
          <img src="images/olah sampah.png" alt="TPST/TPA" />
          <h4>TPST/TPA</h4>
          <p>
            Greenovate Unimus menyediakan informasi lokasi pengumpulan,
            kapasitas, dan jadwal TPST/TPA di kawasan Kampus UNIMUS.
          </p>
        </div>
        <div class="fitur-item">
          <img src="images/pengepul.png" alt="Pickup" />
          <h4>PICK UP</h4>
          <p>Menawarkan penjemputan sampah praktis di wilayahmu.</p>
        </div>
      </div>
    </section>

    <!-- JENIS SAMPAH SECTION -->
    <section class="jenis-sampah">
      <h2>JENIS SAMPAH</h2>
      <p>
        Berbagai jenis sampah yang dapat didaur ulang dan disetorkan kepada
        Greenovate UNIMUS.
      </p>
      <div class="jenis-grid">
        <div class="jenis-item">
          <img src="icon/kertas.png" /><span>Kertas</span>
        </div>
        <div class="jenis-item">
          <img src="icon/plastik.png" /><span>Plastik</span>
        </div>
        <div class="jenis-item">
          <img src="icon/kardus.png" /><span>Kardus</span>
        </div>
        <div class="jenis-item">
          <img src="icon/kaca.png" /><span>Kaca</span>
        </div>
        <div class="jenis-item">
          <img src="icon/logam.png" /><span>Logam</span>
        </div>
        <div class="jenis-item">
          <img src="icon/organik.png" /><span>Organik</span>
        </div>
        <div class="jenis-item">
          <img src="icon/lainnya.png" /><span>Lainnya</span>
        </div>
      </div>
    </section>

    <!-- GREENOVATE CTA SECTION -->
    <section class="greenovate-cta">
      <h2>GREENOVATE UNIMUS</h2>
      <p>
        Greenovate UNIMUS adalah platform yang memudahkan pemilihan sampah
        dengan memberikan informasi layanan sampah yang tersedia sesuai dengan
        alamat yang pengguna berikan.
      </p>
      <a href="#" class="btn-cta">DAFTAR LAYANAN</a>
    </section>

    <footer class="footer">
      <div class="footer-container">
        <div class="footer-col">
          <h3>Greenovate UNIMUS</h3>
          <p>
            Berawal dari Pilah, Berakhir pada Kelestarian. Langkah kecil kita
            dalam mendaur ulang dan bertanggung jawab atas sumber daya
            memberikan dampak besar pada pelestarian lingkungan.
          </p>
          <p class="copyright">© 2024 Greenovate. All rights reserved</p>
        </div>
        <div class="footer-col">
          <h4>Greenovate</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Informasi</a></li>
            <li><a href="#">Layanan</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Social Media</h4>
          <div class="social-icons">
            <a href="#"><img src="icon/Instagram.png" alt="Instagram" /></a>
            <a href="#"><img src="icon/Facebook.png" alt="Facebook" /></a>
            <a href="#"><img src="icon/Youtube.png" alt="YouTube" /></a>
          </div>
          <form class="subscribe-form">
            <label for="email">Subscribe</label>
            <input type="email" id="email" placeholder="Enter email address" />
            <button type="submit">Send</button>
          </form>
        </div>
      </div>
    </footer>
  </body>
</html>
