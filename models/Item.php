<?php namespace StDevs\Dom\Models;

use Model;

/**
 * Item Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Item extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'stdevs_dom_items';

    /**
     * @var array rules for validation
     */
    public $rules = [];
}
