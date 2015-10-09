<div class="widget">
    <h2 class="widgettitle">Categorias</h2>
    <ul class="menu">
        @foreach ($categorias as $categoria) 
        <li><a href="{!! route('postByCategory', ['id'=>$categoria['id']]) !!}">{{ $categoria['name'] }}</a></li>
        @endforeach
    </ul>
</div>