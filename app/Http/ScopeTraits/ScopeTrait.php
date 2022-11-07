<?php
namespace App\Http\ScopeTraits;
use Carbon\Carbon;

trait ScopeTrait
{
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', now()->today());
    }

    public function scopeYesterday($query)
    {
        return $query->whereDate('created_at', now()->yesterday());
    }

    public function scopeCreatedBetweenDates($query,  array $dates)
    {
        $start_date= ($dates[0] instanceof Carbon) ? $dates[0] : Carbon::parse($dates[0])->startOfDay()->toDateTimeString();
        $end_date= ($dates[1] instanceof Carbon) ? $dates[1] : Carbon::parse($dates[1])->endOfDay()->toDateTimeString();
         return $query->whereBetween('created_at', [
            $start_date,
            $end_date
        ]);
    }
}
