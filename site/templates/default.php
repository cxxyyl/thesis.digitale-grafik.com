<?php snippet('head')?>
<?php snippet('searchbar') ?>

<!-- <div id="selection">
    <div>Thesis</div>
    <div>Graduates</div>
</div> -->



<!---------------------------- List of all Klasse Digitale Grafik Thesis Projects ---------------------------->
<!-- This <main> element contains all the theses. You can find all the single theses inside each <article> -->
<main id="content">

<?php snippet('accordion') ?>
<?php snippet('accordion') ?>
<?php snippet('accordion') ?>
<?php snippet('accordion') ?>
<?php snippet('accordion') ?>
<?php snippet('accordion') ?>


<?php // foreach ($site->grandchildren()->listed() as $item):?> 
<?php // $template = $item->template();$thesis = 'thesis';if (str_contains($template, $thesis)): ?>     
<?php // snippet('accordionLinked') ?>

<?php snippet('footer')?>

<script>
    document.getElementById('scroll-wrapper').scrollLeft = document.getElementById('spacer').offsetLeft;
</script>