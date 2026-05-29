<?php

namespace App\Models;


use App\Traits\HasBlocked;
use App\Traits\HasDateFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PortalUser extends Authenticatable
{
    use HasFactory, HasApiTokens, HasDateFilter, HasBlocked;

    protected $guarded = [];
    protected $appends = ['blocked'];

    protected $hidden = [
        'password'
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class)->with('permissions');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(PortalUser::class, 'created_by');
    }

    public function lineManager(): BelongsTo
    {
        return $this->belongsTo(PortalUser::class, 'line_manager_id');
    }

    public static function findByMsisdn(string $msisdn)
    {
        return static::where('msisdn', $msisdn)->first();
    }

    public function logout(): void
    {
        $this->tokens()->delete();
    }

    public static function useFilter(): QueryBuilder
    {
        return QueryBuilder::for(PortalUser::class)
            ->allowedFilters([
                AllowedFilter::partial('name'),
                AllowedFilter::exact('username'),
                AllowedFilter::scope('blocked'),
                ...static::getDateFilters()
            ])->defaultSort('name')
            ->allowedSorts('name', 'username', 'created_at')
            ->allowedIncludes(['creator', 'role.permissions']);
    }

    public function loadRelations(): self
    {
        return $this->load('creator', 'role.permissions');
    }
}
