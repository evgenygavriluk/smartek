@include('header')

<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h1>
                    <?=$h1;?>
                </h1>
                <?=$adress; ?><br />

                    <select id="authorid" name="authorid" onchange='location=value'>
                        <option value="{{route('biblPageAuthor/authorid',['bibliotekaid'=>$id, 'authorid'=>0, 'pageid'=>$currentPage ])}}">Все авторы</option>

                        @foreach($authors as $a)
                            @if($a['authorid']==$authorid)
                                <option value="{{route('biblPageAuthor/authorid',['bibliotekaid'=>$id, 'authorid'=>$a['authorid'], 'pageid'=>$currentPage ])}}" selected>{{$a['authorname']}}</option>
                            @else
                                <option value="{{route('biblPageAuthor/authorid',['bibliotekaid'=>$id, 'authorid'=>$a['authorid'], 'pageid'=>$currentPage ])}}">{{$a['authorname']}}</option>
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
            window.location = '{{route('biblPageAuthor/sortrule',['bibliotekaid'=>$id, 'authorid'=>$authorid, 'pageid'=>$currentPage, 'sortRule'=>1])}}';
        }
        else {
            window.location = '{{route('biblPageAuthor/sortrule',['bibliotekaid'=>$id, 'authorid'=>$authorid, 'pageid'=>$currentPage, 'sortRule'=>0])}}';
        }
        console.log($("#sort_type").val());
    });
</script>