<div class="posts">
    @foreach ($posts as $post) 
    <div class="post">
        <div class="post-image">
            <img src="{{ $post['image'] }}" alt="">
                <a class="read-more" href="{!! route('getThePost', ['id'=>$post['id']]) !!}">View</a>
        </div>
        <!-- /.post-image -->
        <div class="post-content">
            <h2>
                <a href="{!! route('getThePost', ['id'=>$post['id']]) !!}">{{ $post['title'] }}</a>
            </h2>
            {!! html_entity_decode($post['descripcion']) !!}...
        </div>
        <!-- /.post-content -->
        <div class="post-meta clearfix">
            <div class="post-meta-author">By {{ $post['author']->name }}</div><!-- /.post-meta-author -->
            <div class="post-meta-date">{{ date('d/m/Y', strtotime($post->fechaPublicar)) }}</div><!-- /.post-meta-date -->
            @foreach ($post["categorys"] as $categoria) 
				<div class="post-meta-categories"><i class="fa fa-tags"></i> <a href="{!! route('postByCategory', ['id'=>$categoria['id']]) !!}">{{$categoria->name}}</a></div><!-- /.post-meta-categories -->
            @endforeach          
            <div class="post-meta-comments"><i class="fa fa-comments"></i> <a href="{!! route('getThePost', ['id'=>$post['id']]) !!}">{{count($post["comments"])}} comentarios</a></div><!-- /.post-meta-comments -->
            <div class="post-meta-more"><a href="{!! route('getThePost', ['id'=>$post['id']]) !!}">Leer más <i class="fa fa-chevron-right"></i></a></div><!-- /.post-meta-more -->
        </div><!-- /.post-meta -->
    </div> 
    @endforeach      
    <div class="pager">
        {!! $posts->render() !!}
    </div>
    <!-- /.post -->
 </div>
 @include('blogLaravel::front.subviewcategorias',['categorias' =>$categorias ])       