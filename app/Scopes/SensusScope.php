<?php
namespace App\Scopes;


use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as BaseBuilder;
use Illuminate\Database\Eloquent\Model;

class SensusScope implements Scope {

    protected $extensions = ['OnlySensus'];

    public function apply(Builder $builder, Model $model) {

        $column = $model->table.'.id_sensus';
        //$builder->whereNull($column);
        $this->addOnlySensus($builder);
    }


    protected function addOnlySensus(Builder $builder)
    {

        $builder->macro('OnlySensus', function(Builder $builder)
        {

            $builder->withoutGlobalScope($this)->whereRaw('id_sensus <= 0 ');

            return $builder;
        });

        $builder->macro('NotSensus', function(Builder $builder)
        {

            $builder->withoutGlobalScope($this)->whereRaw('id_sensus > 0 ');

            return $builder;
        });
    }
}
