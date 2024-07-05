let nombreInstructor = document.querySelector('#nombreInstructor')

nombreInstructor.addEventListener('change', (e) => {
    //e.stopPropagation()
    let id = nombreInstructor.value
    
    $.ajax({
        url: 'get-instructor',
        method: 'GET',
        dataType: 'json',
        data: { 
            id: id,
        },
        beforeSend: function (f) {
            alertProcesando("Procesando..." , "warning")
        },
        success: function(res){
            // let result =  JSON.parse(res);
            let numDocumento = document.getElementById("num_documento")
            numDocumento.value = res[0].num_documento
            alertProcesando("Procesando" , "success")
        },
        error: function(res){
            alertProcesando("Hubo un error, no se pudo seleccionar el instructor", "error")
        }
    });
});

const alertProcesando = (msg, icono) => {
    const toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
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
        icon: icono,
        title: msg
    });
}