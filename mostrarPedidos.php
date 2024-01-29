<?php
session_start();

require_once "funciones/leer.php";

//Manejamos variable de session para coger el nombre del user

$nameHtml = isset($_SESSION["userHtml"]) ? $_SESSION["userHtml"] : "";


//Funcion para imprimir Html las cards de los pedidos

function printPedidos(): string
{

    $arrayToUse = leerPedidos(); // Asumiendo que lecturaPedidos() está definida y devuelve un array
    $output = "";


    foreach ($arrayToUse as $value) {

        $nameHtml = $_SESSION["userHtml"];

        if ($value["id"] == $nameHtml) {
            $arraycantidades = [$value["cantidad1"], $value["cantidad2"], $value["cantidad3"]];


            $output .= "<div class='col-3 mt-4 ms-4'>
                         <div class='card' style='width: 18rem;'>
                            <div class='card-body '>
                                <h5 class='card-title'>" . $value["nombre"] . "</h5> 
                                <h6 class='card-subtitle mb-2 text-secondary'>" . $value["direccion"] . "</h6>
                                <br>
                                <h6 class='card-subtitle mb-2 text-secondary'>Producto:" . strtoupper($value["productos"]) . "</h6>
                                <br>
                                <h6 class='card-subtitle mb-2 text-secondary'>Cantidad; " . buscaValue($arraycantidades) . "</h6>
                                <h6 class='card-subtitle mb-2 text-secondary'>Fecha: " . $value["fecha"] . "</h6>                     
                            </div>
                        </div>
                      </div>";
        }
    }

    return $output;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Formulario de Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        span {
            color: blue;
            font-size: large;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!--   header -->
        <header>
            <div class="row">
                <div class="col-9 p-3 mb-2 text-center">
                    <h1 class="mt-4">Tus pedidos <span><?php echo $nameHtml ?></span></h1>
                </div>
                <div class="col-2 p-3 mb-2 text-center">
                    <img src="images/logo.jpg" class="rounded img-fluid" alt="imagen de logo black friday">
                </div>
            </div>
        </header>

        <!--   Seccion de Cards con Pedidos -->
        <section>
            <div class="row">
                <?php echo printPedidos() ?>
            </div>
        </section>

        <!--   Nav -->
        <div class="row">
            <div class="col-6 mx-auto mt-5">
                <a href='calcular.php' class='btn btn-warning'>Calcular precio pedido</a>
                <a href='busquedaPedidos.php' class='btn btn-warning btn-block ml-2'>Buscar pedidos</a>
                <a href='index.php' class='btn btn-danger btn-block'>Sing Out</a>
            </div>
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
    </div>

</body>

</html>