let $modalResult;

$(function() {
    $modalResult = $("#result-modal");

    // $(document).on('click', '[data-search]', searchTerm);
    $(document).on('click', '[data-details]', showDetails);

    $('[data-toggle="tooltip"]').tooltip();
});

function showDetails() {
    $("[name=coincidenciaResult]").each(function() {
        $(this).remove();
    });

    const idResultado = $(this).data('details');
    const termino = $(this).data('termino');
    const url = '../rutas/coincidenciasResultado.php';

    $modalResult.find('[id="terminoBuscado"]').val(termino);

    $.ajax({
        url: url,
        data: {
            idResultado: idResultado
        },
        method: 'POST'
    }).done(function(response) {
        console.log(response);
        if (response.error) {
            console.log(response);
            alert(response.message);
        } else {
            if (response.coincidencias.length === 0) {
                alert("Sin coincidencias");
            } else {
                // console.log(response);
                let coincidences = '';
                for (let i=0; i<response.coincidencias.length; i++) {
                    coincidences += '<input type="text" value="' + response.coincidencias[i][0]
                                    + '" disabled name="coincidenciaResult" class="form-control" />';
                }

                $("#coincidencias").append(coincidences);

                $modalResult.modal({
                    show: true,
                    backdrop: 'static'
                });

            }
        }

    });
}

function searchTerm() {
    event.preventDefault();

    $("[name=resultadosBusqueda]").each(function() {
        $(this).remove();
    });

    const url = '../rutas/buscarTermino.php';
    const idTerm = $(this).data('search');
    const term = $(this).data('termino');

    $.ajax({
        url: url,
        data: {
            idTerm: idTerm, 
            term:term
        },
        method: 'POST'
    }).done(function(response) {
        console.log(response);

        if (response.error) {
            console.log(response.message);
            alert(response.message);
        } else {
            if (response.results.length === 0) {
                alert("Sin coincidencias");
            } else {
                console.log(response.results[0][0]);
                for (let i = 0; i < response.results.length; i++) {
                    const body = '<tr name="resultadosBusqueda">'+
                                    '<td>'+response.results[i][0]+'</td>'+
                                    '<td>'+response.results[i][1]+'</td>'+
                                    '<td>'+response.results[i][2]+'</td>'+
                                    '<td>'+response.results[i][3]+'</td>'+
                                    '<td>'+
                                        '<button data-details="'+response.results[i][0]+'" data-termino="'+response.results[i][1]+'" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button>'+
                                        ' ' +                                        
                                        '<button data-send="'+response.results[i][0]+'" data-termino="" class="btn btn-sm btn-info"><i class="fa fa-send-o"></i></button>'+
                                    '</td>'+
                                '</tr>';
                    $("#tablaResultados").append(body);
                }
            }
        }

    });
}
