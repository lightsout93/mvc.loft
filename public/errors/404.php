404 not found
<br>
<?php if (file_exists(__DIR__.'/../../debug')) : ?>
    Error: <br><pre>
    <?php
    echo 'line:'. $e->getLine()."<br>";
    echo 'File:'. $e->getFile() . "<br>";
    echo $e->getMessage()."<br>";
    echo $e->getTraceAsString();
endif;

$data = $_POST;
var_dump($data);