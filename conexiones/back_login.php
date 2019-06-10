<?php

//INICIALIZAR SESIÓN
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: home.php");
    exit;
}
require_once "conexion.php";

$email = $password = "";
$email_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (empty(trim($_POST["email"]))) {
        $email_err = "Ingrese correo electronico";
    } else {
        $email = trim($_POST["email"]);
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (empty(trim($_POST["password"]))) {
            $password_err = "Ingrese una contraseña";
        } else {
            $password = trim($_POST["password"]);
        }
    }



    //AQUÍ SE VALIDAN LAS CREDENCIALES 

    if (empty($email_err) && empty($password_err)) {

        $sql = "SELECT id, nombre, contrasena, email FROM usuario WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = $email;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
            }

            //VERIFICAR SI EL USUARIO YA EXISTE

            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $nombre, $hashed_password, $email);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashed_password)) {
                        session_start();

                        //ALMACENAR LOS DATOS EN VARIABLES DE SESSION
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["email"] = $email;

                        header("location: home.php");
                    } else {
                        $password_err = "La contraseña es incorrecta";
                    }
                }
            } else {
                $email_err = "Este correo no se encuentra registrado, registrate para 
                obtener nuestros beneficios";
            }
        } else {
            echo "Algo salió mal al iniciar sesión, inténtalo más tarde";
        }
    }
    mysqli_close($link);
}