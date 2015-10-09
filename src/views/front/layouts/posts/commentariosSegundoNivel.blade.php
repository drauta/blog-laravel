<div class="comment comment-children">
  <div class="comment-image">
    <!-- <img src="assets/img/tmp/agent-2.jpg" alt="">{{url('$quote->author->img')}} -->
    <img src="/assets/img/tmp/agent-2.jpg" alt="">
  </div>
  <!-- /.comment-image -->
  <div class="comment-inner">
    <div class="comment-header">
      <h2>{{$quote->author->name}}</h2>
      <span class="separator">&#8226;</span>
      <span class="comment-date">{{date('d/m/Y', strtotime($quote->created_at))}}</span>
      <div class="comment-reply panel-heading" data-toggle="collapse" aria-expanded="false">
        <a role="button" data-toggle="collapse" data-parent="#comments" href="#collapse{{$quote->id}}" aria-expanded="false">
          <i class="fa fa-reply"></i> Contestar
        </a>
      </div>
      <!-- /.comment-reply -->
    </div>
    <!-- /.comment-header -->
    <div class="comment-content-wrapper">
      <div class="comment-content">
        {{$quote->textBody}}
      </div>
      <!-- /.comment-content -->
    </div>
    <!-- /.comment-content-wrapper -->
  </div>
  <div id="collapse{{$quote->id}}" class="panel-body panel-collapse collapse" aria-expanded="false">
    @include('blogLaravel::forms.formResponderComentario',$comment)
  </div>
  <!-- /.comment -->
</div>
@foreach($quote->quotedBy as $quote)
  @include('blogLaravel::front.layouts.posts.commentariosSegundoNivel',$quote)
@endforeach