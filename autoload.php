<?php

spl_autoload_register(function ($class) {
    @include __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $class . '.php';
});