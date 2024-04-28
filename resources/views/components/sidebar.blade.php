<div class="container">
    @foreach ($major_category_names as $major_category_name)
    <h2 class="major_category_name">{{$major_category_name}}</h2>
    @foreach ($categories as $category)
    @if ($category->major_category_name===$major_category_name)
    <label class=""><a href="{{route('posts.index',['category'=>$category->id])}}">{{$category->name}}</a></label>
    @endif
    @endforeach
    @endforeach
</div>