<!-- Banners -->
<div class="col-md-12 mt-2">
    @php($mainBanners = App\Models\Other::where(['type'=>2, 'published'=>1])->orderBy('id','ASC')->paginate(100))
    <div id="carouselMain" class="carousel slide carousel-light" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($mainBanners as $i => $banner)
                <li data-target="#carouselMain" data-slide-to="{{$i}}" @if ($i == 0) class="active" @endif></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach($mainBanners as $i => $banner)
                <div class="carousel-item p-3 @if ($i == 0) active @endif">
                    <a href="{{ $banner->link??'#' }}">
                        <img src="{{$banner->image}}" class="d-block w-100 shadow-custom rounded-3 bg-white"
                             alt="{{$banner->title}}">
                    </a>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselMain" role="button" data-slide="prev">
            <span class="fa fa-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">{{__('Previous')}}</span>
        </a>
        <a class="carousel-control-next" href="#carouselMain" role="button" data-slide="next">
            <span class="fa fa-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">{{__('Next')}}</span>
        </a>
    </div>
</div>
