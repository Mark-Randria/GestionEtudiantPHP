
<?php

    $connPDO = new PDO('mysql:host=localhost;dbname=gestiondesnotes', 'root', '');
    $connPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>