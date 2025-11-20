<?php
session_start();

// Cegah akses tanpa login
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$admin = $_SESSION['admin'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Davici Market</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Inline CSS agar selaras dengan index -->
    <style>
        body {
            background: #f5f5f5;
            font-family: 'Inter', sans-serif;
        }

        .main-header {
            background: white;
            padding: 20px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .main-header .logo h1 {
            margin: 0;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #ffffff;
            border-right: 1px solid #ddd;
            padding-top: 20px;
            position: fixed;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            font-weight: 500;
            color: #333;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #000;
            color: #fff;
        }
        .content {
            margin-left: 250px;
            padding: 35px;
        }
        .card-box {
            border-radius: 12px;
            padding: 25px;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header class="main-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <h1>DAVICI</h1>
                </div>

                <div>
                    <a href="logout.php" class="btn btn-dark">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <div class="sidebar">
        <h5 class="text-center mb-3">ADMIN PANEL</h5>
        <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="#"><i class="fas fa-shopping-bag"></i> Data Produk</a>
        <a href="#"><i class="fas fa-list"></i> Kategori</a>
        <a href="#"><i class="fas fa-users"></i> Pengguna</a>
        <a href="#"><i class="fas fa-cog"></i> Pengaturan</a>
    </div>

    <!-- Content -->
    <div class="content">
        <h2>Selamat datang, <?= $admin; ?> 👋</h2>
        <p>Ini adalah halaman dashboard admin Davici Market.</p>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card-box">
                    <h5><i class="fas fa-shopping-bag"></i> Total Produk</h5>
                    <h2 class="mt-2">120</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-box">
                    <h5><i class="fas fa-users"></i> Total Pengguna</h5>
                    <h2 class="mt-2">54</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-box">
                    <h5><i class="fas fa-tags"></i> Total Kategori</h5>
                    <h2 class="mt-2">12</h2>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
