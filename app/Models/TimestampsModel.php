<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimestampsModel extends Model
{
    /**
     * Scope a query to order by given column (DESC) and paginate the results.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $oderColumn
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function scopeOrderedPagination($query, $orderColumn, $perPage)
    {
        return $query->orderBy($orderColumn, 'desc')
                    ->paginate($perPage, ['*'], __('pagination.page'));
    }

}
