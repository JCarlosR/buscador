$(document).ready(function(){
	$modalDelete = $("#delete-modal");

	$modalCreate = $("#create-modal");

    $modalResult = $("#result-modal");

	$(document).on('click', '[data-delete]', showModalDelete);
	$("#form-delete").on('submit', deleteTerm);

	$("#btn-create").on('click', showModalCreate);
	$("#form-create").on('submit', createTerm);

    $(document).on('click', '[data-search]', searchTerm);

    $(document).on('click', '[data-details]', showDetails);
});

var $modalDelete;
var $modalCreate;
var $modalResult;

function showDetails() {
    $("[name=coincidenciaResult]").each(function() {
        $(this).remove();
    });
    var idResultado = $(this).data('details');
    var termino = $(this).data('termino');
    var url = '../rutas/coincidenciasResultado.php';

    $modalResult.find('[id="terminoBuscado"]').val(termino);

    $.ajax({
        url: url,
        data: {
            idResultado: idResultado
        },
        method: 'POST'
    })
    .done(function( response ) {
        console.log(response);
        if(response.error) {
            console.log(response.coincidencias.length);
            alert(response.message);
        }else{
            if (response.coincidencias.length == 0) {
                alert("Sin coincidencias");
            }else{
                //console.log(response.coin);
                for (var i = 0; i < response.coincidencias.length; i++) {
                    var body = '<input type="text" value="'+response.coincidencias[i][0]+'" disabled="" name="coincidenciaResult" class="form-control col-xs-10 col-sm-10" />';
                    $("#coincidencias").append(body);
                };

                $modalResult.modal({
                    show:true,
                    backdrop:'static'
                });

            }
            
            
            

            //location.reload();
        }

    });
}

function searchTerm() {
    event.preventDefault();

    $("[name=resultadosBusqueda]").each(function() {
        $(this).remove();
    });

    var url = '../rutas/buscarTermino.php';
    var idTerm = $(this).data('search');
    var term = $(this).data('termino');

    $.ajax({
        url: url,
        data: {
            idTerm: idTerm, 
            term:term
        },
        method: 'POST'
    })
    .done(function(response) {
        console.log(response);
        if (response.error) {
            console.log(response.message);
            alert(response.message);
        } else {
            if (response.results.length == 0) {
                alert("Sin coincidencias");
            } else {
                console.log(response.results[0][0]);
                for (var i = 0; i < response.results.length; i++) {
                    var body = '<tr name="resultadosBusqueda">'+
                                    '<td>'+response.results[i][0]+'</td>'+
                                    '<td>'+response.results[i][1]+'</td>'+
                                    '<td>'+response.results[i][2]+'</td>'+
                                    '<td>'+response.results[i][3]+'</td>'+
                                    '<td>'+
                                        '<a href="#" data-details="'+response.results[i][0]+'" data-termino="'+response.results[i][1]+'" class="on-default remove-row"><i class="fa fa-eye"></i></a>'+
                                        '<a href="#" data-send="'+response.results[i][0]+'" data-termino="" class="on-default remove-row"><i class="fa fa-send-o"></i></a>'+
                                    '</td>'+
                                '</tr>';
                    $("#tablaResultados").append(body);
                };            
            }            
            
            // location.reload();
        }

    });
}

function showModalDelete () {
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

function deleteTerm () {
	event.preventDefault();
    var url = '../rutas/eliminarTermino.php';
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

function createTerm () {
	event.preventDefault();
    var url = '../rutas/guardarTermino.php'; 
	var data = $("#form-create").serializeArray();
	console.log(data);
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