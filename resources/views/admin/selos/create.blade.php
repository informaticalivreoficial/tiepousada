@extends('adminlte::page')

@section('title', 'Cadastrar Selo')

@php
$config = [
    "height" => "300",
    "fontSizes" => ['8', '9', '10', '11', '12', '14', '18'],
    "lang" => 'pt-BR',
    "toolbar" => [
        // [groupName, [list of button]]
        ['style', ['style']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['style', ['bold', 'italic', 'underline', 'clear']],
        //['font', ['strikethrough', 'superscript', 'subscript']],        
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video','hr']],
        ['view', ['fullscreen', 'codeview']],
    ],
]
@endphp

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><i class="fas fa-search mr-2"></i>Cadastrar novo Selo</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Painel de Controle</a></li>
            <li class="breadcrumb-item"><a href="{{route('selos.index')}}">Selos</a></li>
            <li class="breadcrumb-item active">Cadastrar novo Selo</li>
        </ol>
    </div>
</div> 
@stop

@section('content')
<div class="row">
    <div class="col-12">
       @if($errors->all())
            @foreach($errors->all() as $error)
                @message(['color' => 'danger'])
                {{ $error }}
                @endmessage
            @endforeach
        @endif         
    </div>            
</div>   
                    
            
<form action="{{ route('selos.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
@csrf          
<div class="row">            
    <div class="col-12">
        <div class="card card-teal card-outline"> 
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                       <div class="row mb-4">
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">   
                                <div class="form-group">
                                    <label class="labelforms text-muted"><b>*Título</b></label>
                                    <input type="text" class="form-control" name="titulo" value="{{old('titulo')}}">
                                </div>                                                    
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="labelforms text-muted"><b>Status:</b></label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ (old('status') == '1' ? 'selected' : '') }}>Publicado</option>
                                        <option value="0" {{ (old('status') == '0' ? 'selected' : '') }}>Rascunho</option>
                                    </select>
                                </div>
                            </div>                          
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">   
                                <div class="form-group">
                                    <label class="labelforms text-muted"><b>Url</b> <small class="text-info">(Ex: http://www.dominio.com)</small></label>
                                    <input type="text" class="form-control" name="link" value="{{old('link')}}">
                                </div>                                                    
                            </div>                                                      
                        </div>
                        <div class="row">  
                            <div class="col-12 mb-1"> 
                                <div class="form-group">
                                    <label class="labelforms text-muted"><b>Imagem: </b>(150X100) pixels</label>
                                    <div class="thumb_user_admin">                                                    
                                        <img id="preview1" src="{{url(asset('backend/assets/images/image.jpg'))}}" alt="{{ old('titulo') }}" title="{{ old('titulo') }}"/>
                                        <input id="img-input" type="file" name="imagem">
                                    </div>
                                </div>
                            </div>                                  
                            <div class="col-12">   
                                <label class="labelforms text-muted"><b>Descrição:</b></label>
                                <x-adminlte-text-editor name="content" v placeholder="Descrição do slide..." :config="$config">{{ old('content') }}</x-adminlte-text-editor>                                                      
                            </div>
                        </div>                               
                        
                    </div> 
                    
                </div>
                <div class="row text-right">
                    <div class="col-12 mb-4">
                        <button type="submit" class="btn btn-lg btn-success" title="Cadastrar Agora"><i class="nav-icon fas fa-check mr-2"></i> Cadastrar Agora</button>
                    </div>
                </div>  
                                        
                </form>

            </div>
            <!-- /.card -->
        </div>
    </div>
</div>                   
</form>                 
            
@stop

@section('css')
<link href="{{url(asset('backend/plugins/airdatepicker/css/datepicker.min.css'))}}" rel="stylesheet" type="text/css">
    <style type="text/css">
        /* Foto User Admin */
        .thumb_user_admin{
        border: 1px solid #ddd;
        border-radius: 4px; 
        text-align: center;
        }
        .thumb_user_admin input[type=file]{
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }
        .thumb_user_admin img{
            max-width: 100%;          
        }
    </style>
    @stop

@section('js')
<script src="{{url(asset('backend/plugins/airdatepicker/js/datepicker.min.js'))}}"></script>
<script src="{{url(asset('backend/plugins/airdatepicker/js/i18n/datepicker.pt-BR.js'))}}"></script>
<script>
    $(function () { 
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });  
        
        function readImagem() {
            if (this.files && this.files[0]) {
                var file = new FileReader();
                file.onload = function(e) {
                    document.getElementById("preview1").src = e.target.result;
                };       
                file.readAsDataURL(this.files[0]);
            }
        }
        document.getElementById("img-input").addEventListener("change", readImagem, false); 
        
       
    });
</script>
@stop