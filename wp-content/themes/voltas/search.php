<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package voltas
 */

get_header();
?>
<div class="container">
<div id="searchResults">
	<?php if (have_posts()) : while (have_posts()) : the_post() ?>
			<div class="search">

				<div class="post">
					<div class="post-image">
						<a href="<?php echo the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail(); ?>
						</a>
					</div>
					<div class="post-info">
						<a href="<?php echo the_permalink(); ?>" title="<?php the_title(); ?>">
							<h3><?php the_title(); ?></h3>
						</a>
						<div class="location">Ngày đăng: <i><?php the_time('d/m/Y'); ?></i>, Update: <?php the_modified_time('d/m/Y'); ?> Vào lúc: <?php the_modified_time(); ?> </div>
						<p><?php the_excerpt(); ?> </p>
					</div>
				</div>


			</div>
		<?php endwhile;
	else : ?>
		<p>Từ khóa bạn tìm không thấy vui lòng thử lại.</p>
	<?php endif; ?>
</div>
</div>

<?php
get_footer();
