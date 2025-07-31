<?php
// modules/account/main.php

$action = $segments[1] ?? 'login';

if ($action === 'login') {
    include 'login.php';
} elseif ($action === 'logout') {
    include 'logout.php';
} else {
    throw_error(404, 'Account action not found.');
}