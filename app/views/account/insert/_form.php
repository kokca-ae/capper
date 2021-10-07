<?php if ($form) : ?>
    <form class="form" action='<?= $form["location"]; ?>' method="<?= $form["method"]; ?>">

        <?php foreach ($form['fields'] as $name => $value) : ?>

            <input type='hidden' name='<?= $name; ?>' value='<?= $value; ?>'>

        <?php endforeach; ?>

        <div class="bttnGradientBlock">
            <button class="gradientBttn doItBttn"><?=$this->getLanguageText('Confirm')?></button>
        </div>
    </form>

<?php endif ?>
