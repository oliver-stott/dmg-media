<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$title = $attributes['title'];
$description = $attributes['description'];
$searchInputText = $attributes['searchInput'];
$selectedPosts = isset($attributes['selectedPosts']) ? $attributes['selectedPosts'] : [];
var_dump($selectedPosts);
?>

<section <?php echo get_block_wrapper_attributes(); ?>>
	<div class="search__controls">
		<h1 class="search__title"><?php echo $title; ?></h1>
		<p class="search__description"><?php echo $description; ?></p>
		<label for="search-input">Please enter a search term...</label>
		<input id="search-input" class="search__input" type="text" value="<?php echo $searchInputText; ?>">
	</div>

	<div class="search__posts">
		<?php if (!empty($selectedPosts)) : ?>
			<ul class="search__post-list">
				<?php foreach ($selectedPosts as $post) : ?>
					<li class="search__post-item">
						<a href="<?php echo esc_url($post['link']); ?>" target="_blank" rel="noopener noreferrer">
							<?php echo esc_html($post['title']); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<p><?php esc_html_e('No posts selected. Please search and select posts.', 'search-posts'); ?></p>
		<?php endif; ?>
	</div>
</section>
