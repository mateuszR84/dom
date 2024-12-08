<?php namespace StDevs\Dom\Models;

use Model;
use System\Models\File;
use October\Rain\Support\Facades\Input;
use October\Rain\Database\Traits\Sluggable;

/**
 * Game Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Game extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use Sluggable;

    /**
     * @var string table name
     */
    public $table = 'stdevs_dom_games';

    /**
     * @var array rules for validation
     */
    public $rules = [
        'title' => 'required',
        'platform' => 'required|string',
        'type' => 'required|string'
    ];

    public $slugs = [
        'slug' => 'title'
    ];

    public $fillable = [
        'title', 
        'rating',
        'platform',
        'type',
        'series',
        'release_date',
        'notes'
    ];

    public $attachOne = [
        'cover' => File::class,
    ];
    
    public function onCreateFromPost(array $data = null)
    {
        $this->title = $data['title'];
        $this->genres = $data['genres'] ?? '';
        $this->rating = $data['rating'] ?? '';
        $this->platform = $data['platform'] ?? '';
        $this->type = $data['type'] ?? '';
        $this->series = $data['series'] ?? '';
        $this->release_date = $data['release_date'] ?? null;
        $this->notes = $data['notes'] ?? '';

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

    public function getGenresAttribute($value)
    {
        $genres = $value;
        if (str_contains($genres, ',')) {
            $genresArray = explode(',', $genres);
            return $genresArray;
        }    
        return [$genres];
    }
}
