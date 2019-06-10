<?php
    require "conexiones/back_login.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/estilos.css">

    <meta name="viewport" content="width=device-width, user-scalable=no, 
    initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

</head>

<body>

    <div class="container-all">

        <div class="container-form">

            <img src="" alt="" class="logo">
            <h1 class="title">Iniciar Sesión</h1>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method="POST" class="">

                <label for="">Email</label>
                <input type="email" name="email" id="">
                <span class="msg-error"> <?php echo $email_err;?></span>
                <label for="">Password</label>
                <input type="password" name="password" id="">
                <span class="msg-error"> <?php echo $password_err;?></span>
                <input type="submit" value="Iniciar">
            </form>
            <span class="text-footer">¿Aún no te has registrado?
                <a href="register.php">Registrate</a></span>
        </div>



        <div class="container-texto">
            <div class="capa"></div>
            <h1 class="title-description">Lorem ipsum dolor sit amet</h1>
            <p class="text-description">"Lorem ipsum dolor sit amet,
                consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua.
            </p>
        </div>

    </div>

</body>


</html>