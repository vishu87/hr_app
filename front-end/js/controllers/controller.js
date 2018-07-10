var app = angular.module('app', [
	'jcs-autoValidate',
	'angular-ladda',
	'ngCookies',
	'ngFileUpload',
	'ui.bootstrap',
	'ngSanitize'
]);

angular.module('jcs-autoValidate')
    .run([
    'defaultErrorMessageResolver',
    function (defaultErrorMessageResolver) {
        defaultErrorMessageResolver.getErrorMessages().then(function (errorMessages) {
          errorMessages['patternPassword'] = 'Password must be atleast 8 charaters long alphanumeric and it must contain one special charaters';
        });
    }
]);

app.run(function($rootScope , $http) {
    $rootScope.login = function(){
        console.log('asd');
        $("#login").modal('show');
    }
    $rootScope.loginModal = function(){
        $("#loginModal").modal('show');
    }
    $rootScope.loginModalEntrepreneur = function(){
        $("#loginModalEntrepreneur").modal('show');
    }
    $rootScope.loginModalBroker = function(){
        $("#loginModalBroker").modal('show');
    }
});

app.controller('RegistrationCtrl', function($scope, $http, $rootScope, $timeout, LoginService) {

    $scope.type = 2;
    $scope.processing = false;
    $scope.show_form = true;
    $scope.registerData = {};
    $scope.registerData = {
     first_name : 'Demo',
     last_name : 'User',
     username : 'demo',
     email : 'demo@andorra.com',
     password : 'abcd@1234',
     re_password : 'abcd@1234'
    };
    $scope.formError = '';
    $scope.formSuccess = '';

    $scope.onSubmit = function(check){
        $scope.formError = '';
        data = $scope.registerData;
        data.type = $scope.type;
        $scope.processing = true;

        LoginService.register(data).then(function(response){
            if(response.data.success){
                $scope.formSuccess = response.data.message;
                $scope.formError = '';
                $scope.registerData = {};
                $scope.processing = false;
                $scope.registerForm.$setPristine();
                $scope.show_form = false;
                location.href = response.data.redirect_url;
            } else {
                $scope.formError = response.data.message;
                $scope.processing = false;
            }
        });
    }
});

app.controller('HomeController',function($scope , $http){

});

app.controller('LoginCtrl', function($scope, $http, $rootScope, $timeout) {

    $scope.processing = false;
    $scope.loginData = {};
    $scope.formError = '';

    $scope.onSubmit = function(check){
        $scope.formError = '';
        data = $scope.loginData;
        $scope.processing = true;

        console.log(data);
        $http({
            method: 'POST',
            url: base_url + "/api/login",
            data: data
        })
        .then(function(response) {
            if(response.status == 200){
                if(response.data.success){
                    location.href = response.data.redirect_url;
                } else {
                    $scope.formError = response.data.message;
                    $scope.processing = false;
                }
            }
        });
    }
});

app.service('LoginService', function($http){
    
    this.register = function(data) {
        var promise = $http({
            method: 'POST',
            url: base_url + "/api/register",
            data : data
        })
        .then(function(response) {
            console.log(response.data);
            if(response.status == 200){
                return response;
            }
        });
        return promise;
    }

});