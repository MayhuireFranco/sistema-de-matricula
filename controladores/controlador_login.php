<?php
require_once __DIR__ . '/../modelos/BD.php';

class ControladorLogin {
    public function mostrar() {
        require_once __DIR__ . '/../vistas/login/mostrar.php';
    }

    public function verificar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controlador=login&accion=mostrar');
            exit();
        }

        $usuario = trim($_POST['usuario'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($usuario === '' || $password === '') {
            $error = 'Ingrese usuario y contraseña.';
            require_once __DIR__ . '/../vistas/login/mostrar.php';
            return;
        }

        try {
            $conexion = BD::crearInstancia();
            $consulta = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1');
            $consulta->execute([':usuario' => $usuario]);
            $fila = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($fila && password_verify($password, $fila['password'])) {
                session_regenerate_id(true);
                $_SESSION['idUsuario'] = $fila['id'];
                $_SESSION['usuario'] = $fila['usuario'];
                $_SESSION['rol'] = $fila['rol'];
                $_SESSION['idProfesor'] = $fila['id_profesor'] ?? null;

                header('Location: index.php?controlador=paginas&accion=inicio');
                exit();
            }

            $error = 'Usuario o contraseña incorrectos.';
            require_once __DIR__ . '/../vistas/login/mostrar.php';
        } catch (PDOException $e) {
            $error = 'No se pudo consultar la tabla usuarios. Verifique que exista en la base de datos.';
            require_once __DIR__ . '/../vistas/login/mostrar.php';
        }
    }

    public function salir() {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
        header('Location: index.php?controlador=login&accion=mostrar');
        exit();
    }
}
