<?php

namespace StDevs\Dom\Components;

use Cms\Classes\ComponentBase;

/**
 * CollectionItemCreate Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class CollectionItemCreate extends ComponentBase
{
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
        return [];
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
}
