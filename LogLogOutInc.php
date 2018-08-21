<?php

	session_start();
	session_unset();
	session_destroy();
	if (!isset($_SESSION['timeout_idle'])) {
    $_SESSION['timeout_idle'] = time() + MAX_IDLE_TIME;
} else {
    if ($_SESSION['timeout_idle'] < time()) {    
        session_unset();
	    session_destroy();
	    header("Location: LogIndex.php");
	    exit();
    } else {
        $_SESSION['timeout_idle'] = time() + MAX_IDLE_TIME;
    }
}
	header("Location: LogIndex.php");
	exit();

?>
