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
        <link href="Resource/Style/Menu/Menu.css" rel="stylesheet">
        <script type="text/javascript" src="Resource/Script/Menu/Menu.js"></script>
        <script type="text/javascript" src="Resource/Script/Security/LogOut.js"></script>
    </head>
    <body>


        <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>

        <!-- MENU MOVIL #1 -->
        <ul id="slide-out" class="side-nav fixed">               

            <?php
                include 'Helper/Menu/MenuHelper.php';
            ?>        

        </ul>



    </body>
</html>
