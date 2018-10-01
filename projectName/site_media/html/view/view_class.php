<?php

  /******************************************
  *       Conector Vista a Plantilla	     	*
  *       Conector view to template 		    *
  ******************************************/


  	class view{

  			/*
  			*
  			*Metodo get_template
  			*Action: Retorna html en metodo
  			*Parametros: templateName = dirTemplate = (carpeta del archivo), (Nombre de plantilla html)
  			*/
  			function get_template($dirTemplate,$templateName='blank'){

  				//Router de templates + formato 
  				$router = '../../templates/'.$dirTemplate.'/'.$templateName.'.html';

  				/*
  				*	file_get_contents(URL)
  				*	Parametros: URL = (URL del archivo)
  				*
			    *	Action: file_get_contents(variable) permite guardar el texto o contenido dentro
			    *	de una variable, para posteriormente imprimirla y ser traducida
			    */
          $template = file_get_contents($router);

          //Retornar plantilla en metodo
          return $template;
  		  }
       

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
              *  Esquema de array 
              *  $arrayData= array(0 => "nombre",1 => "title");
              *  $remplazar_token = array(0 => "token",1 => "token");
              */         
              
              $newHTML = str_replace($remplazar_token[$i], $arrayData[$i], $htmlTemplate);
              
             } 

             //retorna nuevo html por metodo, listo para imprimir
             return $newHTML;
         }  

    }


          

 ?>