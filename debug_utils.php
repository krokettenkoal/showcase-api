<?php

function exec_dump(string $command, bool $showResult = true): void
{
    $output = [];
    $result_code = 1;
    exec($command, $output, $result_code);
    echo "<p class='command'>$command</p>";
    dump_output($result_code, $output, $showResult);
}

function dump_output(int $code, array $output, bool $showResult = true): void
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
    if ($showResult) {
        $res_class = $code ? 'error' : 'success';
        echo "<p class='$res_class'>Command " . ($code ? "failed with error code $code" : 'successful') . '</p>';
    }
}
