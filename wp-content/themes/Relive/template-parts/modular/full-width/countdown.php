<?php if( $id['countdown_time_none'] ){?>
<?php
date_default_timezone_set('PRC');
if( $id['countdown_time'] > date('Y-m-d H:i:s', time()) ){?>
<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth mnmd-countdown-block"<?php if( xintheme('full_background_white') ){?> style="margin-bottom: 20px"<?php }?>>
	<div class="container">
		<div class="mnmd-block__inner inverse-text">
			<div class="background-img gradient-5" style=" background: <?php echo $id['countdown_color_1'] ?>; background: -webkit-linear-gradient(225deg, <?php echo $id['countdown_color_2'] ?> 0, <?php echo $id['countdown_color_1'] ?> 100%); background: linear-gradient(225deg, <?php echo $id['countdown_color_2'] ?> 0, <?php echo $id['countdown_color_1'] ?> 100%); ">
				<div class="background-svg-pattern">
				</div>
			</div>
			<div class="row row--space-between row--flex row--vertical-center">
				<div class="col-xs-12 col-md-6">
					<div class="mnmd-countdown">
						<div class="mnmd-countdown__inner meta-font js-countdown" data-countdown="<?php echo $id['countdown_time'] ?>">
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6 text-center">
					<h3 class="typescale-4"><a href="<?php echo $id['countdown_button_url'] ?>" target="_blank" rel="nofollow" class="link"><?php echo $id['modular_title_full'] ?></a></h3>
					<p class="text-secondary">
						<?php echo $id['countdown_describe'] ?>
					</p>
					<?php if( $id['countdown_button_text'] ) : ?>
					<a href="<?php echo $id['countdown_button_url'] ?>" target="_blank" rel="nofollow" class="btn btn-primary"  style="background: <?php echo $id['countdown_button_color'] ?>"><?php echo $id['countdown_button_text'] ?></a>
					<?php endif; ?>
				</div>
			</div>
			<?php if( $id['countdown_button_url'] ){?>
			<a href="<?php echo $id['countdown_button_url'] ?>" target="_blank" rel="nofollow" class="link-overlay"></a>
			<?php }?>
		</div>
	</div>
</div>
<?php }?>
<?php } else {?>
<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth mnmd-countdown-block"<?php if( xintheme('full_background_white') ){?> style="margin-bottom: 20px"<?php }?>>
	<div class="container">
		<div class="mnmd-block__inner inverse-text">
			<div class="background-img gradient-5" style=" background: <?php echo $id['countdown_color_1'] ?>; background: -webkit-linear-gradient(225deg, <?php echo $id['countdown_color_2'] ?> 0, <?php echo $id['countdown_color_1'] ?> 100%); background: linear-gradient(225deg, <?php echo $id['countdown_color_2'] ?> 0, <?php echo $id['countdown_color_1'] ?> 100%); ">
				<div class="background-svg-pattern">
				</div>
			</div>
			<div class="row row--space-between row--flex row--vertical-center">
				<div class="col-xs-12 col-md-6">
					<div class="mnmd-countdown">
						<div class="mnmd-countdown__inner meta-font js-countdown" data-countdown="<?php echo $id['countdown_time'] ?>">
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6 text-center">
					<h3 class="typescale-4"><a href="<?php echo $id['countdown_button_url'] ?>" target="_blank" rel="nofollow" class="link"><?php echo $id['modular_title_full'] ?></a></h3>
					<p class="text-secondary">
						<?php echo $id['countdown_describe'] ?>
					</p>
					<?php if( $id['countdown_button_text'] ) : ?>
					<a href="<?php echo $id['countdown_button_url'] ?>" target="_blank" rel="nofollow" class="btn btn-primary" style="background: <?php echo $id['countdown_button_color'] ?>"><?php echo $id['countdown_button_text'] ?></a>
					<?php endif; ?>
				</div>
			</div>
			<?php if( $id['countdown_button_url'] ){?>
			<a href="<?php echo $id['countdown_button_url'] ?>" target="_blank" rel="nofollow" class="link-overlay"></a>
			<?php }?>
		</div>
	</div>
</div>
<?php }?>