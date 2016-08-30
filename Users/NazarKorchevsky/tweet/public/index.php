
<?php

error_reporting(E_ALL); ini_set('display_errors', 1);

require_once '../app/auth/Auth.php';
$auth = new Auth;
$auth->session_security();

require_once '../app/tweet.php';
$tweet = new Tweet;

if (isset($_POST['msg']) && isset($_POST['tweet'])) {
    require_once '../app/tweet.php';    
    $tweet->createTweet($_SESSION['users_id'], $_POST['msg']);
}

if (isset($_POST['get_post'])) {
    $get_post = $tweet->getPost($_POST['get_post_id']);     
}

if (isset($_POST['Follow'])) {
    $user_id = $_SESSION['users_id'];
    $follow_user_id = $_POST['follow_user_id'];
    $tweet->setFollow($follow_user_id, $user_id);
}

if (isset($_POST['unFollow'])) {
    $follow_user_id = $_POST['follow_user_id'];
    $tweet->unFollow($follow_user_id);
}

$follows = $tweet->follows($_SESSION['users_id']);
$userList = $tweet->userListView();

require_once 'view/viewTweet.html';
?>