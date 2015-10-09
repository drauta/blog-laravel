@include('blogLaravel::front.subviewcategorias',['categorias' =>$categorias ])          
<div class="col-sm-8 col-lg-9">
    <div class="content">
        <div class="page-title">
            <h1>{{$post['title']}}</h1>
        </div>
        <!-- /.page-title -->
        <div class="posts post-detail">
            <img src="{{url($post->image)}}" alt="A Clockwork Origin">
            <div class="post-meta clearfix">
                <div class="post-meta-author">By {{$post['author']->name}}</div>
                <!-- /.post-meta-author -->
                <div class="post-meta-date">{{date('d/m/Y', strtotime($post->updated_at))}}</div>
                <!-- /.post-meta-date -->
                <div class="post-meta-categories"><i class="fa fa-tags"></i> <a href={!! route('postByCategory', ['id'=>$post->categorys[0]->id]) !!}>{{$post->categorys[0]->name}}</a></div>
                <!-- /.post-meta-categories -->
                <div class="post-meta-comments"><i class="fa fa-comments"></i>{{count($post->comments)}} comentarios</div>
                <!-- /.post-meta-comments -->
            </div>
            <!-- /.post-meta -->
            <div class="post-content">
                {!! html_entity_decode($post['textBody']) !!}
            </div>
            <!-- /.post-content -->
            <div class="post-meta-tags clearfix">
                Tags:
                <ul>
                    @foreach ($post->tags as $tag)
                    <li class="tag">{{$tag->name}}</li>
                    @endforeach
                </ul>
            </div>
            <!-- /.post-meta -->
            <h2 id="reviews">{{count($post->comments)}} comentarios</h2>
            @if(count($post->comments) > 0)
            <div class="comments" id="comments">
                @foreach ($post->comments as $comment)
                @if($comment->quotedComment == 0)
                <div class="comment panel panel-camper">
                    <div class="comment-image">
                        <img src="/assets/img/tmp/agent-1.jpg" alt="">
                    </div>
                    <!-- /.comment-image -->
                    <div class="comment-inner" id="comments">
                        <div class="comment-header">
                            <h2>{{$comment->name}}</h2>
                            <span class="separator">&#8226;</span>
                            <span class="comment-date">{{date('d/m/Y', strtotime($comment->created_at))}}</span>
                            <div class="comment-reply panel-heading" data-toggle="collapse" aria-expanded="false">
                                <a role="button" data-toggle="collapse" data-parent="#comments" href="#collapse{{$comment->id}}" aria-expanded="false">
                                    <i class="fa fa-reply"></i> Contestar
                                </a>
                            </div>
                            <!-- /.comment-reply -->
                        </div>
                        <!-- /.comment-header -->
                        <div class="comment-content-wrapper">
                            <div class="comment-content">
                                {{$comment->textBody}}
                            </div>
                            <!-- /.comment-content -->
                        </div>
                        <!-- /.comment-content-wrapper -->
                    </div>
                    <div id="collapse{{$comment->id}}" class="panel-body panel-collapse collapse" aria-expanded="false">
                        @include('blogLaravel::forms.formResponderComentario',$comment)
                    </div>
                    @foreach ($comment->quotedBy as $quote)
                    @include('blogLaravel::front.layouts.posts.commentariosSegundoNivel',$quote)
                    @endforeach
                </div>
                @endif
                @endforeach
            </div>
            @else
            <h2>No hay mensajes</h2>
            @endif

            @include('blogLaravel::forms.formComentarPost')

        </div>
        <!-- /.post -->
    </div>
    <!-- /.content -->
</div>
<!-- /.col-* -->

