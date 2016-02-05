/* Funciones jQuery */
$(window).load(function () {
    //$("#txtUser").focus();
    list();
});

function save() {
    if (validateForm() === true) {
        Execute(scanInfo('save'), 'Configuration/CtlRol', '', 'closeWindow();list();');
    }
}

function list() {
    Execute(scanInfo('list'), 'Configuration/CtlRol', '', 'buildPaginator(info);');
}

function showData() {
    openWindow();
}