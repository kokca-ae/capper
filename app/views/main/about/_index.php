<?php require_once($this->getLayout('header_other')); ?>
<!--<script src="/assets/js/highcharts.js"></script>-->
<?
$path = ROOT . '/app/views/main/about/' . $this->lang . '.php';
        if (file_exists($path)) {
            require($path);
        }
?>


<?php require_once($this->getLayout('footer_home')); ?>