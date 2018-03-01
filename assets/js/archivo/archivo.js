$(document).ready(function(){
	/*$modalDelete = $("#delete-modal");*/

	$modalCreate = $("#create-modal");

	/*$(document).on('click', '[data-delete]', showModalDelete);
	$("#form-delete").on('submit', deleteUser);*/

	$("#btn-create").on('click', showModalCreate);
	$("#form-create").on('submit', createFile);
});

var $modalDelete;
var $modalCreate;

/*function showModalDelete () {
	event.preventDefault();
	$id = $(this).data('delete');
	$username = $(this).data('username');

	$modalDelete.find('[id="id"]').val($id);
	$modalDelete.find('[id="username"]').val($username);

	$modalDelete.modal({
		show:true,
		backdrop:'static'
	});
}

function deleteUser () {
	event.preventDefault();
    var url = '../rutas/eliminarUsuario.php';
    var data = $("#form-delete").serializeArray();
    $.ajax({
        url: url,
        data: data,
        method: 'POST'
    })
    .done(function( response ) {
    	console.log(response);
        if(response.error) {
        	console.log(response.message);
            alert(response.message);
        }else{
            alert(response.message);
            location.reload();
        }

    });
}
*/
function showModalCreate () {
	event.preventDefault();

	$modalCreate.modal({
		show:true,
		backdrop:'static'
	});
}

function createFile () {
	event.preventDefault();
    var url = '../rutas/subirArchivo.php'; 
	var data = new FormData($("#form-create")[0]);
	console.log(data);
    $.ajax({
        url: url,
        data: data,
        method: 'POST',
        contentType: false,
    	processData: false
    })
    .done(function( response ) {
    	console.log(response);
        if(response.error) {
        	console.log(response.message);
            alert(response.message);
        }else{
            alert(response.message);
            location.reload();
        }

    });
}