<?php snippet('head') ?>


<section id="about">
<?= $site->about()->kirbytext()?>
</section>


<section id="imprint">
<?= $site->imprint()->kirbytext()?>
</section>
<?php snippet('footer') ?>