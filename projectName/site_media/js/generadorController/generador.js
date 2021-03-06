/*************************************************************************************************
 **				                        Modulo Controller		                         		**
 **************************************************************************************************/



/*------------------------------- Area Modulo Controller --------------------------------*/
// angular.module se compone de ('Nombre del modulo',[dependencias]) Inyectables
var app = angular.module("generador", ['ngMaterial']);
/*------------------------------- Area Modulo Controller --------------------------------*/


/*------------------------------- Area Modulo Controller --------------------------------*/
//.controller ('Nombre Controller', directiva en function($scope)) Inyectables
app.controller('generador_Controller', function($scope, $timeout, $rootScope, $http) {


    /*--------------------------    Area de Declaracion     ------------------------------*/
    //*************************(  Contenido del controller )********************************
    $scope.nombreArchivoHTML = null;
    $scope.nombreTituloPage = null;
    $scope.nameFavicon = null;
    $scope.selectTypeEnd = {
        angular: false,
        servicio: false
    };
    //**************************************************************************************


    /*--------------------------            $apis           ------------------------------*/
    //*************************(  Consulta a Base de Datos )********************************
    $scope.$api = {
        consultaGet: function() {

            /**
             * dataService Realiza la peticion GET params (Para enviar parametros por GET ?String=String )
             * @type $http
             */
            var dataService = $http({
                method: 'GET',
                url: '../../../../core/generator_files/generators/generator.php',
                params: {
                    nombreArchivoHTML: $scope.nombreArchivoHTML,
                    nombreTituloPage: $scope.nombreTituloPage,
                    faviconName: $scope.faviconName,
                    selectTypeEnd: $scope.selectTypeEnd.servicio == true ? 'servicio' : 'angular'
                },
                headers: {
                    'Content-Type': 'application/json; charset=UTF-8'
                }
            });

            /**
             * Control de respuesta
             * @param  $http response Peticion
             * @return none
             */
            dataService.then(function(response) {
                var data = response.data;
                $scope.resultGenerator = data.errorText + " " + data.statusCode;
            }, function(response) {
                var data = response.data;
                $scope.resultGenerator = data.errorText + " " + data.statusCode;
            });
        }
    };
    //**************************************************************************************
    /*--------------------------            $apis           ------------------------------*/





    /*--------------------------            $gui            ------------------------------*/
    //*************************(  Ejecuciones de la pantalla )******************************
    $scope.$gui = {
        validador: function() {
            if (!$scope.nombreArchivoHTML || !$scope.nombreTituloPage || !$scope.faviconName || (!$scope.selectTypeEnd.angular && !$scope.selectTypeEnd.servicio)) {
                return true;
            } else {
                return false;
            }
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


    /*--------------------------            Arranque         ------------------------------*/

})
/*---------------------------------------------Area Modulo Controller-----------------------------------------------*/

//************************************************************************************************************************
