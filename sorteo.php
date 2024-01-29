<?php
session_start();

require_once "funciones/leer.php";


//Manejamos datos de formulario

$nombres = isset($_POST["check"]) ? $_POST["check"] : "";


//Manejamos variables de Session

if ($nombres) {
    $_SESSION["status"] = true;
} else {
    $_SESSION["status"] = false;
}


$arrayToCalculate = leerPedidos(); //Nos traemos el array que lee el archivo .txt


//Funcion que nos muestra los participantes.

function mostrarParticipantes($array)
{
    $output = "";
    $output .= '<div class="card">';
    $output .= '<div class="card-header font-weight-bold">PARTICIPANTES</div>';
    $output .= '<ul class="list-group list-group-flush">';
    for ($i = 0; $i < count($array); $i++) {
        $output .= '<li class="list-group-item">' . $array[$i] . '</li>';
    }
    $output .= '</ul>';
    $output .= '</div>';

    return $output;
}

$arrayUsers = [];

foreach ($arrayToCalculate as $value) {
    array_push($arrayUsers, $value["id"]);
}

//Quitamos los id repetidos

$uniqueValues = [];

for ($i = 0; $i < count($arrayUsers); $i++) {

    if (!in_array($arrayUsers[$i], $uniqueValues)) {
        $uniqueValues[] = $arrayUsers[$i];  // Agregar el valor único al conjunto
    }
}

if ($_SESSION["status"] == true) {

    function sorteo($array)
    {
        $participantes = count($array);
        $numero = random_int(0, $participantes - 1);
        return $array[$numero];
    }

    $ganador = sorteo($uniqueValues);

    header("Location: ganador.php?ganador=" . $ganador);
    exit;
} elseif ($_SESSION["status"] == false) {
    $ganador = "";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sorteo de Pedido Gratis</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .card {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid text-center mt-5">

        <!-- Encabezado -->
        <div class="row">
            <div class="col">
                <img src="images/sorteo2.jpg" class="img-fluid" alt="Responsive image">
            </div>
        </div>

        <!-- Formulario -->

        <div class="row mt-5">
            <div class="col">
                <form action="#" method="post" class="mb-4">
                    <label for="pregunta" class="mr-2">Empieza el sorteo</label>
                    <input type="checkbox" name="check" value="true" checked>
                    <input type="submit" value="Pulsa" class="btn btn-primary ml-2">
                </form>
            </div>
        </div>

        <!-- Participantes -->
        <section>
            <div class="row">
                <div class="col-4 mx-auto">
                    <?php echo mostrarParticipantes($uniqueValues) ?>
                </div>
            </div>
        </section>


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