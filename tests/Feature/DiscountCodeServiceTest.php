<?php
use App\Repositories\DiscountCodeRepository;
use App\Services\DiscountCodeService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DiscountCodeServiceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_import_discount_codes()
    {
        $repository = new DiscountCodeRepository;
        $service = new DiscountCodeService($repository);

        $data = [
            'code' => 'TESTCODE',
            'campaign_id' => 1,
        ];

        $service->import($data);

        $this->assertDatabaseHas('discount_codes', $data);
    }
}
