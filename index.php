<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto Denyys</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

    <form action="enviar.php" method="POST" id="contacto-form">
        <h2>Contáctanos</h2>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required>

        <label for="asunto">Asunto:</label>
        <input type="text" id="asunto" name="asunto" required>

        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" required></textarea>

        <button type="submit">Enviar Mensaje</button>
    </form>

    <script src="script.js"></script>
</body>
</html>