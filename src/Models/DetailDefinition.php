<?php

namespace Ettemlevest\AdditionalDetails\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Collection;

class DetailDefinition extends Model
{
    use HasSlug;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detail_definitions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model_type', 'description',
    ];

    /**
     * Get the options for generating slugs.
     *
     * @return \Spatie\Sluggable\SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('description')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable(): string
    {
        return config('additional_details.table_names.detail_definitions', parent::getTable());
    }

    public static function forModel(string $class): Collection
    {
        return DetailDefinition::where('model_type', $class)->get();
    }
}
