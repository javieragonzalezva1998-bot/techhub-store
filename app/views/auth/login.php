<?php require "app/views/layout/header.php"; ?>

<h2>Iniciar sesión</h2>

<?php if (isset($_SESSION["success"])): ?>
    <div class="alert alert-success">
        <?= $_SESSION["success"]; ?>
    </div>
    <?php unset($_SESSION["success"]); ?>
<?php endif; ?>

<?php if (isset($_SESSION["error"])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION["error"]; ?>
    </div>
    <?php unset($_SESSION["error"]); ?>
<?php endif; ?>

<form method="POST" action="index.php?controller=auth&action=login" class="card p-4 shadow-sm mt-3" style="max-width: 450px;">

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input name="email" type="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input name="password" type="password" class="form-control" required>
    </div>

    <button class="btn btn-primary">
        Ingresar
    </button>

    <a href="index.php?controller=auth&action=registerForm" class="mt-3">
        Crear cuenta
    </a>

</form>

<?php require "app/views/layout/footer.php"; ?>