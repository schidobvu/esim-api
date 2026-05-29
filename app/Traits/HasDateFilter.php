<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Spatie\QueryBuilder\AllowedFilter;

trait HasDateFilter
{
    public function scopeAfter(Builder $query, $data): Builder
    {
        $params = explode('[', str_replace(']','',$data));
        if (sizeof($params) < 2) return $query;
        return $query->where($params[0], '>', Carbon::parse($params[1]));
    }

    public function scopeBefore(Builder $query, $data): Builder
    {
        $params = explode('[', str_replace(']','',$data));
        if (sizeof($params) < 2) return $query;
        return $query->where($params[0], '<', Carbon::parse($params[1]));
    }

    public function scopeBetween(Builder $query, $data): Builder
    {
        $params = explode('[', str_replace(']','',$data));
        if (sizeof($params) < 3) return $query;
        return $query->where($params[0], '>=', Carbon::parse($params[1]))
            ->where($params[0], '<', Carbon::parse($params[2]));
    }

    public static function getDateFilters(): array
    {
        return [
            AllowedFilter::scope('after'),
            AllowedFilter::scope('before'),
            AllowedFilter::scope('between'),
        ];
    }
}
