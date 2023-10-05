<?php

class DebugUtils {
    /**
     * Executes a command and dumps the output as HTML
     * @param string $command The command to execute
     * @param bool $showResult Whether to show the result of the command (success or error)
     * @return void
     */
    public static function exec_dump(string $command, bool $showResult = true): void
    {
        $output = [];
        $result_code = 1;
        exec($command, $output, $result_code);
        echo "<p class='command'>$command</p>";
        self::dump_output($result_code, $output, $showResult);
    }

    /**
     * Dumps the output of a command as HTML
     * @param int $code The exit code of the command
     * @param array $output The output (lines) of the command
     * @param bool $showResult Whether to show the result of the command (success or error)
     * @return void
     */
    public static function dump_output(int $code, array $output, bool $showResult = true): void
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
}
