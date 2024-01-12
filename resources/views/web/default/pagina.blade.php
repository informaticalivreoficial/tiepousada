@extends("web.{$configuracoes->template}.master.master")

@section('content')

<div id="post-pages" class="container padding-bottom" style="padding: 50px 0 10px;">
    <section id="single-post" class="col-md-12">
        <h3 style="margin-top: 0px;"><span><b>{{$post->titulo}}</b></span></h3>
        <div class="post-boxes" style="margin-bottom: 10px;">
            <div class="post-short-desc">
                {!!$post->content!!}
            </div>
        </div>

        <div class="clearfix"></div>

        @if($post->images()->get()->count()) 
            <ul class="gallery-img-container clearfix" style="margin-top: 25px;margin-left: -7px;">
                @foreach($post->images()->get() as $key => $image)
                    <li class="col-xs-6 col-md-3 suite">
                        <a href="{{ $image->url_image }}" title="{{$post->titulo}}">
                            <img width="277" height="166" alt="{{$post->titulo}}" src="{{ $image->url_image }}"/>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </section> 
</div>

@endsection
