<?php
namespace App\Traits;

use App\Scopes\DraftScope;
use App\Scopes\SensusScope;
use Illuminate\Database\Eloquent\Builder;

trait SensusTrait {
    public static function bootSensusTrait() {
        static::addGlobalScope(new SensusScope);
    }


    public function scopeOnlySensus(Builder $query)
    {
        return $query->withoutGlobalScope(new SensusScope)->whereNull($this->getTable().'.is_sensus IS NOT NULL');
    }

    public function scopeNotSensus(Builder $query)
    {
        return $query->withoutGlobalScope(new SensusScope)->whereRaw($this->getTable().'.is_sensus IS NULL');
    }

    public function scopeWithSensus(Builder $query)
    {
        return $query->withoutGlobalScope(new SensusScope   );
    }
}
