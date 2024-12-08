<?php namespace StDevs\Dom\Components;

use StDevs\Dom\Models\Game;
use Cms\Classes\ComponentBase;

/**
 * GamesList Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class GamesList extends ComponentBase
{
    public $games;
    public $series;
    public $genres;
    public $filters;
    public $mode;
    
    public function componentDetails()
    {
        return [
            'name' => 'Games List',
            'description' => 'Component for displaying games items'
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
            ],
            'enableFiltering' => [
                'title' => 'Enable filtering and sorting',
                'type' => 'checkbox',
                'default' => 0
            ],
            'mode' => [
                'title' => 'Mode',
                'type' => 'dropdown',
                'options' => [
                    'scroller' => 'Scroller',
                    'pagination' => 'Pagination',
                ],
                'default' => 'pagination'
            ],
        ];
    }
    
    public function onRun()
    {
        $maxItems = $this->property('maxItems');

        $this->filters = $this->property('enableFiltering');

        if ($maxItems) {
            $this->games = Game::orderByDesc('created_at')->paginate($maxItems);
        } else {
            $this->games = Game::orderByDesc('created_at')->get();
        }
        // $genres = Game::all('genres')->toArray();
        // $distinctGenres = [];
        // foreach ($genres as $genre) {
        //     $items = explode(',', $genre['genres']);
        //     foreach ($items as $item) {
        //         $distinctGenres[] = trim($item);
        //     }
        // }

        // $distinctGenres = array_unique($distinctGenres);
        // $this->genres = $distinctGenres;

        $this->series = Game::distinct()->pluck('series')->sort();
        $this->mode = $this->property('mode');
    }

    public function onAlpha()
    {
        return;    
    }
}
