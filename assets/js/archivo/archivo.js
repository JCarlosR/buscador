$(document).ready(function(){
	$modalDelete = $("#delete-modal");
	$modalCreate = $("#create-modal");

	$(document).on('click', '[data-delete]', showModalDelete);
	$("#form-delete").on('submit', deleteFile);

	$("#btn-create").on('click', showModalCreate);
	$("#form-create").on('submit', createFile);

    $("#cboOpcion").on('change', activeCboUsuarios);
});

var $modalDelete;
var $modalCreate;

function activeCboUsuarios() {
    if ($(this).val() == 3) {
        $.ajax({
            url: '../rutas/traerUsuarios.php',
            method: 'POST'
        })
        .done(function(response) {
            console.log(response);
            if (response.error) {
                console.log(response.usuarios);
            } else {
                $('#cboUsuarios').empty();
                for (var i = 0; i < response.usuarios.length; i++) {
                    $('#cboUsuarios').append($('<option>', {
                        value: response.usuarios[i][0],
                        text: response.usuarios[i][2]
                    }));                    
                };
                $('#cboUsuarios').multiSelect('refresh');

                console.log(response.usuarios);
            }
        });

        $("#divUsuarios").css("display","");
    } else {

        $("#divUsuarios").css("display","none");
    };
}

function showModalDelete() {
	event.preventDefault();

	$id = $(this).data('delete');
	$archivo = $(this).data('archivo');

	$modalDelete.find('[id="id"]').val($id);
	$modalDelete.find('[id="archivo"]').val($archivo);

	$modalDelete.modal({
		show: true,
		backdrop:'static'
	});
}

function deleteFile() {
	event.preventDefault();

    var url = '../rutas/eliminarArchivo.php';
    var data = $("#form-delete").serializeArray();

    $.ajax({
        url: url,
        data: data,
        method: 'POST'
    })
    .done(function(response) {
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

function showModalCreate() {
	event.preventDefault();

	$modalCreate.modal({
		show: true,
		backdrop:'static'
	});
}

function createFile() {
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
    .done(function(response) {
    	console.log(response);
        if (response.error) {
        	console.log(response.message);
            alert(response.message);
        } else {
            alert(response.message);
            //location.reload();
        }
    });
}