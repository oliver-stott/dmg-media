=== Dmg Media ===

== Description ==

This plugin enables a read more search block, built in React Native Gutenberg blocks.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/dmg-media` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress

== Usage ==

1. The block can be found in the block editor under 'dmg: Read More'
2. WPCLI commands can be used to search for posts containing the read more block.

To search for posts run

```
wp dmg-read-more search
```

Search after or before a specific date

```
wp dmg-read-more search --date-after=yyyy-mm-dd
wp dmg-read-more search --date-before=yyyy-mm-dd
```

Search between a date range

```
wp dmg-read-more search --date-after=yyyy-mm-dd --date-before=yyyy-mm-dd
```
