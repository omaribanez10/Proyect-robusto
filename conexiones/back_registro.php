<?php

require_once "conexion.php";

$username = $email = $password = "";

//Para la validación y detección de errores

$username_err = $email_err = $password_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor, ingrese un nombre de usuario";
    } else {
        $sql = "SELECT id FROM usuario WHERE nombre = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "Este nombre de usuario ya existe, intente con uno diferente";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Algo salió mal en guardado nombre de usuario, inténtalo más tarde";
            }
        }
    }


    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor, ingrese un correo ";
    } else {
        $sql = "SELECT id FROM usuario WHERE email = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = trim($_POST["email"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "Este correo ya está en uso, intente con uno diferente o inicie sesión";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Algo salió mal en el correo electronico, inténtalo más tarde";
            }
        }
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, ingrese una contraseña";
    } else if (strlen(trim($_POST["password"]))  < 4) {
        $password_err = "La contraseña es muy corta, la contraseña debe tener mínimo 5 caracteres";
    } else {
        $password = trim($_POST["password"]);
    }


    //Comprobando los errores de la variables antes de insertarlas en la base de datos

    if (empty($username_err) && empty($email_err) && empty($password_err)) {

        $sql = "INSERT INTO usuario (nombre,contrasena,email) VALUES (?,?,?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_email);


            //ESTABLECEMOS LOS PARÁMETROS

            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Se encripta la contraseña.

            if (mysqli_stmt_execute($stmt)) {
                header("location: index.php");
            } else {
                echo "Algo salió mal en el registro de la base de datos, inténtalo más tarde
                o comunícate con nosotros";
            }
        }
    }
    mysqli_close($link);
}
