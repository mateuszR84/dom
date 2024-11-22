<?php

namespace StDevs\Dom\Models;

use Model;
use October\Rain\Database\Traits\Sluggable;
use System\Models\File;
use October\Rain\Support\Facades\Input;

/**
 * Album Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Album extends Model
{
    use Sluggable;

    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'stdevs_dom_albums';

    /**
     * @var array rules for validation
     */
    public $rules = [];

    public $slugs = [
        'slug' => ['title', 'artist'],
    ];

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

    public function onCreateFromPost(array $data = null)
    {
        $this->title = $data['title'];
        $this->artist = $data['artist'];
        $this->genres = $data['genres'] ?? '';
        $this->rating = $data['rating'] ?? '';
        $this->barcode = $data['barcode'] ?? '';
        $this->release_date = $data['release_date'] ?? null;
        $this->description = $data['description'] ?? '';

        if ($avatar = Input::file('cover')) {
            $this->setCover($avatar);
        }

        $this->save();
    }

    public function setCover($cover)
    {
        $file = new File();
        $file->data = $cover;
        $file->is_public = false;
        $file->save();
        $this->cover()->add($file);
    }
}
