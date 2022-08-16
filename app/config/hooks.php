<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | Hooks
  | -------------------------------------------------------------------------
  | This file lets you define "hooks" to extend CI without hacking the core
  | files.  Please see the user guide for info:
  |
  |	https://codeigniter.com/user_guide/general/hooks.html
  |
 */
$hook['pre_system'][] = array(
    'class' => 'By_pass_csrf',
    'function' => 'by_pass_csrf_module',
    'filename' => 'By_pass_csrf.php',
    'filepath' => 'hooks',
    'params' => array()
);
