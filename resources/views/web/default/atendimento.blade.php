@extends("web.{$configuracoes->template}.master.master")

@section('content')

<section id="contact-page" class="container">
 
    <h3><span><b>Atendimento</b></span></h3>
    
    <div class="contact-info clearfix"> 
        <div class="contact-info-contnet">
            <div class="col-md-4 col-xs-4">
                <p><i style="font-size:22px;color: #3AA04E;" class="fa fa-map-marker"></i></p>
                @if($configuracoes->rua)	
                    {{$configuracoes->rua}}
                    @if($configuracoes->num)
                        , {{$configuracoes->num}}
                    @endif
                    @if($configuracoes->bairro)
                        , {{$configuracoes->bairro}}
                    @endif
                    @if($configuracoes->cidade)  
                        <br />{{$configuracoes->cidade}}/{{$configuracoes->uf}}
                    @endif
                @endif
            </div> 
        
            <div class="col-md-4 col-xs-4">
                <p><i style="font-size:22px;color: #3AA04E;" class="fa fa-phone"></i></p>
                @if($configuracoes->telefone1)
                    {{$configuracoes->telefone1}}
                @endif
                @if($configuracoes->telefone2 && $configuracoes->telefone1)
                    <br />{{$configuracoes->telefone2}}
                @else
                    {{$configuracoes->telefone2}}
                @endif
                @if($configuracoes->telefone3 && $configuracoes->telefone1 || $configuracoes->telefone2)
                    <br />{{$configuracoes->telefone3}}
                @else
                    {{$configuracoes->telefone3}}
                @endif            
            </div> 
            
            <div class="col-md-4 col-xs-4">
                <p><i style="font-size:22px;color: #3AA04E;" class="fa fa-envelope"></i></p>
                @if($configuracoes->email)
                    <a href="mailto:{{$configuracoes->email}}">{{$configuracoes->email}}</a>
                @endif
                @if($configuracoes->email1 && $configuracoes->email)
                    <br /><a href="mailto:{{$configuracoes->email1}}">{{$configuracoes->email1}}</a>
                @else
                    <a href="mailto:{{$configuracoes->email1}}">{{$configuracoes->email1}}</a>
                @endif             
            </div> 
        </div> 
    </div>
     
    
    <div class="contact-us-content col-md-12"> 
        <!-- Conctact Form --> 
        <form id="contact-form" name="contact-form" action="" method="post" class="j_formsubmit" autocomplete="off">
            @csrf 
            <div id="js-contact-result"></div>
            
            <!-- HONEYPOT -->
            <input type="hidden" class="noclear" name="bairro" value="" />
            <input type="text" class="noclear" style="display: none;" name="cidade" value="" />
            <div class="row form_hide"> 
                <div class="name-field col-md-12 col-xs-12 col-sm-12 col-lg-4"> 
                    <input type="text" id="name-field" name="nome" placeholder="Seu nome"/> 
                </div> 
                <div class="email-field col-md-12 col-xs-6 col-sm-6 col-lg-4"> 
                    <input type="email" id="email-field" name="email" placeholder="Seu email"/> 
                </div>
                <div class="phone-field col-md-12 col-xs-6 col-sm-6 col-lg-4"> 
                    <input type="tel" name="telefone" placeholder="Seu telefone"/> 
                </div>
            </div>
            <div class="message-field row form_hide"> 
                <textarea name="mensagem" id="message-field" class="noclear" placeholder="Digite sua mensagem"></textarea>
                <button style="padding: 20px; width: 200px; font-size: 16px;" type="submit" class="contact-submit btn colored btncheckout" name="submit">Enviar Agora</button>
            </div> 
        </form>
    </div> 
</section>

@endsection

@section('js')
<script>
    $(function () {

        // Seletor, Evento/efeitos, CallBack, Ação
        $('.j_formsubmit').submit(function (){
            var form = $(this);
            var dataString = $(form).serialize();

            $.ajax({
                url: "{{ route('web.sendEmail') }}",
                data: dataString,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function(){
                    form.find(".btncheckout").attr("disabled", true);
                    form.find('.btncheckout').html("Carregando...");                
                    form.find('.alert').fadeOut(500, function(){
                        $(this).remove();
                    });
                },
                success: function(resposta){
                    $('html, body').animate({scrollTop:$('#js-contact-result').offset().top-100}, 'slow');
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
                    form.find(".btncheckout").attr("disabled", false);
                    form.find('.btncheckout').html("Enviar Agora");                                
                }
            });

            return false;
        });

    });
</script>   
@endsection