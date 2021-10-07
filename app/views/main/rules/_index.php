<?php require_once($this->getLayout('header_other')); ?>

	
<?
$path = ROOT . '/app/views/main/rules/' . $this->lang . '.php';
        if (file_exists($path)) {
            require($path);
        }
?>
		</div>
		</div>
        </div>
    </section>
<!-- -->



<?php require_once($this->getLayout('footer_home')); ?>