<?php
$urlToRestApi = $this->Url->build('/api/customers', true);
echo $this->Html->scriptBlock('var urlToRestApi = "' . $urlToRestApi . '";', ['block' => true]);
echo $this->Html->script('Customers/index', ['block' => 'scriptBottom']);

?>

<!DOCTYPE html>
<html ng-app="app">
<head>
    <meta charset="UTF-8">
    <title>Customers index</title>
</head>
<body>

<div ng-controller="CustomerCRUDController">
<br/>
    <div class="card w-75 mx-auto">
        <h5 class="card-header">Customer information</h5>
        <div class="card-body">

            <table>
                <tr>
                    <td width="100">Number:</td>
                    <td><input type="text" id="number" ng-model="customer.number" disabled="disabled"/></td>
                </tr>

                <tr>
                    <td width="100">Name:</td>
                    <td><input type="text" id="name" ng-model="customer.name" /></td>
                </tr>

                <tr>
                    <td width="100">Phone:</td>
                    <td><input type="text" id="phone" ng-model="customer.phone" /></td>
                </tr>

                <tr>
                    <td width="100">Email:</td>
                    <td><input type="text" id="email" ng-model="customer.email" /></td>
                </tr>
            </table>

            <a ng-click="updateCustomer(customer.number,customer.name,customer.phone,customer.email)" class="btn btn-primary">Update customer</a>
            <a ng-click="addCustomer(customer.number,customer.name,customer.phone,customer.email)" class="btn btn-primary">Add customer</a>
            <a ng-click="addCustomer(customer.number,customer.name,customer.phone,customer.email)" class="btn btn-primary">Clear</a>

            <p style="color: green">{{message}}</p>
            <p style="color: red">{{errorMessage}}</p>
        </div>
    </div>
    <br/>
    <div class="card w-75 mx-auto">
        <h5 class="card-header">Customers</h5>
        <div class="card-body">


            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tr ng-repeat="customer in customers">

                    <td>{{customer.number}}</td>
                    <td>{{customer.name}}</td>
                    <td>{{customer.phone}}</td>
                    <td>{{customer.email}}</td>

                    <td>
                        <a href="javascript:void(0);" class="glyphicon glyphicon-edit" ng-click="getCustomer(customer.id)"></a>
                        <a href="javascript:void(0);" class="glyphicon glyphicon-trash" ng-click="deleteCustomer(customer.id)"></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

</body>
</html>
