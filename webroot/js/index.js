function getCocktails() {
    $.ajax({
        type: 'GET',
        url: urlToRestApi,
        dataType: "json",
        data: '',
        success:
                function (cocktails) {
                    $list = $('#cocktailList');
                    $.each(cocktails.data, function (key, value)
                    {
                        $list.append('<li>' + value.id + ' : ' + value.name + ', ' + value.description + '</li>');
                    });

                }
    });
}

getCocktails();