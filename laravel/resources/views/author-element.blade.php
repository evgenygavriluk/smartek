@include('header')

<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h1>
                    <?=$h1;?>
                </h1>

                <ul class="list-group">
                    @foreach($books[0] as $book)
                        <li class="list-group-item">
                            <img src="{{asset('pic/books/'.$book['bookimage'])}}" width="50px">
                            <a href="{{route('book/bookid', $book['bookid'])}}">{{$book['bookname']}}</a>
                        </li>
                    @endforeach
                </ul>

                @if(isset($books[1]))
                <ul class="list-group"><h5>Книги в соавторстве</h5>
                    @foreach($books[1] as $book)
                        <li class="list-group-item">
                            <img src="{{asset('pic/books/'.$book['bookimage'])}}" width="50px">
                            <a href="{{route('book/bookid', $book['bookid'])}}">{{$book['bookname']}}</a>
                        </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>

    </div>
</section>

@include('footer')