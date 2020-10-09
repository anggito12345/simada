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
        return $query->withoutGlobalScope(new SensusScope)->where($this->getTable().'.is_sensus', '')->orWhereNotNull($this->getTable().'.is_sensus');
    }

    public function scopeWithSensus(Builder $query)
    {
        return $query->withoutGlobalScope(new SensusScope   );
    }
}
