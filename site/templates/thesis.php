<!DOCTYPE html>
<html lang="en">

<?php snippet('creditsmini')?>


<?php snippet('head')?>

<!-- Visit the main page for full documentation -->
<a class="standalone__return" href="<?= $site->url() ?>">Return</a>


<?php 
    // Make 20XX/YY from 20XX
    $published = (int) $page->yearOfPublishing()->value(); // Convert to an integer
    $nextYear = $published + 1; // Add 1 to the year
    $newYear = $published . '/' . substr($nextYear, -2); // Format as "2025/26"

    // Check if SuSe or WiSe
    $semesterCycle = $page->semesterCycle()->value(); // Get the value of semesterCycle
      $isWs = $semesterCycle === 'WiSe'; // Check if it's "WiSe" and set $isWs to true or false

	// Save current authorID
	$graduate = $page->authorID()->toUser();  
?>

<main class="standalone">
	<article class="standalone__thesis">
		<section>
<?php if ($page->title()->isNotEmpty()): ?>
			<h1><?= $page->title()?></h2>
<?php endif ?>
<?php if ($page->thesisSubtitle()->isNotEmpty()): ?>
			<h2><?= $page->thesisSubtitle()?></h2>
<?php endif ?>
<!-- Connect to user -->
			<p><?=$graduate->name()?></p>
<!-- Select degree -> structure -->
<?php if($page->selectDegree()->isNotEmpty()): ?>
			<p><?= option('category-map')[$page->selectDegree()->value()] ?> Thesis</p>
<?php endif?>
<?php if ($page->language()->isNotEmpty()): ?>
			<p><?= option('category-map')[$page->language()->category()->value()] ?></p>
<?php endif ?>
<?php if ($page->thesisAbstract()->isNotEmpty()): ?>
				<h3>Abstract</h3>
				<div class="text-wrapper">
					<?= $page->thesisAbstract()->kirbytext()?>
				</div>
<?php endif ?>
<?php if ($page->thesisTags()->isNotEmpty()): ?>  
			<h3>Tags</h3>
 			 <p><?= implode(', ', $page->thesisTags()->split()) ?></p>
<?php endif ?>

<?php if($page->advisor1()->isNotEmpty() || $page->advisor2()->isNotEmpty() || $page->advisor3()->isNotEmpty()):?>
			<h3>Advisors</h3>
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
<?php endif ?>
				</ul>
		</section>

		<section>
<?php if ($page->thesispdf()->isNotEmpty()): ?>
			<h3>Files</h3>
<?php $download = $page->thesispdf()->toFile() ?>
				<a href="<?= $download->url() ?>">Download Thesis PDF</a>
<?php endif ?>
		</section>

		<section>
			<h3>Thesis Website</h3>
				<ul>
<?php if ($page->mirrorExternal()->isNotEmpty()): ?>
					<li><a href="<?= $page->mirrorExternal()->toUrl()?>"><?= $page->mirrorExternal()->toUrl()?></a></li>
<?php endif ?>
<?php if ($page->mirrorKDG()->isNotEmpty()): ?>
					<li><a href="<?= $page->mirrorKDG()->toUrl()?>"><?= $page->mirrorKDG()->toUrl()?></a></li>
<?php endif ?>
				</ul>
		</section>
	</article>

	<article class="standalone__graduate">
		<section>
			<h1>About the Author</h1>
			<h3>Bio</h3>
<?php if ($graduate->bio()->isNotEmpty()): ?>
			<?= $graduate->bio()->kirbytext()?> 
<?php endif ?>   
			<h3>Classes</h3>
<?php if ($graduate->class()->isNotEmpty()): ?>
				<ul>
<?php foreach ($graduate->class()->split() as $tags): ?>
					<li><?= $tags ?></li>
<?php endforeach ?>
				</ul>
<?php endif ?>
			<h3>Degrees at HFBK Hamburg</h3>
				<ul>

<?php foreach ($site->children()->published()->filterBy('authorID', $graduate) as $gradProject):?>
<?php 
// Make 20XX/YY from 20XX
$gradPublished = (int) $gradProject->yearOfPublishing()->value(); // Convert to an integer
$gradNextYear = $gradPublished + 1; // Add 1 to the year

// Check if SuSe or WiSe
$GradSemesterCycle = $gradProject->semesterCycle()->value(); // Get the value of semesterCycle
$GradIsWs = $GradSemesterCycle === 'WiSe'; // Check if it's "WiSe" and set $isWs to true or false
?>

<?php if ($gradProject->selectDegree()->isNotEmpty() && $gradProject->yearOfPublishing()->isNotEmpty()): ?>
			<li><?= $gradProject->selectDegree()->value()?>, <?php if($GradIsWs === true): ?><?= $gradNextYear ?><?php else: ?><?= $gradProject->yearOfPublishing()?><?php endif ?></li>
<?php endif ?> 
<?php endforeach?>
				</ul>
		</section>

		<section>
			<h3>Contact</h3>
				<ul>
<?php if ($graduate->website()->isNotEmpty()): ?>
					<li><a target="_blank" href=" <?= $graduate->website()->toUrl()?>"><?= $graduate->website()?></a></li>
<?php endif ?>
<?php if ($graduate->socialsEmail()->isNotEmpty()): ?>
					<li><a href="mailto:<?= Str::encode($graduate->email()) ?>"><?= Str::encode($graduate->email()) ?></a></li>
<?php endif ?>
				</ul>
		</section>                
			
		<section>
			<h3>Projects</h3>
			<ul>
<!-- check kirby index for all pages with graduate ID , make array, for each display array-->
<?php foreach ($site->children()->published()->filterBy('authorID', $graduate) as $gradProject):?> 
				<li><a href="<?= $gradProject->url()?>"><?= $gradProject->title()?></a></li>
<?php endforeach?>
			</ul>		
		</section>	
	</article>
</main>


<?php snippet('footer')?>

</html>