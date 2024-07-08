<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(false);
//$routes->get('/', 'Home::index');

//USUARIOS
$routes->get('inicio', 'Usuarios::inicio');
$routes->get('salir', 'Usuarios::salir');
$routes->get('/', 'Usuarios::index');
$routes->post('validate', 'Usuarios::validate_credentials');
$routes->get('nuevo-usuario', 'Usuarios::nuevo');
$routes->post('usuario-insert', 'Usuarios::insert');
$routes->get('usuarios', 'Usuarios::showUsuarios');
$routes->get('edita_datos_usuario/(:num)', 'Usuarios::editar/$1');
$routes->get('delete-user/(:num)', 'Usuarios::delete/$1');
$routes->post('actualizar-user', 'Usuarios::update');
$routes->post('getNameCedula', 'Usuarios::usuarios_select');

//ASISTENCIA
$routes->get('asistencia', 'Asistencia::insert');
$routes->get('registra-asistencia-instructor', 'Asistencia::FrmRegistraAsistenciaInstructor');
$routes->get('get-instructor', 'Asistencia::getInstructor');
$routes->post('registra_aistencia_instructor', 'Asistencia::registraAsistenciaInstructor');

//MIEMBROS
$routes->get('miembros', 'Miembros::index');
$routes->get('frm_asigna_membresia_miembro', 'Membresia::frm_asigna_membresia_miembro');
$routes->get('nuevo', 'Miembros::nuevo');
$routes->post('insert', 'Miembros::insert');
$routes->post('actualizar', 'Miembros::update');
$routes->get('pdf', 'Miembros::pdf');
$routes->get('edita_datos_miembro/(:num)', 'Miembros::editar/$1');

//MEMBRESIAS
$routes->get('membresias', 'Membresia::index');
$routes->get('asigna_membresia_miembro/(:num)', 'Membresia::asigna_membresia_miembro/$1');
$routes->post('asign_membresia', 'Membresia::asign_membresia');
$routes->get('edit/(:num)', 'Membresia::edit/$1');
$routes->post('update_date', 'Membresia::update_date');
$routes->post('miembros_select', 'Membresia::miembros_select');
$routes->get('transfer', 'Membresia::frm_select_transfer');
$routes->get('select-transfer-membership/(:num)', 'Membresia::fr_select_member_transfer_membership/$1', ['as' => 'select-transfer_membership']);
$routes->post('transfer_membership', 'Membresia::transfer_membership',['as' => 'transfer_membership']);

//REPORTES
$routes->group('reportes', static function ($routes) {
    $routes->get('index', 'Reportes::index');
    $routes->get('lista-miembros', 'Reportes::listaMiembrosPDF');
    $routes->get('lista-membresias', 'Reportes::listaMembresiasPDF');

    $routes->get('reporte-movimientos', 'Reportes::lista_movimientos');
    $routes->get('selecciona-instructor', 'Reportes::frm_selecciona_instructor');
    $routes->post('genera_reporte_asistencia_instructor', 'Reportes::genera_reporte_asistencia_instructor');
});
// $routes->get('reportes', 'Reportes::index');
// $routes->get('lista-miembros', 'Reportes::listaMiembrosPDF');
// $routes->get('lista-membresias', 'Reportes::listaMembresiasPDF');
$routes->post('genera_reporte_asistencia_instructor', 'Reportes::genera_reporte_asistencia_instructor');


