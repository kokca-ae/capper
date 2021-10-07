<?php require_once($this->getLayout('header_other')); ?>

<?
$path = ROOT . '/app/views/main/faq/' . $this->lang . '.php';
        if (file_exists($path)) {
            require($path);
        }
?>


<?php require_once($this->getLayout('footer_home')); ?>