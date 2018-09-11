let $modalCreate;
let $modalDelete;

$(function() {
	$modalCreate = $("#create-modal");
    $modalDelete = $("#delete-modal");

	$("#btn-create").on('click', showModalCreate);
	$("#form-create").on('submit', createTerm);

    $(document).on('click', '[data-delete]', showModalDelete);
    $("#form-delete").on('submit', deleteTerm);
});

function showModalDelete() {
	event.preventDefault();
	$id = $(this).data('delete');
	$termino = $(this).data('termino');

	$modalDelete.find('[id="id"]').val($id);
	$modalDelete.find('[id="termino"]').val($termino);

	$modalDelete.modal({
		show:true,
		backdrop:'static'
	});
}

function deleteTerm() {
	event.preventDefault();
    var url = '../rutas/eliminarTermino.php';
    var data = $("#form-delete").serializeArray();
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

function createTerm() {
	event.preventDefault();
    const url = '../rutas/guardarTermino.php';
	const data = $("#form-create").serializeArray();
	console.log(data);
    $.ajax({
        url: url,
        data: data,
        method: 'POST'
    }).done(function(response) {
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
