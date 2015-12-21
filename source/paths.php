<?php
$_base = __DIR__;

define('PATH', [
    'BASE'      => $_base,
    'PUBLIC'    => dirname($_base) . '/html',
    'LOCALE'    => $_base . '/App/Lang',
    'CONFIG'    => $_base . '/App/Config',
    'TEMPLATE'  => $_base . '/App/Templates',
]);