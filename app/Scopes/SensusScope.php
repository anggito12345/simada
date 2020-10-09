<?php
namespace App\Scopes;


use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as BaseBuilder;
use Illuminate\Database\Eloquent\Model;

class SensusScope implements Scope {

    protected $extensions = ['OnlySensus'];

    public function apply(Builder $builder, Model $model) {

        $column = $model->table.'.is_sensus';
        $builder->whereNull($column);
        $this->addOnlyDrafts($builder);
    }


    protected function addOnlyDrafts(Builder $builder)
    {

        $builder->macro('OnlySensus', function(Builder $builder)
        {

            $builder->withoutGlobalScope($this)->where('is_sensus', '1');

            return $builder;
        });
    }
}
