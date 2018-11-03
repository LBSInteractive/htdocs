<?php
error_reporting(0);
header('Content-type: application/json; charset=UTF-8');

if (empty($_GET)) {
    header('HTTP/1.1 417');
    header('Respuesta: Error Inesperado');
    $preRequest = ["statusCode" => 417,"requestToken" => "M","errorText" => "Data Vácia"];
    $RequestFinal = json_encode($preRequest);
    echo($RequestFinal);
} else {
    $Request = $_GET;
    if (empty($Request['nombreArchivoHTML']) || empty($Request['nombreTituloPage']) || empty($Request['faviconName'])) {
        header('HTTP/1.1 400');
        header('Respuesta: Error en la Estrutura');
        $preRequest = ["statusCode" => 400,"requestToken" => "M","errorText" => "Error en la Estrutura"];
        $RequestFinal = json_encode($preRequest);
        echo($RequestFinal);
    } else {
        if ($Request[selectTypeEnd] == 'servicio') {
            if (generarCoreController_HTML($Request[nombreArchivoHTML])) {
                if (generarCoreModel_HTMLAngularJS($Request[nombreArchivoHTML])) {
                    header('HTTP/1.1 200');
                    header('Respuesta: OK');
                    $preRequest = ["statusCode" => 200,"requestToken" => "B","errorText" => "Creado"];
                    $RequestFinal = json_encode($preRequest);
                    echo($RequestFinal);
                } else {
                    header('HTTP/1.1 417');
                    header('Respuesta: Bad');
                    $preRequest = ["statusCode" => 417,"requestToken" => "M","errorText" => "No Creado"];
                    $RequestFinal = json_encode($preRequest);
                    echo($RequestFinal);
                }
            } else {
                header('HTTP/1.1 417');
                header('Respuesta: Bad');
                $preRequest = ["statusCode" => 417,"requestToken" => "M","errorText" => "No Creado"];
                $RequestFinal = json_encode($preRequest);
                echo($RequestFinal);
            }
        } else {
            $nombreHTML = $Request[nombreArchivoHTML];
            $file_name = $nombreHTML.".html";
            $tituloHTML = $Request[nombreTituloPage];
            $faviconHTML = $Request[faviconName];

            if (generarArchivoHTMLAngularJS($nombreHTML, $file_name, $tituloHTML, $faviconHTML)) {
                if (generarArchivoController_HTMLAngularJS($nombreHTML, $file_name, $tituloHTML, $faviconHTML)) {
                    if (generarArchivoCSS_HTMLAngularJS($nombreHTML, $file_name, $tituloHTML, $faviconHTML)) {
                        if (generarCoreController_HTMLAngularJS($nombreHTML)) {
                            if (generarCoreModel_HTMLAngularJS($nombreHTML)) {
                                header('HTTP/1.1 200');
                                header('Respuesta: OK');
                                $preRequest = ["statusCode" => 200,"requestToken" => "B","errorText" => "Creado"];
                                $RequestFinal = json_encode($preRequest);
                                echo($RequestFinal);
                            } else {
                                header('HTTP/1.1 417');
                                header('Respuesta: Bad');
                                $preRequest = ["statusCode" => 417,"requestToken" => "M","errorText" => "No Creado"];
                                $RequestFinal = json_encode($preRequest);
                                echo($RequestFinal);
                            }
                        } else {
                            header('HTTP/1.1 417');
                            header('Respuesta: Bad');
                            $preRequest = ["statusCode" => 417,"requestToken" => "M","errorText" => "No Creado"];
                            $RequestFinal = json_encode($preRequest);
                            echo($RequestFinal);
                        }
                    } else {
                        header('HTTP/1.1 417');
                        header('Respuesta: Bad');
                        $preRequest = ["statusCode" => 417,"requestToken" => "M","errorText" => "No Creado"];
                        $RequestFinal = json_encode($preRequest);
                        echo($RequestFinal);
                    }
                } else {
                    header('HTTP/1.1 417');
                    header('Respuesta: Bad');
                    $preRequest = ["statusCode" => 417,"requestToken" => "M","errorText" => "No Creado"];
                    $RequestFinal = json_encode($preRequest);
                    echo($RequestFinal);
                }
            } else {
                header('HTTP/1.1 417');
                header('Respuesta: Bad');
                $preRequest = ["statusCode" => 417,"requestToken" => "M","errorText" => "No Creado"];
                $RequestFinal = json_encode($preRequest);
                echo($RequestFinal);
            }
        }
    }
}






/****************************  ZONA DE CREACIÓN HTML con AngularJS  *********************************************/


