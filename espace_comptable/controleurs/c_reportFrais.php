<?php

    $var = filter_input(INPUT_POST , 'name', FILTER_SANITIZE_STRING);
    if(!empty($var)){
        var_dump(3);
    }

?>