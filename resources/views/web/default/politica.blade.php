@extends("web.{$configuracoes->template}.master.master")

@section('content')

<div id="post-pages" class="container padding-bottom" style="padding: 50px 0 10px;">
    <section id="single-post" class="col-md-12">
        <h3 style="margin-top: 0px;"><span><b>Política de Privacidade</b></span></h3>
        <div class="post-boxes" style="margin-bottom: 10px;">
            <div class="post-short-desc">
                {!! $configuracoes->politicas_de_privacidade !!}
            </div>
        </div>        
    </section> 
</div>
@endsection