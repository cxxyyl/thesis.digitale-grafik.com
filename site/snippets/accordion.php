<?php  foreach ($site->grandchildren()->listed() as $item):?> 
<?php  $template = $item->template();$thesis = 'thesis';if (str_contains($template, $thesis)): ?>     
<article data-info="<?= $item->title()->slug()?>" class="search-result accordion" >
    

<!--

✶     ̴   ̴   ̴   ̴   ̴   ̴    ✶
   ̴ ℹ   ✶   ℹ    ✶   ℹ  ̴
 ̴  ✶  Article Info  ✶     ̴
   ̴ ℹ   ✶   ℹ    ✶   ℹ  ̴
✶     ̴   ̴   ̴   ̴   ̴   ̴    ✶

Title ------ <?= $item->title()?>

<?php if ($item->thesisSubtitle()->isNotEmpty()): ?>
Subtitle --- <?= $item->thesisSubtitle()?><?php endif ?>

<?php $graduate = $item->connectedGraduate()->toPage() ?>
By --------- <?=$graduate->name()?> <?=$graduate->surname()?>

<?php if($item->selectDegree()->isNotEmpty()): ?>
Degree ----- <?= $item->selectDegree()?><?php endif?>

<?php if($item->semesterCycle()->isNotEmpty()): ?>
Published -- <?= $item->semesterCycle()?><?php endif?>
<?php if($item->yearOfPublishing()->isNotEmpty()): ?>
 – <?= $item->yearOfPublishing()?><?php endif?>


-->
    <div class="accordion_row"> <!-- Wrapper for every row -->
        <div class="accordion-container"> <!-- Everything inside of the visible row -->
            
        <!-- Layout – Row
        ⎾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ⏋
        ⎿ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ⏌
        -->

            <!-- Pursued Degree -->
<?php if($item->selectDegree()->isNotEmpty()): ?>
            <p data-search="<?= option('category-map') [$item->selectDegree()->value()]?>" class="accordion-container_degree filter searchText"><?= $item->selectDegree()?></p>
<?php endif?>

            <!-- Semester of Publishing -->
            <div class="accordion-container__date">
<?php if($item->yearOfPublishing()->isNotEmpty()): ?>
                <p class="filter searchText"><?= $item->yearOfPublishing()?></p>
<?php endif?>
<?php if($item->semesterCycle()->isNotEmpty()): ?>
                <p class="filter searchText"><?= $item->semesterCycle()?></p>
<?php endif?>
            </div>
                
            <!-- Thesis Author -->
<?php $graduate = $item->connectedGraduate()->toPage() ?>
            <h4 class="accordion-container__graduate"><?=$graduate->name()?> <?=$graduate->surname()?></h4>
            
            <!-- Thesis Title -->
            <h4 class="accordion-container__thesis"><?= $item->title()?></h4>
            
            <!-- Language the thesis is written in -->
<?php if ($item->language()->isNotEmpty()): ?>
            <p data-search="<?=option('category-map')[$item->language()->category()->value()]?>" class="filter button-primary button-extraSpacing searchText"><?= $item->language()->category()?></p>
<?php endif ?>
            
            <!-- Links for downloading the thesis and opening the original thesis website  -->
            <div class="accordion-container__downloads">
<?php if ($item->reissue()->mirrorExternalBroken() === true ):?>
                <a target="_blank" class="button-primary" href="<?=$item->mirrorExternal()->url()?>">Open Website ↗</a>
<?php else:?>
                <a target="_blank" class="button-primary" href="<?=$item->mirrorKDG()->url()?>">Open Website ↗</a>
<?php endif ?>
<?php if ($item->thesispdf()->isNotEmpty()): ?>
            <!-- Download Link for Thesis -->
                <a class="button-primary" href="<?=$item->thesispdf()->toFile()->url()?>">Download Thesis ↓</a>
<?php endif ?>
            </div>
        </div>




        <div class="accordion-content"> <!-- Container for accordion that opens on hover -->

        <!--Layout – Accordion
        ⎾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ⏋




        ⎿ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ⏌
         -->


            <section class="accordion-content__thesis"> <!-- Section for all info about the thesis -->
            
        <!-- Layout – Accordion Thesis
        ⎾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ⏋
            ⎾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ⏋



            ⎿ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ⏌
        ⎿ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ⏌
         -->

                <!-- Thesis Title -->
                <h2 class="accordion-content__thesis__title searchText"><?= $item->title()?></h2>
               
                <div class="accordion-content__thesis-info">

                    <!-- Thesis Subtitle // this will only show up, if there is a subtitle -->
<?php if ($item->thesisSubtitle()->isNotEmpty()): ?>
                    <h5 class="searchText accordion-content__thesis-info__subtitle"><?= $item->thesisSubtitle()?></h5>
<?php endif ?>

                    <ul class="accordion-content__thesis-info__published">

                        <!-- Persued Degree -->
<?php if($item->selectDegree()->isNotEmpty()): ?>
                        <li data-search="<?= option('category-map') [$item->selectDegree()->value()]?>" class="searchText filter"><?= option('category-map')[$item->selectDegree()->value()]?> Thesis</li>
<?php endif?>

                        <!-- Year of Publishing -->
                        <li><?php if($item->yearOfPublishing()->isNotEmpty()):?><span class="filter searchText"><?= $item->semesterCycle()?></span><?php endif?> <?php if($item->semesterCycle()->isNotEmpty()): ?><span class="filter searchText"><?= $item->yearOfPublishing()?></span><?php endif?></li>
                    </ul>
                    
                    <!-- Advisors -->
                    <ul class="accordion-content__thesis-info__advisors">
<?php if ($item->advisor1()->isNotEmpty()): ?>
                        <li class="searchText filter"><?= $item->advisor1()?></li>
