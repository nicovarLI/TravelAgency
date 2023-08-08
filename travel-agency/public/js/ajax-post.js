$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#add-city-form').on('submit', function(event){
    event.preventDefault();
    var formData = $(this).serializeArray();
    var jsonData = {};

    $.each(formData, function(_,field){
        jsonData[field.name] = field.value;
    });

    $.ajax({
        url: '/',
        method: 'POST',
        data: JSON.stringify(jsonData),
        dataType: 'JSON',
        contentType: 'application/json',
        cache: false,
        processData: false,
        success:function(response)
        {
            $('#cities-table').html(response.updatedCitiesTable)
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText)
        }
    });
})
