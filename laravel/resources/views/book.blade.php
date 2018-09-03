@include('header')

<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h1>{{$h1}}</h1>

                    <select id="authorid" name="authorid" onchange='location=value'>
                        <option value="{{route('bookPageAuthor/authorid',['pageid'=>$currentPage, 'authorid'=>0])}}">Все авторы</option>

                        @foreach($authors as $a)
                            @if($a['authorid']==$authorid)
                                <option value="{{route('bookPageAuthor/authorid',['authorid'=>$a['authorid'], 'pageid'=>$currentPage ])}}" selected>{{$a['authorname']}}</option>
                            @else
                                <option value="{{route('bookPageAuthor/authorid',['authorid'=>$a['authorid'], 'pageid'=>$currentPage ])}}">{{$a['authorname']}}</option>
                            @endif
                        @endforeach

                    </select>

                @include('booktable')
            </div>
        </div>
    </div>
</section>


@include('footer')
<script>
    $("#sort").click(function() {
        if($("#sort_type").val() == 0){
            window.location = '{{route('bookPageAuthor/sortrule',['authorid'=>$authorid, 'pageid'=>$currentPage, 'sortRule'=>1])}}';
        }
        else {
            window.location = '{{route('bookPageAuthor/sortrule',['authorid'=>$authorid, 'pageid'=>$currentPage, 'sortRule'=>0])}}';
        }
        console.log($("#sort_type").val());
    });
</script>