<?php
namespace App\Tests\ApiResponse;

use App\ApiResponse\PaginatedList;
use PHPUnit\Framework\TestCase;

class PaginatedListTest extends TestCase
{
    public function testReturnedArray()
    {
        $pl = new PaginatedList;
        $result = $pl->get(5, 13, 50, [ [ 'id'=>12, 'name'=>'Product name', 'description'=>'Lorem ipsum' ] ]);

        $expected = [ 'data' => [
            'page' => 5,
            'per_page' => 13,
            'total_count' => 50,
            'items' => [
                [
                    'id' => 12,
                    'name' => 'Product name',
                    'description' => 'Lorem ipsum',
                ],
            ],
        ]];
        
        $this->assertEquals($expected, $result);
    }
}