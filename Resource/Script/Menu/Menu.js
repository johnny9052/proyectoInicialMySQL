$(document).ready(function () {

    //Menu de navegacion
    $('.dropdown-button').dropdown();
    $('.button-collapse').sideNav();

    $('.button-collapse').sideNav({
        menuWidth: 240, // Default is 240
        edge: 'left', // Choose the horizontal origin
        closeOnClick: false // Closes side-nav on <a> clicks, useful for Angular/Meteor
    }
    );

    //loadMenu();

});


/**
 * Trae los menus a los cuales tiene acceso un usuario
 * @returns {void}
 * @author Johnny Alexander Salazar
 * @version 0.1
 */
function loadMenu() {    
    Execute(scanInfo("menu"), "General/CtlMenu", "", "BuildMenu(data);");
}




