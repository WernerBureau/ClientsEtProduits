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

<br/>
<div class="card w-75 mx-auto">
<div ng-controller = "usersCtrl">
    <div class="card-body">
    <div id="logDiv" style="margin: 10px 0 20px 0;"><a href="javascript:void(0);" class="glyphicon glyphicon-log-in" id="login-btn" onclick="javascript:$('#loginForm').slideToggle();">
            Login with Captcha </a>
    </div>

    <div class="none formData" id="loginForm">
        <form class="form" enctype='application/json'>
            <div class="form-group">
                <label>Username</label>
                <input ng-model="username" type="text" class="form-control" id="username" name="username" style="width: 250px" />
                <label>Password</label>
                <input ng-model="password" type="password" class="form-control" id="password" name="password"  style="width: 250px"/>
                <div id="example1"></div>
                <p style="color:red;">{{ captcha_status }}</p>
            </div>
            <a href="javascript:void(0);" class="btn btn-warning" onclick="$('#loginForm').slideUp(); emptyInput();">Cancel</a>
            <a href="javascript:void(0);" class="btn btn-success" ng-click="login()">Submit</a>
        </form>
    </div>

    <div class="panel-body none formData" id="changeForm">
        <form class="form" enctype='application/json'>
            <div class="form-group">
                <label>New password</label>
                <input ng-model="newPassword" type="password" class="form-control" id="form-password" name="form-password" style="width: 250px" />
            </div>
            <a href="javascript:void(0);" class="btn btn-warning" onclick="$('#changeForm').slideUp(); emptyInput();">Cancel</a>
            <a href="javascript:void(0);" class="btn btn-success" ng-click="changePassword()">Submit</a>
            <a href="javascript:void(0);" class="btn btn-warning" ng-click="logout()">Logout</a>
        </form>
    </div>
    <br>
    <div>
        <p style="color: green;">{{messageLogin}}</p>
        <p style="color: red;">{{errorLogin}}</p>
    </div>
    <br>
    </div>
</div>
</div>
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
