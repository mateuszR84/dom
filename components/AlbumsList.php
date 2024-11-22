<?php namespace StDevs\Dom\Components;

use StDevs\Dom\Models\Album;
use Cms\Classes\ComponentBase;

/**
 * AlbumsList Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class AlbumsList extends ComponentBase
{
    public $albums;

    public function componentDetails()
    {
        return [
            'name' => 'Albums List Component',
            'description' => 'No description provided yet...'
        ];
    }

    /**
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties()
    {
        return [
            'maxItems' => [
                'title' => 'Max items',
                'type' => 'string',
                'default' => 0
            ]
        ];
    }

    public function onRun()
    {
        $maxItems = $this->property('maxItems');

        if ($maxItems) {
            $this->albums = Album::orderByDesc('created_at')->limit($this->property('maxItems'))->get();
        } else {
            $this->albums = Album::orderByDesc('created_at')->get();
        }

    }
}
