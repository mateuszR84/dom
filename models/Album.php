<?php namespace StDevs\Dom\Models;

use Model;
use System\Models\File;

/**
 * Album Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Album extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'stdevs_dom_albums';

    /**
     * @var array rules for validation
     */
    public $rules = [];

    public $fillable = [
        'title',
        'artist',
        'barcode',
        'genres',
        'release_date',
        'description'
    ];

    public $jsonable = [
        'genres'
    ];

    public $attachOne = [
        'cover' => File::class,
    ];

    public function onSave(array $data = null)
    {
        $this->title = $data['title'];
        $this->artist = $data['artist'];
        $this->genres = $data['genres'];
        $this->rating = $data['rating'];  
        $this->barcode = $data['barcode'];  
        $this->release_date = $data['release_date'];  
        $this->description = $data['description'];  

        
        
        $this->save();
    }
}
