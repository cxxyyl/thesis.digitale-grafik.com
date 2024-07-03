<article id="<?= $item->title()->slug()?>" class="search-result accordion" >
        <div class="accordion-title">
            <div class="accordion__row">
                <!-- Persued Degree -->
                <?php if($item->selectBM()->isNotEmpty()): ?>
                <p class="accordion__degree"><?= $item->selectBM()?></p>
                <?php endif?>

                <div class="accordion__date">
                    <!-- Semester of Publishing -->
                    <?php if($item->yearOfPublishing()->isNotEmpty()): ?>
                    <p><?= $item->yearOfPublishing()?></p>
                    <?php endif?>

                    <?php if($item->semesterCycle()->isNotEmpty()): ?>
                    <p><?= $item->semesterCycle()?></p>
                    <?php endif?>
                </div>
                
                <!-- Thesis Author -->
                <?php $graduate = $item->connectedGraduate()->toPage() ?>
                <h4 class="accordion__graduate"><?=$graduate->name()?> <?=$graduate->surname()?></h4>
            
                <!-- Thesis Title -->
                <h4 class="accordion__thesis"><?= $item->title()?></h4>
            

                <!-- Language the thesis is written in -->
                <?php if ($item->language()->isNotEmpty()): ?>
                <p class="button-primary"><?= $item->language()->category()?></p>
                <?php endif ?>
            
                <!-- Links for downloading the Thesis and opening the original thesis website  -->
                <div class="">

                    <?php if ($item->reissue()->mirrorExternalBroken() === true ):?>
                    <a class="button-primary" href="<?=$item->mirrorExternal()->url()?>">Open Website</a>
                    <?php else:?>
                    <a class="button-primary" href="<?=$item->mirrorKDG()->url()?>">Open Website</a>
                    <?php endif ?>

                    <!-- This will not show up if there is no uploaded file -->
                    <?php if ($item->thesispdf()->isNotEmpty()): ?>
                    <a class="button-primary" href="<?=$item->thesispdf()->toFile()->url()?>">Download Thesis</a>
                    <?php endif ?>
                 </div>
            </div>
        </div>

        <div class="accordion-content">
            <section class="accordion-content__left">
                <div class="accordion-content__left__info">
               
                    <!-- Thesis Title -->
                    <h2 class="searchText"><?= $item->title()?></h2>

                    <!-- Thesis Subtitle / this will only show up, if there is a subtitle -->
                    <?php if ($item->thesisSubtitle()->isNotEmpty()): ?>
                    <h5 class="searchText"><?= $item->thesisSubtitle()?></h5>
                    <?php endif ?>

                    <!-- Language the thesis is written in -->
                    <?php if ($item->language()->isNotEmpty()): ?>
                    <p class="button-primary"><?= $item->language()->category()?></p>
                    <?php endif ?>

                    <!-- Persued Degree -->
                    <?php if($item->selectBM()->isNotEmpty()): ?>
                    <?= option('category-map')[$item->selectBM()->value()] ?>
                    <?php endif?>

                    <!-- Year of Publishing -->
                    <p><?php if($item->yearOfPublishing()->isNotEmpty()):?><?= $item->semesterCycle()?><?php endif?> <?php if($item->semesterCycle()->isNotEmpty()): ?><?= $item->yearOfPublishing()?></p><?php endif?></p>

                    <!-- Advisors -->
                    <div class="">
                        <?php if ($item->advisor1()->isNotEmpty()): ?>
                        <div class="searchText"><?= $item->advisor1()?></div>
                        <?php endif ?>

                        <?php if ($item->advisor2()->isNotEmpty()): ?>
                        <div class="searchText"><?= $item->advisor2()?></div>
                        <?php endif ?>

                        <?php if ($item->advisor3()->isNotEmpty()): ?>
                        <div class="searchText"><?= $item->advisor3()?></div>
                        <?php endif ?>
                    </div>

                    <!-- Topics - The tags are searchable -->
                    <h5>Topics</h5>
                    <?php if ($item->thesisTags()->isNotEmpty()): ?>
                    <div>
                    <?php foreach ($item->thesisTags()->split() as $tags): ?>
                        <div class="searchText"><?= $tags ?></div>
                    <?php endforeach ?>
                    </div>
                    <?php endif ?>

                </div>
                
                <!-- Thesis Abstract / this will only show up, if there is an abstract -->
                <div class="accordion-content__left__abstract searchText">
                <?php if ($item->thesisAbstract()->isNotEmpty()): ?>
                <?= $item->thesisAbstract()->kirbytext()?>
                <?php endif ?>
                </div>
            </section>

            <section class="accordion-content__right">
                <?php $graduate = $item->connectedGraduate()->toPage() ?>    

                <!-- Graduate -->
                <?php if ($graduate->name()->isNotEmpty()): ?>
                <h2 class="accordion-content__right__graduate searchText"><?= $graduate->name()?> <?= $graduate->surname()?></h2>
                <?php endif ?>

                <!-- Graduate Information -->
                <!-- Hier fehlen noch alle Klassen und noch ein paar Verknüpfungen zum Backend -->

                <div>
                    <div>
                    <!-- MA Abschluss, Jahr -->
                    <!-- BA Abschluss, Jahr -->
                    </div>

                    <!-- Klassen -->
                    <div>
                        <?php if ($graduate->class()->isNotEmpty()): ?>
                        <?php foreach ($graduate->class()->split() as $tags): ?>
                        <div>Klasse <?= $tags ?></div>
                        <?php endforeach ?>
                    </div>
        <?php endif ?>
                    </div>
                    <div>
                        <p>Thesis Projects at KDG:</p>
                        <!-- connected MA Title -->
                        <?php if ($graduate->linkMA()->isNotEmpty()): ?> 
                            <?php $thesisMA = $graduate->linkMA()->toPage() ?>

                            <?php if ($thesisMA->thesisTitle()->isNotEmpty()): ?>
                                <a href="<?= $thesisMA->url() ?>"><?= $thesisMA->thesisTitle()?></a>
                            <?php endif ?>
                        <?php endif ?>  
  
                        <!-- connected BA Title -->
                         <?php if ($graduate->linkBA()->isNotEmpty()): ?>    
                            <?php $thesisBA = $graduate->linkBA()->toPage() ?>

                            <?php if ($thesisBA->thesisTitle()->isNotEmpty()): ?>
                            <a href="<?= $thesisBA->url() ?>"><?= $thesisBA->thesisTitle()?></a>
                            <?php endif ?>
                        <?php endif ?>
                    </div>

                    <div>
                        <!-- Website -->
                        <?php if ($graduate->website()->isNotEmpty()): ?>
                        <a target="_blank" href="<?= $graduate->website()->toUrl()?>">Website</a>
                        <?php endif ?>

                        <!-- Mail -->
                        <?php if ($graduate->email()->isNotEmpty()): ?>
                        <a href="mailto:<?= Str::encode($graduate->email()) ?>">Mail</a>
                        <?php endif ?> 

                        <!-- Socials Structure -->




                    </div> 
                </div>   
                <div>    
                    <?php if ($graduate->bio()->isNotEmpty()): ?>
                    <?= $graduate->bio()->kirbytext()?> 
                    <?php endif ?>

                </div>    
            </section>
        </div>
    </article>

    <?php endif ?> 

<?php endforeach?>