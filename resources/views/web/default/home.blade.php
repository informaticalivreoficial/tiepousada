@extends("web.{$configuracoes->template}.master.master")

@section('content')

    {{--SLIDER--}}
    <section id="slider">
        <ul class="bxslider">
            @if (!empty($slides) && $slides->count() > 0)
                @foreach ($slides as $key => $slide)  
                <li>                     
                    <a href="{{($slide->link ? $slide->link : '#')}}" {{($slide->target == 1 ? 'target="_blank"' : '')}}>
                        <div class="items">
                            <img src="{{$slide->getimagem()}}" alt="{{$slide->titulo}}" />  
                            @if ($slide->content)
                                <div class="caption-box"><h4>{!!$slide->content!!}</h4>
                            @endif
                        </div>
                    </a> 
                </li>
                @endforeach             
            @endif            
        </ul>
    </section>

    <section id="main-booking-form"> 
        <div id="main-booking-form-container">        
            <div class="search-row"> 
                <form class="search-form horizontal container" action="{{route('web.reservar')}}" method="post">
                @csrf
                <div class="search-fields col-xs-6 col-md-3"> 
                    <input name="checkini" id="j_data" autocomplete="off" placeholder="Check-in" class="datepicker-fields check-in" type="text" value=""/>                   
                    <i class="fa fa-calendar"></i>
                </div>
                
                <div class="search-fields col-xs-6 col-md-3"> 
                    <input name="checkouti" autocomplete="off" id="j_data1" placeholder="Check-Out" class="datepicker-fields check-out" type="text" value=""/> <i class="fa fa-calendar"></i> 
                </div>
                
                <div class="search-fields col-xs-6 col-md-3">
                    <select id="search-field2" name="adultos"> 
                        <option value="1">Adultos</option>
                        <option value="1">1</option> 
                        <option value="2">2</option> 
                        <option value="3">3</option> 
                        <option value="4">4</option> 
                        <option value="5">5</option>
                        <option value="6">6</option> 
                        <option value="6">+6</option> 
                    </select> 
                </div> 
                
                <div class="search-fields col-xs-6 col-md-3"> 
                    <select id="search-field3" name="cri_0_5"> 
                        <option value="0">Crianças</option> 
                        <option value="0">0</option> 
                        <option value="1">1</option> 
                        <option value="2">2</option> 
                        <option value="3">3</option> 
                        <option value="4">4</option> 
                        <option value="5">5</option>
                        <option value="6">6</option> 
                        <option value="+6">+6</option> 
                    </select> 
                </div>
                
                <div class="search-button-container"> 
                    <input value="Reservar" type="submit"/> 
                </div> 

                </form> 
            </div> 
        </div> 
    </section>

    <section id="welcome"> 
        <h3><span><b>Bem Vindo</b> A {{$configuracoes->nomedosite}}</span></h3> 
        <div class="container"> 
            <div class="service-boxes welcome-text col-md-12 col-xs-12" data-animation="fadeInUp">             
                {!!$configuracoes->descricao!!}
            </div> 
        </div>         
    </section> 

    
    <section id="rooms" class="luxury">

        <h3><span><b>Serviços</b> Oferecidos</span></h3>
        <div id="roomLoader" class="container">
            <div class="loader"></div>
            <div class="close-icon"></div>
            <div id="roomLoader-container"></div>
        </div>

        <ul class="property-container container">
            @if (!empty($paginas && $paginas->count() > 0))
                @foreach($paginas as $pagina)
                    <li class="property-boxes col-xs-6 col-md-4" data-animation="fadeInLeft" data-animation-delay=".2">
                        <div class="prp-img">
                            <img width="360" height="240" src="{{$pagina->cover()}}" alt="{{$pagina->titulo}}"/>          
                        </div>
                        <div class="prp-detail"> 
                            <div class="title">{{$pagina->titulo}}</div>
                            <div class="description">{!!\App\Helpers\Renato::Words($pagina->content, 15)!!}</div>
                            <a href="{{route('web.pagina', ['slug' => $pagina->slug])}}" data-room-id="4" class="more-detail btn colored">Ver +</a>            
                        </div>
                    </li>
                @endforeach
            @endif            
        </ul>
    </section>

    @if (!empty($avaliacoes) && $avaliacoes->count() > 0)
        <section id="testimonials" data-background="parallax">
            <div id="testimonials-container">
                <h3><span><b>Depoimento</b> de Hóspedes</span></h3>
                <div id="testimonials-content" class="container" data-animation="fadeInUp">
                    <div id="testimonials-slider" class="owl-carousel owl-theme">
                        @foreach($avaliacoes as $depoimento)
                            <div class="item" style="min-height:285px;">
                                <cite>{{$depoimento->name}}</cite>
                                <blockquote>"{{$depoimento->questao_7_content}}"<br /><br />
                                    {{$depoimento->cidade}} - {{$depoimento->uf}}
                                </blockquote>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif    

@endsection

@section('css')
    <style>
        #testimonials {
            background: url({{url('frontend/'.$configuracoes->template.'/assets/images/testimonials_bg.jpg')}}) center top no-repeat;
        }
    </style>
@endsection