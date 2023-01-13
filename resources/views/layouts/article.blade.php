<div class="card card-news {{$article->published ? 'published' : 'not-published'}}">
    <img src="{{explode(',',$article->photo)[0]}}" class="card-img-top" alt="...">
    <div class="card-body">
        @if ($article->published)
            <div class="text-muted">{{date('d.m.Y', strtotime($article->published_at))}}</div>
        @else
            <div class="text-muted">{{date('d.m.Y', strtotime($article->created_at))}}</div>
        @endif
        <h5 class="card-title">{{Lang::has('news.title-'.$article->id) ? trans('news.title-'.$article->id) : $article->title}}</h5>
        <p class="card-text">{!! Lang::has('news.summary-'.$article->id) ? trans('news.summary-'.$article->id) : $article->summary !!}</p>
        @auth
            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                @if ($article->published)
                    <span class="text-sm text-success font-weight-bold">{{__('Published')}}</span>
                @else
                    <span class="text-sm text-danger font-weight-bold">{{__('Not published')}}</span>
                @endif
                <div class="btn-group btn-group-sm" role="group" aria-label="{{__('Action')}}">
                    <a href="{{route('news.show', $article->id)}}" class="btn btn-success" data-tooltip="tooltip" title="{{__('Show')}}"><i class="fas fa-search-plus"></i></a>
                    @can('news-edit')
                        <a href="{{route('news.edit', $article->id)}}" class="btn btn-primary" data-tooltip="tooltip" title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                    @endcan
                    @can('news-delete')
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['class' => 'btn btn-dark', 'data-toggle'=> 'modal', 'data-target'=>'#confirmModal', 'data-confirm-text'=>__('Are you sure want to delete this?'), 'data-confirm'=>"$('#article-delete-".$article->id."').submit()", 'data-tooltip'=>'tooltip', 'title'=>__('Delete')]) !!}
                    @endcan
                </div>
            </div>
            @can('news-delete')
            {!! Form::open(['method' => 'DELETE','route' => ['news.destroy', $article->id], 'class'=>'d-none', 'id'=>'article-delete-'.$article->id]) !!}
            {!! Form::close() !!}
            @endcan
        @else
            <a href="{{route('news.detail', $article->id)}}" class="card-link">{{__('read completely')}}</a>
        @endauth
    </div>
</div>
