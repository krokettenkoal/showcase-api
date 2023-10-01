<?php
    require_once './install_utils.php';
?>
<html lang="en">
<head>
    <title>Install</title>
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
        .success {
            color: forestgreen;
        }
        .error {
            color: crimson;
        }
    </style>
</head>
<body>
    <h1>Showcase API Installer</h1>
    <main>
        <h2>Composer</h2>
        <?php
        $comp_output = [];
        $comp_result_code = 1;
        exec("bash install.sh 2>&1", $comp_output, $comp_result_code);
        echo '<p>bash install.sh</p>';
        dump_install_output($comp_result_code, $comp_output);
        ?>

        <h2>Dependencies</h2>
        <?php
        $dep_output = [];
        $dep_result_code = 1;
        exec("export HOME=./ && php ./bin/composer.phar update 2>&1", $dep_output, $dep_result_code);
        echo '<p>php ./bin/composer.phar update</p>';
        dump_install_output($dep_result_code, $dep_output);
        ?>
    </main>
</body>
</html>
