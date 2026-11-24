<?php
session_start();
require_once 'koneksi.php';

$error = '';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM admin WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $admin = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_login'] = $username;
        header("Location: kelola.php");
        exit;
    }

    $error = "Username atau password salah!";
}

include 'header.php';
?>

<style>
.login {
    max-width: 350px;
    margin: 30px auto;
    padding: 20px;
    border: 1px solid;
}

h2 {
    text-align: center;
}

input, button {
    width: 100%;
    padding: 8px;
    margin: 8px 0;
    box-sizing: border-box;
}

button {
    border: 1px solid;
}
</style>

<div class="login">
    <h2>Login Admin</h2>

    <p><?= htmlspecialchars($error) ?></p>

    <form method="POST">
        Username
        <input type="text" name="username" required>

        Password
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
    </form>

    <a href="index.php">Kembali ke Katalog</a>
</div>

<?php include 'footer.php'; ?>