//Funcion
/*
* Funcion: generarArchivoHTMLAngularJS()
* Respuesta: No presenta
* Action: Genera archivo HTML con AngularJS
*/
function generarArchivoHTMLAngularJS($nombreHTML, $file_name, $tituloHTML, $faviconHTML)
{
    if (existeArchivo_Pregunta("../../../site_media/html/templates/".$nombreHTML."_ng/")) {
        return false;
    } else {
        //Crear Carpeta
        mkdir("../../../site_media/html/templates/".$nombreHTML."_ng/", 0700);

        //Direccionar archivo y crear
        //Direccionar
        $router = "../../../site_media/html/templates/".$nombreHTML."_ng/".$file_name;

        //Crear
        $file = fopen($router, "a");

        //Direccionar Plantilla
        $routerTemplate = '../templates/generator_template_html_angularjs.html';

        //Consumir plantilla
        $template = file_get_contents($routerTemplate);

        //Renderizar tokens (Remplaza datos con los tokens)
        //Crear arrays
        $arrayData= array(0 => $nombreHTML , 1 => $tituloHTML, 2 => $faviconHTML, 3 => $nombreHTML, 4 => $nombreHTML);
        $remplazar_token = array(0 => '{nameApp}', 1 => '{pageTitle}', 2 => '{faviconName}', 3 => '{nameController}', 4 => '{personalStyle}');

        //Ejecutar Render
        $newTemplate = get_temaplate_render_dinamic_data($template, $arrayData, $remplazar_token);


        //Escribir en archivo con template
        fwrite($file, $newTemplate);
        fclose($file);
        return true;
    }
}


//Funcion
/*
* Funcion: generarArchivoController_HTMLAngularJS()
* Respuesta: No presenta
* Action: Genera archivo Controller para AngularJS de HTML con AngularJS
*/
function generarArchivoController_HTMLAngularJS($nombreHTML, $file_name, $tituloHTML, $faviconHTML)
{
    if (existeArchivo_Pregunta("../../../site_media/js/".$nombreHTML."Controller/")) {
        return false;
    } else {
        //Crear Controller angular
        mkdir("../../../site_media/js/".$nombreHTML."Controller/", 0700);
        $router2 = "../../../site_media/js/".$nombreHTML."Controller/".$nombreHTML.".js";
        $file2 = fopen($router2, "a");
        $routerTemplate2 = '../templates/generator_template_angular_controller.html';
        $template2 = file_get_contents($routerTemplate2);
        $arrayData2= array(0 => $nombreHTML , 1 => $nombreHTML );
        $remplazar_token2 = array(0 => '{nameApp}', 1 => '{nameApp}' );
        $newTemplate2 = get_temaplate_render_dinamic_data($template2, $arrayData2, $remplazar_token2);
        fwrite($file2, $newTemplate2);
        fclose($file2);
        return true;
    }
}


//Funcion
/*
* Funcion: generarArchivoCSS_HTMLAngularJS()
* Respuesta: No presenta
* Action: Genera archivo Css para HTML con AngularJS
*/
function generarArchivoCSS_HTMLAngularJS($nombreHTML, $file_name, $tituloHTML, $faviconHTML)
{
    if (existeArchivo_Pregunta("../../../site_media/css/".$nombreHTML."_ng/")) {
        return false;
    } else {
        mkdir("../../../site_media/css/".$nombreHTML."_ng/", 0700);
        $routerCSS = "../../../site_media/css/".$nombreHTML."_ng/".$nombreHTML.".css";
        $fileCSS = fopen($routerCSS, "a");
        $routerTemplateCSS = '../templates/generator_template_css.html';
        $templateCSS = file_get_contents($routerTemplateCSS);
        fwrite($fileCSS, $templateCSS);
        fclose($fileCSS);
        return true;
    }
}

//Funcion
/*
* Funcion: generarCoreController_HTMLAngularJS()
* Respuesta: No presenta
* Action: Genera archivo Modulo Controller para HTML con AngularJS
*/
function generarCoreController_HTMLAngularJS($nombreHTML)
{
    if (existeArchivo_Pregunta("../../../site_media/html/modules/".$nombreHTML."MC/")) {
        return false;
    } else {
        mkdir("../../../site_media/html/modules/".$nombreHTML."MC/", 0700);
        $routerController = "../../../site_media/html/modules/".$nombreHTML."MC/".$nombreHTML."Controller.php";
        $fileController = fopen($routerController, "a");
        $routerTemplateController = '../templates/generator_template_controller.html';
        $templateController = file_get_contents($routerTemplateController);
        $arrayData= array(0 => $nombreHTML, 1 => $nombreHTML."_ng" , 2 => $nombreHTML );
        $remplazar_token = array(0 => '{nombreHTML}', 1 => '{nombreRutaTemplate}', 2 => '{nombreArchivoTemplate}' );
        $newTemplate = get_temaplate_render_dinamic_data($templateController, $arrayData, $remplazar_token);
        fwrite($fileController, $newTemplate);
        fclose($fileController);
        return true;
    }
}

//Funcion
/*
* Funcion: generarCoreModel_HTMLAngularJS()
* Respuesta: No presenta
* Action: Genera archivo Modulo Model para HTML con AngularJS
*/
function generarCoreModel_HTMLAngularJS($nombreHTML)
{
    if (existeArchivo_Pregunta("../../../site_media/html/modules/".$nombreHTML."MC/".$nombreHTML."Model.php")) {
        return false;
    } else {
        $routerModel = "../../../site_media/html/modules/".$nombreHTML."MC/".$nombreHTML."Model.php";
        $fileModel = fopen($routerModel, "a");
        $routerTemplateModel = '../templates/generator_template_model.html';
        $templateModel = file_get_contents($routerTemplateModel);
        $arrayData= array(0 => $nombreHTML);
        $remplazar_token = array(0 => '{nombreHTML}');
        $newTemplate = get_temaplate_render_dinamic_data($templateModel, $arrayData, $remplazar_token);
        fwrite($fileModel, $newTemplate);
        fclose($fileModel);
        return true;
    }
}


