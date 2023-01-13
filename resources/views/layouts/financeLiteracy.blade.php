{{--<!-- News -->--}}
{{--<div class="col-md-12 mt-3">--}}
{{--    <h3 class="section-title">{{__('Financial literacy')}}</h3>--}}
{{--    @php($finSabats = App\Models\Other::where(['type'=>4, 'published'=>1])->orderBy('id','ASC')->paginate(8))--}}
{{--    <div class="row literacy">--}}
{{--        @foreach($finSabats as $finSabat)--}}
{{--        <div class="col-md-3">--}}
{{--            <div class="card pt-4 text-center">--}}
{{--                <a class="card-link" href="{{$finSabat->link}}"></a>--}}
{{--                <div class="p-3">--}}
{{--                    <img class="card-img-top" src="{{$finSabat->image}}">--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <h4 class="card-title">{{Lang::has('other.title-'.$finSabat->id) ? trans('other.title-'.$finSabat->id) : $finSabat->title}}</h4>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--</div>--}}
