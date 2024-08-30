<!DOCTYPE html>
<html lang="pt-br">
<head>	
    <meta charset="utf-8"/>    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=no"/>
    <meta name="language" content="pt-br" /> 
    <meta name="author" content="{{env('DESENVOLVEDOR')}}"/>
    <meta name="designer" content="Renato Montanari">
    <meta name="publisher" content="Renato Montanari">
    <meta name="url" content="{{$configuracoes->dominio}}" />
    <meta name="keywords" content="{{$configuracoes->metatags}}">
    <meta name="distribution" content="web">
    <meta name="rating" content="general">
    <meta name="date" content="Dec 26">
    <meta name="google-site-verification" content="QWwA532Gwapv86hAlqZWT7eTlIDOkeQ7UQXkE0CzJiY" />
    <meta name="msvalidate.01" content="AB238289F13C246C5E386B6770D9F10E" />

    {!! $head ?? '' !!}

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="{{$configuracoes->getfaveicon()}}" />
    <link rel="shortcut icon" href="{{$configuracoes->getfaveicon()}}" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="{{$configuracoes->getfaveicon()}}"/>
    <link rel="apple-touch-icon" sizes="72x72" href="{{$configuracoes->getfaveicon()}}"/>
    <link rel="apple-touch-icon" sizes="114x114" href="{{$configuracoes->getfaveicon()}}"/>

    <!-- Fontes ===================== -->
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700%7cDroid+Serif:400,700,400italic,700italic%7cYellowtail%7cGreat+Vibes" rel="stylesheet" type="text/css"/>

    <!-- Styles ===================== -->
    <link rel="stylesheet" id="main-style-file" type="text/css" href="{{url('frontend/'.$configuracoes->template.'/assets/css/styles.css')}}"/>
    <link rel="stylesheet" id="main-style-file" type="text/css" href="{{url('frontend/'.$configuracoes->template.'/assets/css/footer.css')}}"/>

    <!-- Styles Renato ===================== -->
    <link rel="stylesheet" id="main-style-file" type="text/css" href="{{url('frontend/'.$configuracoes->template.'/assets/css/renato.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @hasSection('css')
        @yield('css')
    @endif
 </head>
 <body>

    <div class="main-wrapper">

        {{--HEADER--}}
        <div id="main-header-top"> 
            <div class="main-header-top-container container">        
                <div id="top-logo">
                    <img style="z-index:1;margin-bottom: -15px;" src="{{$configuracoes->getLogomarca()}}" alt="{{$configuracoes->nomedosite}}" />     
                </div>
                @if($configuracoes->whatsapp)
                    <ul class="list-inline">
                        <li style="font-size:22px !important;">
                            <a class="sharezap" href="#" target="_blank"><i style="font-size:22px;color: #3AA04E;" class="fa fa-whatsapp"></i>&nbsp; <b>{{$configuracoes->whatsapp}}</b></a>
                        </li>
                    </ul>
                @endif  
            </div> 
        </div>

        <header id="main-header">         
            <div class="header-content container"> 
                <div class="menu-container">             
                    <nav id="main-menu"> 
                        <ul class="main-menu"> 
                            <li><a href="{{route('web.home')}}" class="current">Início</a></li>
                            @if (!empty($Links) && $Links->count())                            
                                @foreach($Links as $menuItem)                            
                                <li {{($menuItem->children && $menuItem->parent ? 'class=dropdown' : '')}}>
                                    <a {{($menuItem->target == 1 ? 'target=_blank' : '')}} href="{{($menuItem->tipo == 'Página' ? route('web.pagina', [ 'slug' => ($menuItem->post != null ? $menuItem->PostObject->slug : '#') ]) : $menuItem->url)}}" {{($menuItem->children && $menuItem->parent ? 'class=dropdown-toggle data-toggle=dropdown' : '')}}>{{ $menuItem->titulo }}{!!($menuItem->children && $menuItem->parent ? "<b class=\"caret\"></b>" : '')!!}</a>
                                    @if( $menuItem->children && $menuItem->parent)
                                    <ul class="dropdown-menu icon-fa-caret-up submenu-hover">
                                        @foreach($menuItem->children as $subMenuItem)
                                        <li><a {{($subMenuItem->target == 1 ? 'target=_blank' : '')}} href="{{($subMenuItem->tipo == 'Página' ? route('web.pagina', [ 'slug' => ($subMenuItem->post != null ? $subMenuItem->PostObject->slug : '#') ]) : $subMenuItem->url)}}">{{ $subMenuItem->titulo }}</a></li>                                        
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                            @endif
                            <li><a href="{{route('web.reservar')}}">Reservas</a></li>                          
                        </ul> 
                    </nav>   
                    <div id=main-menu-handle><span></span></div>
                </div> 
            </div>         
        </header> 

        {{--CONTEÚDO DO SITE--}}
        @yield('content')

        <footer id=top-footer> 
            <div id=top-footer-content class=container> 

                @if (!empty($selos) && $selos->count() > 0)
                    @foreach($selos as $selo)
                        <div class="widget col-md-2">        
                            <h4>&nbsp;</h4>
                            <div class="content-box row" style="border-left: none !important;"> 
                                <div class=widget-content>                        
                                    <p style="text-align: center;">
                                        <img src="{{$selo->getimagem()}}" alt="{{$selo->titulo}}" title="{{$selo->titulo}}"/>
                                    </p>                               
                                </div> 
                            </div> 
                        </div>
                    @endforeach
                @endif                     
                
                <div class="widget col-md-4">
                    
                    <h4>{{$configuracoes->nomedosite}}</h4> 
                    <div class="content-box row"> 
                        <div class="widget-content">
                            <p>
                                @if($configuracoes->rua)	
                                    <i class="fa fa-map-marker" style="font-size:16px;color:#3AA04E;"></i> {{$configuracoes->rua}}
                                @endif
                                @if($configuracoes->num)
                                    , {{$configuracoes->num}}
                                @endif
                                @if($configuracoes->bairro)
                                    , {{$configuracoes->bairro}}
                                @endif
                                @if($configuracoes->cidade)  
                                    - {{$configuracoes->cidade}}/{{$configuracoes->uf}}
                                @endif
                            </p>

                            <p>
                                @if($configuracoes->telefone1)
                                    <i style="font-size:16px;color: #3AA04E;" class="fa fa-phone"></i> {{$configuracoes->telefone1}}
                                @endif                            
                                @if($configuracoes->telefone1 && $configuracoes->telefone2)
                                    - {{$configuracoes->telefone2}}
                                @endif
                                @if ($configuracoes->telefone2 && $configuracoes->telefone1 == null)
                                    <i style="font-size:16px;color: #3AA04E;" class="fa fa-phone"></i> {{$configuracoes->telefone2}}
                                @endif
                                @if($configuracoes->telefone3)
                                    <i style="font-size:16px;color: #3AA04E;" class="fa fa-phone"></i> {{$configuracoes->telefone3}}
                                @endif
                            </p>

                            @if ($configuracoes->whatsapp)
                                <p class="whats">
                                    <a class="sharezap" href="#" target="_blank">
                                        <i style="font-size:16px;color: #3AA04E;" class="fa fa-whatsapp"></i> {{$configuracoes->whatsapp}}
                                    </a>
                                </p> 
                            @endif

                            <p>
                                @if($configuracoes->email)
                                    <i style="font-size:16px;color: #3AA04E;" class="fa fa-envelope"></i> {{$configuracoes->email}}
                                @endif 
                                @if($configuracoes->email1)
                                    <i style="font-size:16px;color: #3AA04E;" class="fa fa-envelope"></i> {{$configuracoes->email1}}
                                @endif
                            </p>                        
                            
                            <p style="margin-top: 10px;">
                                <img src="{{url('frontend/'.$configuracoes->template.'/assets/images/wifizone.png')}}" width="71" height="41" />
                            </p>
                        
                            {{--Footer Social icons--}} 
                            <div class="social-icons">
                                @if ($configuracoes->facebook)
                                    <a target="_blank" href="{{$configuracoes->facebook}}" title="Facebook"><img src="{{url('frontend/'.$configuracoes->template.'/assets/images/icon-facebook.png')}}" width="32" height="32" /></a>
                                @endif
                                @if ($configuracoes->twitter)
                                    <a target="_blank" href="{{$configuracoes->twitter}}" title="Twitter"><img src="{{url('frontend/'.$configuracoes->template.'/assets/images/icon-twitter.png')}}" width="32" height="32"></a>
                                @endif
                                @if ($configuracoes->instagram)
                                    <a target="_blank" href="{{$configuracoes->instagram}}" title="Instagram"><img src="{{url('frontend/'.$configuracoes->template.'/assets/images/icon-instagran.png')}}" width="32" height="32"></a>
                                @endif
                                @if ($configuracoes->linkedin)
                                    <a target="_blank" href="{{$configuracoes->linkedin}}" title="linkedin"><img src="{{url('frontend/'.$configuracoes->template.'/assets/images/icon-icon-likedin.png')}}" width="32" height="32"></a>
                                @endif
                                @if ($configuracoes->youtube)
                                    <a target="_blank" href="{{$configuracoes->youtube}}" title="Youtube"><img src="{{url('frontend/'.$configuracoes->template.'/assets/images/icon-youtube.png')}}" width="32" height="32"></a>
                                @endif                           
                            </div> 
                        
                        </div> 
                    </div> 
                </div>
                
            </div> 
        </footer>         
         
        <footer id="footer"> 
            {{--Go up Button--}}
            <div id="go-up"></div>
        
            {{--Footer Menu--}}
            <ul class="footer-menu container"> 
                @if (!empty($Links) && $Links->count())                            
                    @foreach($Links as $menuItem)                            
                        <li {{($menuItem->children && $menuItem->parent ? 'class=dropdown' : '')}}>
                            <a {{($menuItem->target == 1 ? 'target=_blank' : '')}} href="{{($menuItem->tipo == 'Página' ? route('web.pagina', [ 'slug' => ($menuItem->post != null ? $menuItem->PostObject->slug : '#') ]) : $menuItem->url)}}" {{($menuItem->children && $menuItem->parent ? 'class=dropdown-toggle data-toggle=dropdown' : '')}}>{{ $menuItem->titulo }}{!!($menuItem->children && $menuItem->parent ? "<b class=\"caret\"></b>" : '')!!}</a>
                            @if( $menuItem->children && $menuItem->parent)
                            <ul class="dropdown-menu icon-fa-caret-up submenu-hover">
                                @foreach($menuItem->children as $subMenuItem)
                                <li><a {{($subMenuItem->target == 1 ? 'target=_blank' : '')}} href="{{($subMenuItem->tipo == 'Página' ? route('web.pagina', [ 'slug' => ($subMenuItem->post != null ? $subMenuItem->PostObject->slug : '#') ]) : $subMenuItem->url)}}">{{ $subMenuItem->titulo }}</a></li>                                        
                                @endforeach
                            </ul>
                            @endif
                        </li>
                    @endforeach
                @endif
                <li><a href="{{route('web.reservar')}}" title="Pré-Reserva">Pré-Reserva</a></li>
                <li><a href="{{route('web.atendimento')}}" title="Atendimento">Atendimento</a></li> 
                <li><a href="{{route('web.politica')}}" title="Política de Privacidade">Política de Privacidade</a></li>
            </ul>  
        
            {{--Copyright--}}
            <div class="copyright"> 
                &copy; {{$configuracoes->ano_de_inicio}} - {{date('Y')}}  {{$configuracoes->nomedosite}} - Todos os direitos reservados. 
                <p class="font-accent text-center" style="margin-top: 5px;">
                    <span class="small text-silver-dark">Feito com <i style="color:red;" class="fa fa-heart"></i> por <a style="color:#fff;" target="_blank" href="{{env('DESENVOLVEDOR_URL')}}">{{env('DESENVOLVEDOR')}}</a></span>
                </p>
            </div>     
        
        </footer>

    </div>

    <!-- JS Includes --> <!-- Essential JS files ( DO NOT REMOVE THEM ) --> 
    <script type="text/javascript" src="{{url('frontend/'.$configuracoes->template.'/assets/js/jquery-1.11.1.min.js')}}"></script> 

    <script type="text/javascript" src="{{url('frontend/'.$configuracoes->template.'/assets/js/jquery.modernizr.min.js')}}"></script> 
    <!-- Include bootstrap tab scrip --> 
    <script type="text/javascript" src="{{url('frontend/'.$configuracoes->template.'/assets/js/bootstrap/tab.js')}}"></script> 
    <!-- Include required js files --> 
    <script type="text/javascript" src="{{url('frontend/'.$configuracoes->template.'/assets/js/jquery.bxslider.min.js')}}"></script> 
    <script type="text/javascript" src="{{url('frontend/'.$configuracoes->template.'/assets/js/owl.carousel.min.js')}}"></script> 
    <script type="text/javascript" src="{{url('frontend/'.$configuracoes->template.'/assets/js/jquery.magnific-popup.min.js')}}"></script> 
    <script type="text/javascript" src="{{url('frontend/'.$configuracoes->template.'/assets/js/helper.js')}}"></script> 
    <script type="text/javascript" src="{{url('frontend/'.$configuracoes->template.'/assets/js/init.js')}}"></script> 
    <script type="text/javascript" src="{{url('frontend/'.$configuracoes->template.'/assets/js/template.js')}}"></script>

    <script src="{{url('frontend/'.$configuracoes->template.'/assets/js/datepicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{url('frontend/'.$configuracoes->template.'/assets/js/jquery-ui.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            "use strict";
            jQuery('.gallery-img-container').magnificPopup({
                delegate: 'a',
                type: 'image',
                removalDelay: 600,
                mainClass: 'mfp-fade',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
                }
            });
            jQuery(' .gallery-img-container > li ').each( function() { jQuery(this).hoverdir(); } );
        });
    </script>


    <script type="text/javascript">      
        $( "#j_data" ).datepicker({
        //beforeShowDay: DisableMonday,// chama função data 
        //beforeShowDay: unavailable,// chama função dia da semana
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior',
        showOn: 'focus',
        buttonImageOnly: true,
        //buttonImage: '<?php //echo PATCH;?>/images/data.png'
        });
        

        $( "#j_data1" ).datepicker({
        //beforeShowDay: DisableMonday,// chama função data 
        //beforeShowDay: unavailable,// chama função dia da semana
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior',
        showOn: 'focus',
        buttonImageOnly: true,
        //buttonImage: '<?php //echo PATCH;?>/images/data.png'
        });
    </script>

    <script>
        jQuery(document).ready(function() {
            jQuery('.lista').change(function() {
                window.location = $(this).val();
            });
        });
    </script>

    <script>
        $(function () {
    
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
    
        });
    </script>

    <script>
        $(document).ready(function() {
            var isMobile = {
                Android: function() {
                    return navigator.userAgent.match(/Android/i);
                },
                BlackBerry: function() {
                    return navigator.userAgent.match(/BlackBerry/i);
                },
                iOS: function() {
                    return navigator.userAgent.match(/iPhone|iPad|iPod/i);
                },
                Opera: function() {
                    return navigator.userAgent.match(/Opera Mini/i);
                },
                Windows: function() {
                    return navigator.userAgent.match(/IEMobile/i);
                },
                any: function() {
                    return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
                }
            };
            if( isMobile.any() ) {
                $('.sharezap').attr("href", "https://api.whatsapp.com/send?l=pt_pt&phone="+{{ \App\Helpers\Renato::limpatelefone($configuracoes->whatsapp) }}+"&text=Atendimento "+"{{$configuracoes->nomedosite}}");
                return true; // está utilizando celular
            }else{
                $('.sharezap').attr("href", "https://web.whatsapp.com/send?l=pt_pt&phone="+{{ \App\Helpers\Renato::limpatelefone($configuracoes->whatsapp) }}+"&text=Atendimento "+"{{$configuracoes->nomedosite}}");
                return false; // não é celular
            }
        });
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{$configuracoes->tagmanager_id}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
    
        gtag('config', '{{$configuracoes->tagmanager_id}}');
    </script>

    @hasSection('js')
        @yield('js')
    @endif    

    

</body>
</html>