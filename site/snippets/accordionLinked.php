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
        <div data-info="" class="accordion__row">
            <div class="accordion__container">
                
            <!-- Pursued Degree -->
                <?php if($item->selectBM()->isNotEmpty()): ?>
                <p class="accordion__degree"><?= $item->selectBM()?></p>
                <?php endif?>

                <!-- Semester of Publishing -->
                <div class="accordion__date">
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
                <p class="button-primary "><?= $item->language()->category()?></p>
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


                    <!-- hier muss noch die funktion rein, die anzeigt wie viele tags insgesamt verwendet werden. also die funktion tagname(3) -->
                        

                    <h5>Topics</h5>
                    <?php if ($item->thesisTags()->isNotEmpty()): ?>
                    <div>
                    <?php foreach ($item->thesisTags()->split() as $tags): ?>
                        <div class="searchText button-primary"><?= $tags ?></div>
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
                <!-- Hier fehlen noch ein paar Verknüpfungen zum Backend -->

                <div>
                    <div>
                    <?php if ($graduate->studies()->isNotEmpty()): ?> 

                    <?php $gradProjects = $graduate->studies()->toStructure();
                    foreach ($gradProjects as $gradProject): ?>
                    <p><?= $gradProject->selectStudies()?>, <?= $gradProject->graduation()->toDate('Y')?></p>
                    <?php endforeach ?>
                     <?php endif ?>
                    </div>

                    <!-- Klassen -->
                    <div class="">
                        <?php if ($graduate->class()->isNotEmpty()): ?>
                        <?php foreach ($graduate->class()->split() as $tags): ?>
                        <div>Klasse <?= $tags ?></div>
                        <?php endforeach ?>
                        <?php endif ?>
                    </div>
                        
                    <div class="">
                        <!-- Link to other Thesis Projects -->
                        <p>Thesis Projects at KDG:</p>
                       
                        <!-- Kirby Structure for all connected projects -->
                        <?php if ($graduate->studies()->isNotEmpty()): ?> 

                        <?php $gradProjects = $graduate->studies()->toStructure();
                     
                        foreach ($gradProjects as $gradProject): ?>
                        
                        <!-- hier muss noch ein Hook rein -> wie springe ich zum entsprechenden Eintrag -->
                        <p><?= $gradProject->linkThesis()->toPage()->title()?></p>
                        <?php endforeach ?>

                        <?php endif ?>
                    </div>

                    <div class="">
                        <!-- Website -->
                        <?php if ($graduate->website()->isNotEmpty()): ?>
                        <a target="_blank" href="<?= $graduate->website()->toUrl()?>">Website</a>
                        <?php endif ?>

                        <!-- Mail -->
                        <?php if ($graduate->email()->isNotEmpty()): ?>
                        <a href="mailto:<?= Str::encode($graduate->email()) ?>">Mail</a>
                        <?php endif ?> 

                        <!-- Socials Structure -->
                        <?php
                        $entries = $graduate->socials()->toStructure();
                        foreach ($entries as $entry): ?>
                        <a target="_blank" href="<?= $entry->socialLink()->url() ?>"> <?= $entry->socialName() ?></a>
                        <?php endforeach ?>
                    </div> 
                </div> 
                
                <!-- Graduate Bio -->
                <div class="">    
                    <?php if ($graduate->bio()->isNotEmpty()): ?>
                    <?= $graduate->bio()->kirbytext()?> 
                    <?php endif ?>

                </div>    
            </section>
        </div>
    </article>

    <?php endif ?> 

<?php endforeach?>