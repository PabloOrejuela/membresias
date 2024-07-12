<link rel="stylesheet" href="<?= site_url(); ?>public/css/frm-nuevo-usuario.css">
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
                    <form action="<?php echo site_url().'usuario-insert';?>" method="post">
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
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="telefono" 
                                maxlength="10" 
                                id="telefono" 
                                value="<?= old('telefono'); ?>" 
                                placeholder="teléfono"
                                onkeydown = "return soloNumeros(event)"
                            >
                            <p id="error-message"><?= session('errors.telefono');?> </p>
                        </div>
                        <div class="mb-3 col-md-8">
                            <label for="user" class="form-label">Usuario:</label>
                            <input type="text" class="form-control" name="user" id="user" value="<?= old('user'); ?>" placeholder="Usuario">
                            <p id="error-message"><?= session('errors.user');?> </p>
                        </div>
                        <div class="mb-3 col-md-8">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" value="<?= old('password'); ?>" placeholder="password">
                            <p id="error-message"><?= session('errors.password');?> </p>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?= old('email'); ?>"  placeholder="jdoe@email.com">
                            <p id="error-message"><?= session('errors.email');?> </p>
                        </div>
                        <div class="mb-3">
                            <label for="idrol" class="form-label">Rol del usuario:</label>
                            <select class="form-select" aria-label="Default select example" name="idrol">
                                <option value="0">Elija un rol</option>
                                <?php 
                                    foreach ($roles as $key => $rol) {
                                        echo '<option value="'.$rol->idrol.'">'.$rol->rol.'</option>';
                                    }
                                ?>
                            </select>
                            <p id="error-message"><?= session('errors.idrol');?> </p>
                        </div>

                        <input type="submit" name="submit" value="Guardar" class="btn btn-outline-info" />
                        <p>
                        <?= session('errors.nombre');?> 
                        <?= session('errors.num_documento');?> 
                        <?= session('errors.telefono');?>
                        <?= session('errors.email');?>
                        <?= session('errors.idrol');?>
                        <?= session('errors.user');?>
                        <?= session('errors.password');?>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= site_url(); ?>public/js/frm-nuevo-usuario.js"></script>