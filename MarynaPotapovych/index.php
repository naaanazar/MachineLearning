<?php
ini_set( 'error_reporting', E_ALL);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'ClassArr.php'; 


$a = new ClassArr();
$a->OutArr();
$a->ForwardSort();
$a->BackSort();
$a->Spiral();

    $sort_asc->arrayOut($sort_asc->spiral('ASC'));
    $sort_asc->arrayOut($sort_asc->spiral('DESC'));