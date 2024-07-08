<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= esc($title); ?></h1>       
            <div class="card mb-4 col-md-6">
                <div class="card-header">
                    <i class="fa-solid fa-user-pen"></i>
                    <?= esc($title); ?>
                </div>
                <div class="card-body">

                <?= session()->getFlashdata('error') ?>
                <?= service('validation')->listErrors() ?>
                <form action="<?php echo site_url().'actualizar';?>" method="post">
                    <?= csrf_field(); ?>
                    <?php
                    
                        if (isset($datos) && $datos != NULL) {
                            
                                echo '
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="nombre" 
                                        id="FormControlInput" 
                                        value="'.$datos->nombre.'" 
                                        required 
                                        placeholder="nombre"
                                    >
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="num_documento" class="form-label">Cédula:</label>
                                    <input 
                                    type="text" 
                                    class="form-control" 
                                    name="num_documento" 
                                    id="num_documento" 
                                    value="'.$datos->num_documento.'" 
                                    required 
                                    placeholder="CI"
                                >
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento:</label>
                                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="'.$datos->fecha_nacimiento.'" placeholder="Fecha de Nacimiento">
                                </div>
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono:</label>
                                    <input type="text" class="form-control" name="telefono" id="telefono" value="'.$datos->telefono.'" required placeholder="teléfono">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" name="email" id="email" value="'.$datos->email.'" required placeholder="jdoe@email.com">
                                </div>
                                </br>
                                <h4>Información de repersentante (en caso de que sea menor de edad)</h4>
                                <div class="mb-3 col-md-4">
                                    <label for="representante" class="form-label">Representante:</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="representante" 
                                        id="representante" 
                                        value="'.$datos->representante.'" 
                                        placeholder="representante"
                                    >
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="telf_representante" class="form-label">Teléfono representante:</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="telf_representante" 
                                        maxlength="10" 
                                        id="telf_representante" 
                                        value="'.$datos->telf_representante.'" 
                                        placeholder="teléfono representante"
                                    >
                                </div>';
                                echo '<br>';
                                echo '<h4>Información de contactos de emergencia</h4>';
                                echo '
                                    <div class="mb-3 col-md-4">
                                        <label for="nombre_contacto" class="form-label">Nombre de contacto:</label>
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            name="nombre_contacto" 
                                            id="nombre_contacto" 
                                            value="'.$datos->nombre_contacto.'" 
                                            placeholder="Nombre contacto de emergencia"
                                        >
                                    </div>
                                    
                                    <div class="mb-3 col-md-8">
                                        <label for="telf_contacto" class="form-label">Teléfono contacto:</label>
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            name="telf_contacto" 
                                            maxlength="10" 
                                            id="telf_contacto" 
                                            value="'.$datos->nombre_contacto.'" 
                                            placeholder="Teléfono contacto de emergencia"
                                        >
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email_contacto" class="form-label">Email_contacto:</label>
                                        <input 
                                            type="email_contacto" 
                                            class="form-control" 
                                            name="email_contacto" 
                                            id="email_contacto" 
                                            value="'.$datos->email_contacto.'"  
                                            placeholder="jdoe@email.com"
                                        >
                                    </div>
                                ';
                            }
                            echo form_hidden('idmiembros', $datos->idmiembros);
                    ?>
                    <p>
                        <?= session('errors.nombre');?> 
                        <?= session('errors.num_documento');?> 
                        <?= session('errors.fecha_nacimiento');?>
                        <?= session('errors.telefono');?>
                        <?= session('errors.email');?>
                    </p>
                    <input type="submit" name="submit" value="Actualizar" class="btn btn-outline-info" />
                </form>
            </div>
        </div>
    </div>
</main>