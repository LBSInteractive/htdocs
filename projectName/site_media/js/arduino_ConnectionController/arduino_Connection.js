/*************************************************************************************************
 **				                        Modulo Controller		                         		**
 **************************************************************************************************/



/*------------------------------- Area Modulo Controller --------------------------------*/
// angular.module se compone de ('Nombre del modulo',[dependencias]) Inyectables
var app = angular.module("arduino_Connection", []);
/*------------------------------- Area Modulo Controller --------------------------------*/


/*------------------------------- Area Modulo Controller --------------------------------*/
//.controller ('Nombre Controller', directiva en function($scope)) Inyectables
app.controller('arduino_Connection_Controller', function($scope, $timeout, $rootScope, $http) {


    /*--------------------------    Area de Declaracion     ------------------------------*/
    //*************************(  Contenido del controller )********************************
    $scope.ports = [];
    $scope.lines = [];

    var socket = io();

    socket.on('serial_data', function(data) {
        $scope.data = data;
        $scope.lines.push(data);
        if ($scope.lines.length > 20)
            $scope.lines.shift();
        $scope.$apply();
    })

    $http.get('/port_list')
        .then(function(response) {
            console.log(response.data);
            $scope.ports = response.data;
            if ($scope.ports.length)
                $scope.p = $scope.ports[0];
        }, function(error) {
            console.log(error);
        });

    $scope.doConnect = function() {
        socket.emit('do_connect', $scope.p.comName);
    };

    $scope.doDisconnect = function() {
        socket.emit('do_disconnect', $scope.p.comName);
        $scope.data = '';
        $scope.lines = [];
    };
    //**************************************************************************************
    //*************************( Contenido del controller global)***************************
    //Variable Global rootScope
    $rootScope.variable = "variable global"
    //**************************************************************************************
    /*--------------------------    Area de Declaracion     ------------------------------*/





    /*--------------------------            $apis           ------------------------------*/
    //*************************(  Consulta a Base de Datos )********************************
    $scope.$api = {
        /**
         * Para hacer un request por POST
         * @return JSON en Consola
         */
        consultaPost: function() {
            /**
             * dataService Realiza la peticion POST data (Para enviar parametros por POST )
             * @type $http
             */
            var dataService = $http({
                method: 'POST',
                url: 'http://localhost/projectName/site_media/html/modules/servicioMC/servicioController.php',
                data: {
                    nombre: 'ejemplo'
                },
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            /**
             * Control de respuesta
             * @param  $http response Peticion
             * @return none
             */
            dataService.then(function(response) {
                console.log(response.data);
            }, function(response) {
                console.log("Error");
            });

        },
        /**
         * Para hacer un request por GET
         * @return JSON en Consola
         */
        consultaGet: function() {
            /**
             * dataService Realiza la peticion GET params (Para enviar parametros por GET ?String=String )
             * @type $http
             */
            var dataService = $http({
                method: 'GET',
                url: 'http://localhost/projectName/site_media/html/modules/servicioMC/servicioController.php',
                params: {
                    nombre: 'ejemplo'
                },
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            /**
             * Control de respuesta
             * @param  $http response Peticion
             * @return none
             */
            dataService.then(function(response) {
                console.log(response.data);
            }, function(response) {
                console.log("Error");
            });
        }
    };
    //**************************************************************************************
    /*--------------------------            $apis           ------------------------------*/





    /*--------------------------            $gui            ------------------------------*/
    //*************************(  Ejecuciones de la pantalla )******************************
    $scope.$gui = {
        ejemplo: function() {
            $scope.variable = "Nuevo Valor pantalla";
        }
    };
    //**************************************************************************************
    /*--------------------------            $gui            ------------------------------*/





    /*--------------------------           $tools           ------------------------------*/
    //************************* (    Ejecuciones Simples  ) ********************************
    $scope.$tools = {
        ejemplo: function() {
            $scope.variable = "Nuevo Valor Tools";
        }
    };
    //**************************************************************************************
    /*--------------------------           $tools           ------------------------------*/





    /*--------------------------        $complexSystem      ------------------------------*/
    //*************************(    Ejecuciones Complejas ) ********************************
    $scope.$complexSystem = {
        ejemplo: function() {
            $scope.variable = "Nuevo Valor Complejo";
        }
    };
    //**************************************************************************************
    /*--------------------------        $complexSystem      ------------------------------*/





    /*--------------------------            Arranque         ------------------------------*/
    console.log("Hello World!");
    //Ejemplo de ejecucion
    $scope.$complexSystem.ejemplo();
    console.log($scope.variable);

    /**
     * Request GET
     */
    $scope.$api.consultaGet();

    /**
     * Request POST
     */
    $scope.$api.consultaPost();
    /*--------------------------            Arranque         ------------------------------*/

})
/*---------------------------------------------Area Modulo Controller-----------------------------------------------*/

//************************************************************************************************************************
