<?php


namespace Tests\Services\Other;


use App\Services\Other\Models\Link;
use App\Services\Other\Services\LinkService;
use Tests\TestCase;

class LinkServiceTest extends TestCase
{

    public function test_link_all_with_cache()
    {
        config(['meedu.system.cache.status' => 1]);

        $link = factory(Link::class)->create([
            'sort' => 1,
        ]);

        /**
         * @var $linkService LinkService
         */
        $linkService = $this->app->make(LinkService::class);
        $links = $linkService->all();

        $this->assertEquals(1, count($links));
        $this->assertEquals($link->sort, $links[0]['sort']);
        $this->assertEquals($link->name, $links[0]['name']);
        $this->assertEquals($link->url, $links[0]['url']);

        $link1 = factory(Link::class)->create([
            'sort' => 2,
        ]);
        $links = $linkService->all();

        $this->assertEquals(1, count($links));
        $this->assertEquals($link->name, $links[0]['name']);
    }

    public function test_link_all_with_no_cache()
    {
        config(['meedu.system.cache.status' => 0]);

        $link = factory(Link::class)->create([
            'sort' => 1,
        ]);

        /**
         * @var $linkService LinkService
         */
        $linkService = $this->app->make(LinkService::class);
        $links = $linkService->all();

        $this->assertEquals(1, count($links));
        $this->assertEquals($link->sort, $links[0]['sort']);
        $this->assertEquals($link->name, $links[0]['name']);
        $this->assertEquals($link->url, $links[0]['url']);

        $link1 = factory(Link::class)->create([
            'sort' => 2,
        ]);
        $links = $linkService->all();

        $this->assertEquals(2, count($links));
        $this->assertEquals($link->name, $links[0]['name']);
        $this->assertEquals($link1->name, $links[1]['name']);
    }

}