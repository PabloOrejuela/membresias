let btnfechaInicio = document.querySelectorAll('[data-bs-target="#fechaInicioModal"]');
let btnfechaFinal = document.querySelectorAll('[data-bs-target="#fechaFinalModal"]');

btnfechaInicio.forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation()
        let id = this.dataset.id
        let fecha = this.dataset.fecha
        let dateFechaInicio = document.getElementById('fecha_inicio_membresia')
        let idmembresias = document.getElementById('idmembresias')
        
        dateFechaInicio.value = fecha
        idmembresias.value = id
        $('#fechaInicioModal').modal();
    });
});

function actualizarFechaInicioMembresia(){

    //console.log(horaSalidaPedido);
    $.ajax({
        dataType:"html",
        url: "membresias/actualizarFechaInicioMembresia",
        method: 'get',
        data: { 
            id: document.getElementById('idmembresias').value,
            fechaInicio: document.getElementById('fecha_inicio_membresia').value,
        },
        beforeSend: function (f) {
            alertaMensaje("Procesando", 500, "info")
        },
        success: function(data){
            //console.log(data);
            alertaMensaje("La fecha se ha actualizado", 2000, "success")
            setTimeout(function(){
                location.replace('membresias');
            }, 3000);
        },
        error: function(){
            alertaMensaje("Error: La fecha no se pudo actualizar", 2000, "error")
        }
    });
}

btnfechaFinal.forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation()
        let id = this.dataset.id
        let fecha = this.dataset.fecha
        let dateFechaFinal = document.getElementById('fecha_final_membresia')
        let idmembresias = document.getElementById('idmembresias')
        
        dateFechaFinal.value = fecha
        idmembresias.value = id
        $('#fechaFinalModal').modal();
    });
});

function actualizarFechaFinalMembresia(){

    //console.log(horaSalidaPedido);
    $.ajax({
        dataType:"html",
        url: "membresias/actualizarFechaFinalMembresia",
        method: 'get',
        data: { 
            id: document.getElementById('idmembresias').value,
            fechaFinal: document.getElementById('fecha_final_membresia').value,
        },
        beforeSend: function (f) {
            alertaMensaje("Procesando", 500, "info")
        },
        success: function(data){
            //console.log(data);
            alertaMensaje("La fecha se ha actualizado", 2000, "success")
            setTimeout(function(){
                location.replace('membresias');
            }, 3000);
        },
        error: function(){
            alertaMensaje("Error: La fecha no se pudo actualizar", 2000, "error")
        }
    });
}

$(document).ready(function () {
    $.fn.DataTable.ext.classes.sFilterInput = "form-control form-control-sm search-input";
    $('#datatablesSimple').DataTable({
        "responsive": true, 
        "order": [[1, 'asc']],
        lengthMenu: [
            [5, 10, 20, 30 -1],
            [5, 10, 20, 30, 'Todos']
        ],
        language: {
            processing: 'Procesando...',
            lengthMenu: 'Mostrando _MENU_ registros por página',
            zeroRecords: 'No hay registros',
            info: 'Mostrando _START_ a _END_ de _MAX_',
            infoEmpty: 'No hay registros disponibles',
            infoFiltered: '(filtrando de _MAX_ total registros)',
            search: 'Buscar',
            paginate: {
            first:      "Primero",
            previous:   "Anterior",
            next:       "Siguiente",
            last:       "Último"
                },
                aria: {
                    sortAscending:  ": activar para ordenar ascendentemente",
                    sortDescending: ": activar para ordenar descendentemente"
                }
        },
        //"lengthChange": false, 
        "autoWidth": false,
        "dom": "<'row'<'col-sm-12 col-md-8'l><'col-md-12 col-md-2'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>"
    });
});

const alertaMensaje = (msg, time, icon) => {
    const toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: time,
        //timerProgressBar: true,
        //height: '200rem',
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
        customClass: {
            // container: '...',
            popup: 'popup-class',
        }
    });
    toast.fire({
        position: "top-end",
        icon: icon,
        title: msg,
    });
}