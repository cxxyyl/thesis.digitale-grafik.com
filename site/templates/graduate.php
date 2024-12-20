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
<?php $connectedProject = $gradProject->linkThesis()->toPage()?>
<?php 
    // Make 20XX/YY from 20XX
    $yearOfPublishing = (int) $connectedProject->yearOfPublishing()->value(); // Convert to an integer
    $nextYear = $yearOfPublishing + 1; // Add 1 to the year
    $newYear = $yearOfPublishing . '/' . substr($nextYear, -2); // Format as "2025/26"

    // Check if SuSe or WiSe
    $semesterCycle = $connectedProject->semesterCycle()->value(); // Get the value of semesterCycle
      $isWs = $semesterCycle === 'WiSe'; // Check if it's "WiSe" and set $isWs to true or false
?>

		<article class="standalone__thesis">
			<section>
<?php if ($connectedProject->title()->isNotEmpty()): ?>
				<h1><a href="<?= $connectedProject->url()?>"><?= $connectedProject->title()?></a></h1>
<?php endif ?>
<?php if ($connectedProject->thesisSubtitle()->isNotEmpty()): ?>
				<h2><?= $connectedProject->thesisSubtitle()?></h2>
<?php endif ?>

<?php if($connectedProject->selectDegree()->isNotEmpty()): ?>
				<p><?= option('category-map')[$connectedProject->selectDegree()->value()] ?></p>
<?php endif?>
<?php if($connectedProject->semesterCycle()->isNotEmpty() && $connectedProject->yearOfPublishing()->isNotEmpty()): ?>
			<p><?= $connectedProject->semesterCycle()?> – <?php if($isWs === true): ?><?= $newYear?><?php else: ?><?= $connectedProject->yearOfPublishing()?><?php endif?></p>
<?php endif?>
<?php if ($connectedProject->language()->isNotEmpty()): ?>
				<p><?= option('category-map')[$connectedProject->language()->category()->value()] ?></p>
<?php endif ?>
				<h3>Abstract</h3>
<?php if ($connectedProject->thesisAbstract()->isNotEmpty()): ?>
					<div class="text-wrapper"><?= $connectedProject->thesisAbstract()->kirbytext()?></div>
<?php endif ?>

				<h3>Tags</h3><?php if ($connectedProject->thesisTags()->isNotEmpty()): ?>  
					<p><?= implode(', ', $connectedProject->thesisTags()->split()) ?></p>
<?php endif ?>


<?php if( $connectedProject->advisor1()->isNotEmpty() ||  $connectedProject->advisor2()->isNotEmpty() ||  $connectedProject->advisor3()->isNotEmpty()):?>
			<h3>Advisors</h3>
				<ul>
<?php if ( $connectedProject->advisor1()->isNotEmpty()): ?>
					<li><?=  $connectedProject->advisor1()?></li>
<?php endif ?>
<?php if ( $connectedProject->advisor2()->isNotEmpty()): ?>
					<li><?=  $connectedProject->advisor2()?></li>
<?php endif ?>
<?php if ( $connectedProject->advisor3()->isNotEmpty()): ?>
					<li><?=  $connectedProject->advisor3()?></li>
<?php endif ?>
<?php endif ?>
				</ul>
			</section>

			<section>
<?php if ($connectedProject->thesispdf()->isNotEmpty()): ?>
				<h3>Files</h3>
<?php $download = $connectedProject->thesispdf()->toFile() ?>
					<a href="<?= $download->url() ?>">Download Thesis PDF</a>
<?php endif ?>
			</section>

			<section>
				<h3>Thesis Website</h3>
					<ul>
<?php if ($connectedProject->mirrorExternal()->isNotEmpty()): ?>
						<li><a href="<?= $connectedProject->mirrorExternal()->toUrl()?>"><?= $connectedProject->mirrorExternal()->toUrl()?></a></li>
<?php endif ?>
<?php if ($connectedProject->mirrorKDG()->isNotEmpty()): ?>
						<li><a href=" <?= $connectedProject->mirrorKDG()->toUrl()?>"><?= $connectedProject->mirrorKDG()->toUrl()?> </a></li>
<?php endif ?>
					</ul>
			</section>
		</article>
<?php endforeach?>
<?php endif ?>
	</div>



<article class="standalone__graduate">
    <section>
		<h1 id="aboutAuthor">About the Author</h1>
<?php if ($page->name()->isNotEmpty()): ?>
		<h1><?= $page->name()?> <?= $page->surname()?></h1>
<?php endif ?>
<?php if ($page->bio()->isNotEmpty()): ?>
		<h3>Bio</h3>
<?= $page->bio()->kirbytext()?> 
<?php endif ?>   
		<h3>Classes</h3>
<?php if ($page->class()->isNotEmpty()): ?>
			<ul>
<?php foreach ($page->class()->split() as $tags): ?>
	    		<li><?= $tags ?></li>
<?php endforeach ?>
			</ul>
<?php endif ?>
		<h3>Degrees at HFBK Hamburg</h3>
			<ul>
<?php if ($page->studies()->isNotEmpty()): ?><?php $gradProjects = $page->studies()->toStructure();foreach ($gradProjects as $gradProject): ?>
	   			<li class="searchText"><?= $gradProject->selectStudies()?>, <?= $gradProject->graduation()->toDate('Y')?></li>
<?php endforeach ?>
<?php endif ?>
			</ul>
    </section>
	
    <section>
		<h3>Contact</h3>
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