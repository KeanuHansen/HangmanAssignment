<!DOCTYPE html>

<html>
    <?php
        session_start();

        $servername = "sql102.epizy.com";
        $username = "epiz_31690256";
        $password = "vHEIxJPd8gt";
        $dbname = "epiz_31690256_keanureeves";

        $connection = new mysqli($servername, $username, $password, $dbname);

        $randomNumberSQL = "UPDATE randomint SET random = (SELECT FLOOR(RAND()*(10-1+1))+1) WHERE id = 1";
    ?>

    <body>
        
    <form action="guessnumber.php" method="post">

        <p>Hello! Enter your name: <input type="text" name="name"/></p>

        <input type="submit" value="Submit"/>
    </form>
    </body>

</html>