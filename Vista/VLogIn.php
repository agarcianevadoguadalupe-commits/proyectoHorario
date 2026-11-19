<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="Vista/estilos.css">
</head>

<body>
    <header class="cabecera">
        <a href="https://fundacionloyola.com/vguadalupe/" class="logoEVG">
            <img
                src="https://fundacionloyola.com/vguadalupe/wp-content/uploads/2019/12/logotipo.png"
                alt="Logotipo EVG">
        </a>

        <nav class="menu">
            <a href="index.php?controlador=cHorario&metodo=ver">
                Horarios
            </a>
        </nav>
    </header>

    <main>
        <section class="tarjeta tarjeta-login">
            <h1>Iniciar sesión</h1>

            <?php if ($datos["error"] !== "") { ?>
                <p class="error" role="alert">
                    <?php echo htmlspecialchars(
                        $datos["error"],
                        ENT_QUOTES,
                        "UTF-8"
                    ); ?>
                </p>
            <?php } ?>

            <form action="index.php?controlador=cSesion&metodo=iniciar"
                method="post">

                <div class="campo">
                    <label for="correo">Correo</label>
                    <input
                        type="email"
                        id="correo"
                        name="correo"
                        autocomplete="username"
                        maxlength="254"
                        value="<?php echo htmlspecialchars(
                                    $datos["correo"],
                                    ENT_QUOTES,
                                    "UTF-8"
                                ); ?>"
                        required>
                </div>

                <div class="campo">
                    <label for="contrasena">Contraseña</label>
                    <input
                        type="password"
                        id="contrasena"
                        name="contrasena"
                        autocomplete="current-password"
                        required>
                </div>

                <div class="botones">
                    <input type="submit" value="Entrar">
                    <a href="index.php?controlador=cHorario&metodo=ver"
                        class="cancelar">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
</body>

</html>