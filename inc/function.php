<?php

/* fonction de debug/visualisation des variables */
function debug($variable)
{
    echo '<pre>'. print_r($variable, true). '</pre>';
}