let paquete = document.getElementById("idpaquete");
let diasSemana = document.getElementById("dias-semana");


paquete.addEventListener("change", function(e) {
    alertaMensaje("Se ha cambiado el valor del paquete", 1000, "info")

    diasSemana.style.display = "block"
})

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