@extends("web.{$configuracoes->template}.master.master")

@section('content')

<section id="columns" class="padding-bottom"> 

    <h3><span><b>Reservas</b></span></h3>    
    <div class="container">     
        <div class="row"> 
    
            <div class="col-md-6">
                <h4><b>Formulário de Orçamento</b></h4>
    
                <form id="contact-form" name="contact-form" action="" method="post" class="j_formsubmit" autocomplete="off">
                    @csrf
                    <div id="js-contact-result"></div>
                    <!-- HONEYPOT -->
                    <input type="hidden" class="noclear" name="bairro" value="" />
                    <input type="text" class="noclear" style="display: none;" name="cidade1" value="" />
                    <div class="row form_hide"> 
                        <div class="field-container col-xs-12 col-md-12"> 
                            <input type="text" name="nome" placeholder="Seu nome"/> 
                        </div>
                    </div>    
                    <div class="row form_hide">  
                        <div class="field-container col-xs-12 col-md-12"> 
                            <input type="email" name="email" placeholder="Seu email"/> 
                        </div> 
                    </div>
                    <div class="row form_hide">   
                        <div class="field-container col-xs-12 col-md-12"> 
                            <input type="text" name="telefone" id="telefone" placeholder="Seu telefone" class="telefonemask"/> 
                        </div> 
                    </div>
                    <div class="row form_hide">  
                        <div class="search-fields field-container col-xs-6 col-md-6"> 
                            <input id="j_data" name="checkin" autocomplete="off" class="datepicker-fields check-in" placeholder="Check-in" type="text" value="{{(!empty($dadosForm['checkini']) ? $dadosForm['checkini'] : '')}}"/>
                            <i class="fa fa-calendar"></i> 
                        </div> 
                        <div class="search-fields field-container col-xs-6 col-md-6"> 
                            <input id="j_data1" name="checkout" autocomplete="off" class="datepicker-fields check-out" placeholder="Check-out" type="text" value="{{(!empty($dadosForm['checkouti']) ? $dadosForm['checkouti'] : '')}}"/> 
                            <i class="fa fa-calendar"></i> 
                        </div> 
                    </div>
                    <div class="row form_hide">  
                        <div class="search-fields col-xs-6 col-md-6" style="border: 1px solid #cccccc; width: 45%; margin-left: 2.5%; border-bottom-width: 3px;"> 
                            <select name="num_adultos" id="search-field3"> 
                                <option value="">Adultos</option>            
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{$i}}" {{(!empty($dadosForm['adultos']) && $i == $dadosForm['adultos'] ? 'selected' : '')}}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select> 
                        </div>    
                        <div class="search-fields col-xs-6 col-md-6" style="border: 1px solid #cccccc; width: 45%; margin-left: 5%; border-bottom-width: 3px;"> 
                            <select name="num_cri_0_5" id="search-field3">
                                <option value="0">Crianças</option>                
                                @for($i = 0; $i <= 5; $i++)
                                    <option value="{{$i}}" {{(!empty($dadosForm['cri_0_5']) && $i == $dadosForm['cri_0_5'] ? 'selected' : '')}}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select> 
                        </div> 
                        
                    </div>
    
                    <div class="message-field row form_hide"> 
                        <textarea name="mensagem" id="message-field" placeholder="Informações Adicionais"></textarea>
                    </div>
    
                    <div class="row form_hide">
                        <div class="field-container col-xs-12 col-md-12">
                            <button style="padding: 20px; width: 100%; font-size: 16px;" type="submit" class="contact-submit btn colored" id="js-contact-btn">Solicitar Orçamento</button> 
                        </div>
                    </div>
                </form>
                    <div class="row" style="margin-top:80px; padding: 10px; border: 1px solid #189049;">                    
                        <div class="field-container col-xs-7 col-md-7"> 
                            <p><br />Se desejar efetuar sua reserva On-Line, no site <span style="color: #0000FF;">Booking.com.</span>
                            clique no botão ao lado. 
                            </p>
                        </div>
        
                        <div class="field-container col-xs-5 col-md-5">
                            <a target="_blank" href="http://www.booking.com/hotel/br/pousada-do-tia-c.html?aid=330843;lang=pt-br"><input style="padding: 20px; width:99%; font-size: 16px;" type="button" class="contact-submit btn colored1" name="submit" value="Booking.com"/></a>
                        </div>    
                    </div>
    
                <div class="row">
                    <div class="field-container col-xs-12 col-md-12" style="float: none;text-align: center; margin-top: 20px;">
                        <img src="{{url('frontend/'.$configuracoes->template.'/assets/images/visa.jpg')}}"/>
                    </div>
                </div>
    
    
            </div> 
    
            <div class="col-md-6"> 
                <h4><b>{{$politicareserva->titulo}}</b></h4> 
                <p>{!!$politicareserva->content!!}</p> 
            </div> 
        </div>
    
    </div>
     
</section>

@endsection

@section('css')
    
@endsection

@section('js')
    
<script>
    
    $(function(){

        $('.j_formsubmit').submit(function (){
            var form = $(this);
            var dataString = $(form).serialize();

            $.ajax({
                url: "{{ route('web.acomodacaoSend') }}",
                data: dataString,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function(){
                    form.find("#js-contact-btn").attr("disabled", true);
                    form.find('#js-contact-btn').html("Carregando...");                
                    form.find('.alert').fadeOut(500, function(){
                        $(this).remove();
                    });
                },
                success: function(resposta){
                    $('html, body').animate({scrollTop:$('#js-contact-result').offset().top-130}, 'slow');
                    if(resposta.error){
                        form.find('#js-contact-result').html('<div class="alert alert-danger error-msg">'+ resposta.error +'</div>');
                        form.find('.error-msg').fadeIn();                    
                    }else{
                        form.find('#js-contact-result').html('<div class="alert alert-success error-msg">'+ resposta.sucess +'</div>');
                        form.find('.error-msg').fadeIn(); 
                        form.find('input[class!="noclear"]').val('');
                        form.find('textarea[class!="noclear"]').val('');
                        form.find('.form_hide').fadeOut(500); 
                    }
                },
                complete: function(resposta){
                    form.find("#js-contact-btn").attr("disabled", false);
                    form.find('#js-contact-btn').html('Solicitar Orçamento');                                
                }

            });

            return false;
        });
        
    });
    
</script>   
@endsection