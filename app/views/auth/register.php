<?php require "app/views/layout/header.php"; ?>

<h2>Crear cuenta</h2>

    <?php if (isset($_SESSION["error"])): ?>
     <div class="alert alert-danger">
            <?= $_SESSION["error"]; ?>
    </div>
        <?php unset($_SESSION["error"]); ?>
    <?php endif; ?>

<form method="POST" action="index.php?controller=auth&action=register" class="card p-4 shadow-sm mt-3" style="max-width: 450px;">

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input name="nombre" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input name="email" type="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input name="password" type="password" class="form-control" minlength="6" required>
    </div>

    <button class="btn btn-success">
        Registrarse
    </button>

    <a href="index.php?controller=auth&action=loginForm" class="mt-3">
        Volver al login
    </a>

</form>

<?php require "app/views/layout/footer.php"; ?>