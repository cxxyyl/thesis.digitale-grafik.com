<!DOCTYPE html>
<html lang="en">

<?php snippet('creditsmini')?>


<?php snippet('head')?>

<!-- Visit the main page for full documentation -->
<a class="standalone__return" href="<?= $site->url() ?>">Return</a>

<main class="standalone">
	<div class="standalone__thesis-wrapper">
		<h1>Projects</h1>
<?php if ($page->studies()->isNotEmpty()): ?><?php $gradProjects = $page->studies()->toStructure(); foreach ($gradProjects as $gradProject): ?>
<?php $connectedProject = $gradProject->linkThesis()->toPage() ?>
		<article class="standalone__thesis">
			<section>
<?php if ($connectedProject->title()->isNotEmpty()): ?>
				<h1><a href="<?= $connectedProject->url()?>"><?= $connectedProject->title()?></a></h1>
<?php endif ?>
<?php if ($connectedProject->thesisSubtitle()->isNotEmpty()): ?>
				<h2><?= $connectedProject->thesisSubtitle()?></h2>
<?php endif ?>

<?php if($connectedProject->selectDegree()->isNotEmpty()): ?>
				<p>Degree: <?= option('category-map')[$connectedProject->selectDegree()->value()] ?></p>
<?php endif?>
<?php if($connectedProject->semesterCycle()->isNotEmpty() && $connectedProject->yearOfPublishing()->isNotEmpty()): ?>
				<p>Published: <?= $connectedProject->semesterCycle()?> – <?= $connectedProject->yearOfPublishing()?></p>
<?php endif?>
<?php if ($connectedProject->language()->isNotEmpty()): ?>
				<p>Language: <?= option('category-map')[$connectedProject->language()->category()->value()] ?></p>
<?php endif ?>
				<h3>Abstract:</h3>
<?php if ($connectedProject->thesisAbstract()->isNotEmpty()): ?>
					<div class="text-wrapper"><?= $connectedProject->thesisAbstract()->kirbytext()?></div>
<?php endif ?>

				<h3>Tags:</h3><?php if ($connectedProject->thesisTags()->isNotEmpty()): ?>  
				<p><?php foreach ($connectedProject->thesisTags()->split() as $tags): ?><?= $tags ?>, <?php endforeach ?></p>
<?php endif ?>

				<h3>Advisors:</h3>
					<ul>
<?php if ($connectedProject->advisor1()->isNotEmpty()): ?>
						<li><?= $connectedProject->advisor1()?></li>
<?php endif ?>
<?php if ($connectedProject->advisor2()->isNotEmpty()): ?>
						<li><?= $connectedProject->advisor2()?></li>
<?php endif ?>
<?php if ($connectedProject->advisor3()->isNotEmpty()): ?>
						<li><?= $connectedProject->advisor3()?></li>
<?php endif ?>
					</ul>
			</section>

			<section>
				<h3>Files</h3>
<?php if ($connectedProject->thesispdf()->isNotEmpty()): ?>
<?php $download = $connectedProject->thesispdf()->toFile() ?>
					<a href="<?= $download->url() ?>">Download Thesis PDF</a>
<?php endif ?>
			</section>

			<section>
				<h3>Thesis Website Archive</h3>
					<ul>
<?php if ($connectedProject->mirrorExternal()->isNotEmpty()): ?>
						<li><a href="<?= $connectedProject->mirrorExternal()->toUrl()?>">Mirror Original: <?= $connectedProject->mirrorExternal()->toUrl()?></a></li>
<?php endif ?>
<?php if ($connectedProject->mirrorKDG()->isNotEmpty()): ?>
						<li><a href=" <?= $connectedProject->mirrorKDG()->toUrl()?>"> Mirror KDG: <?= $connectedProject->mirrorKDG()->toUrl()?> </a></li>
<?php endif ?>
					</ul>
			</section>
		</article>
<?php endforeach?>
<?php endif ?>
	</div>



<article class="standalone__graduate">
    <section>
		<h1>About the Author</h1>
<?php if ($page->name()->isNotEmpty()): ?>
		<h3>Author: <?= $page->name()?> <?= $page->surname()?></h3>
<?php endif ?>
		<h3>Bio:</h3>
<?php if ($page->bio()->isNotEmpty()): ?>
<?= $page->bio()->kirbytext()?> 
<?php endif ?>   
		<h3>Classes:</h3>
<?php if ($page->class()->isNotEmpty()): ?>
			<ul>
<?php foreach ($page->class()->split() as $tags): ?>
	    		<li><?= $tags ?></li>
<?php endforeach ?>
			</ul>
<?php endif ?>
		<h3>Degrees at HFBK Hamburg: </h3>
			<ul>
<?php if ($page->studies()->isNotEmpty()): ?><?php $gradProjects = $page->studies()->toStructure();foreach ($gradProjects as $gradProject): ?>
	   			<li class="searchText"><?= $gradProject->selectStudies()?>, <?= $gradProject->graduation()->toDate('Y')?></li>
<?php endforeach ?>
<?php endif ?>
			</ul>
    </section>
	
    <section>
		<h3>Contact:</h3>
		<ul>
<?php if ($page->website()->isNotEmpty()): ?>
			<li><a target="_blank" href=" <?= $page->website()->toUrl()?>"><?= $page->website()?></a></li>
<?php endif ?>
<?php if ($page->email()->isNotEmpty()): ?>
			<li><a href="mailto:<?= Str::encode($page->email()) ?>"><?= Str::encode($page->email()) ?></a></li>
<?php endif ?>
		</ul>
    </section>                
</main>


<?php snippet('footer')?>

</html>