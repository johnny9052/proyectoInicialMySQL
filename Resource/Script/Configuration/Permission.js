/* Funciones jQuery */
$(window).load(function () {
    list();
});


function list() {
    Execute(scanInfo('list'), 'Configuration/CtlRol', '', 'buildPaginator(info);');
}

function search(id) {
    $("#txtId").val(id);
    Execute(scanInfo('load', false), 'Configuration/CtlPermission', '', 'BuildPermission(info);');
}


function showData(info) {
    $("#txtId").val(info[0].id);
    $("#txtFirstName").val(info[0].primer_nombre);
    $("#txtSecondName").val(info[0].segundo_nombre);
    $("#txtFirstLastName").val(info[0].primer_apellido);
    $("#txtSecondLastName").val(info[0].segundo_apellido);
    $("#txtUser").val(info[0].usuario);
    refreshSelect("selRol", info[0].rol);
    $("#txtDescription").val(info[0].descripcion);
    openWindow();
    showButton(false);
}


function update() {
    var temp = new Array();
    temp.push("permission");
    $(":checked").each(function () {
        var elemento = this;
        temp.push(elemento.value);
    });


    if (validateForm() === true) {
        Execute(scanInfo('update', true, '', [{datos: temp}]), 'Configuration/CtlPermission', '', 'closeWindow();list();');
    }
}




/**
 * A partir de los menus de la base de datos, los organiza como una lista de 
 * objetos, con sus padres y sus respectivos hijos
 * @param {Array} data JSON con la informacion de la base de datos
 * @returns {ArrayObject} lista de objetos estructurados con padres e hijos
 * @author Johnny Alexander Salazar
 * @version 0.1
 */
function BuildPermission(info) {
    $("#FormContainerPermission").html(info.res);
    Execute(scanInfo('loadPermission', true), 'Configuration/CtlPermission', '', 'CheckPermission(info);');
}


/**
 * Cada permiso que se encuentra lo marca en la interfaz
 * @param {Array} padres Lista con los padres y los hijos
 * @returns {void} 
 * @author Johnny Alexander Salazar
 * @version 0.1
 */
function CheckPermission(padres) {
    for (var x in padres) {
        //SI TIENE HIJOS PINTA EL PADRE Y SUS HIJOS
        if (padres[x].hijos.length > 0) {
            for (var y in padres[x].hijos) {
                //SE AÑADE CADA HIJO POR CADA PADRE
                $("#" + padres[x].hijos[y].id).prop('checked', true);
            }
        }

    }
    openWindow();
}