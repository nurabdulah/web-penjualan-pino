<?php
// admin_login.php
session_start();

// Panduan Database:
// -----------------------
// Nama Database   : db_admin
// Nama Tabel      : users
// Struktur Tabel  :
//   id (INT, AUTO_INCREMENT, PRIMARY KEY)
//   username (VARCHAR 50)
//   password (VARCHAR 255)
// -----------------------

// Koneksi ke Database
$conn = mysqli_connect('localhost', 'root', '', 'db_admin');

if (!$conn) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

// Proses login ketika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gunakan proteksi agar tidak error
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Jika username / password kosong
    if ($username === '' || $password === '') {
        $error = 'Form tidak boleh kosong!';
    } else {
        // Query aman untuk menghindari SQL injection
        $stmt = mysqli_prepare($conn, 'SELECT id, username, password FROM users WHERE username = ?');
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Cek user ada atau tidak
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Verifikasi password hashed
            if ($password === $row['password']) {
                $_SESSION['admin'] = $row['username'];
                header('Location: dashboard.php');
                exit();
            } else {
                $error = 'Password salah!';
            }
        } else {
            $error = 'Username tidak ditemukan!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body style="background: #e6e6e6; font-family: Arial;">

    <div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
        <div class="card shadow"
            style="width: 380px; padding: 25px; border-radius: 12px; background: #ffffff; border: 1px solid #ccc;">
            <h3 class="text-center" style="font-weight:600; margin-bottom: 15px;">Login Admin</h3>

            <?php if(isset($error)) { ?>
            <div class="alert alert-danger" style="font-size:14px; padding:8px;"> <?= $error ?> </div>
            <?php } ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label" style="font-weight:500;">Username</label>
                    <input type="text" name="username" class="form-control" style="border-radius:6px;" required />
                </div>

                <div class="mb-3">
                    <label class="form-label" style="font-weight:500;">Password</label>
                    <input type="password" name="password" class="form-control" style="border-radius:6px;" required />
                </div>

                <button type="submit" name="login" class="btn w-100"
                    style="background:#000; color:white; padding:10px; font-weight:500; border-radius:6px;">
                    Masuk
                </button>
            </form>
        </div>
    </div>

</body>

</html>
