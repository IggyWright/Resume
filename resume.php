<?php
require_once __DIR__ . '/vendor/autoload.php';

use ResumeSite\Views\ResumeView;

$view = new ResumeView();
?>

<!DOCTYPE html>
<html lang="en">

    <?php echo $view->head('
        <link rel="stylesheet" type="text/css" href="css/resume.css">
    '); ?>
    <?php echo $view->navigation(); ?>
    <?php echo $view->dropdownNavigation(); ?>
    <?php echo $view->resumeWidget(); ?>

</html>
