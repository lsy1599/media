@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="course-menu-box">
                    <div class="menu-item {{!$scene ? 'active' : ''}}">
                        <a href="{{route('courses')}}?{{$queryParams(['scene' => ''])}}">所有课程</a>
                    </div>
                    <div class="menu-item {{$scene == 'recom' ? 'active' : ''}}">
                        <a href="{{route('courses')}}?{{$queryParams(['scene' => 'recom'])}}">推荐课程</a>
                    </div>
                    <div class="menu-item {{$scene == 'sub' ? 'active' : ''}}">
                        <a href="{{route('courses')}}?{{$queryParams(['scene' => 'sub'])}}">订阅最多</a>
                    </div>
                </div>

                <div class="category-box">
                    <a href="{{route('courses')}}?{{$queryParams(['category_id' => 0])}}"
                       class="category-box-item {{!$categoryId ? 'active' : ''}}">不限</a>
                    @foreach($courseCategories as $category)
                        <a href="{{route('courses')}}?{{$queryParams(['category_id' => $category['id']])}}"
                           class="category-box-item {{$categoryId == $category['id'] ? 'active' : ''}}">{{$category['name']}}</a>
                    @endforeach
                </div>
            </div>

            <div class="col-12">
                <div class="course-list-box">
                    @foreach($courses as $index => $course)
                        @include('frontend.components.course-item', ['course' => $course, 'class' => (($index + 1) % 4 == 0) ? 'last' : ''])
                    @endforeach
                </div>
            </div>

            <div class="col-12">
                {!! str_replace('pagination', 'pagination justify-content-center', $courses->render()) !!}
            </div>
        </div>
    </div>

    @include('frontend.components.recom_courses')

@endsection