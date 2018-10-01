<?php

/*
* Arranque
*/

        //Verificar Checkbox angular
            if (empty($_POST['angular'])){

               //opcion sin angular*****************************************************************************************

                    //Atrapar Varialebles POST
                    $nombreHTML = $_POST['nombreHTML'];

                    if ( !empty($_POST['coreController']) ) {
                      generarCoreController_HTML($nombreHTML);
                      generarCoreModel_HTML($nombreHTML);
                      echo "Se ha generado el Modelo y el Controlador <->";
                      echo " PROCESO FINALIZADO <->";
                    } else {
                      echo " PROCESO FINALIZADO <->";
                    }

            }else{

                //opcion con angular*****************************************************************************************
                //Verificar existencia y valores de los campos
                   if (losCamposEstanVacios_Pregunta()) {
                        echo "Campos vacios, archivo no generado!";
                   }else{
                        //Atrapar Varialebles POST
                        $nombreHTML = $_POST['nombreHTML'];
                        $file_name = $nombreHTML.".html";
                        $tituloHTML = $_POST['tituloHTML'];
                        $faviconHTML = $_POST['faviconHTML'];

                         //Existencia mkdir
                            if (existeArchivo_Pregunta('../../../site_media/html/templates/'.$nombreHTML.'_ng/')) {
                                echo "El directorio del html/template ya existe, por favor eliminelo si desea crearlo.";
                            }else{

                                generarArchivoHTMLAngularJS($nombreHTML,$file_name,$tituloHTML,$faviconHTML);
                                echo "Se ha generado correctamente la plantilla html con AngularJS Implementado <->";

                                if (existeArchivo_Pregunta('../../../site_media/js/'.$nombreHTML.'Controller/')) {
                                   echo "El directorio site_media/js para controller ya existe, por favor elimine el template y el controller si desea crearlo nuevamente.";
                                }else{
                                   generarArchivoController_HTMLAngularJS($nombreHTML,$file_name,$tituloHTML,$faviconHTML);
                                   echo "Se ha generado correctamente el Controller para AngularJS <->";

                                   if (existeArchivo_Pregunta('../../../site_media/css/'.$nombreHTML.'_ng/')) {
                                        echo "El directorio site_media/css ya existe, por favor elimine el template, el controller y el css si desea crearlo nuevamente.";
                                    }else{
                                            generarArchivoCSS_HTMLAngularJS($nombreHTML,$file_name,$tituloHTML,$faviconHTML);
                                            echo "Se ha generado correctamente el CSS <->";
                                            echo " PROCESO FINALIZADO <->";
                                            if ( !empty($_POST['coreController']) ) {
                                              generarCoreController_HTMLAngularJS($nombreHTML);
                                              generarCoreModel_HTMLAngularJS($nombreHTML);
                                              echo "Se ha generado el Modelo y el Controlador <->";
                                              echo " PROCESO FINALIZADO <->";
                                            } else {
                                              echo " PROCESO FINALIZADO <->";
                                            }
                                    }
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
            function generarArchivoHTMLAngularJS($nombreHTML,$file_name,$tituloHTML,$faviconHTML){

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
            }


            //Funcion
            /*
            * Funcion: generarArchivoController_HTMLAngularJS()
            * Respuesta: No presenta
            * Action: Genera archivo Controller para AngularJS de HTML con AngularJS
            */
            function generarArchivoController_HTMLAngularJS($nombreHTML,$file_name,$tituloHTML,$faviconHTML){

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
            }


            //Funcion
            /*
            * Funcion: generarArchivoCSS_HTMLAngularJS()
            * Respuesta: No presenta
            * Action: Genera archivo Css para HTML con AngularJS
            */
            function generarArchivoCSS_HTMLAngularJS($nombreHTML,$file_name,$tituloHTML,$faviconHTML){
                mkdir("../../../site_media/css/".$nombreHTML."_ng/", 0700);
                $routerCSS = "../../../site_media/css/".$nombreHTML."_ng/".$nombreHTML.".css";
                $fileCSS = fopen($routerCSS, "a");
                $routerTemplateCSS = '../templates/generator_template_css.html';
                $templateCSS = file_get_contents($routerTemplateCSS);
                fwrite($fileCSS, $templateCSS);
                fclose($fileCSS);
            }

            //Funcion
            /*
            * Funcion: generarCoreController_HTMLAngularJS()
            * Respuesta: No presenta
            * Action: Genera archivo Modulo Controller para HTML con AngularJS
            */
            function generarCoreController_HTMLAngularJS($nombreHTML){
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
            }

            //Funcion
            /*
            * Funcion: generarCoreModel_HTMLAngularJS()
            * Respuesta: No presenta
            * Action: Genera archivo Modulo Model para HTML con AngularJS
            */
            function generarCoreModel_HTMLAngularJS($nombreHTML){
                mkdir("../../../site_media/html/modules/".$nombreHTML."MC/", 0700);
                $routerModel = "../../../site_media/html/modules/".$nombreHTML."MC/".$nombreHTML."Model.php";
                $fileModel = fopen($routerModel, "a");
                $routerTemplateModel = '../templates/generator_template_model.html';
                $templateModel = file_get_contents($routerTemplateModel);
                    $arrayData= array(0 => $nombreHTML);
                    $remplazar_token = array(0 => '{nombreHTML}');
                    $newTemplate = get_temaplate_render_dinamic_data($templateModel, $arrayData, $remplazar_token);
                fwrite($fileModel, $newTemplate);
                fclose($fileModel);
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
            function generarArchivoHTML($nombreHTML,$file_name,$tituloHTML,$faviconHTML){

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
            * Funcion: generarArchivoCSS_HTML()
            * Respuesta: No Presenta
            * Action: Genera archivo CSS para HTML
            */
            function generarArchivoCSS_HTML($nombreHTML,$file_name,$tituloHTML,$faviconHTML){
                   mkdir("../../../site_media/css/".$nombreHTML."/", 0700);
                   $routerCSS = "../../../site_media/css/".$nombreHTML."/".$nombreHTML.".css";
                   $fileCSS = fopen($routerCSS, "a");
                   $routerTemplateCSS = '../templates/generator_template_css.html';
                   $templateCSS = file_get_contents($routerTemplateCSS);
                   fwrite($fileCSS, $templateCSS);
                   fclose($fileCSS);
            }

            //Funcion
            /*
            * Funcion: generarCoreController_HTMLAngularJS()
            * Respuesta: No presenta
            * Action: Genera archivo Modulo Controller para HTML con AngularJS
            */
            function generarCoreController_HTML($nombreHTML){
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
            }

            //Funcion
            /*
            * Funcion: generarCoreModel_HTMLAngularJS()
            * Respuesta: No presenta
            * Action: Genera archivo Modulo Model para HTML con AngularJS
            */
            function generarCoreModel_HTML($nombreHTML){
                mkdir("../../../site_media/html/modules/".$nombreHTML."MC/", 0700);
                $routerModel = "../../../site_media/html/modules/".$nombreHTML."MC/".$nombreHTML."Model.php";
                $fileModel = fopen($routerModel, "a");
                $routerTemplateModel = '../templates/generator_template_model.html';
                $templateModel = file_get_contents($routerTemplateModel);
                    $arrayData= array(0 => $nombreHTML);
                    $remplazar_token = array(0 => '{nombreHTML}');
                    $newTemplate = get_temaplate_render_dinamic_data($templateModel, $arrayData, $remplazar_token);
                fwrite($fileModel, $newTemplate);
                fclose($fileModel);
            }


/****************************  FIN ZONA DE CREACIÓN HTML   *********************************************/









/****************************  ZONA  VERIFICADORES  *********************************************/

            //Funcion con retorno
            /*
            * Funcion: losCamposEstanVacios_Pregunta
            * Respuesta: return true si estan vacios, false en caso contrario
            * Action: No presenta
            */
            function losCamposEstanVacios_Pregunta(){
                //Inicializar estado en false
                $estadoTMP = false;

                //Verificar campos sin inicialización
                if (isset($_POST['nombreHTML']) || isset($_POST['tituloHTML']) || isset($_POST['tituloHTML'])) {
                    //Verificar campos no vacios
                      if ($_POST['nombreHTML'] == '' || $_POST['tituloHTML'] == '' || $_POST['tituloHTML'] == 'faviconHTML'){
                        //Cambiar estado a true
                        $estadoTMP = true;
                     }

                }else{
                    //Cambiar estado a true
                      $estadoTMP = true;
                }

                //Retornar resultado
                return $estadoTMP;
            }


            //Funcion con retorno
            /*
            * Funcion: existeArchivo_Pregunta
            * Respuesta: true si existe, false en caso contrario
            * Action: No presenta
            * Parametros: $file_name (nombre de archivo a crear)
            */
            function existeArchivo_Pregunta($file_name){
            		$estadoTMP = false;
            		//verificar existencia
					if (file_exists($file_name)){
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
            function get_temaplate_render_dinamic_data($htmlTemplate, $arrayData = array(), $remplazar_token = array()) {


                 //For segun ancho del array data
                 for ($i = 0; $i < count($arrayData); $i++ ){

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

?>
