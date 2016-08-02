
<?php

error_reporting(E_ALL); ini_set('display_errors', 1);

require_once '../app/auth/Auth.php';
$auth = new Auth;
$auth->session_security();

require_once '../app/tweet.php';
$tweet = new Tweet;
$userList = $tweet->userListView();

if (isset($_POST['msg']) && isset($_POST['tweet'])) {
    require_once '../app/tweet.php';    
    $tweet->createTweet($_SESSION['users_id'], $_POST['msg']);
}


if (isset($_POST['get_post'])) {

    $get_post = $tweet->getPost($_POST['get_post_id']);
     
}

if (isset($_POST['Follow'])) {
    $tweet->setFollow();
   
}




?>

<form class='login' action='login.php' method='post'>
	<span><?php echo $_SESSION['user'] . $_SESSION['users_id']?></span>
	<input type='submit' name='logout' value='Logout'>
</form>
<br><br>
<hr>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <textarea placeholder="tweet" name="msg"></textarea>
    <input type="submit" name="tweet" value="tweet">
</form>
<hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="number" placeholder="id" name="get_post_id">
    <input type="submit" name="get_post" value="get post">
</form>
<?= isset($get_post) ? $get_post : ''  ?>
<hr>
<?= $userList ?>
<hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?= $userList ?>
     <input type="number" placeholder="Follow user id" name="follow_user_id">    
     <input type="submit" name="Follow" value="follow">
</form>



