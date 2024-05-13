<?php

namespace App\Http\Filters;
use Illuminate\Database\Eloquent\Builder;

class ResultFilter extends AbstractFilter{
    public const SEARCHFORM = 'searchForm';
    public const SORTORDER = 'sortType';

    public function getCallbacks(): array{
        return [
            self::SEARCHFORM => [$this,'searchForm'],
            self::SORTORDER => [$this,'sortOrder']
        ];
    }

    public function searchForm(Builder $builder, $value){
        if($this->getQueryParam('searchType') == 'categories.name'){
            $builder->join('categories', 'results.category_id', '=', 'categories.id')
            ->where('categories.name', 'like', "%".$this->getQueryParam('searchForm')."%")
            ->select('results.*');
        }else{
            $builder->where($this->getQueryParam('searchType'), 'like', "%".$this->getQueryParam('searchForm')."%");
        }
    }

    public function sortOrder(Builder $builder, $value){
        if($this->getQueryParam('sortType') == 'category_id'){
            $builder->join('categories', 'results.category_id', '=', 'categories.id')
            ->orderBy('categories.name', $this->getQueryParam('sortOrder'))
            ->select('results.*');
        }else{
            $builder->orderBy($this->getQueryParam('sortType'), $this->getQueryParam('sortOrder'));
        }
    }
}