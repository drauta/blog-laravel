@extends("blogLaravel::admin.layouts.html")
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('drauta/bloglaravel/libs/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" />
<style type='text/css'>
    .note-editable{
        height: 300px;
    }
    #cuerpoPost{
        display: none;

    }
    .sinPadding {
        padding: 0;
    }
</style>
@endsection
@section('javascript')
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="{{asset('drauta/bloglaravel/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('drauta/bloglaravel/libs/ckeditor/ckeditor.js')}}"></script>
<script>
$(document).ready(function () {
    // TAGS
    $('#tagsPost').tagsinput();
    $(".note-editable").html($("#cuerpoPost").html());

    // GUARDAR POST
    $("#crearPost button.guardar").click(function () {
        $("#borrador").val("true");
        $("#cuerpoPost").html($(".note-editable").html());
        $(this).parents("form").submit();
    });

    //GUARDAR Y PUBLICAR POST
    $("#crearPost .publicar").click(function () {
        $("#borrador").val("false");

        $("#cuerpoPost").html($(".note-editable").html());
        $(this).parents("form").submit();
    });
});
    CKEDITOR.replace('cuerpoPost', {
        filebrowserBrowseUrl: '{{asset('drauta/bloglaravel/libs/ckeditor/browse/browse.php')}}',
        filebrowserUploadUrl: '{{asset('drauta/bloglaravel/libs/ckeditor/upload/upload.php')}}'
    });
</script>

@endsection
@section('content')
<div class="page-content">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Datos Post</h3>
        </div>
        <div class="col-xs-3 col-xs-offset-9">
            <a class="btn btn-success" href="{!! route('formListPosts') !!}" role="button">Ver listado de posts</a>
        </div>
        <div class="panel-body container-fluid" style="clear:both;">
            <div class="row row-lg">
                @if (count($errors) > 0)
                <div class="col-sx-12 alert alert-danger">
                    <h2>Errores</h2>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="col-xs-12">
                    <form id="crearPost" action="{!! route('createPostProces') !!}" method="POST" enctype="multipart/form-data"><br/>
                        <input type="hidden" name="_token" class="form-control round" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="tipo" value="{{ $tipo }}"/>
                        <input type="hidden" name="idPost" value=" @if(isset($idPost)) {{$idPost}} @else 0 @endif"
                               <!--  TITULO Y DESCRIPCI�N-->
                               <div class="example-wrap">
                                   <?php $titulo = Input::old('titulo'); ?>
                            <h4 class="example-title">Título</h4>
                            <input type="text"  class="form-control" name="titulo" placeholder="Insertar titulo" value="{{Input::old('titulo')}} @if (!isset($titulo) && isset($post)) {{$post->title}} @endif" />
                        </div>
                        <div class="example-wrap">
                            <?php $descripcion = Input::old('descripcion'); ?>
                            <h4 class="example-title">Descripción</h4>
                            <textarea id="descripcionPost" class="form-control" rows="3" name="descripcion" placeholder="Escribe descripción" >{{Input::old('descripcion')}} @if (!isset($descripcion) && isset($post)) {{$post->descripcion}} @endif </textarea>
                        </div>
                        <div class="example-wrap">
                            <?php $contenido = Input::old('contenido'); ?>
                            <h4 class="example-title">Contenido</h4>
                            <div class="panel-body sinPadding">
                                <!--<div id='summernote2'></div>-->
                            </div>
                            <textarea id="cuerpoPost" class="form-control" rows="3" name="contenido" placeholder="Escribe contenido" >{!! Input::old('contenido') !!} @if (!isset($contenido) && isset($post)) {{$post->textBody}} @endif </textarea>
                        </div>

                        <div class="example-wrap" style="clear:both;overflow:auto;">
                            <div class="col-xs-5">
                                <h4 class="example-title ">Imagen preferida</h4>
                                <div class="form-group">
                                    <div class="input-group input-group-file">
                                        <input type="text" class="form-control" readonly="">
                                        <span class="input-group-btn">
                                            <span class="btn btn-success btn-file">
                                                <i class="icon wb-upload" aria-hidden="true"></i>
                                                <input type="file" id="file" name="file"/>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- SUBIR IM�GEN -->
                        <div class="col-sm-6">
                            <div class="example-wrap">
                                <h4 class="example-title">Tags</h4>
                                <p>Selecciona una o varias etiquetas</p>
                                <div class="bs-example">
                                    @if (count(Input::old('tags'))>0)
                                    <input id="tagsPost" name="tags" type="text" value="{{Input::old('tags')}}" date-role="tagsinput"/>
                                    @else
                                    <?php $etiquetas = ""; ?>
                                    @foreach ($tags as $tag)
                                    <?php $etiquetas = $etiquetas . $tag["name"] . ","; ?>
                                    @endforeach
                                    <input id="tagsPost" name="tags" type="text" value="{{$etiquetas}}" date-role="tagsinput"/>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="example-wrap">
                                <?php $categoriaId = Input::old('categoria'); ?>
                                <?php
                                if (!isset($categoriaId)) {
                                    if (isset($categoriaActual)) {
                                        $categoriaId = $categoriaActual;
                                    }
                                }
                                ?>
                                <h4 class="example-title">Categorias</h4>
                                <p>Selecciona una categoria</p>
                                @foreach ($categorias as $categoria)
                                <div class="radio-custom radio-primary">
                                    @if ($categoriaId== $categoria['id'])
                                    <input type="radio" name="categoria" value="{{ $categoria['id'] }}" checked="checked">
                                    @else
                                    <input type="radio" name="categoria" value="{{ $categoria['id'] }}">
                                    @endif
                                    <label>{{ $categoria['name'] }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <input id="borrador" type="hidden" name="borrador"/>
                            <button type="button" class="btn-primary btn guardar">Guardar como borrador</button>
                            <button type="button" class="btn-danger btn publicar">Guardar y publicar</button>
                        </div>
                        <!-- TAGS -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
