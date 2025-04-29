<?php foreach ($site->children()->published()->sortBy('yearOfPublishing', 'desc', 'semesterCycle', 'desc') as $item):?> 
<?php 
    $template = $item->template();$thesis = 'thesis';if (str_contains($template, $thesis)): 

    // Make 20XX/YY from 20XX
    $yearOfPublishing = (int) $item->yearOfPublishing()->value(); // Convert to an integer
    $nextYear = $yearOfPublishing + 1; // Add 1 to the year
    $newYear = $yearOfPublishing . '/' . substr($nextYear, -2); // Format as "2025/26"

    // Check if SuSe or WiSe
    $semesterCycle = $item->semesterCycle()->value(); // Get the value of semesterCycle
    $isWs = $semesterCycle === 'WiSe'; // Check if it's "WiSe" and set $isWs to true or false

    // Connected Graduate
    $graduate = $item->authorID()->toUser();
    $id = $item->authorID();
?>


<article id="<?php if ($item->title()->isNotEmpty()):?><?= $item->title()->slug()?><?php endif?>" class="search-result accordion">
<!--

✶    ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ✶
   ̴ ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ  ̴
 ̴   ✶                      Article Info                      ✶    ̴
   ̴ ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ   ✶   ℹ  ̴
✶    ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ̴   ✶

<?php if ($item->title()->isNotEmpty()):?>
Title ------ <?= $item->title()?><?php endif ?>

<?php if ($item->thesisSubtitle()->isNotEmpty()): ?>
Subtitle --- <?= $item->thesisSubtitle()?><?php endif ?>

<?php if ($graduate->name()->isNotEmpty()):?>
By --------- <?=$graduate->name()?><?php endif ?>

<?php if($item->selectDegree()->isNotEmpty()): ?>
Degree ----- <?= option('category-map-short')[$item->selectDegree()->value()] ?><?php endif?>

<?php if($item->semesterCycle()->isNotEmpty()): ?>
Published -- <?= $item->semesterCycle()?><?php endif?> – <?php if($item->yearOfPublishing()->isNotEmpty()): ?><?php if($isWs === true): ?><?= $newYear ?><?php else: ?><?= $item->yearOfPublishing() ?><?php endif; ?><?php endif; ?>


Direct Link to Subpage for Printing Options
<?= $item->url()?>

--> 

    <div class="accordion_row"> <!-- Wrapper for every row -->
        <div class="accordion-container"> <!-- Everything inside of the visible row -->
            
        <!-- Layout – Row
        ⎾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ‾ ⏋
        ⎿ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ⏌
        -->

            <!-- Pursued Degree -->
<?php if($item->selectDegree()->isNotEmpty()): ?>
            <p data-search="<?= $item->selectDegree()?>" class="accordion-container__degree filter searchText"><?= option('category-map-short') [$item->selectDegree()->value()]?></p>
<?php endif?>

            <!-- Semester of Publishing -->
            <div class="accordion-container__date">
<?php if($item->yearOfPublishing()->isNotEmpty()): ?>
<?php if($isWs === true): ?>
                <p class="filter searchText"><?= $newYear?></p>
<?php else: ?>
                <p class="filter searchText"><?= $item->yearOfPublishing()?></p>
<?php endif ?>
<?php endif ?>
<?php if($item->semesterCycle()->isNotEmpty()): ?>
                <p class="filter searchText"><?= $item->semesterCycle()?></p>
<?php endif?>
            </div>

            <!-- Language the thesis is written in -->
<?php if ($item->language()->isNotEmpty()): ?>
            <h4 data-search="<?=option('category-map')[$item->language()->category()->value()]?>" class="accordion-container__language filter searchText"><?= $item->language()->category()?></h4>
<?php endif ?>
            
            <!-- Thesis Title -->
            <h4 class="accordion-container__thesis"><?= $item->title()?></h4>
            
             <!-- Thesis Author -->

            <h4 class="accordion-container__graduate"><?=$graduate->name()?></h4>
            
            <!-- Links for downloading the thesis and opening the original thesis website  -->
            <div class="accordion-container__downloads">

            <!-- Website Status-->
<!-- 
                


-->

<?php if ($item->mirrorExternalBroken()->toBool() === true && $item->mirrorExternal()->isNotEmpty()):?>
                <h4 class="status-online">Website</h4>
