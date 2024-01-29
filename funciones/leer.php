<?php

//Funcion generica para leer el archivo .txt y ponerlo en un array para manejarlo en mas scripts

function leerPedidos(): array
{
    $archivoTxt = fopen("ficheros/pedidos.txt", "r"); //abrimos lectura
    $array = [];

    if ($archivoTxt) { //si existe archivo, continuamos

        while (($linea = fgets($archivoTxt)) !== false) {

            $datos = explode(";", trim($linea)); //separamos los elementos por su separador, en este caso ",

            if (count($datos) == 8) { // el 2 son los elementos del txt, pueden ser menos o mas

                array_push($array, ["id" => $datos[0], "nombre" => $datos[1], "direccion" => $datos[2], "productos" => $datos[3], "cantidad1" => $datos[4], "cantidad2" => $datos[5], "cantidad3" => $datos[6], "fecha" => $datos[7]]);
            }
        }
        fclose($archivoTxt);

        return $array;
    } else {
        return "<p>Error al abrir el archivo.</p>";
    }
}



//Funcion que busca el valor de la cantidad correcto ya que hay tres alores de post que recibimos, las otras son 0

function buscaValue($array)
{
    $resultado = max($array);
    return $resultado;
}




