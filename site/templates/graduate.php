<?php snippet('head')?>

<a href="<?= $site->url() ?>">Return</a>

<h1>Graduate</h1>

    <h2>Info</h2>

        <?php if ($page->name()->isNotEmpty()): ?>
            <div> <?= $page->name()?> <?= $page->surname()?></div>
        <?php endif ?>

        <?php if ($page->bio()->isNotEmpty()): ?>
            <?= $page->bio()->kirbytext()?> 
        <?php endif ?>

        <?php if($image = $page->gradImage()->toFile()): ?>
            <img src="<?= $image->url() ?>" alt="<?= $image->alt() ?>">
        <?php endif ?>
        
        <?php if ($page->class()->isNotEmpty()): ?>
            <div>
                <?php foreach ($page->class()->split() as $tags): ?>
                    <div><?= $tags ?></div>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <?php if ($page->degree()->isNotEmpty()): ?>
            <div> <?= $page->degree()?></div>
        <?php endif ?>

        <?php if ($page->graduation()->isNotEmpty()): ?>
            <div><?= $page->graduation()->toDate("Y") ?></div>
        <?php endif ?>
                            
    <h2>Contact</h2>

        <?php if ($page->website()->isNotEmpty()): ?>
                <a target="_blank" href=" <?= $page->website()->toUrl()?>">Website</a>
        <?php endif ?>

        <?php if ($page->email()->isNotEmpty()): ?>
            <a href="mailto:<?= Str::encode($page->email()) ?>">
            <?= Str::encode($page->email()) ?>
            </a>
        <?php endif ?>

    <h2>Socials</h2>
        
        <?php if ($page->instagram()->isNotEmpty()): ?>
                <a target="_blank" href=" <?= $page->instagram()->toUrl()?>">Instagram</a>
        <?php endif ?>

        <?php if ($page->arena()->isNotEmpty()): ?>
                <a target="_blank" href=" <?= $page->arena()->toUrl()?>">Arena</a>
        <?php endif ?>

        <?php if ($page->git()->isNotEmpty()): ?>
                <a target="_blank" href=" <?= $page->git()->toUrl()?>">Github</a>
        <?php endif ?>

        <?php if ($page->social1name()->isNotEmpty()): ?>
                <a target="_blank" href=" <?= $page->social1link()->toUrl()?>"><?=$page->social1name() ?></a>
        <?php endif ?>

        <?php if ($page->social2name()->isNotEmpty()): ?>
                <a target="_blank" href=" <?= $page->social2link()->toUrl()?>"><?=$page->social2name() ?></a>
        <?php endif ?>

<h1>Projects</h1>
    
    <?php if ($page->linkBA()->isNotEmpty()): ?>    
        <?php $thesisBA = $page->linkBA()->toPage() ?>

        <?php if ($thesisBA->thesisTitle()->isNotEmpty()): ?>
        <a href="<?= $thesisBA->url() ?>"><?= $thesisBA->thesisTitle()?></a>
        <?php endif ?>

    <?php endif ?>
    
    <?php if ($page->linkMA()->isNotEmpty()): ?> 
        <?php $thesisMA = $page->linkMA()->toPage() ?>

        <?php if ($thesisMA->thesisTitle()->isNotEmpty()): ?>
            <a href="<?= $thesisMA->url() ?>"><?= $thesisMA->thesisTitle()?></a>
        <?php endif ?>
    <?php endif ?>

<?php snippet('footer')?>