<?php
namespace App\Scopes;


use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as BaseBuilder;
use Illuminate\Database\Eloquent\Model;

class DraftScope implements Scope {

    protected $extensions = ['onlyDrafts'];

    public function apply(Builder $builder, Model $model) {

        $column = $model->table.'.draft';
        $builder->whereNull($column);
        $this->addOnlyDrafts($builder);
    }


    protected function addOnlyDrafts(Builder $builder)
    {

        $builder->macro('onlyDrafts', function(Builder $builder)
        {

            $builder->withoutGlobalScope($this)->where('draft', '1');

            return $builder;
        });

        $builder->macro('All', function(Builder $builder)
        {

            $builder->withoutGlobalScope($this)->whereNull('draft');

            return $builder;
        });
    }
}
