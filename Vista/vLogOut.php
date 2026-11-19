<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sesión cerrada</title>
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

        <a href="index.php?controlador=cSesion&metodo=iniciar" class="sesion">
            Iniciar sesión
        </a>
    </header>

    <main>
        <section class="tarjeta">
            <h1>Sesión cerrada</h1>
            <p>Has cerrado la sesión correctamente.</p>

            <a href="index.php?controlador=cHorario&metodo=ver">
                Volver al horario
            </a>
        </section>
    </main>
</body>

</html>