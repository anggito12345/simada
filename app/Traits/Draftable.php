<?php
namespace App\Traits;

use App\Scopes\DraftScope;
use Illuminate\Database\Eloquent\Builder;

trait Draftable {
    public static function bootDraftable() {
        static::addGlobalScope(new DraftScope);
    }


    public function scopeOnlyDrafts(Builder $query)
    {
        return $query->withoutGlobalScope(new DraftScope)->where($this->getTable().'.draft', '')->orWhereNotNull($this->getTable().'.draft');
    }

    public function scopeNotDrafts(Builder $query)
    {
        return $query->withoutGlobalScope(new DraftScope)->whereRaw($this->getTable().'.draft IS NULL');
    }

    public function scopeWithDrafts(Builder $query)
    {
        return $query->withoutGlobalScope(new DraftScope);
    }
}
