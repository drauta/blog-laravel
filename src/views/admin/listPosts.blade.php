@extends('blogLaravel::admin.layouts.html')
@section('content')
<div class="page-content"> 
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Listado de posts</h3>
        </div>
        <div class="panel-body container-fluid">
            <div class="col-xs-3 col-xs-offset-9">
                <a class="btn btn-success" href="{!! route('formAdminPosts') !!}" role="button">Crear nuevo Post</a>                
            </div>
            <div class="table-responsive" style="clear:both;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Fecha publicación</th>
                            <th>Categoría</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td class="active">{{$post->title}}</td>
                            <td class="active">{{$post->fechaPublicar}}</td>
                            <td class="active">
                                @foreach ($post["categorys"] as $category)
                                {{$category->name}}
                                @endforeach 
                            </td>
                            <td class="active">
                                @if ($post["borrador"])
                                Borrador
                                @else
                                Publicado
                                @endif                           
                            </td>
                            <td class="active">					
							
                                <a class="btn btn-primary" href="{!! route('formEditPost',['id'=>$post["id"]]) !!}" role="button">Editar</a>
                                <a class="btn btn-default" href="{!! route('getThePost',['id'=>$post["id"]]) !!}" role="button">Ver</a>
                                <a class="btn btn-danger" href="{!! route('formErasePost',['id'=>$post["id"]]) !!}" role="button">Eliminar</a>
                            </td>
                        </tr>                          
                        @endforeach                                              
                    </tbody>
                </table>
                {!! $posts->render() !!}                                
            </div>

        </div>
    </div>
</div>

@endsection