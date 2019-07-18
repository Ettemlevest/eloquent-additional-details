<?php

namespace Ettemlevest\AdditionalDetails\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class DetailDefinition extends Model
{
    use HasSlug;

    protected $table = 'detail_definitions';

    protected $fillable = [
        'model_type', 'description',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('description')
            ->saveSlugsTo('slug');
    }

    public function getTable()
    {
        return config('additional_details.table_names.detail_definitions', parent::getTable());
    }
}
