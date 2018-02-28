$(document).ready(function(){
	$("#frmRegister").on('submit', registerUser);
});

function registerUser () {
	event.preventDefault();
	var url = '../rutas/registrarUsuario.php';
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
			alert(response.message);
		}
	});
}