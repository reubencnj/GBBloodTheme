<?php
/**
 * Author:          Reuben Jackson
 * Created on:      03/028/2022
 *
 * 
 */


get_header();
global $post;

$opening_times_mon = get_post_meta( $post->ID, 'clinic_opening_times_box_mon', true);
$opening_times_tue = get_post_meta( $post->ID, 'clinic_opening_times_box_tue', true);
$opening_times_wed = get_post_meta( $post->ID, 'clinic_opening_times_box_wed', true);
$opening_times_thu = get_post_meta( $post->ID, 'clinic_opening_times_box_thu', true);
$opening_times_fri = get_post_meta( $post->ID, 'clinic_opening_times_box_fri', true);
$opening_times_sat = get_post_meta( $post->ID, 'clinic_opening_times_box_sat', true);
$opening_times_sun = get_post_meta( $post->ID, 'clinic_opening_times_box_sun', true);


if(empty($opening_times_mon)){
	$opening_times_mon='Closed';
}
if(empty($opening_times_tue)){
	$opening_times_tue='Closed';
}
if(empty($opening_times_wed)){
	$opening_times_wed='Closed';
}
if(empty($opening_times_thu)){
	$opening_times_thu='Closed';
}
if(empty($opening_times_fri)){
	$opening_times_fri='Closed';
}
if(empty($opening_times_sat)){
	$opening_times_sat='Closed';
}
if(empty($opening_times_sun)){
	$opening_times_sun='Closed';
}



?>
	<div class="<?php echo esc_attr( $container_class ); ?> single-post-container">
		<h1><?=get_the_title();?></h1>
		<p><?=get_the_content();?></p>
		<div class="container">
			<div class="row">
				<div id="clinic_address_box" class="col">
					<?=get_post_meta( $post->ID, 'clinic_address_box', true );?>
					<?php the_post_thumbnail('full'); ?>

				</div>
				<div id="clinic_opening_times_box" class="col">
					<table>
						<tr>
							<td>Mon</td>
							<td><?=$opening_times_mon;?></td>
						</td>
						<tr>
							<td>Tue</td>
							<td><?=$opening_times_tue;?></td>
						</tr>
						<tr>
							<td>Wed</td>
							<td><?=$opening_times_wed;?></td>
						</tr>
						<tr>
							<td>Thu</td>
							<td><?=$opening_times_thu;?></td>
						</tr>
						<tr>
							<td>Fri</td>
							<td><?=$opening_times_fri;?></td>
						</tr>
						<tr>
							<td>Sat</td>
							<td><?=$opening_times_sat;?></td>
						</tr>
						<tr>
							<td>Sun</td>
							<td><?=$opening_times_sun;?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php
get_footer();
