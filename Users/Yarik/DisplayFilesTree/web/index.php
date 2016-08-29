<?php

require '../app/DisplayFilesTree.php';
require '../app/DisplayFilesTreeIsDir.php';

use app\DisplayFilesTree;
use app\DisplayFilesTreeIsDir;

$disp = new DisplayFilesTree();
$disp->display('/media/Crowdin/Service/www/arr');

