var app = angular.module('app',[]);

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