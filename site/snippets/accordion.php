<?php  foreach ($site->grandchildren()->listed() as $item):?> 
<?php  $template = $item->template();$thesis = 'thesis';if (str_contains($template, $thesis)): ?>

<!--

✶    ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ✶
   ̴ ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ  ̴
 ̴   ✶                      Article Info                      ✶    ̴
   ̴ ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ  ̴
✶    ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ✶

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

<article data-info="<?= $item->title()->slug()?>" class="search-result accordion">
    <div class="accordion_row"> <!-- Wrapper for every row -->
        <div class="accordion-container"> <!-- Everything inside of the visible row -->
            
        <!-- Layout – Row
        ⎾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ⏋
        ⎿ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ⏌
        -->

            <!-- Pursued Degree -->
<?php if($item->selectDegree()->isNotEmpty()): ?>
            <p data-search="<?= option('category-map') [$item->selectDegree()->value()]?>" class="accordion-container__degree filter searchText"><?= $item->selectDegree()?></p>
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
<?php if ($item->mirrorExternal()->isNotEmpty()): ?> 
                <!-- Link to Website-->
                <a target="_blank" class="button-primary" href="<?=$item->mirrorExternal()->url()?>">Open Website ↗</a>
<?php endif ?>
<?php else:?>
<?php if ($item->mirrorKDG()->isNotEmpty()): ?> 
                <!-- Link to Website-->
                <a target="_blank" class="button-primary" href="<?=$item->mirrorKDG()->url()?>">Open Website ↗</a>
<?php endif ?>
<?php endif ?>
<?php if ($item->thesispdf()->isNotEmpty()): ?>

                <!-- Download Link for Thesis -->
                <a class="button-primary" href="<?=$item->thesispdf()->toFile()->url()?>">Download Thesis ↓</a>
<?php endif ?>
            </div>
        </div>



        <!-- Container for accordion that opens on hover -->
        <div class="accordion-content"> 
        <!--Layout – Accordion
        ⎾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ⏋




        ⎿ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ⏌
         -->


            <!-- Section for all info about the thesis -->
            <section class="accordion-content__thesis"> 
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

                    <!-- 
                    Topics - The tags are searchable and clickable.
                    By clicking on a tag it will appear as a filter
                    on the top, next to the searchbar.
                    -->
<?php if ($item->thesisTags()->isNotEmpty()): ?>
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
                

                <!-- 
                Thesis Abstract / this will only show up, if there is an abstract 
               
                Sadly I could not figure out how to format the output from 
                kirbytextin a neat way, which is really irritating (￣ヘ￣). Maybe 
                I'll find a solution for this at some point. 
                -->
                <div class="accordion-content__thesis-abstract searchText">
<?php if ($item->thesisAbstract()->isNotEmpty()): ?>
                    <?= $item->thesisAbstract()->kirbytext()?>
<?php endif ?>
                </div>
            </section>



            <!-- Section for the Graduate CV-->
            <section class="accordion-content__cv"> 

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
                        <li class="searchText"><?= $gradProject->selectStudies()?>, <?= $gradProject->graduation()->toDate('Y')?></li>
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
                        <ul>
<?php if ($graduate->studies()->isNotEmpty()): ?><?php $gradProjects = $graduate->studies()->toStructure(); foreach ($gradProjects as $gradProject): ?>
                            <li class="filter"><?= $gradProject->linkThesis()->toPage()->title()?></li>
<?php endforeach ?><?php endif ?>
                        </ul>
                    </div>

                    <!-- All socials and other links -->
                    <ul class="accordion-content__cv-info__socials">
<?php if ($graduate->website()->isNotEmpty()): ?> 
                        <!-- Website -->                        
                        <li><a target="_blank" href="<?= $graduate->website()->toUrl()?>">Website</a></li>
<?php endif ?>
<?php if ($graduate->email()->isNotEmpty()): ?>                         
                        <!-- Mail -->
                        <li><a href="mailto:<?= Str::encode($graduate->email()) ?>">Mail</a></li>
<?php endif ?> 
                        <!-- Socials -->
<?php $entries = $graduate->socials()->toStructure(); foreach ($entries as $entry): ?>
                        <li><a class="searchText filter" target="_blank" href="<?= $entry->socialLink()->url() ?>"> <?= $entry->socialName() ?></a></li>
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
                <div class="accordion-content__links__download-container">
                    <a href="<?=$item->thesispdf()->toFile()->url()?>">Download Thesis ↓</a>
                    <button class="tag"><?= $item->language()->category()?></button>
                </div>
<?php endif ?>
<?php if ($item->reissue()->mirrorExternalBroken() === true ):?>
<?php if ($item->mirrorExternal()->isNotEmpty()): ?> 
                <!-- Link to Website-->
                <a target="_blank" href="<?=$item->mirrorExternal()->url()?>">Open Website ↗</a>
<?php endif ?>
<?php else:?>
<?php if ($item->mirrorKDG()->isNotEmpty()): ?> 
                <!-- Link to Website-->
                <a target="_blank"  href="<?=$item->mirrorKDG()->url()?>">Open Website ↗</a>
<?php endif ?>
<?php endif ?>
<?php if ($item->repositoryLink()->isNotEmpty()): ?>
                <!-- Link To HFBK Repository -->
                <a target="_blank" href="<?=$item->repositoryLink()->url()?>">Practical Work ↗</a>
<?php endif ?>
            </div>
        </div>
    </div>    
</article>
<?php endif ?>
<?php endforeach?>