<?php
if (isset($_POST['register'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="CSS/reset.css">
    <link rel="stylesheet" href="CSS/register.css">
</head>
<body>
    <div class="logo"></div>
    <h1>Registrar cuenta</h1>
    <form action="#">
        <div class="input"><input type="text" placeholder="Nombre" name="nombre"></div>
        <div class="input"><input type="text" placeholder="Nombre usuario" name="usuario"></div>
        <div class="input"><input type="text" placeholder="Correo electrónico" name="email"></div>
        <div class="input"> <input type="password" placeholder="Contraseña" name="contrasena"></div>
        <div class="input"><input type="text" placeholder="Fecha de nacimiento" onfocus="(this.type = 'date')" id="date"></div>
        <input type="hidden" name="token" value="$token">
        <input class="button" type="button" value="Registrarse">
    </form>
</body>
</html>
<?php
}
