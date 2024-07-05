<link rel="stylesheet" href="<?= site_url(); ?>public/css/registra_aistencia_instructor_view.css">
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= esc($title); ?></h1>    
            <div class="card mb-4 col-md-5">
                <div class="card-header">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="card-body">
                    
                    <form action="<?php echo site_url().'registra_aistencia_instructor';?>" method="post" name="form_registro" >
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="hora_inicio" class="form-label">Hora de inicio:</label>
                            <input type="text" class="form-control" name="hora_inicio" id="reloj" readonly  placeholder="<?= date('Y-m-d H:m:s'); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Instructor:</label>
                            <select 
                                id="nombreInstructor" 
                                name="nombre" 
                                class="form-select form-control-border" 
                                required="required"
                            >
                            <option value="0" selected>--Seleccionar Instructor--</option>
                            <?php
                                if (isset($instructores)) {
                                    foreach ($instructores as $key => $instructor) {
                                        echo '<option value="'.$instructor->idusuario.'" '.set_select('vendedor', $instructor->idusuario, false).'>'.$instructor->nombre.'</option>';
                                    }
                                }
                            ?>
                            </select>
                            <p id="error-message"><?= session('errors.nombre');?> </p>
                        </div>
                        <div id="imagen" class="mb-3">
                        </div>

                        <div class="mb-3">
                            <label for="num_documento" class="form-label">Cedula:</label>
                            <input type="text" class="form-control" name="num_documento" id="num_documento" value="<?= old('num_documento'); ?>"  placeholder="cedula" readonly>
                            <p id="error-message"><?= session('errors.num_documento');?> </p>
                        </div>
                        <div class="mb-3">
                            <textarea name="observaciones" class="form-control" placeholder="Observaciones"></textarea>
                        </div>
                        <?php
                            $url = base_url();
                            echo '<script languaje="JavaScript">
                                    var varjs="'.$url.'";
                                    </script>';
                         ?> 
                        <input type="submit" name="submit" value="Registrar" class="btn btn-outline-info" />
                        
                    </form>
                    <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <?php
                
                if (session('mensaje') && session('mensaje') == "exito") {
                  echo'<div class="alert alert-success mt-2" role="info">La asistencia se registró exitosamente</div>';
                }else if(session('mensaje') == "error"){
                    echo'<div class="alert alert-danger mt-2" role="alert">Hubo un error no se pudo registrar</div>';
                }
              ?>
              
            </div>
            <!-- /.col -->
          </div>
                </div>
            </div>
        </div>
    </main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= site_url(); ?>public/js/registra_aistencia_instructor_view.js"></script>
<script type="text/javascript">
    function mueveReloj(){
        momentoActual = new Date()
        
        //anio = momentoActual.getYear()
        mes = momentoActual.getMonth()
        dia = momentoActual.getDay()
        hora = momentoActual.getHours()
        minuto = momentoActual.getMinutes()
        segundo = momentoActual.getSeconds()

        horaImprimible = hora + " : " + minuto + " : " + segundo

        document.form_registro.reloj.value = horaImprimible
        setTimeout("mueveReloj()",1000)
    }
</script>

