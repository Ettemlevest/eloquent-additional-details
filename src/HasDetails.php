<?php

namespace Ettemlevest\AdditionalDetails;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Ettemlevest\AdditionalDetails\Models\Detail;
use Ettemlevest\AdditionalDetails\Models\DetailDefinition;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasDetails
{
    /**
     * Get a compact collection with the details associated the the model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDetailsAttribute(): Collection
    {
        return $this->additional_details->mapWithKeys(function (Detail $item) {
            return [$item->definition->description => $item->value];
        });
    }

    /**
     * Detail resources associated with the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function additional_details(): MorphMany
    {
        return $this->morphMany(Detail::class, 'model');
    }

    /**
     * Set a detail's value for the model.
     *
     * Creates it if not already exists. Will delete detail when called
     * with $value = null.
     *
     * @param string $name
     * @param mixed $value
     * @throws Exception
     * @return boolean|\Ettemlevest\AdditionalDetails\Models\Detail
     */
    public function setDetail(string $name, $value)
    {
        $detail = $this
            ->additional_details()
            ->get()
            ->where('definition.slug', $name)
            ->first();

        // validate model has the searched detail, throw exception
        if (! DetailDefinition::whereSlug($name)->count()) {
            throw new Exception('Detail definition does not exists: '. $name);
        }

        // remove detail when null
        if ($value === null) {
            return $this->additional_details()->whereHas('definition', function (Builder $query) use ($name) {
                $query->where('slug', $name);
            })->delete() === 1;
        }

        // create detail if not exists
        if (! $detail) {
            $detail = new Detail();
            $detail->definition()->associate(
                DetailDefinition::whereSlug($name)->first()
            );
        }

        $detail->value = $value;

        return $this->additional_details()->save($detail);
    }
}
