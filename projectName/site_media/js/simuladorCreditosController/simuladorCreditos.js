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
    $scope.periodoAmortizacion = 0;
    $scope.factoresInteres = "efecAnual";
    $scope.total = 0;
    $scope.anios = 0;
    $scope.meses = 0;
    $scope.prestamo;
    $scope.efectivoAnual;
    $scope.nominalAnual;
    $scope.periodica;
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
        efectivoAnualIngresado: function() {
            $scope.efectivoAnualHomologo = Number($scope.efectivoAnual);
            $scope.nominalAnual = 0;
            $scope.nominalAnualHomologo = 0;
            $scope.periodica = 0;
            $scope.periodicaHomologo = 0;

            $scope.periodica = Math.pow( (1 +  (Number($scope.efectivoAnual)/100) ) , (90/360) ) - 1; // 90 cambiar por dias
            $scope.periodicaHomologo = ((Math.pow( (1 +  (Number($scope.efectivoAnual)/100) ) , (90/360) ) - 1)*100).toFixed(2); // 90 cambiar por dias
            $scope.nominalAnual = Number($scope.periodica*4); //4 cambiar por ciclo dias
            $scope.nominalAnualHomologo = (Number($scope.periodica*4)*100).toFixed(2); // 4 cambiar por ciclo dias
        },
        calculoNominalAnual: function() {
            $scope.nominalAnualHomologo = $scope.nominalAnual;
            $scope.efectivoAnual = 0;
            $scope.efectivoAnualHomologo = 0;
            $scope.periodica = 0;
            $scope.periodicaHomologo = 0;

            $scope.periodica = (Number($scope.nominalAnual)/100) / 4; // 4 cambiar por ciclo dias
            $scope.periodicaHomologo = (((Number($scope.nominalAnual)/100) / 4) * 100).toFixed(2); // 90 cambiar por dias
            $scope.efectivoAnual = Math.pow( 1 + Number($scope.periodica)/100, (360/90) ) -1;
            $scope.efectivoAnualHomologo = ((Math.pow( 1 + Number($scope.periodica) , (360/90) ) -1)*100).toFixed(2);
        },
        calculoPeriodico: function() {
            $scope.periodicaHomologo = $scope.periodica;
            $scope.efectivoAnual = 0;
            $scope.efectivoAnualHomologo = 0;
            $scope.nominalAnual = 0;
            $scope.nominalAnualHomologo = 0;


            $scope.nominalAnual = (Number($scope.periodica)/100) * 4;
            $scope.nominalAnualHomologo = (((Number($scope.periodica)/100) * 4)*100).toFixed(2);
            $scope.efectivoAnual = Math.pow( 1 + (Number($scope.periodica)/100), (360/90) ) -1;
            $scope.efectivoAnualHomologo = ((Math.pow( 1 + (Number($scope.periodica)/100), (360/90) ) -1)*100).toFixed(2);
        },
        calcular: function() {
            var periodoAmortizacion = 0;
            if ($scope.selectTypeEnd.mensual == true) {
                periodoAmortizacion = 12;
            } else if ($scope.selectTypeEnd.trimestral == true) {
                periodoAmortizacion = 12;
            } else {
                periodoAmortizacion = 0;
            }
        }
    };
    //**************************************************************************************
    /*--------------------------            $gui            ------------------------------*/






    /*--------------------------           $watchers          ------------------------------*/
    //************************* (    Ejecuciones Simples  ) ********************************
    // $scope.$watch("identificacion",function(newValue,oldValue) {
    //
    //    if (newValue===oldValue) {
    //      return;
    //    }
    //
    //    $scope.identificacion = $filter('number')(newValue);
    //  });
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


        },
        reCalcularMeses: function() {
            $scope.total = (Number($scope.anios) * 12) + (Number($scope.meses));
        },
        validarAnios: function() {
            if (Number($scope.anios) < 3 || Number($scope.anios) > 7) {
                $scope.anios = 0;
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
        } else {
            return 0 + '%';
        }

    };
}]);

/*--------------------------------------------Filters-----------------------------------------------*/
//************************************************************************************************************************
