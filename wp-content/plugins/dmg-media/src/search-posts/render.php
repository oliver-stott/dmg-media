<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$title = $attributes['title'];
$description = $attributes['description'];
$searchInputText = $attributes['searchInput'];


?>
<section <?php echo get_block_wrapper_attributes(); ?>>
	<div class="search__controls">
		<h1 class="search__title"><?php echo $title; ?></h1>
		<p class="search__description"><?php echo $description; ?></p>
		<label for="search-input">Please enter a search term...</label>
		<input id="search-input" class="search__input" type="text" value="<?php echo $searchInputText; ?>">
	</div>
	<div class="search__posts">

	</div>
</section>
