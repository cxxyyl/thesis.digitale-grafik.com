<?php snippet('head')?>

   <div id="selection">
        <div>Thesis</div>
        <div>Graduates</div>
    </div>

<div id="scroll-wrapper" dir="ltr">

    <div id="theses-container">

        <h1>Theses</h1>
            <?php foreach ($site->grandchildren()->listed() as $item): ?>
                
                <?php
                $template = $item->template();
                $thesis = 'thesis';

                if (str_contains($template, $thesis)): ?> 
                
                    <div class="row-wrapper">

                        <?php if($item->selectBM()->isNotEmpty()): ?>
                            <div class="bama"><?= $item->selectBM()?></div>
                        <?php endif?>

                        <?php if ($item->title()->isNotEmpty()): ?>
                            <a class="thesis" href="<?= $item->url()?>"><?= $item->title()?></a>
                        <?php endif ?>
                        
                        <?php $graduate = $item->connectedGraduate()->toPage() ?>
                        <a class="graduate-name" href="<?= $graduate->url()?>"><?=$graduate->name()?> <?=$graduate->surname()?></a>
                        
                        <?php if ($item->yearOfPublishing()->isNotEmpty()): ?>
                            <div class="date-of-publishing"><?= $item->yearOfPublishing()->toDate("Y") ?></div>
                        <?php endif ?>

                    </div>

                <?php endif ?> 

            <?php endforeach?>
        

<?php snippet('footer')?>

<script>
    document.getElementById('scroll-wrapper').scrollLeft = document.getElementById('spacer').offsetLeft;
</script>