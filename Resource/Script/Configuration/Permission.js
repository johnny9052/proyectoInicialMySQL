/* Funciones jQuery */
$(window).load(function () {
    list();
});


function save() {
    if (validateForm() === true) {
        Execute(scanInfo('save', true), 'Configuration/CtlUser', '', 'closeWindow();list();');
    }
}

function list() {
    Execute(scanInfo('list'), 'Configuration/CtlRol', '', 'buildPaginator(info);');
}


function search(id) {
    $("#txtId").val(id);
    Execute(scanInfo('search', true), 'Configuration/CtlUser', '', 'showData(info);');
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
    if (validateForm() === true) {
        Execute(scanInfo('update', true), 'Configuration/CtlUser', '', 'closeWindow();list();');
    }
}


function deleteInfo() {
    Execute(scanInfo('delete', true), 'Configuration/CtlUser', '', 'closeWindow();list();');
}



/**
 * A partir de los menus de la base de datos, los organiza como una lista de 
 * objetos, con sus padres y sus respectivos hijos
 * @param {Array} data JSON con la informacion de la base de datos
 * @returns {ArrayObject} lista de objetos estructurados con padres e hijos
 * @author Johnny Alexander Salazar
 * @version 0.1
 */
function FixPermission(data) {
    data = eval(data);
    var padres = new Array();

    /*Se sacan los codigos de los padres*/
    for (var x in data) {
        if (data[x].codpadre === "-1") {
            padres.push({id: data[x].id, nombre: data[x].nombre, prioridad: data[x].prioridad, hijos: ""});
        }
    }

    /*Por cada padre se sacan sus hijos*/
    for (var x in padres) {
        var temp = new Array();
        for (var y in data) {
            if (padres[x].id === data[y].codpadre) {
                temp.push([{id: data[y].id, nombre: data[y].nombre, prioridad: data[y].prioridad, codigo: data[y].codigo}]);
            }
        }
        padres[x].hijos = temp;
    }

    return padres;
}