<?php
session_start();

require_once "funciones/leer.php";

//Manejamos datos de formulario

$nombres = isset($_POST["nombres"]) ? $_POST["nombres"] : "";

//Metemos el el array del .txt en una variable para usar el array con los datos de los users

$arrayToCalculate = leerPedidos();

//Funcion para imprimir el select

function printSelect($pedidos)
{
    $uniqueValues = array();  // Usaremos un array para rastrear los valores únicos
    $output = "";

    foreach ($pedidos as $value) {
        $id = $value["id"];

        // Verificar si el valor ya está en el conjunto de valores únicos
        
        if (!in_array($id, $uniqueValues)) {
            $uniqueValues[] = $id;  // Agregar el valor único al conjunto

            // Construir la opción HTML
            $output .= "<option value='" . $id . "'>" . $id . "</option>";
        }
    }

    return $output;
}


//Funcion que calcula el costo total de los pedidos por user y imprime una card

function calcularCostoTotalBusqueda($pedidos)
{
    $costoTotal = 0;
    $output1 = "";
    $output2 = 0;
    $cantidadTotal = 0;
    $nombres = isset($_POST["nombres"]) ? $_POST["nombres"] : "";

    foreach ($pedidos as $pedido) {

        $producto = trim($pedido["productos"]);
        $cantidad1 = (int)trim($pedido["cantidad1"]);
        $cantidad2 = (int)trim($pedido["cantidad2"]);
        $cantidad3 = (int)trim($pedido["cantidad3"]);


        if ($pedido["id"] == $nombres) {

            $output1 .= "<div class='card mb-3' style='width: 18rem;'>
            <ul class='list-group list-group-flush '>";
            if ($producto === "iphone") {
                $costoTotal = $cantidad1 * 1000;
                $output1 .= "<li class='list-group-item '><span class='cantidad'>" . $cantidad1 . "</span> Unidades IPHONE</li>";
                $output1 .= "<li class='list-group-item'>Coste Total de <span>" . $costoTotal . "€</span></li>";
                $output2 = $output2 + $costoTotal;
            } elseif ($producto === "roomba") {
                $costoTotal = $cantidad2 * 500;
                $output1 .= "<li class='list-group-item '><span class='cantidad'>" . $cantidad2 . "</span> Unidades ROOMBA</li>";
                $output1 .= "<li class='list-group-item'>Coste Total de <span>" . $costoTotal . "€</span></li>";
                $output2 = $output2 + $costoTotal;
            } elseif ($producto === "reloj") {
                $costoTotal += $cantidad3 * 100;
                $output1 .= "<li class='list-group-item '><span class='cantidad'>" . $cantidad3 . "€</span> Unidades RELOJ</li>";
                $output1 .= "<li class='list-group-item'>Coste Total de <span>" . $costoTotal . "€</span></li>";
                $output2 = $output2 + $costoTotal;
            }
            $output1 .= "</ul>";
            $output1 .= "</div>";
        } elseif ($nombres == "") {

            if ($producto === "iphone") {
                $cantidadTotal += (int)$cantidad1 * 1000;
            } elseif ($producto === "roomba") {
                $cantidadTotal += (int)$cantidad2 * 500;
            } elseif ($producto === "reloj") {
                $cantidadTotal += (int)$cantidad3 * 100;
            }
            $output2 = $cantidadTotal;
        }
    }

    return [$output1, $output2];
}

$resultado = calcularCostoTotalBusqueda($arrayToCalculate);

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

        span.cantidad {
            color: black;
            font-size: x-large;
        }
    </style>
</head>

<body>
    <div class="container-fluid">

        <!-- header -->
        <header class="text-center">
            <div class="row">
                <div class="col-6 offset-3 p-3 mb-2 text-center">
                    <img src="images/logo.jpg" class="rounded img-fluid" alt="imagen de logo black friday">
                </div>
            </div>
            <div class="row">
                <div class="col-12 p-3 mb-2">
                    <h1 class="mt-4">PEDIDOS</h1>
                </div>
            </div>
        </header>

        <!-- formulario -->
        <section>
            <div class="row border-bottom">
                <div class="col-5 offset-2 p-3 mb-2 text-center mx-auto">
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="nombre" class="form-label">Nombre</label>
                            <select class="form-control" name="nombres" id="nombre">
                                <option value="">Selecciona Un pedido</option>
                                <?php echo printSelect($arrayToCalculate); ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-6 offset-3 mt-3">
                                <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Impresion cards con pedidos y costes -->
        <section>
            <div class="row  mt-4 border-bottom">
                <div class="col-4">
                    <?php echo $resultado[0] ?>
                </div>
                <div class="col-5">
                    <div class="card ms-5" style="width: 18rem;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item fs-2 ">Total: <?php echo $resultado[1] ?>€ </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Navegacion -->
        <nav>
            <div class="row ms-5">
                <div class="col-6 mx-auto mt-5">
                    <a href='pedido.php' class='btn btn-warning ml-2'>Hacer mas pedidos</a>
                    <a href='mostrarPedidos.php' class='btn btn-warning btn-block ml-2'>Ver tus pedidos</a>
                    <a href='calcular.php' class='btn btn-warning'>Calcular precio pedido</a>
                    <a href='index.php' class='btn btn-danger ml-2'>Sing Out</a>
                </div>
            </div>
        </nav>

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