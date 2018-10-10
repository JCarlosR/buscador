$(function() {
    $('[data-toggle="tooltip"]').tooltip();

    $(document).on('click', '[data-send]', sendMailWithResults);
});

function sendMailWithResults() {
    const id = $(this).data('send');
    const url = '../rutas/enviarMailCoincidencia.php';
    $.ajax({
        url: url,
        data: {
            coincidenciaId: id
        },
        method: 'POST'
    }).done(response => {
        // console.log(response);
        if (response.error) {
            console.log(response.message);
            alert(response.message);
        } else {
            alert(response.message);
        }
    });
}
