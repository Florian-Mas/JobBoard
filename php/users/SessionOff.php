<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
session_unset();
session_destroy();
echo json_encode("session détruite");