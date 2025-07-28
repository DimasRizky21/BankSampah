<?php
include '../koneksi.php';
session_start();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT");

if (!isset($_SESSION['admin'])) {
  header("Location: login.php"); 
  exit;
}


// Ambil total user
$result_user = mysqli_query($koneksi, "SELECT COUNT(*) AS total_user FROM users");
$total_user = mysqli_fetch_assoc($result_user)['total_user'];

// Ambil total setoran
$result_setor = mysqli_query($koneksi, "SELECT SUM(total) AS total_setor FROM pembelian_sampah");
$total_setor = mysqli_fetch_assoc($result_setor)['total_setor'] ?? 0;

// Ambil total redeem
$result_redeem = mysqli_query($koneksi, "SELECT SUM(nominal) AS total_redeem FROM redeem_request WHERE status = 'Diterima'");
$total_redeem = mysqli_fetch_assoc($result_redeem)['total_redeem'] ?? 0;

// Ambil data komposisi sampah
$query = "SELECT jenis_sampah, SUM(berat) as total_berat FROM pembelian_sampah GROUP BY jenis_sampah";
$result = mysqli_query($koneksi, $query);

$labels = [];
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['jenis_sampah'];
    $data[] = $row['total_berat'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GreenOvate Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    .card h3 {
      margin-bottom: 10px;
    }
    .card p {
      font-size: 24px;
      font-weight: bold;
    }
    .chart-container {
      width: 100%;
      max-width: 500px; /* Batas lebar maksimum */
      height: 300px;     /* Tinggi tetap agar tidak terlalu besar */
      margin: 0 auto;    /* Tengah halaman */
    }
    canvas {
      width: 100% !important;
      height: auto !important;
    }
    <script>
      window.onload = function() {
        if (!navigator.onLine) return; // jika offline abaikan

        // Paksa reload untuk mengambil status session terbaru
        if (performance.navigation.type === 2) {
         location.reload(true);
        }
      };
    </script>
  </style>
</head>

<body>
  <aside class="sidebar">
    <h2>GreenOvate</h2>
    <nav>
      <a href="dashboard.php">Dashboard</a>
      <a href="jenis_sampah.php">Data Sampah</a>
      <a href="daftar_nasabah.php">Data Nasabah</a>
      <a href="beli_sampah.php">Beli Sampah</a>
      <a href="jual_sampah.php">Jual Sampah</a>
      <a href="redeem.php">Tarik Saldo</a>
      <a href="logout.php">Keluar</a>
    </nav>
  </aside>

  <main class="main">
    <div id="dashboard" class="page">
      <div class="header">
        <h1>Overview</h1>
      </div>

      <div class="cards">
        <div class="card">
          <h3>Total Nasabah</h3>
          <p><?= $total_user ?></p>
        </div>
        <div class="card">
          <h3>Total Setoran (Rp)</h3>
          <p><?= number_format($total_setor, 0, ',', '.') ?></p>
        </div>
        <div class="card">
          <h3>Total Redeem (Rp)</h3>
          <p><?= number_format($total_redeem, 0, ',', '.') ?></p>
        </div>
      </div>

      <!-- Doughnut Chart -->
      <div class="chart-container">
        <h2>Komposisi Sampah Berdasarkan Jenis</h2>
        <canvas id="sampahChart"></canvas>
      </div>
    </div>
  </main>

  <script>
    const ctx = document.getElementById('sampahChart').getContext('2d');
    const sampahChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: <?= json_encode($labels); ?>,
        datasets: [{
          label: 'Berat Sampah (kg)',
          data: <?= json_encode($data); ?>,
          backgroundColor: [
            '#4CAF50',
            '#FF9800',
            '#03A9F4',
            '#E91E63',
            '#9C27B0',
            '#FFC107',
            '#00BCD4',
            '#8BC34A',
            '#CDDC39',
            '#FF5722'
          ],
          borderColor: '#ffffff',
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        aspectRatio: 2,
        plugins: {
          legend: {
            position: 'right',
            labels: {
              generateLabels: function(chart) {
                const data = chart.data;
                const dataset = data.datasets[0];
                const total = dataset.data.reduce((sum, val) => sum + Number(val), 0);
                return data.labels.map((label, i) => {
                  const value = dataset.data[i];
                  const percent = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                  return {
                    text: `${label} - ${percent}%`,
                    fillStyle: dataset.backgroundColor[i],
                    strokeStyle: dataset.borderColor,
                    lineWidth: dataset.borderWidth,
                    hidden: chart.getDatasetMeta(0).data[i].hidden,
                    index: i
                  };
                });
              },
              boxWidth: 20,
              padding: 15
            }
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                const data = context.dataset.data;
                const total = data.reduce((sum, val) => sum + Number(val), 0);
                const value = context.parsed;
                const percent = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                return `${context.label} - ${value} kg (${percent}%)`;
              }
            }
          }
        }
      }

    });
  </script>
</body>
</html>
