<?php namespace StDevs\Dom\Models;

use Model;

/**
 * Artist Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Artist extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'stdevs_dom_artists';

    /**
     * @var array rules for validation
     */
    public $rules = [];
}