/****************************  FIN ZONA DE CREACIÓN HTML con AngularJS   *********************************************/





/****************************   ZONA DE CREACIÓN HTML   *********************************************/


//Funcion
/*
* Funcion: generarArchivoHTML()
* Respuesta: No Presenta
* Action: Genera archivo HTML
* Parametros: $nombreHTML,$file_name,$tituloHTML,$faviconHTML (Parametros recibidos en POST)
*/
function generarArchivoHTML($nombreHTML, $file_name, $tituloHTML, $faviconHTML)
{

    //Crear Carpeta
    mkdir("../../../site_media/html/templates/".$nombreHTML."/", 0700);

    //Direccionar archivo y crear
    //Direccionar
    $router = "../../../site_media/html/templates/".$nombreHTML."/".$file_name;

    //Crear
    $file = fopen($router, "a");

    //Direccionar Plantilla
    $routerTemplate = '../templates/generator_template_html.html';

    //Consumir plantilla
    $template = file_get_contents($routerTemplate);

    //Renderizar tokens (Remplaza datos con los tokens)
    //Crear arrays
    $arrayData= array(0 => $nombreHTML , 1 => $faviconHTML, 2 => $nombreHTML);
    $remplazar_token = array(0 => '{pageTitle}', 1 => '{faviconName}',2 => '{personalStyle}');

    //Ejecutar Render
    $newTemplate = get_temaplate_render_dinamic_data($template, $arrayData, $remplazar_token);

    //Escribir en archivo con template
    fwrite($file, $newTemplate);
    fclose($file);
}


//Funcion
/*
* Funcion: generarCoreController_HTMLAngularJS()
* Respuesta: No presenta
* Action: Genera archivo Modulo Controller para HTML con AngularJS
*/
function generarCoreController_HTML($nombreHTML)
{
    if (existeArchivo_Pregunta("../../../site_media/html/modules/".$nombreHTML."MC/")) {
        return false;
    } else {
        mkdir("../../../site_media/html/modules/".$nombreHTML."MC/", 0700);
        $routerController = "../../../site_media/html/modules/".$nombreHTML."MC/".$nombreHTML."Controller.php";
        $fileController = fopen($routerController, "a");
        $routerTemplateController = '../templates/generator_template_controller_api.html';
        $templateController = file_get_contents($routerTemplateController);
        $arrayData= array(0 => $nombreHTML, 1 => $nombreHTML , 2 => $nombreHTML );
        $remplazar_token = array(0 => '{nombreHTML}', 1 => '{nombreRutaTemplate}', 2 => '{nombreArchivoTemplate}' );
        $newTemplate = get_temaplate_render_dinamic_data($templateController, $arrayData, $remplazar_token);
        fwrite($fileController, $newTemplate);
        fclose($fileController);
        return true;
    }
}


/****************************  FIN ZONA DE CREACIÓN HTML   *********************************************/






/****************************  ZONA  VERIFICADORES  *********************************************/

//Funcion con retorno
/*
* Funcion: existeArchivo_Pregunta
* Respuesta: true si existe, false en caso contrario
* Action: No presenta
* Parametros: $file_name (nombre de archivo a crear)
*/
function existeArchivo_Pregunta($file_name)
{
    $estadoTMP = false;
    //verificar existencia
    if (file_exists($file_name)) {
        $estadoTMP = true;
    }
    return $estadoTMP;
}


/****************************  FIN ZONA DE VERIFICADORES CREACIÓN HTML   *********************************************/





/****************************  ZONA METODOS CON RENDER   *********************************************/

/*
*
*Metodo get_temaplate_render_dinamic_data
*Action: Remplaza datos en array
*Parametros: $htmlTemplate = (HTML en variable, se obtiene con metodo getTemplate()) , $arrayData (Datos a cambiar en array),
*            $remplazar_token (Token para identificar remplazo)
*/
function get_temaplate_render_dinamic_data($htmlTemplate, $arrayData = array(), $remplazar_token = array())
{


     //For segun ancho del array data
    for ($i = 0; $i < count($arrayData); $i++) {

      /* str_replace remplaza asi (texto a remplazar,texto, HTML en variable)
      *  str_replace remplaza sin borrar contenido, es decir solo remplaza y se mantiene el texto a exceptuar sus cambios
      *  Debe enviar un getTemplate en $htmlTemplate
      *
      */
        $htmlTemplate = str_replace($remplazar_token[$i], $arrayData[$i], $htmlTemplate);
    }

    //retorna nuevo html por metodo, listo para imprimir
    return $htmlTemplate;
}


/**************************** FIN ZONA METODOS CON RENDER   *********************************************/
