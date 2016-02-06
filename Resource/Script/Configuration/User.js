/* Funciones jQuery */
$(window).load(function () {
    list();
    loadRol();
});


function loadRol() {
    Execute(scanInfo('loadRol', true), 'General/CtlGeneral', '', 'buildSelect(info,"selRol");');
}

function save() {
    if (validateForm() === true) {
        Execute(scanInfo('save'), 'Configuration/CtlRol', '', 'closeWindow();list();');
    }
}

function list() {
    Execute(scanInfo('list'), 'Configuration/CtlRol', '', 'buildPaginator(info);');
}


function search(id) {
    $("#txtId").val(id);
    Execute(scanInfo('search'), 'Configuration/CtlRol', '', 'showData(info);');
}


function showData(info) {
    $("#txtId").val(info[0].id);
    $("#txtName").val(info[0].nombre);
    $("#txtDescription").val(info[0].descripcion);
    openWindow();
    showButton(false);
}


function update() {
    if (validateForm() === true) {
        Execute(scanInfo('update'), 'Configuration/CtlRol', '', 'closeWindow();list();');
    }
}


function deleteInfo() {
    if (validateForm() === true) {
        Execute(scanInfo('delete'), 'Configuration/CtlRol', '', 'closeWindow();list();');
    }
}
