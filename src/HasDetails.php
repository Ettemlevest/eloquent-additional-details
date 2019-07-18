<?php

namespace Ettemlevest\AdditionalDetails;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Ettemlevest\AdditionalDetails\Models\Detail;
use Ettemlevest\AdditionalDetails\Models\DetailDefinition;

trait HasDetails
{
    public function getDetailsAttribute()
    {
        return $this->additional_details->mapWithKeys(function ($item) {
            return [$item->definition->description => $item->value];
        });
    }

    public function additional_details()
    {
        return $this->morphMany(Detail::class, 'model');
    }

    public function setDetail($name, $value)
    {
        $detail = $this->additional_details()->get()->where('definition.slug', $name)->first();

        // validate model has the searched detail, throw exception
        if (! DetailDefinition::whereSlug($name)->count()) {
            throw new Exception('Detail definition does not exists: '. $name);
        }

        // remove detail when null
        if ($value === null) {
            return $this->additional_details()->whereHas('definition', function (Builder $query) use ($name) {
                $query->where('slug', $name);
            })->delete();
        }

        // create detail if not exists
        if (! $detail) {
            $detail = new Detail();
            $detail->definition()->associate(DetailDefinition::whereSlug($name)->first());
        }

        $detail->value = $value;

        return $this->additional_details()->save($detail);
    }
}
