<?php

namespace App\Models;

use App\Traits\HasBlocked;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Role extends Model
{
    use HasFactory, HasBlocked;

    protected $guarded = [];
    protected $appends = ['blocked'];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, PermissionRole::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'created_by');
    }

    public static function useFilter(): QueryBuilder
    {
        return QueryBuilder::for(Role::class)
            ->allowedFilters([
                AllowedFilter::partial('name'),
                AllowedFilter::scope('blocked'),
                AllowedFilter::exact('type')
            ])->defaultSort('name')
            ->allowedSorts('name', 'created_at', 'type')
            ->allowedIncludes(['creator']);
    }

    public function loadRelations(): Role
    {
        return $this->load('creator', 'permissions');
    }
}
