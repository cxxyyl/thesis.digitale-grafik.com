<!DOCTYPE html>
<html lang="en">

<?php snippet('creditsmini')?>


<?php snippet('head') ?>
<?php snippet('nav') ?>

<main class="about-imprint">
    <section class="about">
<?= $site->about()->kirbytext()?>
    </section>


    <section class="imprint">
<?= $site->imprint()->kirbytext()?>
    </section>
</main>

<?php snippet('footer') ?>

</html>


