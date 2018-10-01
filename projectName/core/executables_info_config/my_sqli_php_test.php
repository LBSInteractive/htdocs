<!DOCTYPE html>
<html>

<head>
    <title>Connect Test DB & Library MySqli Test </title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta name="keywords" content="pagina web, web, test, db, data base">  
    <meta name="description" content="Test para base de datos, data base test">
    <meta name="author" content="Jefersson Ramos & Brayan Murillo">
    <link rel="shortcut icon" type="image/png" href="../../../site_media/img/favicon/database.png"/>
    
</head>


<body>

   
<?php
/**
 *Clase para testiar libreria MySQLi y testeo de conexion a base de datos
 */

class mySqlTest {
 

         //Declaración de variables para conexión
         private $hostName;
         private $userName;
         private $passwordDB;
         private $nameDB;

         //Declaración variables mensajes
         private $mensaje1ParteInicial;
         private $mensaje1ParteMedia;
         private $mensaje1ParteFinal;
         private $mensaje2ParteInicial;
         private $mensaje2ParteMedia;
         private $mensaje2ParteFinal;

         //Declaracion de variables finales - estados
         const DESACTIVADO = "Desactivado";
         const ACTIVADO = "Activado";
         const DESCONOCIDO = "No encontrado";
         const CONOCIDO = "Encontrado";
         const ERROR = "Error";
         const VALIDO = "Realizado";
        

        //Constructor
        function __construct(){
            /*Local varial

            $this->hostName = 'localhost';
            $this->userName = 'root';
            $this->passwordDB = 'toor';
            $this->nameDB = 'default';
            */

            /*Host Varial

            $this->hostName = 'mysql.hostinger.co';
            $this->userName = 'u948420309_esbdc';
            $this->passwordDB = 'WS5aqAw/Uhxouf#+Oz';
            $this->nameDB = 'u948420309_esbdc';
            */

            //HOST 
            $this->hostName = 'localhost';
            $this->userName = 'root';
            $this->passwordDB = '';
            $this->nameDB = 'nameDB';


            /******************************************************/
            $this->mensaje1ParteInicial = 'Extensión MySQLi:';
            $this->mensaje1ParteMedia = 'Metodo MySQLi:';
            $this->mensaje1ParteFinal = 'MySQLi ';

            $this->mensaje2ParteInicial = 'Conexión base de datos:';
            $this->mensaje2ParteMedia = 'Conectando a:';
            $this->mensaje2ParteFinal = 'BD:';
            /******************************************************/
        
        }


/****************************** ZONA TEST **************************************************/

        /*
        *
        *Metodo do_Mysqli_Test()
        *Action: Prueba y retorna mensaje sobre existencia de MySQLi
        *Parametros: No presenta
        */    
         function do_Mysqli_Test(){

            //function_exiists valida si existe al funcion mysqli_init en php 
            //extension_load valida la carga de la extension PHP    
            if( function_exists('mysqli_init') && extension_loaded('mysqli') ){
                $mensaje = $this->mensaje1ParteInicial.self::ACTIVADO."\n--\n".$this->mensaje1ParteMedia.self::CONOCIDO."\n--\n".$this->mensaje1ParteFinal.self::ACTIVADO;
            }else{
                $mensaje = $this->mensaje1ParteInicial.self::DESACTIVADO."\n--\n".$this->mensaje1ParteMedia.self::DESCONOCIDO."\n--\n".$this->mensaje1ParteFinal.self::DESACTIVADO; 
            }
             return $mensaje;

         }




         /*
         *
         *Metodo do_test_connect()
         *Action: Prueba Conexión a base de datos y retorna mensaje de resultado
         *Parametros: No presenta
         */    
         function do_test_connect() {

            //Nueva conexión
            $connectionMySQLi = new mysqli($this->hostName,$this->userName,$this->passwordDB, $this->nameDB);
             
            //Verificar resultado de conector 
            if (!$connectionMySQLi->connect_errno) {
                $mensaje = $this->mensaje2ParteInicial.self::ACTIVADO."\n--\n".$this->mensaje2ParteMedia.$this->hostName."\n--\n".$this->mensaje1ParteFinal.self::ACTIVADO;
            }else{
                $mensaje = $this->mensaje2ParteInicial.self::DESACTIVADO."\n--\n".$this->mensaje2ParteMedia.$this->hostName."\n--\n".$this->mensaje2ParteFinal.self::DESACTIVADO;


            }   
            return $mensaje;
          

         }

/****************************** FIN ZONA TEST **************************************************/










/****************************** ZONA SET & GET **************************************************/
        
