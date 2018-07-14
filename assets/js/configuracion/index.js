$(function () {
    $("#form").on('submit', editUser);
});

function editUser() {
	event.preventDefault();

    var url = '../rutas/modificarUsuario.php';
    var data = $(this).serializeArray();

    $.ajax({
        url: url,
        data: data,
        method: 'POST'
    })
    .done(function(response) {
        if (response.error) {
        	console.log(response);
            alert(response.message);
        } else {
            alert(response.message);
            location.reload();
        }
    });
}