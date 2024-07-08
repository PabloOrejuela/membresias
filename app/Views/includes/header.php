<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Miembros</title>

        <link href="<?= site_url(); ?>public/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        
        <script src="https://kit.fontawesome.com/90e597c088.js" crossorigin="anonymous"></script>

        <!-- DataTables -->
        <link rel="stylesheet" href="<?= site_url(); ?>public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"> 
        <link rel="stylesheet" href="<?= site_url(); ?>public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="<?= site_url(); ?>public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="<?= site_url(); ?>public/js/scripts.js"></script>
        <script src="<?= site_url(); ?>public/js/ajax.js"></script>
    </head>
    <body class="sb-nav-fixed" onload="mueveReloj()" >
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?= site_url(); ?>"><img src="<?= site_url(); ?>public/img/icono-64.png" alt="logo" id="img-logo">YouShop</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form> -->
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto  mr-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Editar</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="<?= site_url(); ?>salir">Salir</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menú</div>
                            <!-- Menu Item -->
                            <?php 
                                //echo '<pre>'.var_export($permisos, true).'</pre>';
                                if (isset($permisos) && $permisos->membresia == 1) {
                                echo '
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuthMembresias" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Membresías
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuthMembresias" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="'.site_url().'membresias">Lista Membresías</a>
                                            <a class="nav-link" href="'.site_url().'transfer">Transferencias</a>
                                            <a class="nav-link" href="'.site_url().'frm_asigna_membresia_miembro">Asigna membresía</a>
                                        </nav>
                                    </div>
                                </nav>';
                                }
                            ?>
                            <!-- Menu Item -->
                            <?php 
                                if (isset($permisos) && $permisos->usuarios == 1) {
                                echo '
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuthUsuarios" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Usuarios
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuthUsuarios" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="'.site_url().'usuarios">Lista de usuarios</a>
                                            <a class="nav-link" href="'.site_url().'nuevo-usuario">Nuevo Usuario</a>
                                        </nav>
                                    </div>
                                </nav>';
                                }
                            ?>
                                <!-- END Menú Item -->
                                <!-- Menu Item -->
                            <?php
                                if (isset($permisos) && $permisos->membresia == 1) {
                                echo'    
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuthMiembros" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Miembros
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuthMiembros" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="'.site_url().'miembros">Lista de miembros</a>
                                            <a class="nav-link" href="'.site_url().'nuevo">Nuevo Miembro</a>
                                            
                                        </nav>
                                    </div>
                                </nav>';
                                }
                            ?>
                                <!-- END Menú Item -->
                                
                            <!-- Menu Item -->
                            <?php 
                            
                            if (isset($permisos) && $permisos->instructor == 1) {
                                echo '
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuthInstructores" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Asistencias Instructores
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuthInstructores" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="'.site_url().'registra-asistencia-instructor">Registrar ingreso a clase</a>
                                        </nav>
                                    </div>
                                </nav>';
                                
                                }      
                            ?>
                            <!-- END Menú Item -->
                            <!-- Menu Item -->
                            <?php 
                            
                            if (isset($permisos) && $permisos->reportes == 1) {
                                echo '
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuthReportes" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Reportes
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuthReportes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="'.site_url().'reportes/lista-miembros" target="_blank">Reporte lista de miembros</a>
                                            <a class="nav-link" href="'.site_url().'reportes/lista-membresias" target="_blank">Reporte lista de membresías</a>
                                            <a class="nav-link" href="'.site_url().'reportes/selecciona-instructor" target="_self">Reporte clases por instructor</a>
                                            <a class="nav-link" href="'.site_url().'reportes/reporte-movimientos" target="_blank">Reporte de movimientos</a>
                                        </nav>
                                    </div>
                                </nav>';
                                }
                            ?>
                            <!-- END Menú Item -->
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Usuario:</div>
                        <?= $nombre; ?>
                    </div>
                </nav>
            </div>
            