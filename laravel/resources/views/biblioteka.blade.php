@include('header')

<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h1>
                    <?=$h1;?>
                </h1>
                <ul>
                    @foreach($biblioteks as $biblioteka)
                        <li>
                            <a href="{{route('biblioteka/bibliotekaid' ,$biblioteka['bibliotekaid'])}}">{{$biblioteka['bibliotekatitle']}}</a>
                            На хранении {{$biblioteka['countBooks']}} книг
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
</section>

@include('footer')
