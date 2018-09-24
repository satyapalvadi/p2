<?php
session_start();
if (isset($_SESSION['results'])) {
    $results = $_SESSION['results'];
    $bmrMiffin = $results['bmrMiffin'];
}

session_unset();