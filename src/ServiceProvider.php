<?php

namespace Popcorna;

use Polyether\Support\Providers\ModuleServiceProvider;
use Post;
use Taxonomy;

/**
 * BackendServiceProvider
 *
 * @author Mohammed Anwar <m.anwar@pure-sol.com>
 */
class ServiceProvider extends ModuleServiceProvider
{
    protected $publishViews = false;
    protected $publishConfig = false;

    public function register()
    {
        parent::register();
    }

    public function boot()
    {
        parent::boot();
        $this->registerTaxonomies();
        $this->registerPostTypes();
    }

    private function registerTaxonomies()
    {

        //Register custom taxonomies
        Taxonomy::registerTaxonomy('movie_category', ['movie', 'series'], [
            'labels'       => [
                'name'     => 'Categories',
                'singular' => 'Category',
            ],
            'hierarchical' => true,
            'show_ui'      => true,
        ]);

        Taxonomy::registerTaxonomy('movie_tag', ['movie', 'series'], [
            'labels'       => [
                'name'     => 'Tags',
                'singular' => 'Tag',
            ],
            'hierarchical' => false,
            'show_ui'      => true,
        ]);
    }

    private function registerPostTypes()
    {
        //Register custom post types
        Post::registerPostType('movie', [
            'labels'        => ['name' => 'Movies', 'singular' => 'Movie',],
            'description'   => '',
            'show_ui'       => true,
            'icon'          => 'fa fa-video-camera',
            'hierarchical'  => false,
            'taxonomies'    => ['movie_category'],
            'menu_position' => 1,
        ]);
        Post::registerPostType('series', [
            'labels'        => ['name' => 'Series', 'singular' => 'Series',],
            'description'   => '',
            'show_ui'       => true,
            'icon'          => 'fa fa-youtube-play',
            'hierarchical'  => false,
            'taxonomies'    => ['movie_category'],
            'menu_position' => 2,
        ]);
        Post::registerPostType('episode', [
            'labels'        => ['name' => 'Episodes', 'singular' => 'Episode',],
            'description'   => '',
            'show_ui'       => true,
            'icon'          => 'fa fa-file-video-o',
            'hierarchical'  => false,
            'menu_position' => 3,
        ]);
    }

    protected function InitVars()
    {
        $this->namespace = __NAMESPACE__;
        $this->packagePath = __DIR__ . DIRECTORY_SEPARATOR;
        $this->packageName = 'popcorna';
    }

}
