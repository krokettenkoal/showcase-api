<?php

require_once __DIR__ . '/__setup/SetupUtils.php';

$composerFound = file_exists(__DIR__ . '/bin/composer.phar');
$autoloadFound = file_exists(__DIR__ . '/vendor/autoload.php');

$disableSetup = array_key_exists('disable', $_GET);
$dependencyAction = array_key_exists('dep', $_GET) ? $_GET['dep'] : null;
$installAction = array_key_exists('install', $_GET) ? $_GET['install'] : null;

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
        .btn {
            display: inline-block;
            padding: .5rem 1rem;
            background-color: #005096;
            color: white;
            text-decoration: none;
            border-radius: .5rem;
            margin: 1rem 0;
            text-transform: capitalize;
            font-weight: bold;
        }
        .btn:hover {
            filter: brightness(1.1);
            transition: filter .2s ease-in-out;
        }
        section {
            background-color: #1a1a1a;
            padding: 1rem;
            border-radius: .5rem;
            margin: 1rem 0;
        }
        .success {
            color: forestgreen;
        }
        .bg-success {
            background-color: #155415;
        }
        .error {
            color: crimson;
        }
        .bg-error {
            background-color: #650f21;
        }
        .warn {
            color: orange;
        }
        .bg-warn {
            background-color: #885d11;
        }
        .bg-success a,
        .bg-error a,
        .bg-warn a {
            color: white;
        }
    </style>
</head>
<body>
<main>
    <h1>Showcase API Installer</h1>
    <section class="bg-error">
        <?php
        if($disableSetup){
            SetupUtils::setupEnabled(false);
        }

        if(!SetupUtils::setupEnabled()){
            echo '<p>Setup is currently disabled. Consult the <a href="https://github.com/krokettenkoal/showcase-api#enable-disable-the-installer-setup-page" target="_blank">README</a> to enable it.</p>';
            exit;
        } else {
            echo '<p><strong>Setup is currently enabled.</strong></p>';
            echo '<p>Once you are done with the setup, it is <strong>highly recommended</strong> you disable it.</p>';
            echo '<a href="?disable" class="btn">Disable setup</a>';
        }
        ?>
    </section>

    <h2>System information</h2>
    <section>
        <?php
        echo '<p>Operating System: ' . PHP_OS . ' (' . SetupUtils::getKernelName()->name . ' kernel)' . '</p>';
        echo '<p>PHP version: ' . phpversion() . '</p>';
        ?>
    </section>

    <h2>Composer</h2>
    <section>
        <?php
        $installBtnValue = $composerFound ? 'Reinstall/Update Composer' : 'Install Composer';
        $composerStatus = $composerFound ? 'Composer is already installed.' : 'Composer is not installed yet.';
        $composerStatusClass = $composerFound ? 'success' : 'warn';

        echo '<p class="' . $composerStatusClass . '">' . $composerStatus . '</p>';
        echo '<a href="?install=composer" class="btn">' . $installBtnValue . '</a>';

        if($installAction === 'composer') {
            SetupUtils::installComposer();
        }
        ?>
    </section>

    <h2>Dependencies</h2>
    <section>
        <?php
        $depBtnAction = $autoloadFound ? 'update' : 'install';
        $depStatus = $autoloadFound ? 'Dependencies are already installed.' : 'Dependencies are not installed yet.';
        $depStatusClass = $autoloadFound ? 'success' : 'warn';

        echo '<p class="' . $depStatusClass . '">' . $depStatus . '</p>';

        if($composerFound){
            echo '<a href="?dep=' . $depBtnAction . '" class="btn">' . $depBtnAction . ' dependencies</a>';

            if($dependencyAction !== null) {
                SetupUtils::runComposer($dependencyAction);
            }
        }
        ?>
    </section>
</main>
</body>
</html>
