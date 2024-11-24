<!DOCTYPE html>
<html lang="en">

<?php snippet('creditsmini')?>


<?php snippet('head')?>

<!-- Visit the main page for full documentation -->
<a class="standalone__return" href="<?= $site->url() ?>">Return</a>

<main class="standalone">
	<article class="standalone__thesis">
		<section>
<?php if ($page->title()->isNotEmpty()): ?>
			<h1><?= $page->title()?></h2>
<?php endif ?>
<?php if ($page->thesisSubtitle()->isNotEmpty()): ?>
			<h2><?= $page->thesisSubtitle()?></h2>
<?php endif ?>
<?php $graduate = $page->connectedGraduate()->toPage() ?>
			<h3>Author: <?=$graduate->name()?> <?=$graduate->surname()?></h3>
<?php if($page->selectDegree()->isNotEmpty()): ?>
			<p>Degree: <?= option('category-map')[$page->selectDegree()->value()] ?> Thesis</p>
<?php endif?>
<?php if($page->semesterCycle()->isNotEmpty() && $page->yearOfPublishing()->isNotEmpty()): ?>
			<p>Published: <?= $page->semesterCycle()?> – <?= $page->yearOfPublishing()?></p>
<?php endif?>
<?php if ($page->language()->isNotEmpty()): ?>
			<p>Language: <?= option('category-map')[$page->language()->category()->value()] ?></p>
<?php endif ?>

			<h3>Abstract:</h3>
<?php if ($page->thesisAbstract()->isNotEmpty()): ?>
				<div class="text-wrapper">
					<?= $page->thesisAbstract()->kirbytext()?>
				</div>
<?php endif ?>

			<h3>Tags:</h3>
<?php if ($page->thesisTags()->isNotEmpty()): ?>  
				<p><?php foreach ($page->thesisTags()->split() as $tags): ?><?= $tags ?>, <?php endforeach ?></p>
<?php endif ?>

			<h3>Advisors:</h3>
				<ul>
<?php if ($page->advisor1()->isNotEmpty()): ?>
					<li><?= $page->advisor1()?></li>
<?php endif ?>
<?php if ($page->advisor2()->isNotEmpty()): ?>
					<li><?= $page->advisor2()?></li>
<?php endif ?>
<?php if ($page->advisor3()->isNotEmpty()): ?>
					<li><?= $page->advisor3()?></li>
<?php endif ?>
				</ul>
		</section>

		<section>
			<h3>Files</h3>
<?php if ($page->thesispdf()->isNotEmpty()): ?>
<?php $download = $page->thesispdf()->toFile() ?>
				<a href="<?= $download->url() ?>">Download Thesis PDF</a>
<?php endif ?>
		</section>

		<section>
			<h3>Thesis Website Archive</h3>
				<ul>
<?php if ($page->mirrorExternal()->isNotEmpty()): ?>
					<li><a href="<?= $page->mirrorExternal()->toUrl()?>"> Mirror Original: <?= $page->mirrorExternal()->toUrl()?></a></li>
<?php endif ?>
<?php if ($page->mirrorKDG()->isNotEmpty()): ?>
					<li><a href="<?= $page->mirrorKDG()->toUrl()?>"> Mirror KDG: <?= $page->mirrorKDG()->toUrl()?></a></li>
<?php endif ?>
				</ul>
		</section>
	</article>


	<article class="standalone__graduate">
		<section>
			<h1>About the Author</h1>
			<h3>Bio:</h3>
<?php if ($graduate->bio()->isNotEmpty()): ?>
<?= $graduate->bio()->kirbytext()?> 
<?php endif ?>   
			<h3>Classes:</h3>
<?php if ($graduate->class()->isNotEmpty()): ?>
				<ul>
<?php foreach ($graduate->class()->split() as $tags): ?>
					<li><?= $tags ?></li>
<?php endforeach ?>
				</ul>
<?php endif ?>
			<h3>Degrees at HFBK Hamburg: </h3>
				<ul>
<?php if ($graduate->studies()->isNotEmpty()): ?><?php $gradProjects = $graduate->studies()->toStructure();foreach ($gradProjects as $gradProject): ?>
					<li class="searchText"><?= $gradProject->selectStudies()?>, <?= $gradProject->graduation()->toDate('Y')?></li>
<?php endforeach ?>
<?php endif ?>
				</ul>
			</section>
					
			<section>
				<h3>Contact:</h3>
					<ul>
<?php if ($graduate->website()->isNotEmpty()): ?>
						<li><a target="_blank" href=" <?= $graduate->website()->toUrl()?>"><?= $graduate->website()?></a></li>
<?php endif ?>
<?php if ($graduate->email()->isNotEmpty()): ?>
						<li><a href="mailto:<?= Str::encode($graduate->email()) ?>"><?= Str::encode($graduate->email()) ?></a></li>
<?php endif ?>
					</ul>
			</section>                
			
			<section>
				<h3>Projects:</h3>
					<ul>
<?php if ($graduate->studies()->isNotEmpty()): ?><?php $gradProjects = $graduate->studies()->toStructure(); foreach ($gradProjects as $gradProject): ?>
						<li><a href="<?= $gradProject->linkThesis()->toPage()->url()?>"><?= $gradProject->linkThesis()->toPage()->title()?></a></li>
<?php endforeach ?><?php endif ?>
					</ul>
			</section>
	
			<section>
				<h3><a href="<?= $graduate->url()?>">To Author Page</a></h3>
			</section>
	</article>
</main>



<?php snippet('footer')?>

</html>