<?php

namespace Ettemlevest\AdditionalDetails\Models;

use Illuminate\Database\Eloquent\Model;
use Ettemlevest\AdditionalDetails\Models\DetailDefinition;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Detail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'definition_id', 'name', 'model_type', 'model_id', 'value',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'definition'
    ];

    /**
     * A Detail belongs to a DetailDefinition.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo;
     */
    public function definition(): BelongsTo
    {
        return $this->belongsTo(DetailDefinition::class);
    }

    /**
     * Associated model for the resource
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable(): string
    {
        return config('additional_details.table_names.details', parent::getTable());
    }
}
