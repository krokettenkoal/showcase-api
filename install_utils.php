<?php

function dump_install_output($code, $output)
{
    echo '<pre>';
    if (count($output) == 0) {
        echo "No output";
    } else {
        foreach ($output as $line) {
            echo $line . PHP_EOL;
        }
    }
    echo '</pre>';
    $res_class = $code ? 'error' : 'success';
    echo "<p class='$res_class'>Installation " . ($code ? "failed with error code $code" : 'successful') . '</p>';
}