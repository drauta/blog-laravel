<form class="background-white p20 add-comment" method="post" action="{!! route('createComentComent', ['id'=>$post->id]) !!}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" id="post_id" name="post_id" value="{{ $post->id }}">
  <input type="hidden" id="quotedComment" name="quotedComment" value="{{ $comment->id }}">
  <div class="row">
    <div class="form-group col-sm-12">
      <label for="comentario">Respuesta  <span class="required">*</span></label>
      <textarea class="form-control" rows="5" id="comentario" name="comentario" required>{{ old('comentario') }}</textarea>
    </div>
    <div class="col-sm-4 col-sm-offset-8">
      <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-comments"></i>Contestar</button>
    </div>
    <!-- /.col-sm-4 -->
  </div>

  @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <!-- /.row -->
</form>