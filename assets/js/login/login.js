$(function(){
    $("#frmLogin").on('submit', loginUser);
});

function loginUser () {
	event.preventDefault();
	
	const url = 'rutas/validarUsuario.php';
    const data = $(this).serialize();

	$.ajax({
		 url: url,
		 data: data,
		 method: 'POST'
	}).done(response => {
	    // console.log(response);
		if (response.error) {
			console.log(response.message);
			alert(response.message);
		} else {
			location.href ="vistas/panel.php";
		}
	});
}