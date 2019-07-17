<?php

namespace Ettemlevest\AdditionalDetails\Models;

use Illuminate\Database\Eloquent\Model;
use Ettemlevest\AdditionalDetails\Models\DetailDefinition;

class Detail extends Model
{
    protected $table = 'details';

    protected $fillable = [
        'definition_id', 'name', 'model_type', 'model_id', 'value',
    ];

    protected $with = [
        'definition'
    ];

    public function definition()
    {
        return $this->belongsTo(DetailDefinition::class);
    }

    public function model()
    {
        return $this->morphTo();
    }

    public function getTable()
    {
        return config('additional_details.table_names.detail', parent::getTable());
    }
}
