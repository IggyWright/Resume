<?php
require_once __DIR__ . '/vendor/autoload.php';

use ResumeSite\Views\ContactView;

$view = new ContactView();
?>

<!DOCTYPE html>
<html lang="en">

    <?php echo $view->head('
        <link rel="stylesheet" type="text/css" href="css/contact.css">
    '); ?>
    <?php echo $view->navigation(); ?>
    <?php echo $view->dropdownNavigation(); ?>
    <?php echo $view->contactWidget(); ?>

</html>