<?php elseif ($item->mirrorExternalBroken()->toBool() === false && $item->mirrorKDG()->isNotEmpty()):?>
                <h4 class="status-online">Website</h4>
<?php else: ?>
                <h4 class="status-offline">Website</h4>
<?php endif ?>


                <!-- Thesis Status -->
<?php if ($item->thesispdf()->isNotEmpty()): ?>
                <h4 class="status-online">Thesis</h4>
<?php else: ?>
                <h4 class="status-offline">Thesis</h4>
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
                <h2 class="accordion-content__thesis__title searchText no-close"><?= $item->title()?></h2>  
                
                <div class="accordion-content__thesis-info--wrapper">
                    <div class="accordion-content__thesis-info">

                        <!-- Thesis Subtitle // this will only show up, if there is a subtitle -->
    <?php if ($item->thesisSubtitle()->isNotEmpty()): ?>
                        <h5 class="searchText accordion-content__thesis-info__subtitle no-close"><?= $item->thesisSubtitle()?></h5>
    <?php endif ?>
                        <ul class="accordion-content__thesis-info__published">

                            <!-- Persued Degree -->
    <?php if($item->selectDegree()->isNotEmpty()): ?>
                            <li class="no-close" data-search="<?= option('category-map') [$item->selectDegree()->value()]?>" class="searchText filter"><?= option('category-map')[$item->selectDegree()->value()]?> Thesis</li>
    <?php endif?>

                            <!-- Year of Publishing -->
                            <li>
                                <?php if($item->semesterCycle()->isNotEmpty()):?>
                                    <span class="filter searchText"><?= $item->semesterCycle()?></span>
                                <?php endif?> 
                                <?php if($item->yearOfPublishing()->isNotEmpty()):?><?php if($isWs === true):?><span class="filter searchText no-close"><?= $newYear?></span><?php else:?><span class="filter searchText no-close"><?= $item->yearOfPublishing()?></span><?php endif?><?php endif?>
                            </li>
                        </ul>
                        
                        <!-- Advisors -->
                        <ul class="accordion-content__thesis-info__advisors">
    <?php if ($item->advisor1()->isNotEmpty()): ?>
                            <li class="searchText filter no-close"><?= $item->advisor1()?></li>
    <?php endif ?>
    <?php if ($item->advisor2()->isNotEmpty()): ?>
                            <li class="searchText filter no-close"><?= $item->advisor2()?></li>
    <?php endif ?>
    <?php if ($item->advisor3()->isNotEmpty()): ?>
                            <li class="searchText filter no-close"><?= $item->advisor3()?></li>
    <?php endif ?>
                        </ul>

                        <!-- 
                        Topics - The tags are searchable and clickable.
                        By clicking on a tag it will appear as a filter
                        on the top, next to the searchbar.
                        -->
    <?php if ($item->thesisTags()->isNotEmpty()): ?>
                        <div class="accordion-content__thesis-info__topics">    
                            <h5 class="no-close">Topics</h5>
                            <div class="accordion-content__thesis-info__topics__tags">
    <?php foreach ($item->thesisTags()->split() as $tags): ?>
                                <button class="searchText tag filter no-close"><?= $tags ?></button>
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
                       <div class="scrollwrapper no-close">
    <?php if ($item->thesisAbstract()->isNotEmpty()): ?>
                            <?= $item->thesisAbstract()->kirbytext()?>
    <?php endif ?>
                       </div>
                    </div>
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
                <!-- Graduate -->
<?php if ($graduate->name()): ?>
                <h2 class="accordion-content__cv__graduate searchText no-close"><?= $graduate->name()?></h2>
<?php endif ?>
                <div class="accordion-content__cv__info--wrapper">
                    <div class="accordion-content__cv__info">

                        <!-- Degrees pursured at HFBK Hamburg -->
                        <ul class="accordion-content__cv-info__degrees">

