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
    </head>
    <body>
        <ul id="ContainerTitleUser" class="right">   
            <h6 id="titleUser">
                <?php
                if (isset($_SESSION["UserName"])) {
                    echo "Bienvenid@: " . $_SESSION["UserName"];
                }
                ?>                                
            </h6>
        </ul>
    </body>
</html>
