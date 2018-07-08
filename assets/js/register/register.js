$(function(){
	$("#frmRegister").on('submit', registerUser);
});

function registerUser () {
	event.preventDefault();

	const url = '../rutas/registrarUsuario.php';
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
			alert(response.message);
		}
	});
}