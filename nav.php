<?php require_once "functions.php"; ?>

<style>
    nav {
        background: #1e293b;
        padding: 12px 20px;
        text-align: center;
    }

    nav a {
        color: white;
        text-decoration: none;
        margin-right: 16px;
        font-size: 14px;
    }

    nav a:hover {
        text-decoration: underline;
    }
</style>

<nav>
    <a href="index.php">Beranda</a>

    <?php if (is_logged_in()): ?>
        <a href="kelola.php">Kelola Produk</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login Admin</a>
    <?php endif; ?>
</nav>