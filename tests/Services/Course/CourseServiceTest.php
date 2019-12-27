<?php


namespace Tests\Services\Course;


use App\Services\Course\Interfaces\CourseServiceInterface;
use App\Services\Course\Models\Course;
use App\Services\Course\Models\CourseChapter;
use App\Services\Course\Services\CourseService;
use Carbon\Carbon;
use Tests\TestCase;

class CourseServiceTest extends TestCase
{

    /**
     * @var CourseService
     */
    protected $courseService;

    public function setUp()
    {
        parent::setUp();
        $this->courseService = $this->app->make(CourseServiceInterface::class);
    }

    public function test_simplePage()
    {
        $pageSize = mt_rand(1, 10);
        $total = mt_rand(15, 20);
        factory(Course::class, $total)->create([
            'published_at' => Carbon::now()->subDays(1),
            'is_show' => Course::SHOW_YES,
        ]);
        $list = $this->courseService->simplePage(1, $pageSize);

        $this->assertEquals($pageSize, count($list['list']));
        $this->assertEquals($total, $list['total']);
    }

    public function test_find()
    {
        $course = factory(Course::class)->create([
            'is_show' => Course::SHOW_YES,
            'published_at' => Carbon::now()->subDays(1),
        ]);
        $c = $this->courseService->find($course->id);

        $this->assertNotEmpty($c);
        $this->assertEquals($course->title, $c['title']);
    }

    /**
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function test_find_with_no_published()
    {
        $course = factory(Course::class)->create([
            'is_show' => Course::SHOW_YES,
            'published_at' => Carbon::now()->addDays(1),
        ]);
        $c = $this->courseService->find($course->id);
    }

    /**
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function test_find_with_no_show()
    {
        $course = factory(Course::class)->create([
            'is_show' => Course::SHOW_NO,
            'published_at' => Carbon::now()->subDays(1),
        ]);
        $c = $this->courseService->find($course->id);
    }

    public function test_chapters()
    {
        $course = factory(Course::class)->create();
        factory(CourseChapter::class, 10)->create([
            'course_id' => $course->id,
        ]);

        $c = $this->courseService->chapters($course->id);
        $this->assertNotEmpty($c);
        $this->assertEquals(10, count($c));
    }

    public function test_getLatestCourses()
    {
        factory(Course::class, 5)->create([
            'is_show' => Course::SHOW_YES,
            'published_at' => Carbon::now()->subDays(1),
        ]);
        $latestCourses = $this->courseService->getLatestCourses(3);
        $this->assertNotEmpty($latestCourses);
        $this->assertEquals(3, count($latestCourses));
    }

    public function test_getList()
    {
        $courses = factory(Course::class, 5)->create([
            'is_show' => Course::SHOW_YES,
            'published_at' => Carbon::now()->subDays(1),
        ]);
        $course1 = $courses[0];
        $course2 = $courses[1];
        $latestCourses = $this->courseService->getList([$course1->id, $course2->id]);
        $latestCourses = array_column($latestCourses, null, 'id');
        $this->assertNotEmpty($latestCourses);
        $this->assertTrue(isset($latestCourses[$course1->id]));
        $this->assertTrue(isset($latestCourses[$course2->id]));
    }

}