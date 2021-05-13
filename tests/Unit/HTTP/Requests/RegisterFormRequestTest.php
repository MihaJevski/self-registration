<?php

namespace Tests\Unit\HTTP\Requests;

use App\Http\Requests\RegisterFormRequest;
use App\Models\Client;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterFormRequestTest extends TestCase
{
    use WithFaker;

    /**
     * @var mixed
     */
    private $validator;

    /**
     * @var array
     */
    private $rules;

    /**
     * @var array
     */
    private $mockedRequestData;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = app()->get('validator');
        $this->rules = (new RegisterFormRequest())->rules();
        $this->mockedRequestData = $this->prepareRequestData();
    }

    public function tearDown(): void
    {
        parent::tearDown();

        $this->mockedRequestData = null;
    }

    /** @test */
    public function it_should_pass_when_all_data_is_provided()
    {
        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(true, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_no_name_is_provided()
    {
        $this->mockedRequestData['name'] = '';

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_name_has_more_than_100_characters()
    {
        $this->mockedRequestData['name'] = $this->faker->realTextBetween(101);

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_no_address1_is_provided()
    {
        $this->mockedRequestData['address1'] = '';

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_no_address2_is_provided()
    {
        $this->mockedRequestData['address2'] = '';

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_no_city_is_provided()
    {
        $this->mockedRequestData['city'] = '';

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_city_has_more_than_100_characters()
    {
        $this->mockedRequestData['city'] = $this->faker->realTextBetween(101);

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_no_state_is_provided()
    {
        $this->mockedRequestData['state'] = '';

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_state_has_more_than_100_characters()
    {
        $this->mockedRequestData['state'] = $this->faker->realTextBetween(101);

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_no_country_is_provided()
    {
        $this->mockedRequestData['country'] = '';

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_country_has_more_than_100_characters()
    {
        $this->mockedRequestData['country'] = $this->faker->realTextBetween(101);

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_no_zip_code_is_provided()
    {
        $this->mockedRequestData['zipCode'] = '';

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_zip_code_has_more_than_20_characters()
    {
        $this->mockedRequestData['zipCode'] = $this->faker->realTextBetween(21);

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_no_phone_no1_is_provided()
    {
        $this->mockedRequestData['phoneNo1'] = '';

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_phone_no1_has_more_than_20_characters()
    {
        $this->mockedRequestData['phoneNo1'] = $this->faker->realTextBetween(21);

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_phone_no2_has_more_than_20_characters()
    {
        $this->mockedRequestData['phoneNo2'] = $this->faker->realTextBetween(21);

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_no_user_first_name_is_provided()
    {
        $this->mockedRequestData['user']['firstName'] = '';

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_user_first_name_has_more_than_50_characters()
    {
        $this->mockedRequestData['user']['firstName'] = $this->faker->realTextBetween(51);

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_no_user_last_name_is_provided()
    {
        $this->mockedRequestData['user']['lastName'] = '';

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_user_last_name_has_more_than_50_characters()
    {
        $this->mockedRequestData['user']['lastName'] = $this->faker->realTextBetween(51);

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_no_user_email_is_provided()
    {
        $this->mockedRequestData['user']['email'] = '';

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_wrong_user_email_is_provided()
    {
        $this->mockedRequestData['user']['email'] = $this->faker->word;

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_user_email_has_more_than_150_characters()
    {
        $this->mockedRequestData['user']['email'] = $this->faker->realTextBetween(151);

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_no_user_password_is_provided()
    {
        $this->mockedRequestData['user']['password'] = '';

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_user_password_has_more_than_20_characters()
    {
        $fakePassword = $this->faker->password(21, 30);

        $this->mockedRequestData['user']['password'] = $fakePassword;
        $this->mockedRequestData['user']['passwordConfirmation'] = $fakePassword;

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_user_password_has_less_than_8_characters()
    {
        $fakePassword = $this->faker->password(4, 7);

        $this->mockedRequestData['user']['password'] = $fakePassword;
        $this->mockedRequestData['user']['passwordConfirmation'] = $fakePassword;

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_user_password_confirmation_does_not_match_password()
    {
        $this->mockedRequestData['user']['password'] = 'password';
        $this->mockedRequestData['user']['passwordConfirmation'] = 'password2';

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_no_phone_name_is_provided()
    {
        $this->mockedRequestData['user']['phone'] = '';

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /** @test */
    public function it_should_fail_when_phone_name_has_more_than_20_characters()
    {
        $this->mockedRequestData['user']['phone'] = $this->faker->realTextBetween(21);

        $validatedData = $this->validate($this->mockedRequestData);

        $this->assertEquals(false, $validatedData);
    }

    /**
     * Prepare request data
     *
     * @return array
     */
    protected function prepareRequestData(): array
    {
        $data = Client::factory()->make([
            'name' => $this->faker->company,
            'zipCode' => $this->faker->postcode,
            'phoneNo1' => $this->faker->phoneNumber,
            'phoneNo2' => '',
        ])->toArray();

        $data['user'] = User::factory()->make([
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'password' => 'password',
            'passwordConfirmation' => 'password',
        ])->makeVisible('password')->toArray();

        return $data;
    }

    /**
     * Validate request data
     *
     * @param $mockedRequestData
     * @return mixed
     */
    protected function validate($mockedRequestData)
    {
        return $this->validator
            ->make($mockedRequestData, $this->rules)
            ->passes();
    }
}
