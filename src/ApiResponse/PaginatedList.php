<?php
namespace App\ApiResponse;

class PaginatedList {

    public function get($page, $perPage, $totalCount, $items)
    {
        return [ 
            'data' => [
                'page' => $page,
                'per_page' => $perPage,
                'total_count' => $totalCount,
                'items' => $items    
            ]        
        ];
    }
}