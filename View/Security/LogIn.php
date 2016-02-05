<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>LogIn</title>

        <link href="Resource/Style/Security/LogIn.css" rel="stylesheet">

        <script type="text/javascript" src="Resource/Script/Security/LogIn.js"></script>
    </head>
    <body>




        <!-- CENTRAR LOS ELEMENTOS DEL FORMULARIO -->
        <div class="LoginContainer">

            <h4 class="LoginTitulo">Identificacion usuarios</h4>

            <div class="row">

                <div class="input-field col s1 l4">

                </div>                       

                <div class="input-field col s10 l4">                       
                    <div class="box" id="FormContainer">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="txtUser" name="user" type="text" value="" autocomplete="off" required
                                       placeholder="Usuario">
<!--                                <label class="messageInfo" for="user" data-error="Este campo es obligatorio" 
                                       data-success=""></label>-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="txtPassword" name="password" type="password" value="" autocomplete="off" required
                                       placeholder="Password">
<!--                                <label class="messageInfo" for="password" data-error="Este campo es obligatorio" data-success="">                                    
                                </label>-->
                            </div>
                        </div>
                        <div class="row center-btn">
                            <br>
                            <div class="col s12">
                                <a class="waves-effect waves-light btn" id="btnLoguin" onclick="LogIn();"><i class="material-icons left">verified_user</i>Ingresar</a>                
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="progress">
                            <div class="indeterminate"></div>
                        </div>
                    </div>


                    <input type="text" name="type" style="display: none">
                </div>

                <div class="input-field col s1 l4">

                </div>                       

            </div>

        </div>
    </body>
</html>
