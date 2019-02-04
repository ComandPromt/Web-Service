<?php
date_default_timezone_set ('Europe/Madrid');
require_once('nusoap/lib/nusoap.php');
$miURL = 'http://localhost/ejemplows';
$server = new soap_server();
$server->configureWSDL('miservicioweb', $miURL);
$server->wsdl->schemaTargetNamespace=$miURL;
/*
 *  Ejemplo 1: Enviar_respuesta es una funcion sencilla que recibe un parametro y retorna el mismo
 *  con un string anexado
 */
$server->register('enviar_respuesta', // Nombre de la funcion
				   array('parametro' => 'xsd:string'), // Parametros de entrada
			       array('return' => 'xsd:string'), // Parametros de salida
				   $miURL);
                   

function enviar_respuesta($parametro){
	return new soapval('return', 'xsd:string', 'Hola, esto lo envia el Servidor: '.$parametro);
}

//----------------------------------------------------------------------------------------------
/*
Ejemplo 2: guardo datos que recibo de cualquier dispositivo en la base de datos
*/


$server->register('registrar_datos', // Nombre de la funcion
				   array('parametro' => 'xsd:string','parametro2' => 'xsd:string','parametro3' => 'xsd:string'), // Parametros de entrada
                   array('return' => 'xsd:string'), // Parametros de salida
               	   $miURL);

function registrar_datos($parametro,$parametro2,$parametro3){
    
    //recibo el dato enviado por el celular, ahora pongo un mensaje en la variable_accion
    
    $indicador_registro="No";
    
    include ("funciones.inc.php"); // llama el archivo funciones.inc.php donde le hace la conexion con la BD
    $link =conectar(); // Se llama la funcion conectar(); que establece la conexi?n
    mysqli_select_db($link,"datos_webservice");//Fuci?nque seleciona la base de datos
   
          
            $cad="insert into datos values ('0','$parametro','$parametro2','$parametro3')";
           
           
           if($result= mysqli_query ($link, $cad))  //ejecut la consulta a la base de datos
           {
             $indicador_registro="Si";
           }
           else{
            print mysqli_error();//Imprime un mensaje error en el caso de algun problem
            }           
            
	return new soapval('return', 'xsd:string',$indicador_registro);
}

//***********************************************************************************
               
/*
Ejemplo 3: Busco los datos a traves de la cedula que recibo como parametro
*/
//########################################################

$server->register('buscar_datos', // Nombre de la funcion
				   array('cedula' => 'xsd:string'), // Parametros de entrada
                   array('return' => 'xsd:string'), // Parametros de salida
               	   $miURL);               
            
function buscar_datos($cedula){
    
    //recibo el dato enviado por el celular, ahora pongo un mensaje en la variable_accion
    
    $encontro="No";
    
    include ("funciones.inc.php"); // llama el archivo funciones.inc.php donde le hace la conexion con la BD
    $link =conectar(); // Se llama la funcion conectar(); que establece la conexi?n
    mysqli_select_db($link,"datos_webservice");//Fuci?nque seleciona la base de datos
   
     $recibe = "select * from datos where cedula='$cedula'";//string que almacena l aconsulta a ejecutar
     $result= mysqli_query ($link,$recibe);//ejecut la consulta a la base de datos
         
        while ($f=mysqli_fetch_row($result)){ // Convertimos el resultado en un vector
             $encontro="Si";
         }          
          
       
	return new soapval('return', 'xsd:string',$encontro);
}   


//############### Si los datos fueron encontrados procedo a mostrarlos independientemente ###############
  
//                             Muestro La Cedula                   //  
               
$server->register('mostrar_datos_cedula', // Nombre de la funcion
				   array('cedula' => 'xsd:string'), // Parametros de entrada
                   array('return' => 'xsd:string'), // Parametros de salida
               	   $miURL);               
            
function mostrar_datos_cedula($cedula){
    
    //recibo el dato enviado por el celular, ahora pongo un mensaje en la variable_accion
        
    include ("funciones.inc.php"); // llama el archivo funciones.inc.php donde le hace la conexion con la BD
    $link =conectar(); // Se llama la funcion conectar(); que establece la conexi?n
    mysqli_select_db($link,"datos_webservice");//Fuci?nque seleciona la base de datos
   
     $recibe = "select * from datos where cedula='$cedula'";//string que almacena l aconsulta a ejecutar
     $result= mysqli_query ($link,$recibe);//ejecut la consulta a la base de datos
         
        while ($f=mysqli_fetch_row($result)){ // Convertimos el resultado en un vector
            $valor_retorno= $f[1];       
        }          
          
       
	return new soapval('return', 'xsd:string',$valor_retorno);
}               
               
               
//############### Si los datos fueron encontrados procedo a mostrarlos independientemente ###############

//                             Muestro el Nombre                   //  

$server->register('mostrar_datos_nombre', // Nombre de la funcion
				   array('cedula' => 'xsd:string'), // Parametros de entrada
                   array('return' => 'xsd:string'), // Parametros de salida
               	   $miURL);               
            
function mostrar_datos_nombre($cedula){
    
    //recibo el dato enviado por el celular, ahora pongo un mensaje en la variable_accion

    include ("funciones.inc.php"); // llama el archivo funciones.inc.php donde le hace la conexion con la BD
    $link =conectar(); // Se llama la funcion conectar(); que establece la conexi?n
    mysqli_select_db($link,"datos_webservice");//Fuci?nque seleciona la base de datos
   
     $recibe = "select * from datos where cedula='$cedula'";//string que almacena l aconsulta a ejecutar
     $result= mysqli_query ($link,$recibe);//ejecut la consulta a la base de datos
         
        while ($f=mysqli_fetch_row($result)){ // Convertimos el resultado en un vector
            $valor_retorno= $f[2];
                  
        }          
          
       
	return new soapval('return', 'xsd:string',$valor_retorno);
}

//############### Si los datos fueron encontrados procedo a mostrarlos independientemente ###############

//                             Muestro Los Apellidos                  //  

$server->register('mostrar_datos_apellido', // Nombre de la funcion
				   array('cedula' => 'xsd:string'), // Parametros de entrada
                   array('return' => 'xsd:string'), // Parametros de salida
               	   $miURL);               
            
function mostrar_datos_apellido($cedula){
    
    //recibo el dato enviado por el celular, ahora pongo un mensaje en la variable_accion
    
    include ("funciones.inc.php"); // llama el archivo funciones.inc.php donde le hace la conexion con la BD
    $link =conectar(); // Se llama la funcion conectar(); que establece la conexi?n
    mysqli_select_db($link,"datos_webservice");//Fuci?nque seleciona la base de datos
   
     $recibe = "select * from datos where cedula='$cedula'";//string que almacena l aconsulta a ejecutar
     $result= mysqli_query ($link,$recibe);//ejecut la consulta a la base de datos
         
        while ($f=mysqli_fetch_row($result)){ // Convertimos el resultado en un vector
            $valor_retorno= $f[3];      
        }          
           
	return new soapval('return', 'xsd:string',$valor_retorno);
}                                             
               
//......................................................................................               
               
$server->service($HTTP_RAW_POST_DATA);
//registrar_datos("aaa","dsdd","sdsdsd");


?>