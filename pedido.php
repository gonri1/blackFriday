<?php

session_start();

//Manejamos variable de session para coger el nombre del user e indicarlo en pantalla

$nameHtml = isset($_SESSION["userHtml"]) ? $_SESSION["userHtml"] : "";


//manejamos entradas de formulario DE PEDIDOS

$nombre = isset($_POST["name"]) ? strip_tags(trim($_POST["name"])) : ""; //nombre
$direccion = isset($_POST["direccion"]) ? strip_tags(trim($_POST["direccion"])) : ""; //direccion
$producto = isset($_POST["producto"]) ? strip_tags(trim($_POST["producto"])) : ""; //producto
$cantidadIphone = isset($_POST["cantidad_iphone"]) ? (int)strip_tags(trim($_POST["cantidad_iphone"])) : 0; //cantidad Iphone
$cantidadRoomba = isset($_POST["cantidad_roomba"]) ? (int)strip_tags(trim($_POST["cantidad_roomba"])) : 0; //cantidad Roomba
$cantidadReloj = isset($_POST["cantidad_reloj"]) ? (int)strip_tags(trim($_POST["cantidad_reloj"])) : 0; //cantidad Reloj
$hora = date("y-m-d"); //sacamos fecha

$nuevasLineas = "$nameHtml;$nombre;$direccion;$producto;$cantidadIphone;$cantidadRoomba;$cantidadReloj;$hora"; //Creamos string pata introducirlo en archivo.txt
//Cuidado con los espacios



//abrimos archivo.txt para escritura y solo se escribira si estan todos los elementos del formulario estan establecidos

if (($nombre && $direccion && $producto && $hora && $nameHtml) && ($cantidadIphone || $cantidadRoomba || $cantidadReloj)) {

    $archivoTxt = fopen("ficheros/pedidos.txt", "a"); //abrimos para escritura append

    fputs($archivoTxt, $nuevasLineas . PHP_EOL);

    fclose($archivoTxt); //cerramos escritura
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

        <!-- header -->
        <header class="text-center">
            <div class="row">
                <div class="col-9 p-3 mb-2">
                    <h1 class="mt-4">Haz tu pedido <span><?php echo $nameHtml ?></span></h1>
                </div>
                <div class="col-2 p-3 mb-2 text-center">
                    <img src="images/logo.jpg" class="rounded img-fluid" alt="imagen de logo black friday">
                </div>
            </div>
        </header>

        <!-- formulario -->
        <div class="row">
            <form class="col-6 mx-auto" method="post" action="#">
                <!-- Nombre-->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <!-- Direccion-->
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección:</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" required>
                </div>

                <!-- Inputs radio-->
                <div class="mb-3">
                    <label class="form-label">Producto:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="producto" id="iphone" value="iphone">
                        <label class="form-check-label" for="iphone">iPhone</label>
                        <input type="number" class="form-control bg-primary-subtle" id="cantidad_iphone" name="cantidad_iphone" min="0">
                    </div>

                    <div class="form-check">
                        <input class="form-check-input bg-light" type="radio" name="producto" id="roomba" value="roomba">
                        <label class="form-check-label" for="roomba">roomba</label>
                        <input type="number" class="form-control bg-primary-subtle" id="cantidad_roomba" name="cantidad_roomba" min="0">
                    </div>

                    <div class="form-check">
                        <input class="form-check-input bg-light" type="radio" name="producto" id="reloj" value="reloj">
                        <label class="form-check-label" for="reloj">reloj</label>
                        <input type="number" class="form-control bg-primary-subtle" id="cantidad_reloj" name="cantidad_reloj" min="0">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>

        <!-- Navegacion -->

        <div class="row">
            <div class="col-6 mx-auto mt-5">
                <a href='mostrarPedidos.php' class='btn btn-warning btn-block'>Ver tus pedidos</a>
                <a href='calcular.php' class='btn btn-warning'>Calcular precio pedido</a>
                <a href='mostrarPedidos.php' class='btn btn-warning btn-block ml-2'>Ver tus pedidos</a>
                <a href='index.php' class='btn btn-danger btn-block'>Sing Out</a>
            </div>
        </div>

         <!-- Footer -->

        <div class="row">
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
    <!-- Footer -->
    </div>
</body>
</html>