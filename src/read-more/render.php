<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$title = $attributes['title'];
$description = $attributes['description'];
$searchInputText = $attributes['searchInput'];
$selectedPosts = isset($attributes['selectedPosts']) ? $attributes['selectedPosts'] : [];
?>

<section <?php echo get_block_wrapper_attributes(array('class' => 'search')); ?>>
	<h1 class="search__title"><?php echo $title; ?></h1>
	<p class="search__description"><?php echo $description; ?></p>

	<div class="search__posts">
		<?php if (!empty($selectedPosts)) : ?>
			<ul class="search__post-list">
				<?php foreach ($selectedPosts as $post) : ?>
					<li class="search__post-item">
						<a class="dmg-read-more" href="<?php echo esc_url($post['link']); ?>" target="_blank" rel="noopener noreferrer">
							Read More: <?php echo esc_html($post['title']); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<p><?php esc_html_e('No posts selected. Please search and select posts.', 'read-more'); ?></p>
		<?php endif; ?>
	</div>
</section>
