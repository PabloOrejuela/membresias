<link rel="stylesheet" href="<?= site_url(); ?>public/css/membresias_view.css">
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= esc($title); ?></h1>    
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-users"></i>
                    <?= esc($title); ?>
                </div>
                <div class="card-body tabla-membresias">
                    <?= csrf_field(); ?>
                    <table class="table table-bordered table-striped table-hover" id="datatablesSimple">
                        <thead>
                            <th>Nombre</th>
                            <th>Cédula</th>
                            <th>Paquete</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Final</th>
                            <th>Fecha Actual</th>
                            <th>Días</th>
                            <th>Disponible(Días)</th>
                            <th>Entradas</th>
                            <th>Entradas disponibles</th>
                            <th>Estado</th>
                            <th>Registrar Asistencia</th>
                            <th>Editar membresía</th>
                        </thead>
                    <?php 
                        //echo '<pre>'.var_export($membresias, true).'</pre>';
                        
                        foreach ($membresias as $key => $value) {
                            //echo $value->tipo;

                            $entradas_disponibles = $value->entradas - $value->asistencias;
                            $fechaActual = date("Y-m-d");
                            $fecha_final = $value->fecha_final;

                            $diferenciaSegundos = strtotime($fecha_final) - strtotime($fechaActual);
                            $diferenciaDias = ($diferenciaSegundos / 86400);
                            
                            $dias_disponibles = $value->dias - $diferenciaDias;

                            
                            //$saldo = $value->total - $value->asistencias;
                            echo '<tr>
                                    <td>'.$value->nombre.'</td>
                                    <td>'.$value->num_documento.'</td>
                                    <td>'.$value->paquete.'</td>
                                    <td>'.$value->fecha_inicio.'</td>
                                    <td>'.$value->fecha_final.'</td>
                                    <td>'.date("Y-m-d").'</td>'; //FECHA ACTUAL

                            //DIAS
                            echo '<td id="td-center">'.$value->dias.'</td>';
                                    
                            if ($value->tipo == 1) {
                                $saldo = $diferenciaDias;
                                //echo $saldo;echo '<pre>'.var_export($saldo, true).'</pre>';
                                if ($saldo <= ($value->asistencias /3) ){
                                    echo '<td id="td-center-red">'.number_format($diferenciaDias,0).'</td>';
                                }else{
                                    echo '<td id="td-center">'.number_format($diferenciaDias,0).'</td>';
                                }
                                //ENTRADAS
                                echo '<td id="td-center">'.$value->entradas.'</td>'; 
                                //Dias disponibles
                                echo '<td id="td-center">'.number_format($saldo,0).'</td>'; 
                                
                                if ($value->status == 1 && $saldo > 0) {
                                    echo '<td>ACTIVA</td><td></td>
                                        <td id="td-center">
                                        <a type="button" id="btn-register" href="edit/'.$value->idmembresias.'" class="edit">
                                            <img src="'.site_url().'public/img/buttons/edit.png" >
                                        </a>
                                    </td>';
                                }else{
                                    echo '<td id="td-center">CADUCADA</td>';
                                    echo '<td id="td-center">
                                            <a type="button" id="btn-register" href="edit/'.$value->idmembresias.'" class="edit">
                                                <img src="'.site_url().'public/img/buttons/edit.png" >
                                            </a>
                                        </td>';
                                }
                                
                            }else{
                                $saldo = $value->entradas - $value->asistencias;
                                if ($saldo <= ($value->asistencias /3) ){
                                    echo '<td >'.$diferenciaDias.'</td>';
                                }else{
                                    echo '<td id="td-center">'.$diferenciaDias.'</td>';
                                }
                                //ENTRADAS
                                echo '<td id="td-center">'.$value->entradas.'</td>'; 
                                //Dias disponibles
                                echo '<td id="td-center">'.$saldo.'</td>';
                                if ($value->status == 1 && $saldo > 0) {
                                    echo '<td id="td-center">ACTIVA</td>';
                                    echo '<td id="td-center">
                                            <a type="button" id="btn-register" href="asistencia/'.$value->idmembresias.'" 
                                                class="registro" data-bs-toggle="modal" data-bs-target="#asistenciaModal" 
                                                onClick="pasaIdmembresia('.$value->idmembresias.','. $saldo.');">Asistencia
                                            </a>
                                        </td>
                                    <td id="td-center">
                                        <a type="button" id="btn-register" href="edit/'.$value->idmembresias.'" class="edit">
                                            <img src="'.site_url().'public/img/buttons/edit.png" >
                                        </a>
                                    </td>';
                                }else{
                                    echo '<td id="td-center-red">CADUCADA</td><td></td>
                                    <td id="td-center">
                                        <a type="button" id="btn-register" href="edit/'.$value->idmembresias.'" class="edit">
                                            <img src="'.site_url().'public/img/buttons/edit.png" >
                                        </a>
                                    </td>';
                                }
                            }
                            
                        
                            echo  '</tr>';
                        }
                    ?>
                    </table>
                </div>
            </div>
        </div>
    </main>

