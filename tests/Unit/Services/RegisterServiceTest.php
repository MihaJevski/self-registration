<?php

namespace Tests\Unit\Services;

use App\Services\RegisterService;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class RegisterServiceTest extends TestCase
{
    protected $registerService;

    public function setUp(): void
    {
        parent::setUp();
        $this->registerService = $this->app->make(RegisterService::class);
    }

    /** @test */
    public function it_generates_address_string_from_array()
    {
        $data = [
            "name" => "Direct Ad Network",
            "address1" => "Wildwood Rd",
            "address2" => "320",
            "city" => "Salem",
            "state" => "VA",
            "country" => "USA",
            "zipCode" => "24153",
            "phoneNo1" => "1-234-4346-45",
        ];

        $address = $this->registerService->generateFullAddress($data);

        $this->assertEquals('Wildwood Rd 320, Salem, VA 24153, USA', $address);
    }

    /** @test */
    public function it_generates_redis_kye_from_string()
    {
        $string = 'Wildwood Rd 320, Salem, VA 24153, USA';

        $address = $this->registerService->generateCacheKey($string);

        $this->assertEquals('wildwoodrd320salemva24153usa', $address);
    }

    /** @test */
    public function it_stores_test_values_in_cache()
    {
        Cache::shouldReceive('rememberForever')
            ->once()
            ->andReturn('value');

        $this->registerService->getCoordinates('test', 'test test');
    }
}
