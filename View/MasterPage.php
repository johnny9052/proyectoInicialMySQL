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

        <!-- Navbar goes here -->
        <nav class="blue">
            <?php
            include("View/MasterPage/Banner.php");
            include("View/MasterPage/Menu.php");
            ?>
        </nav>


        <!--Page Layout here -->
        <main>
            <div class="row">
                <div class="col s12">
                    <?php
                    if (isset($_SESSION['Page'])) {
                        include($_SESSION['Page'] . ".php");
                    } else {
                        include("View/Home/Home.php");
                    }
                    ?>
                </div>
            </div>
        </main>


        <footer class="page-footer center-row blue fixed">
            <?php
            include("View/MasterPage/Footer.php");
            ?>
        </footer>


    </body>
</html>