<!-- Modal -->
<div class="modal fade" id="asistenciaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registrar asistencia</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="form-asistencia">
                <?= csrf_field(); ?>
                <input type="hidden" id="idmembresias" name="idmembresias">
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Disponible:</label>
                    <input type="text" class="form-control" id="disponible" name="num_asistencias" readonly>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Número de asistencias:</label>
                    <input type="text" class="form-control" id="num_asistencias" name="num_asistencias" value="1" onChange="verificaMaximo();">
                </div>
                <div class="mb-3">
                    <label for="codigos_multipases" id="codigos_multipases" class="col-form-label">Códigos multipases:</label>
                    <input type="text" class="form-control" id="codigos_multipases" name="codigos_multipases" value="1">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onClick="ActualizaAsistencias();">Registrar</button>
        </div>
    </div>
  </div>
</div>
<script>
    function pasaIdmembresia(idmembresias, entradas){
        $('#idmembresias').val(idmembresias);
        $('#disponible').val(entradas);
    };

    function verificaMaximo(){
        var disponible = $('#disponible').val();
        if ($('#num_asistencias').val() > disponible) {
            alert("Cantidad máxima erronea, máximo permitdo: " + disponible);
            $('#num_asistencias').val(disponible);
        }
    };
    
    function ActualizaAsistencias(){
        //event.preventDefault();
        verificaMaximo();
        
        $.ajax({
            type: "POST",
            url: "asistencia",
            cache:false,
            data: $('form#form-asistencia').serialize(),
            success: function(response){
                alert("Registado");
                $('#asistenciaModal').modal('hide');
            },
            error: function(){
                //alert("Error");
                alert("Registado");
                location.reload(true);
            }
        });
        
    }

    $(document).ready(function () {
        $.fn.DataTable.ext.classes.sFilterInput = "form-control form-control-sm search-input";
        $('#datatablesSimple').DataTable({
            "responsive": true, 
            "order": [[1, 'asc']],
            lengthMenu: [
                [25, 50, -1],
                [25, 50, 'Todos']
            ],
            language: {
                processing: 'Procesando...',
                lengthMenu: 'Mostrando _MENU_ registros por página',
                zeroRecords: 'No hay registros',
                info: 'Mostrando _START_ a _END_ de _MAX_',
                infoEmpty: 'No hay registros disponibles',
                infoFiltered: '(filtrando de _MAX_ total registros)',
                search: 'Buscar',
                paginate: {
                first:      "Primero",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "Último"
                    },
                    aria: {
                        sortAscending:  ": activar para ordenar ascendentemente",
                        sortDescending: ": activar para ordenar descendentemente"
                    }
            },
            //"lengthChange": false, 
            "autoWidth": false,
            "dom": "<'row'<'col-sm-12 col-md-8'l><'col-md-12 col-md-2'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>"
        });
    });
</script>
<script type="text/javascript">
    /*function actualizar(){
        location.reload(true);}
    //Función para actualizar cada 5 segundos(5000 milisegundos)
    setInterval("actualizar()",35000);*/
</script>


