function showMessage(titulo, texto){
    swall({
        title: titulo,
        type: 'success',
        text: texto,
        icon: "success",
        showCancelButton: false,
        allowOutsideClick: false,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Ok',
        closeOnConfirm: false,
        closeOnEsc: false,
        timer: 10000,
        html: true
    });
}