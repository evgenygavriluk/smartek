@include('header')

<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h1>{{$h1}}</h1>

                <form name="author" action="" method="get">
                    <select id="author" name="author" onchange='this.form.submit();'>
                        <option value="0">Все авторы</option>
                        <?php

                        /*foreach(Author::getAuthors(0) as $elements){
                            $selected='';
                            if(isset($_GET['author']) and $elements['authorid']==$_GET['author']) $selected = 'selected';
                            echo '<option value="' . $elements['authorid'] . '" '.$selected.'>' . $elements['authorname'] . '</option>';
                        }
                            */
                        ?>

                    </select>
                </form>

                @include('booktable')
            </div>
        </div>
    </div>
</section>


@include('footer')
<script>
    $("#sort").click(function() {
        if($("#sort_type").val() == 0) $("#sort_type").val(1);
        else $("#sort_type").val(0);
        $("#sort_form").submit();
        console.log($("#sort_type").val());
    });
</script>