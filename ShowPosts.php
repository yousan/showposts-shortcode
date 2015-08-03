<?php

/**
 * Created by IntelliJ IDEA.
 * User: yousan
 * Date: 8/3/15
 * Time: 1:52 PM
 */
class ShowPosts
{
    public function __construct(){
        $this->init();
    }

    private function init(){
        $this->registerShortcode();
    }

    private function registerShortcode() {
        add_shortcode('showposts', array($this, 'showposts'));
    }

    public function showposts($args) {
        $defaultArgs = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => '20',
        );
        extract(shortcode_atts($defaultArgs, $args));
        $args = compact(array_keys($defaultArgs));
        $posts = get_posts($args);
        foreach($posts as $post) {
            setup_postdata($post);
            the_excerpt();
        }
    }
}