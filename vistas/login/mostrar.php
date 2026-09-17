<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-7 col-lg-5">
            <div class="card shadow border-0">
                <div class="card-body p-4 p-md-5">
                    <h2 class="text-center fw-bold mb-4">Iniciar sesión</h2>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
                    <?php endif; ?>
                    <form method="POST" action="index.php?controlador=login&accion=verificar">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" id="usuario" name="usuario" class="form-control form-control-lg" autocomplete="username" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg" autocomplete="current-password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">Ingresar</button>
                    </form>
                    <div class="text-center mt-4 small text-muted">
                        Usuario de prueba: <strong>admin</strong> · Contraseña: <strong>admin123</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
