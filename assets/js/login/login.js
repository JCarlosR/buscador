$(document).ready(function(){
	$("#frmLogin").on('submit', loginUser);
});

function loginUser () {
	event.preventDefault();
	var url = 'rutas/validarUsuario.php';
    var data = $(this).serialize();

	$.ajax({
	 url: url,
	 data: data,
	 method: 'POST'
	}).done(function( response ) {
	    console.log(response);
		if(response.error) {
			console.log(response.message);
			alert(response.message);
			
		}else{
			if (response.role == 1) {
				alert("Es un usuario");
			} else{
				alert("Es un admin");
			};
		}
	});
}