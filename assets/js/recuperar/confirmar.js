$(function(){
	$("#frmChangePassword").on('submit', changePassword);
});

function changePassword() {
	event.preventDefault();

	const url = '../rutas/confirmarNuevaClave.php';
    const data = $(this).serialize();

	$.ajax({
         url: url,
         data: data,
         method: 'POST'
	}).done(response => {
		if (response.error) {
			console.log(response.message);
			alert(response.message);
		} else {
			alert(response.message);
		}
	});
}