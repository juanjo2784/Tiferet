function validar() {
    var name = document.getElementById("Nombre").value;
    var cel = document.getElementById("Telefono").value;
    var mail = document.getElementById("Correo").value;
    var asunto = document.getElementById("Asunto").value;
    var mensaje = document.getElementById("Mensaje").value;
    var ercel = /^3+[1|2|5]+[0-9]{8}$/i;
    var ermail = /\w+@\w+\.+[a-z]/;

    if(name == "" || cel == "" || mail=="" || asunto == "" || mensaje == ""){
        alert("Error - Campos en blancos, todos los datos son necesarios");
        return false;
    } else if (!ercel.test(cel)) {
        alert("El numero digitado no es valido " );
        return false;
    } else if(!ermail.test(mail)){
        alert("El correo digitado no es valido " );
        return false;
    }else {
        if(confirm("Esta seguro de enviar el correo?")){
            return true;
        }else{
            return false;
        }
    }

 }