$(document).ready(function(){
	$modalEdit = $("#edit-modal");

	$modalDelete = $("#delete-modal");

	$modalCreate = $("#create-modal");

	$(document).on('click', '[data-edit]', showModalEdit);
	$("#form-edit").on('submit', editUser);

	$(document).on('click', '[data-delete]', showModalDelete);
	$("#form-delete").on('submit', deleteUser);

	$("#btn-create").on('click', showModalCreate);
	$("#form-create").on('submit', createUser);
});

var $modalEdit;
var $modalDelete;
var $modalCreate;

function showModalEdit () {
	event.preventDefault();
	$id = $(this).data('edit');
	$email = $(this).data('email');
	$username = $(this).data('username');

	$modalEdit.find('[id="id"]').val($id);
	$modalEdit.find('[id="email"]').val($email);
	$modalEdit.find('[id="username"]').val($username);

	$modalEdit.modal({
		show:true,
		backdrop:'static'
	});
}

function editUser () {
	event.preventDefault();
    var url = '../rutas/modificarUsuario.php';
    var data = $("#form-edit").serializeArray();
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

function showModalDelete () {
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

function showModalCreate () {
	event.preventDefault();

	$modalCreate.modal({
		show:true,
		backdrop:'static'
	});
}

function createUser () {
	event.preventDefault();
    var url = '../rutas/registrarUsuario.php';
    var data = $("#form-create").serializeArray();
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