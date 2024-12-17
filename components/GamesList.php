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
    public $sortBy = 'created_at';
    
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
            'sortBy' => [
                'title' => 'Sort by',
                'type' => 'dropdown',
                'default' => 'created_at'
            ],
        ];
    }

    public function getSortByOptions(): array 
    {
        return [
            'a-z' => 'Alphabetically',
            'rating' => 'Rating',
            'release_at' => 'Released at',
            'created_at' => 'Created at'
        ]; 
    }
    
    public function onRun()
    {
        $query = Game::with('cover');
        $maxItems = $this->property('maxItems');

        $sortBy = $this->sortBy;
        $sortProperty = $this->property('sortBy');

        if ($sortProperty === 'created_at') {
            $query = $query->orderBy('created_at', 'desc');
        } elseif ($sortProperty = 'rating') {
            $query = $query->orderBy('personal_rating', 'desc');
        } elseif ($sortProperty = 'released_at') {
            $query = $query->orderBy('release_date', 'desc');
        } else {
            $query = $query->orderBy('title', 'desc');
        }
        
        $this->games = $query->paginate($maxItems);
        // $distinctGenres = [];
        // foreach ($genres as $genre) {
        //     $items = explode(',', $genre['genres']);
        //     foreach ($items as $item) {
        //         $distinctGenres[] = trim($item);
        //     }
        // }

        // $distinctGenres = array_unique($distinctGenres);
        // $this->genres = $distinctGenres;

        $this->filters = $this->property('enableFiltering');
        $this->series = Game::distinct()->pluck('series')->sort();
        $this->mode = $this->property('mode');
    }

    public function onSortAlphabetically()
    {
        $data = post();

        $maxItems = $this->property('maxItems');
        $this->games = Game::with('cover')->orderBy('title', $data['dir'])->paginate($maxItems);

        return [
            '#games-collection' => $this->renderPartial('@gamescollection', [
                'games' => $this->games
            ])
        ];
    }
    
    public function onSortByRelease()
    {
        $data = post();

        $maxItems = $this->property('maxItems');
        $query = Game::with('cover')->orderBy('release_date', $data['dir']); 
        $this->games = $query->paginate($maxItems);

        return [
            '#games-collection' => $this->renderPartial('@gamescollection', [
                'games' => $this->games
            ])
        ];
    }

    public function onResetSorting()
    {
        $maxItems = $this->property('maxItems');
        $this->games = Game::with('cover')->orderBy($this->property('sortBy'), 'desc')->paginate($maxItems);

        return [
            '#games-collection' => $this->renderPartial('@gamescollection', [
                'games' => $this->games
            ])
        ];
    }
}
