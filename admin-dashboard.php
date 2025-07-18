<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GreenOvate Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f5fafd;
      color: #1a1a1a;
      display: flex;
    }

    .sidebar {
      width: 220px;
      background-color: #166534;
      padding: 20px;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
      height: 100vh;
      color: #ffffff;
    }

    .sidebar h2 {
      font-size: 22px;
      margin-bottom: 20px;
    }

    .sidebar nav a {
      display: block;
      padding: 12px;
      margin-bottom: 10px;
      text-decoration: none;
      color: #ffffff;
      border-radius: 8px;
      transition: 0.3s;
      cursor: pointer;
    }

    .sidebar nav a:hover {
      background-color: #1b7c4d;
    }

    .main {
      flex: 1;
      padding: 30px;
      background-color: #f0fdf4;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .cards {
      display: flex;
      gap: 20px;
      margin-bottom: 30px;
    }

    .card {
      background: linear-gradient(135deg, #c6f6d5, #9ae6b4);
      border-radius: 15px;
      padding: 20px;
      flex: 1;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      text-align: center;
      color: #1c4532;
    }

    .chart,
    .transactions {
      background: #fff;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      margin-bottom: 30px;
    }

    .transactions h3,
    .chart h3 {
      margin-bottom: 15px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th,
    td {
      padding: 10px;
      border: 1px solid #ccc;
    }
  </style>
</head>

<body>
  <aside class="sidebar">
    <h2>GreenOvate</h2>
    <nav>
      <a onclick="showPage('dashboard')">Dashboard</a>
      <a onclick="showPage('setor')">Setor</a>
      <a onclick="showPage('redeem')">Redeem</a>
      <a href="logout.php">Logout</a>
    </nav>
  </aside>

  <main class="main">
    <!-- Dashboard Page -->
    <div id="dashboard" class="page">
      <div class="header">
        <h1>Overview</h1>
      </div>

      <div class="cards">
        <div class="card">
          <h3>Total Nasabah</h3>
          <p id="total-nasabah">0</p>
        </div>
        <div class="card">
          <h3>Total Setoran (Rp)</h3>
          <p id="total-setor">0</p>
        </div>
        <div class="card">
          <h3>Total Redeem (Rp)</h3>
          <p id="total-redeem">0</p>
        </div>
      </div>
    </div>

    <!-- Setor Page -->
    <div id="setor" class="page" style="display: none;">
      <h2>Data Setor</h2>
      <table>
        <thead style="background-color: #c6f6d5;">
          <tr>
            <th>Nama Nasabah</th>
            <th>Jenis Sampah</th>
            <th>Berat (kg)</th>
            <th>Harga per Kg (Rp)</th>
            <th>Total (Rp)</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Budi Santoso</td>
            <td>Plastik</td>
            <td>3.5</td>
            <td>1.000</td>
            <td>3.500</td>
            <td>2025-07-12</td>
          </tr>
          <tr>
            <td>Ani Wulandari</td>
            <td>Kertas</td>
            <td>2.0</td>
            <td>500</td>
            <td>1.000</td>
            <td>2025-07-12</td>
          </tr>
          <tr>
            <td>Hasan Fadillah</td>
            <td>Logam</td>
            <td>1.5</td>
            <td>2.000</td>
            <td>3.000</td>
            <td>2025-07-12</td>
          </tr>
        </tbody>
      </table>
    </div>


    <!-- Redeem Page -->
    <div id="redeem" class="page" style="display: none;">
      <h2>Data Redeem</h2>
      <table>
        <thead style="background-color: #fed7d7;">
          <tr>
            <th>Nama Nasabah</th>
            <th>Nominal (Rp)</th>
            <th>Tanggal</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Rina Kartika</td>
            <td>50.000</td>
            <td>2025-07-11</td>
            <td>Diterima</td>
          </tr>
          <tr>
            <td>Dedi Maulana</td>
            <td>75.000</td>
            <td>2025-07-10</td>
            <td>Diproses</td>
          </tr>
          <tr>
            <td>Sri Wahyuni</td>
            <td>100.000</td>
            <td>2025-07-09</td>
            <td>Diterima</td>
          </tr>
        </tbody>
      </table>
    </div>

  </main>

  <script>
    function showPage(id) {
      const pages = document.querySelectorAll('.page');
      pages.forEach(page => page.style.display = 'none');
      document.getElementById(id).style.display = 'block';
    }
  </script>
</body>

</html>