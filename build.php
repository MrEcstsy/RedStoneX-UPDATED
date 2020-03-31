<?php

$output = "RedstoneXUpdated.phar";

if(is_file($output)) {
    unlink($output);
}

$phar = new Phar($output);
$phar->startBuffering();
$phar->buildFromDirectory(__DIR__);
$phar->stopBuffering();

echo "RedstoneX phar file has been built";
