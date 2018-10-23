let $modalEdit;
let $modalDelete;
let $modalCreate;

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

function showModalEdit() {
	event.preventDefault();

	const id = $(this).data('edit');
	const email = $(this).data('email');
	const username = $(this).data('username');
    const active = $(this).data('active');

	$modalEdit.find('[name="id"]').val(id);
	$modalEdit.find('[name="email"]').val(email);
	$modalEdit.find('[name="username"]').val(username);
    $modalEdit.find('[name="active"]').val(active).change();

	$modalEdit.modal({
		show: true,
		backdrop: 'static'
	});
}

function editUser() {
	event.preventDefault();

    const url = '../rutas/modificarUsuario.php';
    const data = $("#form-edit").serializeArray();

    $.ajax({
        url: url,
        data: data,
        method: 'POST'
    })
    .done(function(response) {
    	console.log(response);
        if (response.error) {
        	console.log(response.message);
            alert(response.message);
        } else {
            alert(response.message);
            location.reload();
        }

    });
}

function showModalDelete() {
	event.preventDefault();

	const id = $(this).data('delete');
	const username = $(this).data('username');

	$modalDelete.find('[name="id"]').val(id);
	$modalDelete.find('[name="username"]').val(username);

	$modalDelete.modal({
		show:true,
		backdrop:'static'
	});
}

function deleteUser() {
	event.preventDefault();
    
    const url = '../rutas/eliminarUsuario.php';
    const data = $("#form-delete").serializeArray();
    
    $.ajax({
        url: url,
        data: data,
        method: 'POST'
    })
    .done(function(response) {
    	console.log(response);
        if (response.error) {
        	console.log(response.message);
            alert(response.message);
        } else {
            alert(response.message);
            location.reload();
        }

    });
}

function showModalCreate() {
	event.preventDefault();

	$modalCreate.modal({
		show:true,
		backdrop:'static'
	});
}

function createUser() {
	event.preventDefault();
    
    const url = '../rutas/registrarUsuario.php';
    const data = $("#form-create").serializeArray();
    
    $.ajax({
        url: url,
        data: data,
        method: 'POST'
    })
    .done(function(response) {
    	console.log(response);
        if (response.error) {
        	console.log(response.message);
            alert(response.message);
        } else {
            alert(response.message);
            location.reload();
        }

    });
}
