<?php

const setupDisableFile = __DIR__ . '/.disabled';

enum KernelName {
    case NT;
    case UNIX;
}

class SetupUtils {
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

    /**
     * Get the kernel name of the operating system.
     * This simplifies OS name variants to a single name.
     * @param string $os The OS name to simplify. Defaults to the current OS.
     * @return KernelName The name (enum) of the operating system kernel
     */
    public static function getKernelName(string $os = PHP_OS): KernelName {
        return match ($os) {
            'WINNT', 'Windows', 'WIN32' => KernelName::NT,
            default => KernelName::UNIX,
        };
    }

    /**
     * Install the Composer phar to the bin directory.
     * @param string $os The operating system to install for. Defaults to the current OS.
     * @return void
     */
    public static function installComposer(string $os = PHP_OS): void {
        $kernel = self::getKernelName($os);
        switch ($kernel){
            case KernelName::NT:
                SetupUtils::exec_dump('cmd /c ".\__setup\install-composer.cmd" 2>&1');
                break;
            case KernelName::UNIX:
                SetupUtils::exec_dump('sh ./__setup/install-composer.sh 2>&1');
                break;
        }
    }

    /**
     * Run the Composer phar with the given action.
     * @param string $action The action to run. Defaults to 'install'.
     * @param string $os The operating system to run on. Defaults to the current OS.
     * @return void
     */
    public static function runComposer(string $action = 'install', string $os = PHP_OS): void {
        $kernel = self::getKernelName($os);
        $setEnv = match ($kernel) {
            KernelName::NT => 'set',
            default => 'export',
        };

        SetupUtils::exec_dump("$setEnv HOME=./ && php ./bin/composer.phar $action 2>&1");
    }

    /**
     * Gets or sets the state of the setup page.
     * @param bool|null $state The state to set. If null, the current state is returned.
     * @return bool The (new) state of the setup page
     */
    public static function setupEnabled(?bool $state = null): bool {
        if($state === null){
            //  Get state
            return !file_exists(setupDisableFile);
        }

        //  Set state
        if($state){
            if(file_exists(setupDisableFile)){
                unlink(setupDisableFile);
            }
        } else {
            if(!file_exists(setupDisableFile)){
                file_put_contents(setupDisableFile, '');
            }
        }

        return $state;
    }
}
