<?php





if (!isset($_SESSION['users'])) {

    header("Location: " . urll('login.php'));
}
