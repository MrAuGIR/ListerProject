<?php

/* fonction de debug/visualisation des variables */
function debug($variable)
{
    echo '<pre>'. print_r($variable, true). '</pre>';
}


/** 
* Controle des données utilisateurs
* type = 'email', 'text'(default)
*/
function verify_input_form($inputDate, string $type='text'):string{
    if($type === 'text'){
        $inputSanitize = htmlspecialchars($inputDate);
        $inputSanitize = filter_var($inputSanitize,FILTER_SANITIZE_STRING);
    }else{
        $inputSanitize = filter_var($inputDate,FILTER_SANITIZE_EMAIL);
    }
    
    return $inputSanitize;

}