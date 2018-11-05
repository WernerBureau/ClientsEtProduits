$(document).ready(function () {
    // The path to action from CakePHP is in urlToLinkedListFilter 
    $('#country-id').on('change', function () {
        var countryId = $(this).val();
        if (countryId) {
            $.ajax({
                url: urlToLinkedListFilter,
                data: 'country_id=' + countryId,
                success: function (provinces) {
                    $select = $('#province-id');
                    $select.find('option').remove();
                    $.each(provinces, function (key, value)
                    {
                        $.each(value, function (childKey, childValue) {
                            $select.append('<option value=' + childValue.id + '>' + childValue.name + '</option>');
                        });
                    });
                }
            });
        } else {
            $('#province-id').html('<option value="">Select Country first</option>');
        }
    });
});


