<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= esc($title); ?></h1>
                        
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-users"></i>
                    <?= esc($title); ?>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover" id="datatablesSimple" >
                        <thead>
                            <th>Nombre</th>
                            <th>Cédula</th>
                            <th>Teléfono</th>
                            <th>Editar</th>
                        </thead>
                        <?php 
                            if (isset($usuarios) && $usuarios != null) {
                                foreach ($usuarios as $key => $value) {
                                    //$last = $miembrosModel->_get_last_attend($idmembresias);
                                    echo '<tr>
                                            <td>'.$value->nombre.'</td>
                                            <td>'.$value->num_documento.'</td>
                                            <td>'.$value->telefono.'</td>
                                            <td style="text-align:center;">
                                                <a type="button" id="btn-register" href="edita_datos_usuario/'.$value->idusuario.'">
                                                    <i class="fa-solid fa-user-pen"></i>   
                                                </a>
                                            </td>
                                        </tr>';
                                }
                            } else {
                                echo '<tr>
                                        <td colspan="4">No hay registros que mostrar, pudo haber ocurrido un error</td>
                                    </tr>';
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= site_url(); ?>public/js/lista_usuarios.js"></script>