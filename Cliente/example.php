<?php
include_once ("SoapClient.php" );
$servicio="http://localhost/ejemplows/servicio_web.php?wsdl"; //url del servicio
/*$parametros=array(); //parametros de la llamada
$parametros['idioma']="es";
$parametros['usuario']="root";
$parametros['clave']="rootroot";
*/
$client = new SoapClient($servicio,  [ "trace" => 1 ]);
$result = $client->mostrar_datos_cedula("aaa");//llamamos al métdo que nos interesa con los parámetros
?>