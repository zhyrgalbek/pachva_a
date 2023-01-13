<!-- News -->
<div class="col-md-12 mt-5">
    <h3 class="section-title">{{__('News')}}</h3>
{{--    <ul class="nav nav-tabs news-tab" id="newsTab" role="tablist">--}}
{{--        @foreach(\App\Models\Article::getTypeOptions() as $typeKey => $typeLabel)--}}
{{--            <li class="nav-item" role="presentation">--}}
{{--                <a class="nav-link @if($typeKey==1) active @endif" id="tab{{$typeKey}}" data-toggle="tab" href="#content{{$typeKey}}" aria-controls="content{{$typeKey}}" @if($typeKey==1) aria-selected="true" @else aria-selected="false" @endif>{{$typeLabel}}</a>--}}
{{--            </li>--}}
{{--        @endforeach--}}
{{--    </ul>--}}
    <div class="tab-content news-tab-content" id="newsTabContent">
        @foreach(\App\Models\Article::getTypeOptions() as $typeKey => $typeLabel)
        <div class="tab-pane fade @if($typeKey==1) show active @endif" id="content{{$typeKey}}" role="tabpanel" aria-labelledby="tab{{$typeKey}}">
            <div class="row news">
            @php ($articles = \App\Models\Article::latest()->paginate(4))
            @foreach($articles as $article)
                <div class="col-md-3">
                    @include('layouts.article')
                </div>
            @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="col-md-12 mt-3">
    <a href="{{route('news.all')}}" class="btn btn-light service-all float-right">{{__('All news')}} <i class="far fa-newspaper"></i></a>
</div>
