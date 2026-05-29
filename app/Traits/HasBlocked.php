<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasBlocked
{
    public function block()
    {
        $this->update(['blocked_at' => now()]);
    }

    public function unblock()
    {
        $this->update(['blocked_at' => null]);
    }

    public function scopeBlocked(Builder $query, $data): Builder
    {
        return $data == 1 ? $query->whereNotNull('blocked_at') : $query->whereNull('blocked_at');
    }

    public function getBlockedAttribute(): bool
    {
        return !is_null($this->{'blocked_at'});
    }
}
