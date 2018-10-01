<?php

/****************************************************************************************************Notas/

Bienvenido, aqui podras configurar tu core de direccionamiento para tu pagian web

/Iniciemos con nombramiento de la carpeta
-Cambia el nombre de la carpeta ProjectName por la que una que este más acorde a tu gusto y al negocio
Cambias el nombre de la carpeta /projectName/


-Ahora puedes realizar una primer petición sobre localhost:puerto /localhost:8080/ y podras ver la
pantalla del generador, (El generador es la herramienta que te permitira crear templates HTML).


Nota: Si deseas bloquear la navegación por tu arbol de trabajo, es decir, por medio de URLs, en ese caso
puedes copiar en la rutas generales o especificas, el archivo index.php es decir este, y mantener el
redireccionamiento al área de logeo.

/****************************************************************************************************FIN Notas*/





/****************************************************************************************************Router*/

/* En esta área puedes realizar diferente redirecciones, tanto para redirect HTTP o HTTPS, o por lo
*  contrario si deseas redireccionar al Generador.
Copiar y pegar el header generico debajo del comentario token router
*/

/*Router Server HTTPS
* Action: forzar direccionamiento por https
*
*     header("Location: https://dominio/projectName/...../Controller");
*
*/


/*Router Server No-HTTP
* Action: forzar direccionamiento por http
*
*     header("Location: http://dominio/projectName/..../Controller");
*
*/


/*Router Server local
* Action: direccionamiento por localhost
*
*     header("Location: /projectName/..../Controller");
*
*/


/*Router Generador
* Action: direccionamiento al generador
*
*
*     header("Location: /projectName/core/generator_files/generator/generator_html.html");
*
*/


                               /**token router**/
header("Location: /projectName/core/generator_files/generators/generator_html.html");


/****************************************************************************************************FIN Router*/





/****************************************************************************************************Pruebas*/

/* Aquí podras realizar test de prueba, donde podras evidenciar ejemplos como el error 404 y su pagina de
redirección correspondiente.
//Copia la linea header prefabricada, descomentala y copiala debajo de pruebas

/*
*  URL para pruebas
*/

 /* Tipo: Error 404
 *  Action: direccionamiento al error 404 Apache por defecto
 *
 *	  header("HTTP/1.0 404 Not Found");
 *
 */


/*
*  Envio de encabezados como Status de pruebas
 /

 /* Tipo: Error 404
 *  Action: direccionamiento al error 404 Apache por defecto
 *
 *	  http_response_code(NumeroStatus);
 *
 *Ejemplo
 *
 *    http_response_code(404);
 *
 */


                            /*pruebas*/
 //http_response_code(200);

/****************************************************************************************************FIN Pruebas*/


 ?>
