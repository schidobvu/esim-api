<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Permission extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function creator():BelongsTo
    {
        return $this->belongsTo(PortalUser::class,'created_by');
    }
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, PermissionRole::class);
    }

    public static function add(string $code, string $endpoint, string $method, string $name, string $group = null): self
    {
        $type = explode('/', $endpoint)[0];
        return self::create(['code' => $code, 'endpoint' => $endpoint, 'method' => $method, 'name' => $name, 'group' => $group, 'type' => $type]);
    }

    public static function useFilter(): QueryBuilder
    {
        return QueryBuilder::for(PortalUser::class)
            ->allowedFilters([
                AllowedFilter::partial('name'),
                AllowedFilter::exact('username'),
                AllowedFilter::scope('blocked'),
            ])->defaultSort('name')
            ->allowedSorts('name', 'type', 'created_at')
            ->allowedIncludes(['creator', 'roles']);
    }

    public function loadRelations(): Permission
    {
        return $this->load('creator', 'roles');
    }
}
