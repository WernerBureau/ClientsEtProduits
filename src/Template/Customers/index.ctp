<?php
$urlToRestApi = $this->Url->build('/api/customers', true);
echo $this->Html->scriptBlock('var urlToRestApi = "' . $urlToRestApi . '";', ['block' => true]);
echo $this->Html->script('Customers/index', ['block' => 'scriptBottom']);

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="panel panel-default customers-content">
                    <div class="panel-heading">Customers <a href="javascript:void(0);" class="glyphicon glyphicon-plus" id="addLink" onclick="javascript:$('#addForm').slideToggle();">Add</a></div>
                    <div class="panel-body none formData" id="addForm">
                        <h2 id="actionLabel">Add Customer</h2>
                        <form class="form" id="customerAddForm" enctype='application/json'>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" id="name"/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" id="email"/>
                            </div>
                            <div class="form-group">
                                <label>Number</label>
                                <input type="text" class="form-control" name="number" id="number"/>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone"/>
                            </div>
                            <a href="javascript:void(0);" class="btn btn-warning" onclick="$('#addForm').slideUp();">Cancel</a>
                            <a href="javascript:void(0);" class="btn btn-success" onclick="customerAction('add')">Add Customer</a>
                        </form>
                    </div>
                    <div class="panel-body none formData" id="editForm">
                        <h2 id="actionLabel">Edit Customer</h2>
                        <form class="form" id="customerEditForm" enctype='application/json'>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" id="nameEdit"/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" id="emailEdit"/>
                            </div>
                            <div class="form-group">
                                <label>Number</label>
                                <input type="text" class="form-control" name="number" id="numberEdit"/>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" id="phoneEdit"/>
                            </div>
                            <input type="hidden" class="form-control" name="id" id="idEdit"/>
                            <a href="javascript:void(0);" class="btn btn-warning" onclick="$('#editForm').slideUp();">Cancel</a>
                            <a href="javascript:void(0);" class="btn btn-success" onclick="customerAction('edit')">Update Customer</a>
                        </form>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Number</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="customerData">
                            <?php
                                $count = 0;
                                foreach ($customers as $customer): $count++;
                                    ?>
                                    <tr>
                                        <td><?php echo '#' . $count; ?></td>
                                        <td><?php echo $customer['name']; ?></td>
                                        <td><?php echo $customer['email']; ?></td>
                                        <td><?php echo $customer['number']; ?></td>
                                        <td><?php echo $customer['phone']; ?></td>
                                        <td>
                                            <a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editCustomer('<?php echo $customer['id']; ?>')"></a>
                                            <a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?') ? customerAction('delete', '<?php echo $customer['id']; ?>') : false;"></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
