<?php

namespace StDevs\Dom\Components;

use StDevs\Dom\Models\Game;
use StDevs\Dom\Models\Album;
use Cms\Classes\ComponentBase;
use October\Rain\Support\Facades\Flash;
use Illuminate\Support\Facades\Redirect;

/**
 * CollectionItemCreate Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class CollectionItemCreate extends ComponentBase
{
    /**
     * Item type, ie. album, book ...
     *
     * @var string
     */
    public $type;

    public function componentDetails()
    {
        return [
            'name' => 'Collection Item Create Component',
            'description' => 'No description provided yet...'
        ];
    }

    /**
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties()
    {
        return [
            'type' => [
                'title' => 'Type',
                'description' => 'Select item type',
                'type' => 'string',
            ]
        ];
    }

    public function onRun()
    {
        $this->type = $this->property('type');
    }

    public function onSelectItemType()
    {
        $data = post();
        $type = $data['item_type'];

        return [
            '#item_form' => $this->renderPartial('@' . $type, [
                'type' => $data['item_type'],
            ])
        ];
    }
    
    public function onSave(array $data = null) 
    {
        $data = post();
        if (!$data) {
            return;
        }

        $itemType = $data['itemType'];

        if ($itemType === 'Game') {
            (new Game())->onCreateFromPost($data);
        } elseif ($itemType === 'Album') {
            (new Album())->onCreateFromPost($data);
        } elseif ($itemType === 'Book') {
            // (new Album())->onCreateFromPost($data);
        }


        Flash::success('Item successfully added');

        return Redirect::refresh();
    }
}
