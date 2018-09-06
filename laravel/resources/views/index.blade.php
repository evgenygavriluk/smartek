@include('header')

    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <h1>{{$h1}}</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="best_books">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <h2>Лучшие книги</h2>
                    <div class="card-deck">
                        @foreach($bestFiveBooks as $book)
                            <div class="card border-secondary mb-3" style="width: 18rem;">
                                <img class="card-img-top" src="{{asset('pic/books/'.$book['bookimage'])}}" alt="'.$book['bookname'].'">
                                <div class="card-body">
                                    <a href="{{route('book/bookid', $book['bookid'])}}" class="btn btn-primary">Перейти к книге</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </section>

    <section id="popular_authors">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <h2>Авторы многокнижцы</h2>
                    <div class="card-deck">
                        @foreach($popularAuthors as $author)
                            <div class="card border-secondary mb-3" style="width: 18rem;">
                                <img class="card-img-top" src="{{asset('pic/authors/'.$author['authorimage'])}}" alt="{{$author['authorname']}}">
                                <div class="card-body">
                                    <h5>{{$author['authorname']}}</h5>
                                    <a href="{{route('author/authorid', $author['authorid'])}}" class="btn btn-primary">Об авторе</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </section>

    <section id="last_comments">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <h2>Последние отзывы</h2>
                    <div class="card-deck">
                        @foreach($lastFiveComments as $comment)
                            <div class="card border-secondary mb-3" style="max-width: 18rem;">
                                <div class="card-header">{{$comment->commentatorname}} прокомментировал книгу
                                    <a href="{{route('book/bookid', $comment->id)}}">{{$comment->bookname}}</a>
                                </div><div class="card-body">
                                    <p class="card-text">{{$comment->commenttext}}</p>
                                    <small>Поставил баллов: {{$comment->commentraiting}}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@include('footer')