@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('posts.page', $post) }}

        <div class="bg-white p-3 rounded shadow post-show">
        {!! html_entity_decode( $post->description ) !!}

        </div>

<!--     --><?php
//      $data = json_decode(file_get_contents('http://sklad.102.kg/api.php?action=select_stores'));
//        ?>
{{--        <div class="row store-blocks">--}}
{{--            @foreach($data as $key => $item)--}}
{{--                <div class="col-md-6 store-block">--}}
{{--                    <a href="http://127.0.0.1:8000/post/store">Данные по складам</a>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 store-block">--}}
{{--                    <a href="http://127.0.0.1:8000/post/store">Данные по свидетельствам</a>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}

    </div>
@endsection
