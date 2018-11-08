function getCustomers() {
    $.ajax({
        type: 'GET',
        url: urlToRestApi,
        dataType: "json",
        success:
            function (customers) {
                var customerTable = $('#customerData');
                customerTable.empty();
                var count = 1;
                $.each(customers.data, function (key, value)
                {
                    var editDeleteButtons = '<td>' +
                        '<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editCustomer(' + value.id + ')"></a>' +
                        '<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm(\'Are you sure to delete data?\') ? customerAction(\'delete\', ' + value.id + ') : false;"></a>' +
                        '</td></tr>';
                    customerTable.append('<tr><td>' + count + '</td><td>' + value.name + '</td><td>' + value.email + '</td><td>' + value.number + '</td><td>' + value.phone + '</td>' + editDeleteButtons);
                    count++;
                });

            }
    });
}

function convertFormToJSON(form) {
    var array = $(form).serializeArray();
    var json = {};

    $.each(array, function () {
        json[this.name] = this.value || '';
    });

    return json;
}

function customerAction(type, id) {
    id = (typeof id == "undefined") ? '' : id;
    var statusArr = {add: "added", edit: "updated", delete: "deleted"};
    var requestType = '';
    var customerData = '';
    var ajaxUrl = urlToRestApi;
    if (type == 'add') {
        requestType = 'POST';
        customerData = convertFormToJSON($("#addForm").find('.form'));
    } else if (type == 'edit') {
        requestType = 'PUT';
        ajaxUrl = ajaxUrl + "/" + idEdit.value;
        customerData = convertFormToJSON($("#editForm").find('.form'));
    } else {
        requestType = 'DELETE';
        ajaxUrl = ajaxUrl + "/" + id;
    }
    $.ajax({
        type: requestType,
        url: ajaxUrl,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify(customerData),
        success: function (msg) {
            if (msg) {
                alert('Customer data has been ' + statusArr[type] + ' successfully.');
                getCustomers();
                $('.form')[0].reset();
                $('.formData').slideUp();
            } else {
                alert('Some problem occurred, please try again.');
            }
        }
    });
}

function editCustomer(id) {
    $.ajax({
        type: 'GET',
        dataType: 'JSON',
        url: urlToRestApi+ "/" + id,
        success: function (data) {
            $('#idEdit').val(data.data.id);
            $('#nameEdit').val(data.data.name);
            $('#emailEdit').val(data.data.email);
            $('#numberEdit').val(data.data.number);
            $('#phoneEdit').val(data.data.phone);
            $('#editForm').slideDown();
        }
    });
}