         /*
        *
        *Metodo do_Mysqli_Test()
        *Action: modifica item de conexion y retorna mensaje
        *Parametros: $item (nombre de variable a modificar), $valorCambio (valor de remplazo)
        */
         function set_Item(string $item,string $valorCambio){
            $mensajeEstado;
            switch ($item) {
               
                case 'hostName':
                    $this->hostName = $valorCambio;
                    $mensajeEstado = 'Se ha '.self::VALIDO." el cambio a $item"." por $valorCambio"."\n--\n".'Estado del cambio:'.self::VALIDO;
                    break;
                case 'userName':
                    $this->userName = $valorCambio;
                    $mensajeEstado = 'Se ha '.self::VALIDO." el cambio a $item"." por $valorCambio"."\n--\n".'Estado del cambio:'.self::VALIDO;
                    break; 
                case 'passwordDB':
                    $this->passwordDB = $valorCambio;
                    $mensajeEstado = 'Se ha '.self::VALIDO." el cambio a $item"." por $valorCambio"."\n--\n".'Estado del cambio:'.self::VALIDO;
                    break; 
                case 'nameDB':
                    $this->nameDB = $valorCambio;
                    $mensajeEstado = 'Se ha '.self::VALIDO." el cambio a $item"." por $valorCambio"."\n--\n".'Estado del cambio:'.self::VALIDO;
                    break;    
                default:
                    $mensajeEstado = self::ERROR;
                    break;
            }
            return $mensajeEstado;
         }


         /*
         *
         *Metodo get_Item()
         *Action: Retorna mensaje con valor de variable
         *Parametros: $nombreVariable (nombre de la variable), $objetoClaseMySqlTest (objeto de clase, instancia)
         */ 
         function get_Item(string $nombreVariable, mySqlTest $objetoClaseMySqlTest){

            //Variable para resultado
            $resultado;

            $resultado = self::ERROR." de busqueda, no se encuentra la variable o su acceso es negado"; 

            foreach ($objetoClaseMySqlTest as $indexador => $valorDeVariable) {  
         
                if ($indexador == $nombreVariable)  {
                    $resultado =  'Se ha '.self::VALIDO.' la busqueda, el valor para la variable '.$nombreVariable.' es: '.$objetoClaseMySqlTest->$nombreVariable;
                } 
                          
            }   

            return $resultado;
        }

/****************************** FIN ZONA SET & GET **************************************************/
    









/****************************** ZONA METODOS EJECUTABLES  **************************************************/
       
        /*
         *
         *Metodo pruebaCompletaTest()
         *Action: Realiza un test completo con retorno de mensaje con resultados del test
         *Parametros: No presenta
         */ 
        //Test completo de la clase
        function pruebaCompletaTest(){
            $resultado;
            $resultado .= "|1:Test de MySqli| ";
            $resultado .= $this->do_Mysqli_Test();
            $resultado .= "|2:Test de Conexión con atributos: HostName=>".$this->hostName.", UserName=>".$this->userName. ", PasswordDB=>********, NameDB=>".$this->nameDB;
            $resultado .= "....Resultado: ";
            $resultado .= $this->do_test_connect();
            return $resultado;
        }

/****************************** FIN ZONA METODOS EJECUTABLES **************************************************/



}

//Desactivar errores
error_reporting(0);




/****************************** ZONA ARRANQUES EJECUTABLES **************************************************/

/*
*Intanciar de clase (Necesario descomentar para ejecutables de abajo)
*/
// descomentar // $obj = new mySqlTest();


/*
*Ejecutables
*/

/*
*
*Ejecutable test Mysqli
*Action: Testea mysqli e imprime resultado
*Parametros: No presenta
*/ 
// descomentar para ejecutar // echo $obj->do_Mysqli_Test(); 


/*
*
*Ejecutable test conexion
*Action: Testea la conexion e imprime resultado
*Parametros: No presenta
*/ 
// descomentar para ejecutar // echo $obj->do_test_connect();


/*
*
*Ejecutable cambiar variable
*Action: Cambia variable e imprime mensaje
*Parametros: $item (nombre de variable a modificar), $valorCambio (valor de remplazo)
*/ 
// descomentar para ejecutar // echo $obj->set_Item($item,$valorCambio);



/*
*
*Ejecutable obtener variable
*Action: Obtiene variable e imprime mensaje
*Parametros: $nombreVariable (nombre de la variable), $objetoClaseMySqlTest (objeto de clase, instancia)
*/ 
// descomentar para ejecutar // echo $obj->get_Item($nombreVariable, $objetoClaseMySqlTest);



/*
*
*Ejecutable prueba completa
*Action: Ejecuta todo definido y retorna mensaje
*Parametros: No presenta
*/ 
// descomentar para ejecutar // echo $obj->pruebaCompletaTest();

/****************************** FIN ZONA ARRANQUES EJECUTABLES **************************************************/


?>
                        
</body>
</html>