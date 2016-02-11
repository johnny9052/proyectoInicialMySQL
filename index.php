<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!--Prevenir autocompletado -->
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="-1">

        <title>Sistema</title>

        <!--Import materialize.css ONLINE-->
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">-->
        <!--Import materialize.css OFFLINE-->
        <link type="text/css" rel="stylesheet" href="Resource/Framework/Materialize/css/materialize.min.css"  media="screen,projection"/>

        <!-- Personal Styles -->
        <link href="Resource/Style/General.css" rel="stylesheet">


        <!-- ICONOS ONLINE-->
        <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
        <!-- ICONOS OFFLINE-->
        <link href="Resource/Framework/Materialize/css/icons.css" rel="stylesheet">


        <!--Import jQuery before materialize.js ONLINE-->
        <!--<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>-->
        <!--Import jQuery before materialize.js OFFLINE-->
        <script type="text/javascript" src="Resource/Framework/Jquery/jquery-2.1.1.min.js"></script>



        <!--Import materialize.js ONLINE-->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>-->
        <!--Import materialize.js OFFLINE-->
        <script type="text/javascript" src="Resource/Framework/Materialize/js/materialize.min.js"></script>

        <!-- GENERAL JS -->
        <script defer type="text/javascript" src="Resource/Script/General/General.js"></script>
    </head>
    <body>
        <?php
        session_start();

        if (isset($_SESSION["User"])) {
            include("View/MasterPage.php");
        } else {
            include("View/Security/LogIn.php");
        }
        ?>


        <div class="row center-row">
            <div class="col s12 ">
                <label>
                    <?php
                    if (isset($_GET['MessageLogIn'])) {
                        echo $_GET['MessageLogIn'];
                    }
                    ?>
                </label>
            </div>
        </div>

    </body>
</html>
