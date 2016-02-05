/* Funciones jQuery */
$(window).load(function () {
    $("#txtUser").focus();
});

/* Identificar a un usuario del sistema */
function LogIn() {
    if (validateForm() === true) {
        Execute(scanInfo(), 'Security/CtlLogIn','', 'location.reload();');
    }
}