<?php endif ?>

<?php if ($item->advisor2()->isNotEmpty()): ?>
                        <li class="searchText filter"><?= $item->advisor2()?></li>
                        <?php endif ?>

<?php if ($item->advisor3()->isNotEmpty()): ?>
                        <li class="searchText filter"><?= $item->advisor3()?></li>
<?php endif ?>
                    </ul>


                    <!-- Topics - The tags are searchable -->

<?php if ($item->thesisTags()->isNotEmpty()): ?>
                    <!-- hier muss noch die funktion rein, die anzeigt wie viele tags insgesamt verwendet werden. also die funktion tagname(3) -->
                    <div class="accordion-content__thesis-info__topics">    
                        <h5>Topics</h5>
               
                        <div class="accordion-content__thesis-info__topics__tags">
<?php foreach ($item->thesisTags()->split() as $tags): ?>
                            <button class="searchText tag filter"><?= $tags ?></button>
<?php endforeach ?>
                        </div>

                    </div>
<?php endif ?>
                </div>
                
                <!-- Thesis Abstract / this will only show up, if there is an abstract -->
                <div class="accordion-content__thesis-abstract searchText">
<?php if ($item->thesisAbstract()->isNotEmpty()): ?>
                    <?= $item->thesisAbstract()->kt()?>
<?php endif ?>
                </div>
            </section>




            <section class="accordion-content__cv"> <!-- Section for the Graduate CV-->

            <!-- Accordion Graduate CV
            ⎾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ⏋
                                                        ⎾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ⏋



                                                        ⎿ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ⏌
            ⎿ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ⏌
            -->
                <?php $graduate = $item->connectedGraduate()->toPage() ?>    

                <!-- Graduate -->
<?php if ($graduate->name()->isNotEmpty()): ?>
                <h2 class="accordion-content__cv__graduate searchText"><?= $graduate->name()?> <?= $graduate->surname()?></h2>
<?php endif ?>

                <div class="accordion-content__cv__info">

                    <!-- Degrees pursured at HFBK Hamburg -->
                    <ul class="accordion-content_cv-info_degrees">
<?php if ($graduate->studies()->isNotEmpty()): ?><?php $gradProjects = $graduate->studies()->toStructure();foreach ($gradProjects as $gradProject): ?>
                        <li><?= $gradProject->selectStudies()?>, <?= $gradProject->graduation()->toDate('Y')?></li>
<?php endforeach ?>
<?php endif ?>
                    </ul>

                    <!-- Part of following Classes at HFBK Hamburg -->
                    <ul class="accordion-content__cv-info__classes searchText filter">
<?php if ($graduate->class()->isNotEmpty()): ?>
<?php foreach ($graduate->class()->split() as $tags): ?>
                        <li>Klasse <?= $tags ?></li>
<?php endforeach ?>
<?php endif ?>
                    </ul>
                        
                    <div class="accordion-content__cv-info__projects">

                        <!-- Link to other Thesis Projects -->
                        <h5>Thesis Projects at KDG:</h5>
                       
                        <!-- All connected projects -->
                        <!-- hier muss noch ein Hook rein -> wie springe ich zum entsprechenden Eintrag -->
                        <ul>
<?php if ($graduate->studies()->isNotEmpty()): ?><?php $gradProjects = $graduate->studies()->toStructure(); foreach ($gradProjects as $gradProject): ?>
                            <li><?= $gradProject->linkThesis()->toPage()->title()?></li>
<?php endforeach ?><?php endif ?>
                        </ul>
                    </div>


                    <!-- All socials and other links -->

                    <ul class="accordion-content__cv-info__socials">

                        <!-- Website -->
                        <li>
<?php if ($graduate->website()->isNotEmpty()): ?>
                            <a target="_blank" href="<?= $graduate->website()->toUrl()?>">Website</a>
<?php endif ?>
                        </li>
                       
                        <!-- Mail -->
                        <li>
<?php if ($graduate->email()->isNotEmpty()): ?>
                            <a href="mailto:<?= Str::encode($graduate->email()) ?>">Mail</a>
<?php endif ?> 
                        </li>

                        <!-- Socials -->
<?php $entries = $graduate->socials()->toStructure(); foreach ($entries as $entry): ?>
                        <li>    
                            <a target="_blank searchText filter" href="<?= $entry->socialLink()->url() ?>"> <?= $entry->socialName() ?></a>
                        </li>
<?php endforeach ?>
                    </ul> 
                </div> 
                

                <!-- Graduate Bio -->
                <div class="accordion-content__cv__bio searchText">    
<?php if ($graduate->bio()->isNotEmpty()): ?>
                    <?= $graduate->bio()->kirbytext()?> 
<?php endif ?>

                </div>    
            </section>

            <!-- Links to: Download Thesis / Open Website / Practical Works -->
            <div class="accordion-content__links">
<?php if ($item->thesispdf()->isNotEmpty()): ?>
                <a href="<?=$item->thesispdf()->toFile()->url()?>">Download Thesis ↓</a>
<?php endif ?>
<?php if ($item->reissue()->mirrorExternalBroken() === true ):?>
                <a target="_blank" href="<?=$item->mirrorExternal()->url()?>">Open Website ↗</a>
<?php else:?>
                <a target="_blank" href="<?=$item->mirrorKDG()->url()?>">Open Website ↗</a>
<?php endif ?>
<?php if ($item->repositoryLink()->isNotEmpty()): ?>
                <a target="_blank" href="<?=$item->repositoryLink()->url()?>">Practical Work ↗</a>
<?php endif ?>
            </div>

        </div>
    </div>    
</article>
 <?php endif ?>
 <?php endforeach?>