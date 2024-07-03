<?php snippet('head')?>

<a href="<?= $site->url() ?>">Return</a>
<!-- Thesis Info -->
<h1>Thesis</h1>

    <h2>INFO</h2>

        <?php if ($page->title()->isNotEmpty()): ?>
            <div><?= $page->title()?></div>
        <?php endif ?>

        <?php if ($page->thesisSubtitle()->isNotEmpty()): ?>
            <div><?= $page->thesisSubtitle()?></div>
        <?php endif ?>

        <?php if ($page->thesisAbstract()->isNotEmpty()): ?>
            <div><?= $page->thesisAbstract()->kirbytext()?></div>
        <?php endif ?>

        <?php if ($page->thesisTags()->isNotEmpty()): ?>
            <div>
                <?php foreach ($page->thesisTags()->split() as $tags): ?>
                <div><?= $tags ?></div>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <?php if ($page->selectBM()->isNotEmpty()): ?>
            <div><?= $page->selectBM()?></div>
        <?php endif ?>

        <?php if ($page->semesterCycle()->isNotEmpty()): ?>
            <div><?= $page->semesterCycle()?></div>
        <?php endif ?>

        <?php if ($page->yearOfPublishing()->isNotEmpty()): ?>
            <div><?= $page->yearOfPublishing()->toDate("Y") ?></div>
        <?php endif ?>

        <?php if ($page->language()->isNotEmpty()): ?>
            <div><?= $page->language()?></div>
        <?php endif ?>


        <!-- Advisors -->
        
        <?php if ($page->advisor1()->isNotEmpty()): ?>
            <div><?= $page->advisor1()?></div>
        <?php endif ?>

        <?php if ($page->advisor2()->isNotEmpty()): ?>
            <div><?= $page->advisor2()?></div>
        <?php endif ?>

        <?php if ($page->advisor3()->isNotEmpty()): ?>
            <div><?= $page->advisor3()?></div>
        <?php endif ?>


    <h2>FILE</h2>

        <?php if ($page->thesispdf()->isNotEmpty()): ?>
            <?php $download = $page->thesispdf()->toFile() ?>
                <a href="<?= $download->url() ?>">Download Thesis PDF</a>
        <?php endif ?>

        
    <h2>Mirror</h2>

        <?php if ($page->mirrorExternal()->isNotEmpty()): ?>
            <a href="<?= $page->mirrorExternal()->toUrl()?>"> Mirror OG</a>
        <?php endif ?>

        <?php if ($page->mirrorKDG()->isNotEmpty()): ?>
            <a href=" <?= $page->mirrorKDG()->toUrl()?>"> Mirror KDG</a>
        <?php endif ?>


<h1>Graduate</h1>

    <h2>Info</h2>

        <?php $graduate = $page->connectedGraduate()->toPage() ?>

        <?php if ($graduate->name()->isNotEmpty()): ?>
            <div> <?= $graduate->name()?> <?= $graduate->surname()?></div>
        <?php endif ?>

        <?php if ($graduate->bio()->isNotEmpty()): ?>
            <?= $graduate->bio()->kirbytext()?> 
        <?php endif ?>
        
        <?php if ($graduate->class()->isNotEmpty()): ?>
            <div>
                <?php foreach ($graduate->class()->split() as $tags): ?>
                    <div><?= $tags ?></div>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <?php if ($graduate->degree()->isNotEmpty()): ?>
            <div> <?= $graduate->degree()?></div>
        <?php endif ?>

        <?php if ($graduate->graduation()->isNotEmpty()): ?>
            <div><?= $graduate->graduation()->toDate("Y") ?></div>
        <?php endif ?>
                            
    <h2>Contact</h2>

        <?php if ($graduate->website()->isNotEmpty()): ?>
                <a target="_blank" href=" <?= $graduate->website()->toUrl()?>">Website</a>
        <?php endif ?>

        <?php if ($graduate->email()->isNotEmpty()): ?>
            <a href="mailto:<?= Str::encode($graduate->email()) ?>">
            <?= Str::encode($graduate->email()) ?>
            </a>
        <?php endif ?>

<?php snippet('footer')?>