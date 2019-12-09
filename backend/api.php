<?php
/**
 * User: Jose J. Pardines
 * Date: 2019-12-08
 */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('entities/node.class.php');
$node = new Node();
$node->setDB($node->connect("localhost"));

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $node->getNodes($_GET);
} else {
    $node->setError('HTTP RQUEST not supported', 500);
}
echo $node;
