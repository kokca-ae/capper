<?php require_once($this->getLayout('header')); ?>

<section class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="special-heading textalignleft default blue_heading" style="padding-bottom: 0px;">
                    <h2 class="fancy default"><span><?= $_title[LANG] ?></span></h2>
                </div>
                <div class="text-content text-center">
                    <div class="banners">

                        <?= $page['content'] ?>

                    </div>
                </div>
            </div> 
        </div>
    </div>
</section>
<style>
    .banners a {
        margin: 10px;
        display: inline-block;
    }
</style>

<?php require_once($this->getLayout('footer')); ?>