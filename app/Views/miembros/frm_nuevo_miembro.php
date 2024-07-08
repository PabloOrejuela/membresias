<link rel="stylesheet" href="<?= site_url(); ?>public/css/frm_nuevo_miembro.css">
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= esc($title); ?></h1>
                        
            <div class="card mb-4 col-md-6">
                <div class="card-header">
                    <i class="fa-solid fa-users"></i>
                    <?= esc($title); ?>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url().'insert';?>" method="post">
                        <?= csrf_field() ?>
                        <h4><?= esc($title); ?></h4>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" id="FormControlInput" value="<?= old('nombre'); ?>"  placeholder="nombre">
                            <p id="error-message"><?= session('errors.nombre');?> </p>
                        </div>
                        <div class="mb-3 col-md-8">
                            <label for="num_documento" class="form-label">No. de documento:</label>
                            <input type="text" class="form-control" name="num_documento" maxlength="10" id="num_documento" value="<?= old('num_documento'); ?>" placeholder="CI">
                            <p id="error-message"><?= session('errors.num_documento');?> </p>
                        </div>
                        <div class="mb-3 col-md-8">
                            <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento:</label>
                            <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="<?= old('fecha_nacimiento'); ?>" placeholder="Fecha de Nacimiento">
                            <p id="error-message"><?= session('errors.fecha_nacimiento');?> </p>
                        </div>
                        <div class="mb-3 col-md-8">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" name="telefono" maxlength="10" id="telefono" value="<?= old('telefono'); ?>" placeholder="teléfono">
                            <p id="error-message"><?= session('errors.telefono');?> </p>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?= old('email'); ?>"  placeholder="jdoe@email.com">
                            <p id="error-message"><?= session('errors.email');?> </p>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Membresías:</label>
                            <select class="form-select" aria-label="Default select example" name="idpaquete">
                                <option value="0">Elija un paquete</option>
                                <?php 
                                    foreach ($paquetes as $key => $paquete) {
                                        echo '<option value="'.$paquete->idpaquete.'">'.$paquete->paquete.'</option>';
                                    }
                                ?>
                            </select>
                            <p id="error-message"><?= session('errors.idpaquete');?> </p>
                        </div>
                        </br>
                        <h4>Información de representante (en caso de que sea menor de edad)</h4>
                        <div class="mb-3 col-md-4">
                            <label for="representante" class="form-label">Representante:</label>
                            <input type="text" class="form-control" name="representante" id="representante" value="<?= old('representante'); ?>" placeholder="representante">
                            <p id="error-message"><?= session('errors.representante');?> </p>
                        </div>
                        <div class="mb-3 col-md-8">
                            <label for="telf_representante" class="form-label">Teléfono representante:</label>
                            <input type="text" class="form-control" name="telf_representante" maxlength="10" id="telf_representante" value="<?= old('telf_representante'); ?>" placeholder="teléfono representante">
                            <p id="error-message"><?= session('errors.telf_representante');?> </p>
                        </div>
                        </br>
                        <h4>Información de contactos de emergencia</h4>
                        <div class="mb-3 col-md-4">
                            <label for="nombre_contacto" class="form-label">Nombre de contacto:</label>
                            <input type="text" class="form-control" name="nombre_contacto" id="nombre_contacto" value="<?= old('representante'); ?>" placeholder="Nombre contacto de emergencia">
                            <p id="error-message"><?= session('errors.nombre_contacto');?> </p>
                        </div>
                        
                        <div class="mb-3 col-md-8">
                            <label for="telf_contacto" class="form-label">Teléfono contacto:</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="telf_contacto" 
                                maxlength="10" 
                                id="telf_contacto" 
                                value="<?= old('telf_representante'); ?>" 
                                placeholder="Teléfono contacto de emergencia"
                            >
                            <p id="error-message"><?= session('errors.telf_contacto');?> </p>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email_contacto" class="form-label">Email_contacto:</label>
                            <input 
                                type="email_contacto" 
                                class="form-control" 
                                name="email_contacto" 
                                id="email_contacto" 
                                value="<?= old('email_contacto'); ?>"  
                                placeholder="jdoe@email.com"
                            >
                            <p id="error-message"><?= session('errors.email_contacto');?> </p>
                        </div>
                        <p>
                        <?= session('errors.nombre');?> 
                        <?= session('errors.num_documento');?> 
                        <?= session('errors.fecha_nacimiento');?>
                        <?= session('errors.telefono');?>
                        <?= session('errors.email');?>
                    </p>
                        <input type="submit" name="submit" value="Guardar" class="btn btn-outline-info" />
                    </form>
                </div>
            </div>
        </div>
    </main>

<script type="text/javascript">
    $('document').ready(function(){
        $("#telefono").ForceNumericOnly();
    });

</script>