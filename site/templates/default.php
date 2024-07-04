<?php snippet('head')?>
<?php snippet('searchbar') ?>

<!-- <div id="selection">
    <div>Thesis</div>
    <div>Graduates</div>
</div> -->

<!-- Devlog -->
<!-- 

Naming conventions

BEM 

css clean nesting aber damit html multiclassing vs nesting

kurz begründen warum wir was genommen haben




-->


<!---------------------------- List of all Klasse Digitale Grafik Thesis Projects ---------------------------->
<!-- This <main> element contains all the theses. You can find all the single theses inside each <article> -->
<main id="content">

<!-- From here on there is a lot of stuff happening that is generated with php/ Kirby. Sadly I'm still not sure how to make that really accessible. 
 Christoph Knoth was talking about using pre -->
<?php snippet('accordionLinked') ?>
</main>

  <!-- <pre>Where is this text
       displayed? only the code
       or on the website ?

       >okay it's not the code

    what happens if i plug in a piece of php 
    >okay displays all the content - not what i wanted
    
    what happens if i plug in a piece of php that is commented out <?php //snippet('accordion') ?>
    > it juest does not appear at all
  </pre> -->

<?php snippet('footer')?>

<script>
    document.getElementById('scroll-wrapper').scrollLeft = document.getElementById('spacer').offsetLeft;
</script>

