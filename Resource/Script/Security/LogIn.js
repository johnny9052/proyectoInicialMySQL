/* Funciones jQuery */
$(window).load(function () {
    $("#txtUser").focus();
});

/* Identificar a un usuario del sistema */
function LogIn() {
    if (validateForm() === true) {
        Execute(scanInfo('', true), 'Security/CtlLogIn', '', 'location.reload();');
    }
}