var onloadCallback = function () {
    widgetId1 = grecaptcha.render('example1', {
        'sitekey': '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI'
    });
};

var app = angular.module('app', []);

app.controller('usersCtrl', function ($scope, $compile, $http) {

    $scope.login = function () {

        if (grecaptcha.getResponse(widgetId1) === '') {
            $scope.captcha_status = 'Please verify captcha';
            return;
        }

        var req = {
            method: 'POST',
            url: 'api/users/token',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            data: {username: $scope.username, password: $scope.password}
        }
        // fields in key-value pairs
        $http(req)
            .success(function (jsonData, status, headers, config) {

                localStorage.setItem('token', jsonData.data.token);
                localStorage.setItem('user_id', jsonData.data.id);


                // Switch button for Logout
                $('#logDiv').html(
                    $compile('<a href="javascript:void(0);" class="glyphicon glyphicon-log-out" id="login-btn" onclick="javascript:$(\'#changeForm\').slideToggle();">Logout/Modify</a>')($scope)
                );


                $('#loginForm').slideUp();

                //$scope.messageLogin = 'Welcome!';
                $scope.errorLogin = '';
            })

            .error(function (data, status, headers, config) {
                $scope.messageLogin = '';
                $scope.errorLogin = 'Invalid credentials';
            });

    }

    $scope.logout = function () {
        localStorage.setItem('token', "no token");

        $('#logDiv').html(
            $compile('<a href="javascript:void(0);" class="glyphicon glyphicon-log-in" id="login-btn" onclick="javascript:$(\'#loginForm\').slideToggle();">Login</a>')($scope)
        );

        $('#changeForm').slideUp();
        $scope.messageLogin = 'You have logged out';
        $scope.errorLogin = '';

    }
    $scope.changePassword = function () {
        var req = {
            method: 'PUT',
            url: 'api/users/' + localStorage.getItem("user_id"),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem("token")
            },
            data: {'password': $scope.newPassword}
        }
        $http(req)
            .success(function (response) {
                $('#changeForm').slideUp();
                $scope.messageLogin = 'Password successfully changed! ';
            })
            .error(function (response) {
                $scope.errorLogin = 'Impossible to change the password!';

            });
    };
});

app.controller('CustomerCRUDController', ['$scope','CustomerCRUDService', function ($scope,CustomerCRUDService) {

    $scope.updateCustomer = function () {
        CustomerCRUDService.updateCustomer($scope.customer.id,$scope.customer.name,$scope.customer.phone,$scope.customer.email)
            .then(function success(response){
                    $scope.message = 'Customer data updated!';
                    $scope.errorMessage = '';
                    $scope.customer.id = '';
                    $scope.customer.name = '';
                    $scope.customer.phone = '';
                    $scope.customer.email = '';
                    $scope.getAllCustomers();
                },
                function error(response){
                    $scope.errorMessage = 'Error updating customer information';
                    $scope.message = '';
                });
    }

    $scope.getCustomer = function ($id) {

        CustomerCRUDService.getCustomer($id)
            .then(function success(response){
                    $scope.customer = response.data.data;
                    $scope.customer.id = $id;
                    $scope.message='';
                    $scope.errorMessage = '';
                    $scope.getAllCustomers();

                },
                function error (response ){
                    $scope.message = '';
                    if (response.status === 404){
                        $scope.errorMessage = 'Customer not found';
                    }
                    else {
                        $scope.errorMessage = "Error getting customer";
                    }
                });
    }

    $scope.addCustomer = function () {
        if ($scope.customer != null && $scope.customer.name && $scope.customer.phone && $scope.customer.email) {
            CustomerCRUDService.addCustomer($scope.customer.name,$scope.customer.phone,$scope.customer.email)
                .then (function success(response){
                        $scope.message = 'Customer added!';
                        $scope.errorMessage = '';
                        $scope.customer.id = '';
                        $scope.customer.name = '';
                        $scope.customer.phone = '';
                        $scope.customer.email = '';
                        $scope.getAllCustomers();
                    },
                    function error(response){
                        $scope.errorMessage = 'Error adding customer';
                        $scope.message = '';
                    });
        }
        else {
            $scope.errorMessage = 'Please fill out the entire form';
            $scope.message = '';
        }
    }

    $scope.deleteCustomer = function ($id) {
        CustomerCRUDService.deleteCustomer($id)
            .then (function success(response){
                    $scope.message = 'Customer deleted';
                    $scope.customer = null;
                    $scope.errorMessage='';
                    $scope.getAllCustomers();
                },
                function error(response){
                    $scope.errorMessage = 'Error deleting Customer!';
                    $scope.message='';
                })
    }

    $scope.clear = function () {
        CustomerCRUDService.clear($scope.customer.name,$scope.customer.phone,$scope.customer.email)
            .then(function success(response){
                    $scope.errorMessage = '';
                    $scope.customer.id = '';
                    $scope.customer.number = '';
                    $scope.customer.name = '';
                    $scope.customer.phone = '';
                    $scope.customer.email = '';
                },
                function error(response){
                    $scope.errorMessage = 'Error clearing data';
                    $scope.message = '';
                });
    }

    $scope.getAllCustomers = function () {
        CustomerCRUDService.getAllCustomers()
            .then(function success(response){
                    $scope.customers = response.data.data;
                    $scope.message='';
                    $scope.errorMessage = '';
                },
                function error (response ){
                    $scope.message='';
                    $scope.errorMessage = 'Error getting Customers!';
                });
    }
    $scope.getAllCustomers();
}]);

app.service('CustomerCRUDService',['$http', function ($http) {

    this.getCustomer = function getCustomer(customerId){
        return $http({
            method: 'GET',
            url: urlToRestApi+'/'+customerId,
            headers: { 'X-Requested-With' : 'XMLHttpRequest', 'Accept' : 'application/json'}
        });
    }

    this.addCustomer = function addCustomer(name,phone,email){
        return $http({
            method: 'POST',
            url: urlToRestApi,
            data: {name:name, phone:phone, email:email},
            headers: { 'X-Requested-With' : 'XMLHttpRequest', 'Accept' : 'application/json'}
        });
    }

    this.deleteCustomer = function deleteCustomer(id){
        return $http({
            method: 'DELETE',
            url: urlToRestApi+'/'+id ,
            headers: { 'X-Requested-With' : 'XMLHttpRequest', 'Accept' : 'application/json'}
        })
    }

    this.updateCustomer = function updateCustomer(id,name,phone,email){
        return $http({
            method: 'PATCH',
            url: urlToRestApi+'/'+id,
            data: {name:name, phone:phone, email:email},
            headers: { 'X-Requested-With' : 'XMLHttpRequest', 'Accept' : 'application/json'}
        })
    }

    this.getAllCustomers = function getAllCustomers(){
        return $http({
            method: 'GET',
            url: urlToRestApi,
            headers: { 'X-Requested-With' : 'XMLHttpRequest', 'Accept' : 'application/json'}

        });
    }
}]);

$(document).ready(function () {
    localStorage.setItem('token', "no token");
    $('#changePass').hide();
});