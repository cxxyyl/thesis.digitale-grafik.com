<?php  foreach ($site->grandchildren()->listed() as $item):?> 
<?php  $template = $item->template();$thesis = 'thesis';if (str_contains($template, $thesis)): ?>     

<article data-info="<?= $item->title()->slug()?>" class="search-result accordion" >
    
        <!--  can i write comments with kirby? here is some php that displays the thesis title: <?= $item->title()?>
        yes! it works! great :-) 

        My Idea would be the following: 
        Write some extra code to have a quick summary of what the current block of code is: 

        Something like:
        The following block of code is for and then
        Display name Surname
        Thesis 
        Year

        -->

        <!-- This is the code for everything that is displayed in the rows of the table. -->
        <div data-info="" class="accordion_row">
            <div class="accordion_container">
                
            <!-- Pursued Degree -->
                <?php if($item->selectDegree()->isNotEmpty()): ?>
                <p class="accordion_container_degree"><?= $item->selectDegree()?></p>
                <?php endif?>

                <!-- Semester of Publishing -->
                <div class="accordion_container_date">
                    <?php if($item->yearOfPublishing()->isNotEmpty()): ?>
                    <p><?= $item->yearOfPublishing()?></p>
                    <?php endif?>

                    <?php if($item->semesterCycle()->isNotEmpty()): ?>
                    <p><?= $item->semesterCycle()?></p>
                    <?php endif?>
                </div>
                
                <!-- Thesis Author -->
                <?php $graduate = $item->connectedGraduate()->toPage() ?>
                <h4 class="accordion_container_graduate"><?=$graduate->name()?> <?=$graduate->surname()?></h4>
            
                <!-- Thesis Title -->
                <h4 class="accordion_container_thesis"><?= $item->title()?></h4>
            

                <!-- Language the thesis is written in -->
                <?php if ($item->language()->isNotEmpty()): ?>
                <p class="button-primary button-extraSpacing"><?= $item->language()->category()?></p>
                <?php endif ?>
            
                <!-- Links for downloading the Thesis and opening the original thesis website  -->
                <div class="accordion_container_downloads">

                    <?php if ($item->reissue()->mirrorExternalBroken() === true ):?>
                    <a target="_blank" class="button-primary" href="<?=$item->mirrorExternal()->url()?>">Open Website ↗</a>
                    <?php else:?>
                    <a target="_blank" class="button-primary" href="<?=$item->mirrorKDG()->url()?>">Open Website ↗</a>
                    <?php endif ?>

                    <!-- This will not show up if there is no uploaded file -->
                    <?php if ($item->thesispdf()->isNotEmpty()): ?>
                    <a class="button-primary" href="<?=$item->thesispdf()->toFile()->url()?>">Download Thesis ↓</a>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="accordion-content">
            <section class="accordion-content_thesis">
                <!-- Thesis Title -->
                <h2 class="accordion-content_thesis_title searchText"><?= $item->title()?></h2>
                <div class="accordion-content_thesis_info">
                    <!-- Thesis Subtitle / this will only show up, if there is a subtitle -->
                    <?php if ($item->thesisSubtitle()->isNotEmpty()): ?>
                    <h5 class="searchText accordion-content_thesis_info_subtitle"><?= $item->thesisSubtitle()?></h5>
                    <?php endif ?>

                    <ul class="accordion-content_thesis_info_published">
                        <!-- Persued Degree -->
                        <?php if($item->selectDegree()->isNotEmpty()): ?>
                        <li><?= option('category-map')[$item->selectDegree()->value()] ?> Thesis</li>
                        <?php endif?>

                        <!-- Year of Publishing -->
                        <li><?php if($item->yearOfPublishing()->isNotEmpty()):?><?= $item->semesterCycle()?><?php endif?> <?php if($item->semesterCycle()->isNotEmpty()): ?><?= $item->yearOfPublishing()?></p><?php endif?></li>
                    </ul>
                    
                    <!-- Advisors -->
                    <ul class="accordion-content_thesis_info_advisors">
                        <?php if ($item->advisor1()->isNotEmpty()): ?>
                        <li class="searchText"><?= $item->advisor1()?></li>
                        <?php endif ?>

                        <?php if ($item->advisor2()->isNotEmpty()): ?>
                        <li class="searchText"><?= $item->advisor2()?></li>
                        <?php endif ?>

                        <?php if ($item->advisor3()->isNotEmpty()): ?>
                        <li class="searchText"><?= $item->advisor3()?></li>
                        <?php endif ?>
                    </ul>

                    <!-- Topics - The tags are searchable -->

                    <?php if ($item->thesisTags()->isNotEmpty()): ?>
                    <!-- hier muss noch die funktion rein, die anzeigt wie viele tags insgesamt verwendet werden. also die funktion tagname(3) -->
                    <div class="accordion-content_thesis_info_topics">    
                        <h5>Topics</h5>
               
                        <ul class="accordion-content_thesis_info_topics_tags">
                        <?php foreach ($item->thesisTags()->split() as $tags): ?>
                            <li class="searchText button-primary"><?= $tags ?></li>
                        <?php endforeach ?>
                        </ul>
                    </div>
                    <?php endif ?>
                </div>
                
                <!-- Thesis Abstract / this will only show up, if there is an abstract -->
                <div class="accordion-content_thesis_abstract searchText">
                <?php if ($item->thesisAbstract()->isNotEmpty()): ?>
                <?= $item->thesisAbstract()->kirbytext()?>
                <?php endif ?>
                </div>
            </section>

            <section class="accordion-content_cv">
                <?php $graduate = $item->connectedGraduate()->toPage() ?>    

                <!-- Graduate -->
                <?php if ($graduate->name()->isNotEmpty()): ?>
                <h2 class="accordion-content_cv_graduate searchText"><?= $graduate->name()?> <?= $graduate->surname()?></h2>
                <?php endif ?>

                <div class="accordion-content_cv_info">

                    <!-- Degrees pursured at HFBK Hamburg -->
                    <ul class="accordion-content_cv_info_degrees">
                        <?php if ($graduate->studies()->isNotEmpty()): ?> 

                        <?php $gradProjects = $graduate->studies()->toStructure();
                        foreach ($gradProjects as $gradProject): ?>
                        <li><?= $gradProject->selectStudies()?>, <?= $gradProject->graduation()->toDate('Y')?></li>
                        <?php endforeach ?>
                        <?php endif ?>
                    </ul>

                    <!-- Part of following Classes at HFBK Hamburg -->
                    <ul class="accordion-content_cv_info_classes">
                        <?php if ($graduate->class()->isNotEmpty()): ?>
                        <?php foreach ($graduate->class()->split() as $tags): ?>
                        <li>Klasse <?= $tags ?></li>
                        <?php endforeach ?>
                        <?php endif ?>
                    </ul>
                        
                    <div class="accordion-content_cv_info_projects">
                        <!-- Link to other Thesis Projects -->
                        <h5>Thesis Projects at KDG:</h5>
                       
                        <!-- Kirby Structure for all connected projects -->
                        <ul>
                        <?php if ($graduate->studies()->isNotEmpty()): ?> 
                        <?php $gradProjects = $graduate->studies()->toStructure();
                        foreach ($gradProjects as $gradProject): ?>
        
                        <!-- hier muss noch ein Hook rein -> wie springe ich zum entsprechenden Eintrag -->
                        <li><?= $gradProject->linkThesis()->toPage()->title()?></li>
                        <?php endforeach ?>

                        <?php endif ?>
                        </ul>
                    </div>

                    <ul class="accordion-content_cv_info_socials">
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

                        <!-- Socials Structure -->
                        <?php $entries = $graduate->socials()->toStructure(); foreach ($entries as $entry): ?>
                        <li>    
                            <a target="_blank" href="<?= $entry->socialLink()->url() ?>"> <?= $entry->socialName() ?></a>
                        </li>
                        <?php endforeach ?>
                    </ul> 
                </div> 
                
                <!-- Graduate Bio -->
                <div class="accordion-content_cv_bio">    
                    <?php if ($graduate->bio()->isNotEmpty()): ?>
                    <?= $graduate->bio()->kirbytext()?> 
                    <?php endif ?>

                </div>    
            </section>
            <div class="accordion-content_links">

                <!-- This will not show up if there is no uploaded file -->
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
    </article>

    <?php endif ?> 

<?php endforeach?>