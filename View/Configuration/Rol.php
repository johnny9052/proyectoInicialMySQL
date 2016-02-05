<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <!--        <link href="Resource/Style/Security/LogIn.css" rel="stylesheet">-->

        <script type="text/javascript" src="Resource/Script/Configuration/Rol.js"></script>
    </head>
    <body>


        <br>       

        <a class="l3 btn-floating btn modal-trigger" id="btnOpen" href="#ModalNew">
            <i class="material-icons">add</i>
        </a>

        <br>
        <br>

        <div id="ModalNew" class="modal modal-fixed-footer">
            <div class="modal-content">
                <!-- CENTRAR LOS ELEMENTOS DEL FORMULARIO -->
                <div class="container col s12" id="FormContainer">  

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="txtId" name="id" class="identificator"  type="text" value="">                    
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s12">
                            <input id="txtName" name="name" type="text" value="" autocomplete="off" required
                                   placeholder="Nombre del rol">
                            <label class="messageInfo" for="name" data-error="Este campo es obligatorio" data-success="">                                
                            </label>
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="txtDescription" name="description" class="materialize-textarea" value="" autocomplete="off" 
                                      placeholder="Descripcion"></textarea>
                            <label class="messageInfo" for="description" data-error="" data-success="">                                
                            </label>
                        </div>
                    </div>
                </div>   
            </div>

            <div  class="buttonContainer modal-footer center-row">

                <div class="progress">
                    <div class="indeterminate"></div>
                </div>


                <br>

                <a class="buttonAction l4 btn-floating" id="btnSave" 
                   onclick="save();"><i class="material-icons">save</i></a>                                


                <a class="buttonAction l4 btn-floating" id="btnCancel" 
                   onclick="closeWindow();"><i class="material-icons">cancel</i></a>                                

            </div>
        </div>



        <table  class="centered responsive-table striped" id="TblList">                        
        </table>




    </body>
</html>
