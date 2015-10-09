<h2>Escribe un comentario</h2>
<form class="background-white p20 add-comment" method="post" action="{!! route('createComent', ['id'=>$post->id]) !!}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" id="post_id" name="post_id" value="{{ $post->id }}">
  <p>Campos obligatorios <span class="required">*</span></p>
  <div class="row">
    <div class="form-group col-sm-12">
      <label for="comentario">Comentario  <span class="required">*</span></label>
      <textarea class="form-control" rows="5" id="comentario" name="comentario" required>{{ old('comentario') }}</textarea>
    </div>    
    <div class="col-sm-8">
      <p class="form-allowed-tags" id="form-allowed-tags">You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:  <code>&lt;a href=&quot;&quot; title=&quot;&quot;&gt; &lt;abbr title=&quot;&quot;&gt; &lt;b&gt; &lt;blockquote cite=&quot;&quot;&gt; &lt;cite&gt; &lt;code&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=&quot;&quot;&gt; &lt;s&gt; &lt;strike&gt; &lt;strong&gt; </code></p>
    </div>
    <!-- /.col-sm-8 -->
    <div class="col-sm-4">
      <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-comments"></i>Enviar comentario</button>
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