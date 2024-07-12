let imptEmail = document.getElementById("email")

imptEmail.addEventListener('input', function(e){
    e.stopPropagation()
    let email = imptEmail.value
    imptEmail.value = email.toLowerCase()
    
})


function soloNumeros(event) {
    let numero = event.keyCode
    if (numero > 47 && numero < 58 || (numero === 8) || (numero === 9)) {
        return true
    }else{
        return false
    }
}