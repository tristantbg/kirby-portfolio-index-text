<section class="fp-auto-height" id="projects">
	<?php foreach($projects as $project): ?>

		<?php 
		$categories = $project->categories()->split(',');
		?>
		<div class="project<?php foreach($categories as $c) { echo " cat-".tagslug($c); } ?>" data-title="<?= $project->uid(); ?>">
			<div class="project-header">
				<div class="project-title" data-target="page/work/<?= $project->uid() ?>">
					<?= $project->title()->html() ?>
				</div>
				<div class="year">
					<?= $project->date('Y') ?>
				</div>
				<?php if($project->featured()->isNotEmpty()): ?>
					<?php $featured = resizeOnDemand($project->featured()->toFile(), 400); ?>
					<div class="thumb"><img class="lazyload" data-src="<?= $featured ?>"></div>
				<?php endif ?>
				<div class="project-infos">
					<?= $project->text()->kt() ?>
				</div>
			</div>
			<div class="project-content">
				<?php $switch = rand(0,1) ?>
				<?php foreach($project->medias()->toStructure() as $key => $thumb): ?>
					<div class="project-image closed">
						<?php

						$image = $thumb->toFile();


						if ($image->videolink()->isNotEmpty()){
							$rand_size = rand(250,350);
							echo "<div class='project_video' style='width:" . $rand_size . "px' data-small='" . $rand_size . "'>" . $image->videolink()->embed(['lazyvideo' => true, 'autoplay' => false, 'thumb' => resizeOnDemand($image, 600)]) . "</div>";
						}
						else {
							if ($key%2 != $switch) {
								if ($image->landscape()) {
									$rand_size = rand(120,150);
								} else {
									$rand_size = rand(75,130);
								}
								
							} else {
								if ($image->landscape()) {
									$rand_size = rand(180,250);
								} else {
									$rand_size = rand(100,230);
								}
							}
							$srcset = '';
							for ($i = 600; $i <= 1800; $i += 300) {
								$srcset .= resizeOnDemand($image, $i) . ' ' . $i . 'w,';
							}
							if (!$thumb->caption()->empty()){
								$alt = $project->title()->html().', '.$thumb->caption()->html().' — © '.$project->date("Y").', '.$site->title()->html(); 
							}
							else {
								$alt = $project->title()->html().' — © '.$project->date("Y").', '.$site->title()->html(); 
							}
						?>
						<img 
						class="thumb lazyload <?php if($image->isLandscape()){ echo "landscape"; }?>"
						src="<?= url('assets/images/placeholder.gif') ?>"
						data-src="<?php echo resizeOnDemand($image, 500) ?>"
						data-srcset="<?php echo $srcset ?>" 
						data-sizes="50vw"
						data-optimumx="1.5"
						data-small="<?php echo $rand_size ?>"
						width="<?php echo $rand_size ?>px"
						height="<?php echo $rand_size/$image->ratio() ?>"
						alt="<?= $alt ?>" />

						<noscript>
						<img class="thumb" alt="<?= $alt ?>" src="<?php echo resizeOnDemand($image, 1300) ?>" data-small="<?php echo $rand_size ?>" width="<?php echo $rand_size ?>px" height="<?php echo $rand_size/$image->ratio() ?>" />
						</noscript>	
						
					<?php } ?>

				</div>
			<?php endforeach ?>
		</div>

	</div>
<?php endforeach ?>
</section>