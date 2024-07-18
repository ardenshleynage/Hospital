<?php
include ("../dao/dao_superusers.php");
$allusersDAO = new ListUsers();
$num_users = $allusersDAO->getAllUsersNumber();

$allowusersDAO = new ListAllowUsers();
$num_allow_users = $allowusersDAO->getAllowUsersNumber();

$blockusersDAO = new ListBlockUsers();
$num_block_users = $blockusersDAO ->getBlockUsersNumber();



?>