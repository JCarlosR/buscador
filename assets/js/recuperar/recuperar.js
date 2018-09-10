$(function(){
	$("#frmRecover").on('submit', recoverPassword);
});

function recoverPassword() {
	event.preventDefault();

	const url = '../rutas/recuperar.php';
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