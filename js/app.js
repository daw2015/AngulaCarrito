(function () {
    var app = angular.module('mundo', []);

    app.controller('ControladorFormulario', ['$http', function ($http) {
        var that = this;
        this.ciudad = {};
        this.addCiudad = function(ciudades){
            $http.get('city/ajaxinsert.php?Name=&Population=&District=&CountryCode').success(function(datos){
                that.ciudad.ID = datos.ID;
                ciudades.push(that.ciudad);
                that.ciudad = {};
                $('#formularioInsertar').modal('toggle');
            });
        };
        this.editCiudad = function(ciudades){
            $http.get('city/ajaxedit.php?ID=&Name=&Population=&District=&CountryCode').success(function(datos){
                console.log(ciudades);
                console.log(that.ciudad);
                for (var i=0; i<ciudades.length; i++){
                    if(ciudades[i].ID == that.ciudad.ID){
                        console.log(i);
                        ciudades[i].Population = that.ciudad.Population;
                        ciudades[i].CountryCode = that.ciudad.CountryCode;
                        ciudades[i].District = that.ciudad.District;
                        ciudades[i].Name = that.ciudad.Name;
                        break;
                    }
                }
                that.ciudad = {};
                $('#formularioEditar').modal('toggle');
            });
        };
    }]);

    app.directive('ciudadDescripcion', function () {
        return {
            restrict: 'E',//elemento A - atributo
            templateUrl: 'plantillas/ciudad-descripcion.html'
        };
    });

    app.directive('carritoDescripcion', function () {
        return {
            restrict: 'E',
            templateUrl: 'plantillas/carrito-descripcion.html'
        };
    });

    app.directive('ciudadInsertar', function(){
        return {
            restrict: 'E',
            templateUrl: 'plantillas/ciudad-insertar.html'
        };
    });

    app.directive('ciudadEditar', function(){
        return {
            restrict: 'E',
            templateUrl: 'plantillas/ciudad-editar.html'
        };
    });

    app.directive('ciudadPaginar', function(){
        return {
            restrict: 'E',
            templateUrl: 'plantillas/ciudad-paginar.html'
        };
    });

    app.directive('prueba', function(){
        return {
            restrict: 'E',
            templateUrl: 'plantillas/prueba.php'
        };
    });
    /*app.directive('ciudadesListado', function () {
        return {
            restrict: 'E',
            templateUrl: 'plantillas/ciudades-listado.html',
            controller: function(){
                this.ciudad = ciudad;
                this.ciudades = ciudades;
            },
            controllerAs:'cCiudad'
        };
    });*/

    app.directive('ciudadesListado', ['$http', function($http){
        return {
            restrict: 'E',
            templateUrl: 'plantillas/ciudades-listado.html',
            controller: function(){
                var that = this;
                this.pagina = 1;
                this.paginas = 1;
                this.ciudades = [];
                this.paises = [];
                this.carrito = [];
                this.getPagina = function(pagina) {
                    $http.get('city/ajaxcity.php?pagina=' + pagina).success(function(datos) {
                        that.ciudades = datos.ciudades;
                        that.paginas = datos.paginas;
                    });
                };
                this.getPaises = function(){
                    $http.get('country/ajaxcountries.php').success(function(datos) {
                        that.paises = datos.paises;
                    });
                }
                this.previous = function(){
                    this.pagina--;
                    if(this.pagina<1){
                        this.pagina = 1;
                    }
                    this.getPagina(this.pagina);
                };
                this.next = function(){
                    this.pagina++;
                    if(this.pagina>this.paginas){
                        this.pagina = this.paginas;
                    }
                    this.getPagina(this.pagina);
                };
                this.editCiudad = function(ciudad){
                    $('#formularioEditar').modal('toggle');
                    var form = document.getElementById("formEditar");
                    var clon = JSON.parse(JSON.stringify(ciudad));
                    angular.element(form).scope().ctrlForm.ciudad = clon;
                };
                this.borrarCiudad = function(ciudad){
                    $http.get('city/ajaxdelete.php?ID='+ciudad.ID).success(function(datos) {
                        if(datos.r==1){
                            for (var i=0; i<that.ciudades.length; i++){
                                if(that.ciudades[i].ID == ciudad.ID){
                                    that.ciudades.splice(i,1);
                                    break;
                                }
                            }
                        } else {
                            alert("No se puede borrar la ciudad.");
                        }
                    });
                };
                this.agregarCarrito = function(ciudad){
                    $http.get('city/ajaxaddcarrito.php?ID='+ciudad.ID).success(function(datos) {
                        that.carrito = datos.r;
                    });
                };
                this.getCarrito = function(ciudad){
                    $http.get('city/ajaxgetcarrito.php').success(function(datos) {
                        that.carrito = datos.r;
                    });
                };
                this.getPagina(this.pagina);
                this.getPaises();
                this.getCarrito();
            },
            controllerAs:'cCiudad'
        };
    }]);


    /*app.controller('ControladorCiudad', function () {
        this.ciudad = ciudad;
        this.ciudades = ciudades;
    });*/



    /*app.directive('ciudad', function () {
        return {
            restrict: 'E',//elemento A - atributo
            templateUrl: 'plantillas/ciudad-descripcion.html'
        };
    });*/

    /*app.directive('ciudadDescripcion', function () {
        return {
            restrict: 'A',//elemento A - atributo
            templateUrl: 'plantillas/ciudad-descripcion.html'
        };
    });*/



    var ciudad = {
        Name: 'Kabul',
        CountryCode: 'AFG',
        Population: 1700000
    };

    var ciudades = [{
            Name: 'Kabul',
            CountryCode: 'AFG',
            Population: 1700000,
            Barrios: ['B1', 'B2']
        }, {
            Name: 'Granada',
            CountryCode: 'ESP',
            Population: 160000,
            Barrios: ['Zaidín', 'Chana', 'Las Flores']
        }];

})();