<link rel="stylesheet" href="<?= site_url(); ?>public/css/frm-edit-membresias-view.css">
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"><?= esc($title); ?></h2>
                        
            <div class="card mb-4 col-md-8">
                <div class="card-header">
                    <i class="fa-solid fa-users"></i> <?= esc($subtitle); ?>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url().'update-membresia';?>" method="post">
                        <?= 
                            csrf_field();
                            
                            if (isset($membresia) && $membresia != NULL) {

                                $asistencia = explode(",", $membresia->dias_asistencia);
                                //echo '<pre>'.var_export($asistencia, true).'</pre>';exit;
                                echo '
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="nombre" 
                                        id="FormControlInput" 
                                        value="'.$membresia->nombre.'" 
                                        required 
                                        placeholder="nombre" 
                                        readonly
                                    >
                                </div>
                                <div class="mb-3">
                                    <label for="num_documento" class="form-label">Cédula:</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="num_documento" 
                                        id="FormControlInput" 
                                        value="'.$membresia->num_documento.'" 
                                        required placeholder="CI" 
                                        readonly
                                    >
                                </div>
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono:</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="telefono" 
                                        id="FormControlInput" 
                                        value="'.$membresia->telefono.'" 
                                        required 
                                        placeholder="teléfono" 
                                        readonly
                                    >
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input 
                                        type="email" 
                                        class="form-control" 
                                        name="email" 
                                        id="FormControlInput" 
                                        value="'.$membresia->email.'" 
                                        required 
                                        placeholder="jdoe@email.com" 
                                        readonly
                                    >
                                </div>
                                <div class="form-floating mb-4">
                                    <textarea 
                                        class="form-control" 
                                        placeholder="Observaciones" 
                                        id="floatingTextarea"
                                        rows="4"
                                        name="observacion"
                                    >'.$membresia->observacion.'</textarea>
                                    <label for="floatingTextarea">Observaciones</label>
                                </div>';
                            }
                            echo form_hidden('idmiembros', $membresia->idmiembros);
                            echo form_hidden('idmembresias', $membresia->idmembresias);
                        ?>
                        <div class="mb-3">
                            <label for="email" class="form-label">Membresías:</label>
                            <select class="form-select" aria-label="Default select example" name="idpaquete" id="idpaquete">
                                <?php 
                                    foreach ($paquetes as $key => $paquete) {
                                        if ($membresia->idpaquete == $paquete->idpaquete) {
                                            echo '<option value="'.$paquete->idpaquete.'" selected>'.$paquete->paquete.'</option>';
                                        }else{
                                            echo '<option value="'.$paquete->idpaquete.'">'.$paquete->paquete.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                            <p id="error-message"><?= session('errors.idpaquete');?> </p>
                        </div>
                        <div class="mb-3 mt-2" id="dias-semana">
                            <table id="tabla-semana" class="table">
                                <thead><th colspan="7">Días de Asistencia</th></thead>
                                <thead>
                                    <th>Lunes</th>
                                    <th>Martes</th>
                                    <th>Miércoles</th>
                                    <th>Jueves</th>
                                    <th>Viernes</th>
                                    <th>Sábado</th>
                                    <th>Domingo</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                            if ($asistencia[0] == 1) {
                                                echo '
                                                    <td id="td-center">
                                                        <div class="form-check">
                                                            <input 
                                                                class="form-check-input" 
                                                                type="checkbox" 
                                                                value="1" 
                                                                id="flexCheckDefault" 
                                                                name="lunes" 
                                                                checked
                                                            >
                                                        </div>
                                                    </td>
                                                ';
                                            }else{
                                                echo '
                                                    <td id="td-center">
                                                        <div class="form-check">
                                                            <input 
                                                                class="form-check-input" 
                                                                type="checkbox" 
                                                                value="1" 
                                                                id="flexCheckDefault" 
                                                                name="lunes"
                                                            >
                                                        </div>
                                                    </td>
                                                ';
                                            }

                                            if ($asistencia[1] == 2) {
                                                echo '
                                                    <td id="td-center">
                                                        <div class="form-check">
                                                            <input 
                                                                class="form-check-input" 
                                                                type="checkbox" 
                                                                value="2" 
                                                                id="flexCheckDefault" 
                                                                name="martes" 
                                                                checked
                                                            >
                                                        </div>
                                                    </td>
                                                ';
                                            }else{
                                                echo '
                                                    <td id="td-center">
                                                        <div class="form-check">
                                                            <input 
                                                                class="form-check-input" 
                                                                type="checkbox" 
                                                                value="2" 
                                                                id="flexCheckDefault" 
                                                                name="martes" 
                                                            >
                                                        </div>
                                                    </td>
                                                ';
                                            }

                                            if ($asistencia[2] == 3) {
                                                echo '
                                                    <td id="td-center">
                                                        <div class="form-check">
                                                            <input 
                                                                class="form-check-input" 
                                                                type="checkbox" 
                                                                value="3" 
                                                                id="flexCheckDefault" 
                                                                name="miercoles" 
                                                                checked
                                                            >
                                                        </div>
                                                    </td>
                                                ';
                                            }else{
                                                echo '
                                                    <td id="td-center">
                                                        <div class="form-check">
                                                            <input 
                                                                class="form-check-input" 
                                                                type="checkbox" 
                                                                value="3" 
                                                                id="flexCheckDefault" 
                                                                name="miercoles" 
                                                            >
                                                        </div>
                                                    </td>
                                                ';
                                            }

                                            if ($asistencia[3] == 4) {
                                                echo '
                                                    <td id="td-center">
                                                        <div class="form-check">
                                                            <input 
                                                                class="form-check-input" 
                                                                type="checkbox" 
                                                                value="4" 
                                                                id="flexCheckDefault" 
                                                                name="jueves" 
                                                                checked
                                                            >
                                                        </div>
                                                    </td>
                                                ';
                                            }else{
                                                echo '
                                                    <td id="td-center">
                                                        <div class="form-check">
                                                            <input 
                                                                class="form-check-input" 
                                                                type="checkbox" 
                                                                value="4" 
                                                                id="flexCheckDefault" 
                                                                name="jueves" 
                                                            >
                                                        </div>
                                                    </td>
                                                ';
                                            }

                                            if ($asistencia[4] == 5) {
                                                echo '
                                                    <td id="td-center">
                                                        <div class="form-check">
                                                            <input 
                                                                class="form-check-input" 
                                                                type="checkbox" 
                                                                value="5" 
                                                                id="flexCheckDefault"
                                                                name="viernes" 
                                                                checked
                                                            >
                                                        </div>
                                                    </td>
                                                ';
                                            }else{
                                                echo '
                                                    <td id="td-center">
                                                        <div class="form-check">
                                                            <input 
                                                                class="form-check-input" 
                                                                type="checkbox" 
                                                                value="5" 
                                                                id="flexCheckDefault"
                                                                name="viernes" 
                                                            >
                                                        </div>
                                                    </td>
                                                ';
                                            }

                                            if ($asistencia[5] == 6) {
                                                echo '
                                                    <td id="td-center">
                                                        <div class="form-check">
                                                            <input 
                                                                class="form-check-input" 
                                                                type="checkbox" 
                                                                value="6" 
                                                                id="flexCheckDefault" 
                                                                name="sabado" 
                                                                checked
                                                            >
                                                        </div>
                                                    </td>
                                                ';
                                            }else{
                                                echo '
                                                    <td id="td-center">
                                                        <div class="form-check">
                                                            <input 
                                                                class="form-check-input" 
                                                                type="checkbox" 
                                                                value="6" 
                                                                id="flexCheckDefault" 
                                                                name="sabado"
                                                            >
                                                        </div>
                                                    </td>
                                                ';
                                            }

                                            if ($asistencia[6] == 7) {
                                                echo '
                                                    <td id="td-center">
                                                        <div class="form-check">
                                                            <input 
                                                                class="form-check-input" 
                                                                type="checkbox" 
                                                                value="7" 
                                                                id="flexCheckDefault" 
                                                                name="domingo" 
                                                                checked
                                                            >
                                                        </div>
                                                    </td>
                                                ';
                                            }else{
                                                echo '
                                                    <td id="td-center">
                                                        <div class="form-check">
                                                            <input 
                                                                class="form-check-input" 
                                                                type="checkbox" 
                                                                value="7" 
                                                                id="flexCheckDefault" 
                                                                name="domingo" 
                                                            >
                                                        </div>
                                                    </td>
                                                ';
                                            }
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                            <p id="error-message"><?= session('errors.dias');?> </p>
                        </div>
                        <input type="submit" name="submit" value="Actualizar" class="btn btn-outline-info" />
                        <a href="<?= site_url(); ?>membresias" class="btn btn-outline-secondary" id="btn-cancela">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= site_url(); ?>public/js/edit-membresia-miembro.js"></script>