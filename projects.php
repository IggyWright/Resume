<?php
require_once __DIR__ . '/vendor/autoload.php';

use ResumeSite\Views\ProjectsView;

$view = new ProjectsView();
?>

<!DOCTYPE html>
<html lang="en">

    <?php echo $view->head('
        <link rel="stylesheet" type="text/css" href="css/projects.css">
    '); ?>
    <?php echo $view->navigation(); ?>
    <?php echo $view->dropdownNavigation(); ?>
    <?php echo $view->projectsWidget(); ?>

</html>
