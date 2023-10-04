<?php
require_once './debug_utils.php';
?>
<html lang="en">
<head>
    <title>API Debugger | Showcase</title>
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
    </style>
</head>
<body>
<h1>API Debugger</h1>
<main>
    <h2>lighttpd directory</h2>
    <?php
    exec_dump("ls /etc/lighttpd", false);
    ?>
    <h2>lighttpd config</h2>
    <?php
    exec_dump("cat /etc/lighttpd/lighttpd.conf", false);
    ?>
</main>
</body>
</html>
