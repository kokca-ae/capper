<!--<div class="cabNews">
<div class="titleCabSub">
    <span><?=$this->getLanguageText('Latest <br>news'); ?></span>
</div>

<?php if ($this->news_list) : ?>
<?php foreach ($this->news_list as $row) : ?>
<div class="content cfix">
    <div class="newsShortCabContent">
        <span style="text-decoration:none;" class="linkNews"><?=$row['title'];?></span>
        <span class="date"><?=date("d.m.Y H:i",$row['date_add']);?></span>
        <p class="shortNews">
            <?=$row['text'];?>
        </p>
    </div>
</div>
<?php endforeach ?>
<?php else: ?>
<div class="content cfix">
    <div class="newsShortCabContent">
        <span style="text-decoration:none;color:#fff;" class="linkNews"><?=$this->getLanguageText('Sorry');?></span>
        
        <p class="shortNews">
            <?=$this->getLanguageText('No news at the moment');?>
        </p>
    </div>
</div>
<?php endif ?>

<a href="/news" class="toAll"><?=$this->getLanguageText('All the news'); ?></a>
</div>-->