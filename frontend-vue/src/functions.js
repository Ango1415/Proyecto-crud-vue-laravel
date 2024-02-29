import Swal from "sweetalert2"
import axios from "axios"


export function mostrarAlerta(titulo, icono, foco=''){
    if(foco != ''){
        document.getElementById(foco).focus();
    }

    Swal.fire({
        title : titulo,
        icon : icono,
        customClass : {confirmButton: 'btn btn-primary', popup : 'animated zoonIn'},
        buttonStyle : false,
    })
}

export function confirmarAlerta(urlWithSlash, id, titulo, msg){
    let url = `${urlWithSlash}${id}`
    const swalWithBootstrap = Swal.mixin({
        customClass: {confirmButton: 'btn btn-success me-3', cancelButton: 'btn btn-danger'}
    })
    swalWithBootstrap.fire({
        title: titulo,
        text: msg,  
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: '<i class="fa-solid fa-check"></i> Si, eliminar',
        cancelButtonText: '<i class="fa-solid fa-ban"></i> Cancelar',
    }).then((res)=>{
        if(res.isConfirmed){
            enviarSolicitud('DELETE', { }, url, 'Eliminado con éxito');
        }else{
            mostrarAlerta('Operación Cancelada', 'info')
        }
    })
}

export function enviarSolicitud(methodRequest, paramsRequest, urlRequest, msgRequest){
    axios({ 
        method: methodRequest,  
        data: paramsRequest,
        url: urlRequest,

    }).then( function(res) {
        let status = res.status;
        console.log(`${status} \n`)
        if(status === 200){
            mostrarAlerta(msgRequest, 'success')
            window.setTimeout(function(){
                window.location.href='/users/'
            }, 2000)
        }else{
            mostrarAlerta('There was some error in the response', 'error')
        }
    }).catch(function (error) {
        if (error.response) {
          // La respuesta fue hecha y el servidor respondió con un código de estado
          // que esta fuera del rango de 2xx
          console.log(error.response.data);
          console.log(error.response.status);
          console.log(error.response.headers);
        } else if (error.request) {
          // La petición fue hecha pero no se recibió respuesta
          // `error.request` es una instancia de XMLHttpRequest en el navegador y una instancia de
          // http.ClientRequest en node.js
          console.log('Error request');
          console.log(error.request);
        } else {
          // Algo paso al preparar la petición que lanzo un Error
          console.log('Error', error.message);
        }
        console.log(error.config);
        console.log(error.toJSON());
      })
}
