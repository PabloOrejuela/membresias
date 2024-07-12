<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4"><?= esc($title); ?></h3>
                        
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-users"></i>
                    <h5>Asigna una membresía a un miembro ya registrado</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover" id="datatablesSimple" >
                        <thead>
                            <th>Nombre</th>
                            <th>Cédula</th>
                            <th>Asigna membresía</th>
                        </thead>
                        <?php 
                        
                            if ($miembrosList != null) {
                                foreach ($miembrosList as $key => $value) {
                                    //$last = $miembrosModel->_get_last_attend($idmembresias);
                                    echo '<tr>
                                            <td>'.$value->nombre.'</td>
                                            <td>'.$value->num_documento.'</td>
                                            <td style="text-align:center;">
                                                <a type="button" id="btn-register" href="asigna_membresia_miembro/'.$value->idmiembros.'">
                                                    <i class="fa-solid fa-user-pen"></i>   
                                                </a>
                                            </td>
                                        </tr>';
                                }
                            }else {
                                echo '<tr>
                                        <td colspan="3">No hay información que mostrar, puede haber ocurrido un error</td>
                                    </tr>';
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= site_url(); ?>public/js/grid-asigna-membresia.js"></script>