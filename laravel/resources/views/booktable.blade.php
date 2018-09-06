<table id="table" class="table table-bordered table-hover" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
    <thead>
    <tr>
        <th data-field="author" data-sortable="true">Обложка</th>
        <th data-field="author" data-sortable="true">Автор</th>
        <th data-field="book" data-filter-control="input" data-sortable="true">Книга</th>
        <th data-field="year" data-filter-control="select" data-sortable="true">Год</th>
        <th data-field="year" data-filter-control="select" data-sortable="true">Жанр</th>
        <th data-field="score" data-filter-control="select" data-sortable="true">
            <label for="sort_type" id="sort"><i class="fa fa-sort"></i>Рейтинг</label>
            <input id="sort_type" name="sort_type" type="hidden" value="{{$sortRule}}" onchange='location=value'>
        </th>
    </tr>
    </thead>
    <tbody>

    @foreach($books as $book)
        <tr>
            <td>
                <img src="{{asset($book['bookimage'])}}" width="50px">
            </td>
            <td>
                @foreach($book['bookauthors'] as $author)
                    <a href="{{route('author/authorid', $author->id)}}">{{$author->authorname}}</a>&nbsp
                @endforeach
            </td>
            <td>
                <a href="{{route('book/bookid', $book['bookid'])}}">{{$book['bookname']}}</a>
            </td>
            <td>
                {{$book['bookpublicyear']}}
            </td>
            <td>
                {{$book['themaname']}}
            </td>
            <td>
                {{$book['score']}}
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
<nav aria-label="books">
    <ul class="pagination justify-content-center">

        @if(isset($id))
            @if($currentPage > $firstPage)
                <li class="page-item"><a class="page-link" href="{{route($href, ['id'=>$id, 'authorid'=>$authorid, 'pageid'=>($currentPage-1), 'sortRule'=>$sortRule])}}">Предыдущая</a></li>
            @endif

            @for($i=$firstPage; $i<=$allPages; $i++)
                @if($i==$currentPage)
                    <li class="page-item active"><a class="page-link" href="{{route($href, ['id'=>$id, 'authorid'=>$authorid, 'pageid'=>$i, 'sortRule'=>$sortRule])}}">{{$i}}</a></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{route($href, ['id'=>$id, 'authorid'=>$authorid, 'pageid'=>$i, 'sortRule'=>$sortRule])}}">{{$i}}</a></li>
                @endif
            @endfor

            @if(($currentPage)<$allPages)
                <li class="page-item"><a class="page-link" href="{{route($href, ['id'=>$id, 'authorid'=>$authorid, 'pageid'=>($currentPage + 1), 'sortRule'=>$sortRule])}}">Следующая</a></li>
            @endif
        @else

            @if($currentPage > $firstPage)
                <li class="page-item"><a class="page-link" href="{{route($href, ['authorid'=>$authorid, 'pageid'=>($currentPage-1), 'sortRule'=>$sortRule])}}">Предыдущая</a></li>
            @endif

            @for($i=$firstPage; $i<=$allPages; $i++)
                @if($i==$currentPage)
                        <li class="page-item active"><a class="page-link" href="{{route($href, ['authorid'=>$authorid, 'pageid'=>$i, 'sortRule'=>$sortRule])}}">{{$i}}</a></li>
                @else
                        <li class="page-item"><a class="page-link" href="{{route($href, ['authorid'=>$authorid, 'pageid'=>$i, 'sortRule'=>$sortRule])}}">{{$i}}</a></li>
                @endif
            @endfor

            @if(($currentPage)<$allPages)
                <li class="page-item"><a class="page-link" href="{{route($href, ['authorid'=>$authorid, 'pageid'=>($currentPage + 1), 'sortRule'=>$sortRule])}}">Следующая</a></li>
            @endif

        @endif
    </ul>
</nav>