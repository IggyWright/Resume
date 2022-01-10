<?php
require_once __DIR__ . '/vendor/autoload.php';

use ResumeSite\Views\IndexView;

$view = new IndexView();
?>

<!DOCTYPE html>
<html lang="en">

    <?php echo $view->head('
        <link rel="stylesheet" type="text/css" href="css/index.css">
    '); ?>
    <?php echo $view->navigation(); ?>
    <?php echo $view->dropdownNavigation(); ?>
    <?php echo $view->indexWidget(); ?>

</html>
