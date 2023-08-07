$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#add-city-form').on('submit', function(event){
    event.preventDefault();
    var form = $(this);
    console.log(form.serialize());
    var url = form.attr('data-action');
    $.ajax({
        url: '/',
        method: 'POST',
        data: form.serialize(),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(response)
        {
            console.log('success');
            $(form).trigger("reset");
            alert(response.success);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText)
            console.log('error');
        }
    });
})
// function convertFormToJSON(form) {
//     const array = $(form).serializeArray();
//     let json = [];
//     $.each(array, function () {
//       json[this.name] = this.value || "";
//     });
//     return json_encode(json);
//   }

