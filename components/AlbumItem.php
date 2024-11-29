<?php namespace StDevs\Dom\Components;

use StDevs\Dom\Models\Album;
use Cms\Classes\ComponentBase;

/**
 * AlbumItem Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class AlbumItem extends ComponentBase
{
    public $albumItem;

    public function componentDetails()
    {
        return [
            'name' => 'Album Item Component',
            'description' => 'No description provided yet...'
        ];
    }

    /**
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties()
    {
        return [
            'albumSlug' => [
                'title'       => 'stdevs.dom::lang.components.album_item.properties.album_slug',
                'description' => 'stdevs.dom::lang.components.album_item.properties.album_slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string',
            ],
        ];
    }

    public function onRun()
    {
        $this->albumItem = Album::where('slug', $this->property('albumSlug'))->first();
    }
}
