<?php

// Check if WPCLI exists
if (defined('WP_CLI') && WP_CLI) {
    WP_CLI::add_command('dmg-read-more search', 'Dmg_Read_More_Search_Command');
}

class Dmg_Read_More_Search_Command
{
    private $default_date_range;

    public function __construct()
    {
        // Define the date subcommand arguments
        $this->default_date_range = [
            'date-after'  => date('Y-m-d', strtotime('-30 days')),
            'date-before' => date('Y-m-d'),
        ];
    }

    public function __invoke($args, $assoc_args)
    {
        $date_range = array_merge($this->default_date_range, $assoc_args);

        $query_args = [
            'post_type'      => 'post',
            'posts_per_page' => -1,
            'date_query'     => [
                'after'     => $date_range['date-after'],
                'before'    => $date_range['date-before'],
                'inclusive' => true,
            ],
            's'              => 'dmg-media/read-more', // Search for the block in post content
            'fields'         => 'ids', // We only want the id's for performance
            'no_found_rows'  => true,
        ];

        $query = new WP_Query($query_args);

        if ($query->have_posts()) {
            foreach ($query->posts as $post_id) {
                WP_CLI::line("Found post ID: $post_id");
            }
        } else {
            WP_CLI::warning('No posts found.');
        }
    }
}
