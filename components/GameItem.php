<?php namespace StDevs\Dom\Components;

use StDevs\Dom\Models\Game;
use Cms\Classes\ComponentBase;

/**
 * GameItem Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class GameItem extends ComponentBase
{
    public $gameItem;

    public function componentDetails()
    {
        return [
            'name' => 'Game Item Component',
            'description' => 'No description provided yet...'
        ];
    }

    /**
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties()
    {
        return [
            'gameSlug' => [
                'title'       => 'stdevs.dom::lang.components.album_item.properties.album_slug',
                'description' => 'stdevs.dom::lang.components.album_item.properties.album_slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string',
            ],
        ];
    }
   
   public function onRun()
    {
        $this->gameItem = $this->page['gameItem'] = Game::where('slug', $this->property('gameSlug'))->first();
    }
}