<?php foreach ($site->children()->published()->filterBy('authorID', $id) as $gradProject):?>
<?php 
// Make 20XX/YY from 20XX
$gradPublished = (int) $gradProject->yearOfPublishing()->value(); // Convert to an integer
$gradNextYear = $gradPublished + 1; // Add 1 to the year
// Check if SuSe or WiSe
$GradSemesterCycle = $gradProject->semesterCycle()->value(); // Get the value of semesterCycle
$GradIsWs = $GradSemesterCycle === 'WiSe'; // Check if it's "WiSe" and set $isWs to true or false
?>
<?php if ($gradProject->selectDegree()->isNotEmpty() && $gradProject->yearOfPublishing()->isNotEmpty()): ?>
			                <li class="searchText no-close"><?= $gradProject->selectDegree()->value()?>, <?php if($GradIsWs === true): ?><?= $gradNextYear ?><?php else: ?><?= $gradProject->yearOfPublishing()?><?php endif ?></li>
<?php endif ?> 
<?php endforeach?>
                        </ul>

                        <!-- Part of following Classes at HFBK Hamburg -->
                        <ul class="accordion-content__cv-info__classes">
<?php if ($graduate->class()->isNotEmpty()): ?>
<?php foreach ($graduate->class()->split() as $tags): ?>
                            <li class="searchText filter no-close">Klasse <?= $tags ?></li>
<?php endforeach ?>
<?php endif ?>
                        </ul>
                            
                        <div class="accordion-content__cv-info__projects">
                            <!-- Link to other Thesis Projects -->
                            <h5 class="no-close">Thesis Projects at KDG:</h5>
                        
                            <!-- All connected projects -->
                            <ul>
<?php foreach ($site->children()->published()->filterBy('authorID', $id) as $gradProject):?> 
                            <li class="filter no-close"><?= $gradProject->title()?></li>
<?php endforeach ?>

                            </ul>
                        </div>

                        <!-- All socials and other links -->
                        <ul class="accordion-content__cv-info__socials">
<?php if ($graduate->website()->isNotEmpty()): ?> 
                            <!-- Website -->                        
                            <li><a class="no-close" target="_blank" href="<?= $graduate->website()->toUrl()?>">Website</a></li>
<?php endif ?>
<?php if ($graduate->socialsEmail()->isNotEmpty()): ?>                         
                            <!-- Mail -->
                            <li><a class="no-close" href="mailto:<?= Str::encode($graduate->socialsEmail()) ?>">Mail</a></li>
<?php endif ?> 
                            <!-- Socials -->
<?php $entries = $graduate->socials()->toStructure(); foreach ($entries as $entry): ?>
                            <li><a class="searchText filter no-close" target="_blank" href="<?= $entry->socialLink()->url() ?>"> <?= $entry->socialName() ?></a></li>
<?php endforeach ?>
                        </ul> 
                    </div> 
                

                    <!-- Graduate Bio -->
                    <div class="accordion-content__cv__bio searchText">    
<?php if ($graduate->bio()->isNotEmpty()): ?>
                        <div class="no-close">
                            <?= $graduate->bio()->kirbytext()?> 
                        </div>
<?php endif ?>
                    </div>  
                </div>      
            </section>

            <!-- Links to: Download Thesis / Open Website / Practical Works -->
            <div class="accordion-content__links">
<?php if ($item->thesispdf()->isNotEmpty()): ?>
                <div class="accordion-content__links__download-container no-close">
                    <a target="_blank" href="<?=$item->thesispdf()->toFile()->url()?>">Download Thesis ↓</a>
                    <button class="tag"><?= $item->language()->category()?></button>
                </div>
<?php endif ?>
<?php if ($item->mirrorExternalBroken()->toBool() === true ):?>
<?php if ($item->mirrorExternal()->isNotEmpty()): ?>
                <!-- Link to original Website-->
                <a target="_blank" href="<?=$item->mirrorExternal()->url()?>">Open Website ↗</a>
<?php endif ?>
<?php else:?>
<?php if ($item->mirrorKDG()->isNotEmpty()): ?> 
                <!-- Link to KDG Archive Website-->
                <a class="no-close" target="_blank"  href="<?=$item->mirrorKDG()->url()?>">Open Website ↗</a>
<?php endif ?>
<?php endif ?>
<?php if ($item->repositoryLink()->isNotEmpty()): ?>
                <!-- Link To HFBK Repository -->
                <a class="no-close" target="_blank" href="<?=$item->repositoryLink()->url()?>">Practical Work ↗</a>
<?php endif ?>
            </div>
        </div>
    </div>    
</article>
<?php endif ?>
<?php endforeach?>