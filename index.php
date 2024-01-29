<?php
session_start();

//Filtramos datos recibidos por formulario

$nombre = isset($_POST["username"]) ? strip_tags(trim($_POST["username"])) : "";
$password = isset($_POST["password"]) ? strip_tags(trim($_POST["password"])) : "";

//Establecemos variable de session

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $_SESSION['acceso'] = true;
} else {
    $_SESSION['acceso'] = false;
}

$_SESSION["userHtml"]=$nombre;



//leemos datos de CLAVE.TXT donde estan las claves y nos devuelve un array con los valores para manejarlos

function lecturaPass(): array
{
    $archivoTxt = fopen("ficheros/clave.txt", "r"); //abrimos lectura
    $array = [];

    if ($archivoTxt) { //si existe archivo, continuamos

        while (($linea = fgets($archivoTxt)) !== false) {

            $datos = explode(";", trim($linea)); //separamos los elementos por su separador, en este caso ","

            if (count($datos) == 2) { // el 2 son los elementos del txt, pueden ser menos o mas

                array_push($array, ["user" => $datos[0], "pass" => $datos[1]]);
            }
        }
        fclose($archivoTxt);

        return $array;
    } else {
        return "<p>Error al abrir el archivo.</p>";
    }
}

//Acceso

function PrintHtml($nom, $pass): mixed
{
    if ($_SESSION['acceso'] == false) {//Si la sesion no esta establecida (sin valores POST), en pantalla el Form SIGN IN

        return "<div class='row'>
                <div class='col-4 mx-auto'>
                    <form method='post' action='#'>
                        <div class='form-group'>
                            <label for='username'>Usuario:</label>
                            <input type='text' class='form-control bg-light' id='username' name='username' required>
                        </div>
                        <div class='form-group'>
                            <label for='password'>Clave:</label>
                         
                            <input type='password'class='form-control bg-light' id='password' name='password' aria-describedby='passwordHelpBlock' required>
                            <small id='passwordHelpBlock' class='form-text text-muted'>
                             Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </small>
                        </div>
                        <button type='submit' class='btn btn-primary btn-sm'>Sing in</button>
                    </form>
                </div>
            </div>";
    } elseif ($_SESSION['acceso'] == true) {

        $arrayToUse = lecturaPass(); //Sacamos los datos del array con los elementos de clave.txt

        foreach ($arrayToUse as $value) {//Si la sesion esta establecida, en pantalla LOS BOTONES DE OPCIONES VARIOS

            if ($value["user"] == $nom && $value["pass"] == $pass) {

                return "<nav>
                        <div class='row'>
                          <div class='col-9 mx-auto mt-5'><h2 class='mb-5'>Bienvenido usuario <span>" . $value["user"] . "</span></h2>
                           <a href='pedido.php' class='btn btn-success mr-2'>Hacer Pedido</a>
                           <a href='mostrarPedidos.php' class='btn btn-success mr-2'>Mostrar pedidos</a>
                           <a href='calcularPrecio.php' class='btn btn-success mr-2'>Calcular precio del pedido</a>
                           <a href='sorteo.php' class='btn btn-success mr-2'>Sorteo del pedido</a> </div>
                          </div>
                        </div>
                        <div class='row'>
                          <div class='col-9 mx-auto mt-5'>
                           <a href='index.php' class='btn btn-warning ml-2'>Sign out</a>
                          </div>
                        </div>
                    </nav>";
            }
        }
        return header('Location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Formulario de Inicio de Sesión</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        h1 {
            text-shadow: 1px 1px whitesmoke;
        }

        span {
            color: blue;
            font-size: large;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!--Encabezado -->

        <header>
            <div class="row">
                <div class=" col-5 p-3 mb-2 text-center mx-auto">
                    <img src="images/logo.jpg" class=" rounded img-fluid" alt="imagen de logo black friday">
                </div>
            </div>

        </header>
        <!--Formulario de sign in o botones de eleccion -->

        <section>
            <?php echo PrintHtml($nombre, $password) ?>
        </section>
        <div class="p-3 mb-2 text-center shadow p-3 mb-1 bg-body rounded">
        </div>

        <!-- Footer -->
        <footer class="text-center text-lg-start bg-body-tertiary text-muted">
            <!-- Section: Social media -->
            <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                <!-- Left -->

                <!-- Left -->

                <!-- Right -->
                <div>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
                <!-- Right -->
            </section>
            <!-- Section: Social media -->

            <!-- Section: Links  -->
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                <i class="fas fa-gem me-3"></i>Company name
                            </h6>
                            <p>
                                Here you can use rows and columns to organize your footer content. Lorem ipsum
                                dolor sit amet, consectetur adipisicing elit.
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Products
                            </h6>
                            <p>
                                <a href="#!" class="text-reset">Angular</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">React</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Vue</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Laravel</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Useful links
                            </h6>
                            <p>
                                <a href="#!" class="text-reset">Pricing</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Settings</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Orders</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Help</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                            <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                            <p>
                                <i class="fas fa-envelope me-3"></i>
                                info@example.com
                            </p>
                            <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                            <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>
            <!-- Section: Links  -->

            <!-- Copyright -->
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2021 Copyright:
                <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
</body>

</html>