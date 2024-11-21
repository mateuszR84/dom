<?php

namespace StDevs\Dom\Components;

use Cms\Classes\ComponentBase;

/**
 * CollectionList Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class CollectionList extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Collection List Component',
            'description' => 'Display collection items'
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
        $type = $this->property('type');
    }
}
