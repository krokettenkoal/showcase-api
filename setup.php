<?php

require_once __DIR__ . '/__setup/DebugUtils.php';

$composerFound = file_exists(__DIR__ . '/bin/composer.phar');
$autoloadFound = file_exists(__DIR__ . '/vendor/autoload.php');

$dependencyAction = array_key_exists('dep', $_GET) ? $_GET['dep'] : null;
$installAction = array_key_exists('install', $_GET) ? $_GET['install'] : null;

enum KernelName {
    case NT;
    case UNIX;
}

/**
 * Get the kernel name of the operating system.
 * This simplifies OS name variants to a single name.
 * @param string $os The OS name to simplify. Defaults to the current OS.
 * @return KernelName The name (enum) of the operating system kernel
 */
function getKernelName(string $os = PHP_OS): KernelName {
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
function installComposer(string $os = PHP_OS): void {
    $kernel = getKernelName($os);
    switch ($kernel){
        case KernelName::NT:
            DebugUtils::exec_dump('cmd /c ".\__setup\install-composer.cmd" 2>&1');
            break;
        case KernelName::UNIX:
            DebugUtils::exec_dump('sh ./__setup/install-composer.sh 2>&1');
            break;
    }
}

/**
 * Run the Composer phar with the given action.
 * @param string $action The action to run. Defaults to 'install'.
 * @param string $os The operating system to run on. Defaults to the current OS.
 * @return void
 */
function runComposer(string $action = 'install', string $os = PHP_OS): void {
    $kernel = getKernelName($os);
    $setEnv = match ($kernel) {
        KernelName::NT => 'set',
        default => 'export',
    };

    DebugUtils::exec_dump("$setEnv HOME=./ && php ./bin/composer.phar $action 2>&1");
}
?>
<html lang="en">
<head>
    <title>API Installer | UAS Showcase</title>
    <style>
        body {
            font-family: Helvetica, Tahoma, Arial, sans-serif;
            background-color: #131313;
            color: white;
        }
        pre {
            max-height: 40vh;
            overflow-y: auto;
            background-color: black;
            border-radius: .5rem;
            padding: 1rem .5rem;
        }
        .command {
            font-style: italic;
            color: #ccc;
        }
        .success {
            color: forestgreen;
        }
        .error {
            color: crimson;
        }
        .warn {
            color: orange;
        }
        .btn {
            display: inline-block;
            padding: .5rem 1rem;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: .5rem;
            margin: 1rem 0;
            text-transform: capitalize;
        }
    </style>
</head>
<body>
<h1>Showcase API Installer</h1>
<main>
    <h2>System information</h2>
    <?php
    echo '<p>Operating System: ' . PHP_OS . ' (' . getKernelName()->name . ' kernel)' . '</p>';
    echo '<p>PHP version: ' . phpversion() . '</p>';
    ?>
    <h2>Composer</h2>
    <?php
    $installBtnValue = $composerFound ? 'Reinstall/Update Composer' : 'Install Composer';
    $composerStatus = $composerFound ? 'Composer is already installed.' : 'Composer is not installed yet.';
    $composerStatusClass = $composerFound ? 'success' : 'warn';

    echo '<p class="' . $composerStatusClass . '">' . $composerStatus . '</p>';
    echo '<a href="?install=composer" class="btn">' . $installBtnValue . '</a>';

    if($installAction === 'composer') {
        installComposer();
    }
    ?>
    <h2>Dependencies</h2>
    <?php
    $depBtnAction = $autoloadFound ? 'update' : 'install';
    $depStatus = $autoloadFound ? 'Dependencies are already installed.' : 'Dependencies are not installed yet.';
    $depStatusClass = $autoloadFound ? 'success' : 'warn';

    echo '<p class="' . $depStatusClass . '">' . $depStatus . '</p>';

    if($composerFound){
        echo '<a href="?dep=' . $depBtnAction . '" class="btn">' . $depBtnAction . ' dependencies</a>';

        if($dependencyAction !== null) {
            runComposer($dependencyAction);
        }
    }
    ?>
</main>
</body>
</html>
