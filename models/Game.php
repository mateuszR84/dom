<?php namespace StDevs\Dom\Models;

use Model;

/**
 * Game Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Game extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'stdevs_dom_games';

    /**
     * @var array rules for validation
     */
    public $rules = [];
}
