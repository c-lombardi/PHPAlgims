<?php
session_start();
session_unset();
header('Location:http://student5.upj.pitt.edu/algims/admin/index.php?action=login');
?>