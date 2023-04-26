<?php
session_start();

if (isset($_POST['download'])) {
    $filename = 'quiz_results.txt';
    $contents = "Quiz Results:\n\n";
    $contents .= "User: " . $_SESSION['user_fullname'] . "\n";
    $contents .= "Email: " . $_SESSION['user_email'] . "\n";
    $contents .= "Birthdate: " . $_SESSION['user_birthdate'] . "\n";
    $contents .= "Score: " .  $_SESSION['score'] . " out of " . "10" . "\n\n";
    $contents .= "Answers:\n";
    foreach ($_SESSION['answers'] as $question => $answer) {
        $contents .= "Question " . $question . ": " . $answer . "\n";
    }

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . $filename);

    echo $contents;
}
?>
