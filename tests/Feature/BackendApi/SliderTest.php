<?php


namespace Tests\Feature\BackendApi;

use App\Models\Administrator;
use App\Services\Other\Models\Slider;

class SliderTest extends Base
{

    public const MODEL = Slider::class;

    public const MODEL_NAME = 'slider';

    public const FILL_DATA = [
        'sort' => 1,
        'thumb' => 'thumb',
        'url' => 'http://meedu.vip',
    ];

    protected $admin;

    public function setUp()
    {
        parent::setUp();
        $this->admin = factory(Administrator::class)->create();
    }

    public function tearDown()
    {
        $this->admin->delete();
        parent::tearDown();
    }

    public function test_index()
    {
        $response = $this->user($this->admin)->get(self::API_V1_PREFIX . '/' . self::MODEL_NAME);
        $this->assertResponseSuccess($response);
    }

    public function test_create()
    {
        $response = $this->user($this->admin)->post(self::API_V1_PREFIX . '/' . self::MODEL_NAME, self::FILL_DATA);
        $this->assertResponseSuccess($response);
    }

    public function test_edit()
    {
        $item = factory(self::MODEL)->create();
        $response = $this->user($this->admin)->get(self::API_V1_PREFIX . '/' . self::MODEL_NAME . '/' . $item->id);
        $this->assertResponseSuccess($response);
    }

    public function test_update()
    {
        $item = factory(self::MODEL)->create();
        $response = $this->user($this->admin)->put(self::API_V1_PREFIX . '/' . self::MODEL_NAME . '/' . $item->id, self::FILL_DATA);
        $this->assertResponseSuccess($response);

        $item->refresh();
        foreach (self::FILL_DATA as $key => $val) {
            $this->assertEquals($val, $item->{$key});
        }
    }

    public function test_destroy()
    {
        $item = factory(self::MODEL)->create();
        $response = $this->user($this->admin)->delete(self::API_V1_PREFIX . '/' . self::MODEL_NAME . '/' . $item->id);
        $this->assertResponseSuccess($response);
        $model = self::MODEL;
        $this->assertEmpty($model::find($item->id));
    }

}