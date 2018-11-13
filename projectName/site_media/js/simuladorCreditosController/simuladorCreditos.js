/*************************************************************************************************
 **				                        Modulo Controller		                         		**
 **************************************************************************************************/



/*------------------------------- Area Modulo Controller --------------------------------*/
// angular.module se compone de ('Nombre del modulo',[dependencias]) Inyectables
var app = angular.module("simuladorCreditos", ['ngMaterial']);
/*------------------------------- Area Modulo Controller --------------------------------*/


/*------------------------------- Area Modulo Controller --------------------------------*/
//.controller ('Nombre Controller', directiva en function($scope)) Inyectables
app.controller('simuladorCreditos_Controller', function($scope, $timeout, $rootScope, $http, $filter) {


    /*--------------------------    Area de Declaracion     ------------------------------*/
    //*************************(  Contenido del controller )********************************
    $scope.variable = "variable";
    $scope.factoresInteres = "efecAnual";
    $scope.anios = 0;
    $scope.meses = 0;
    $scope.total = ($scope.anios > 0) ? ($scope.anios/12)+$scope.meses : $scope.meses;
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
        },
        efectivoAnual: function() {
            //ip = ((1 + EA)^(dias/360)) -1


        },
        nominalAnual: function() {
            //ip = ((1 + ip)^(360/dias)) -1

        },
        periodico: function() {
            //EA = ((1 + ip) ^ (360/dias)) -1

        }
    };
    //**************************************************************************************
    /*--------------------------            $gui            ------------------------------*/






    /*--------------------------           $watchers          ------------------------------*/
    //************************* (    Ejecuciones Simples  ) ********************************
     $scope.$watch("total",function(newValue,oldValue) {
    //
        if (newValue===oldValue) {
          return;
        }

        //$scope.identificacion = $filter('number')(newValue);
        $scope.total = ($scope.anios > 0) ? ($scope.anios/12)+$scope.meses : $scope.meses;
      });
    //**************************************************************************************
    /*--------------------------           $watchers           -----------------------------*/





    /*--------------------------        $complexSystem      ------------------------------*/
    //*************************(    Ejecuciones Complejas ) ********************************
    $scope.$complexSystem = {
        RegExpNombre: function() {
            var reg = /^([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\']+[\s])+([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])+[\s]?([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])?$/g;
            if (reg.test($scope.nombre)) {
                return true;
            } else {
                return false;
            }


        }
    };
    //**************************************************************************************
    /*--------------------------        $complexSystem      ------------------------------*/




    /*--------------------------            Arranque         ------------------------------*/
    $scope.includeMobileTemplate = false;
    var screenWidth = window.innerWidth;

    if (screenWidth < 700) {
        $scope.includeMobileTemplate = true;
    }


})
/*---------------------------------------------Area Modulo Controller-----------------------------------------------*/
//************************************************************************************************************************






//************************************************************************************************************************
/*--------------------------------------------Filters------------------------------------------------*/

app.filter('porcentaje', ['$filter', function($filter) {
    var regExpNumber = /^([0-9]|[1-9][0-9]|[1-9][0-9][0-9])$/g;
    return function(input) {
        number = Number(input);
        if (!isNaN(number)) {
            return (number) + '%';
        }else{
            return 0 + '%';
        }

    };
}]);

/*--------------------------------------------Filters-----------------------------------------------*/
//************************************************************************************************************************
