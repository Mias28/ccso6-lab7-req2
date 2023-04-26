<?php

require "vendor/autoload.php";

session_start();

// 4.

use App\QuestionManager;

$score = null;
try {
    $manager = new QuestionManager;
    $manager->initialize();


    if (!isset($_SESSION['answers'])) {
        throw new Exception('Missing answers');
    }
    $score = $manager->computeScore($_SESSION['answers']);
    $_SESSION['score'] = $score;
} catch (Exception $e) {
    echo '<h1>An error occurred:</h1>';
    echo '<p>' . $e->getMessage() . '</p>';
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz</title>
</head>
<body>

<h1>Thank You</h1>

<p style="color: gray">
    You've completed the exam.
</p>

<h3>
    Congratulations <?php echo $_SESSION['user_fullname']." , ".$_SESSION['user_email'] ; ?>!
    Your score is <?php echo $score; ?> out of <?php echo $manager->getQuestionSize() ;?>

</h3>
<h4>Your Answers:</h4>
    <?php foreach ($_SESSION['answers'] as $question => $answer) { ?>
        <li>
            <strong><?php echo $question; ?>:</strong> 
            <?php echo $answer; ?>
        </li>
    <?php } ?>

<form method="post" action="download.php">
<input type="submit" name="download" value="Download Results">
</form>

</body>
</html>

<!-- DEBUG MODE -->
<pre>
<?php
var_dump($_SESSION);
?>
</pre>