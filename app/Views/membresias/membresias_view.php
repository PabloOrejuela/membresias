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

                            //En caso de que haya vencido el período
                            if ($diferenciaDias < 0) {
                                $diferenciaDias = 0;
                            }
                            
                            $dias_disponibles = $value->dias - $diferenciaDias;
                            
                            //$saldo = $value->total - $value->asistencias;
                            echo '<tr>
                                    <td>'.$value->nombre.'</td>
                                    <td>'.$value->num_documento.'</td>
                                    <td>'.$value->paquete.'</td>
                                    <td>
                                        <a
                                            type="button" 
                                            id="membresia_'.$value->idmembresias.'" 
                                            href="#" 
                                            data-id="'.$value->idmembresias.'" 
                                            data-fecha="'.$value->fecha_inicio.'" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#fechaInicioModal">'.$value->fecha_inicio.'
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            type="button" 
                                            id="membresia_'.$value->idmembresias.'" 
                                            href="#" 
                                            data-id="'.$value->idmembresias.'" 
                                            data-fecha="'.$value->fecha_final.'" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#fechaFinalModal">'.$value->fecha_final.'
                                        </a>
                                    </td>
                                    <td>'.date("Y-m-d").'</td>'; //FECHA ACTUAL

                            //DIAS
                            echo '<td id="td-center">'.$value->dias.'</td>';
                                    
                            if ($value->tipo == 1) {
                                $saldo = $diferenciaDias;
                                
                                //Dias disponibles (
                                if ($saldo <= ($value->asistencias /3) ){
                                    echo '<td id="td-center">'.number_format($diferenciaDias,0).'</td>';
                                }else{
                                    echo '<td id="td-center">'.number_format($diferenciaDias,0).'</td>';
                                }


                                //ENTRADAS
                                echo '<td id="td-center">'.$value->entradas.'</td>'; 

                                //Entradas disponibles)
                                if ($entradas_disponibles > 0) {
                                    echo '<td id="td-center">'.number_format($entradas_disponibles,0).'</td>'; 
                                } else {
                                    echo '<td id="td-center">0</td>'; 
                                }
                                
                                
                                if ($value->status == 1 && $saldo > 0) {
                                    echo '<td id="td-center">ACTIVA</td>';
                                    echo '<td id="td-center">
                                            <a type="button" id="btn-register" href="asistencia/'.$value->idmembresias.'" 
                                                class="registro" data-bs-toggle="modal" data-bs-target="#asistenciaModal" 
                                                onClick="pasaIdmembresia('.$value->idmembresias.','. $saldo.');"><i class="fa-solid fa-dumbbell"></i> Asistencia
                                            </a>
                                        </td>';
                                    echo '<td id="td-center">
                                            <a type="button" id="btn-register" href="edit/'.$value->idmembresias.'" class="edit">
                                                <img src="'.site_url().'public/img/buttons/edit.png" >
                                            </a>
                                        </td>';
                                }else{
                                    echo '<td id="td-center">CADUCADA</td>';
                                    echo '<td></td>';
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

                                //Estado
                                if ($value->status == 1 && $saldo > 0) {
                                    echo '<td id="td-center">ACTIVA</td>';
                                    echo '<td id="td-center">
                                            <a type="button" id="btn-register" href="asistencia/'.$value->idmembresias.'" 
                                                class="registro" data-bs-toggle="modal" data-bs-target="#asistenciaModal" 
                                                onClick="pasaIdmembresia('.$value->idmembresias.','. $saldo.');"><i class="fa-solid fa-dumbbell"></i> Asistencia
                                            </a>
                                        </td>
                                        <td id="td-center">
                                            <a type="button" id="btn-register" href="edit/'.$value->idmembresias.'" class="edit">
                                                <img src="'.site_url().'public/img/buttons/edit.png" >
                                            </a>
                                        </td>';
                                }else{
                                    echo '<td id="td-center-red">CADUCADA</td>';
                                    echo '<td></td>';
                                    echo '<td id="td-center">
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

<!-- Modal Fecha inicio -->
<div class="modal fade" id="fechaInicioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Fecha inicio de la membresía</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input class="form-control" type="hidden" name="idmembresias" id="idmembresias">
      <input class="form-control" type="date" name="fecha_inicio_membresia" id="fecha_inicio_membresia">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onClick="actualizarFechaInicioMembresia()">Actualizar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Fecha final -->
<div class="modal fade" id="fechaFinalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Fecha final de la membresía</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input class="form-control" type="hidden" name="idmembresias" id="idmembresias">
      <input class="form-control" type="date" name="fecha_final_membresia" id="fecha_final_membresia">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onClick="actualizarFechaFinalMembresia()">Actualizar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= site_url(); ?>public/js/membresias_view.js"></script>
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
            dataType:"html",
            url: "asistencia",
            method: 'get',
            data: $('form#form-asistencia').serialize(),
            
            success: function(response){
                alertaMensaje("Procesando", 1000, "info");
                alertaMensaje("Se ha registrado la asistencia", 3000, "success");
                $('#asistenciaModal').modal('hide');
                setInterval(function () {
                    location.reload(true)
                }, 3000);
            },
            error: function(){
                //alert("Error");
                alertaMensaje("Ha habido un error, no se ha registrado la asistencia", 3000, "error");
                setInterval(function () {
                    location.reload(true)
                }, 5000);
                
            }
        });
        
    }
</script>
<script type="text/javascript">
    /*function actualizar(){
        location.reload(true);}
    //Función para actualizar cada 5 segundos(5000 milisegundos)
    setInterval("actualizar()",35000);*/
</script>


