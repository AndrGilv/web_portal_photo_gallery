@section('body')
    <div class="wrapper row3">
        <main class="hoc container clear">
            <div class="content">
                <div id="gallery">
                    <figure>
                        @php
                            use App\Models\Photo;
                            use Illuminate\Support\Facades\Storage;

                            /*$url = Storage::url('test.jpg');*/
                            $categories = \App\Models\Category::all();
                        @endphp



                        <div class="photo_list">
                            @foreach($photos as $photo)
                                <div class="bg-light container-fluid p-4 mb-5 rounded-lg " id="photo_card_{{$photo->id}}">
                                    <p class="card-title"><i>Пользователь: </i>{{$photo->user->fio}}</p>
                                    <p class="card-subtitle"><i>Категория: </i>{{$photo->category->category}}</p>
                                    <div class="row">
                                        <div class="col col-md-12 d-flex justify-content-center ">
                                            <a href="/photo/{{$photo->id}}">
                                                <img class="p-3 " src="{{$photo->photo_url}}">
                                            </a>
                                        </div>
                                    </div>
                                    <p><i>Название фото: </i>{{$photo->name}}</p>
                                    <p><i>Описание: </i>{{$photo->description}}</p>
                                    <p><i>История создания фото: </i>{{$photo->story}}</p>
                                    <p><i>Локация съёмки: </i>{{$photo->location}}</p>
                                    <p><i>Дата создания фото: </i>{{$photo->date}}</p>
                                    <hr/>
                                    <div class="row">
                                        <a class="btn btn-secondary mr-3" href="/edit_photo/{{$photo->id}}">Отредактировать фото</a>
                                        <a class="btn btn-danger deletePhotoBtn" id="photo_{{$photo->id}}" >Удалить фото</a>
                                    </div>
                                    <hr/>

                                    <div id="comments{{$photo->id}}">
                                        <button id="show_first_comments{{$photo->id}}" class="btn btn-primary admin_show_first_comments">Раскрыть комментарии к фото</button>

                                    </div>

                                </div>

                            @endforeach
                            {{$photos->links()}}
                        </div>


                        {{--<ul class="nospace clear">
                            <li class="one_quarter first"><a href="#"><img src={{ URL::asset('img/01.png')}} alt=""></a>
                            </li>
                            <li class="one_quarter"><a href="#"><img src={{ URL::asset('img/01.png')}} alt=""></a></li>
                            <li class="one_quarter"><a href="#"><img src={{ URL::asset('img/01.png')}} alt=""></a></li>
                            <li class="one_quarter"><a href="#"><img src={{ URL::asset('img/01.png')}} alt=""></a></li>
                            <li class="one_quarter first"><a href="#"><img src={{ URL::asset('img/01.png')}} alt=""></a>
                            </li>
                            <li class="one_quarter"><a href="#"><img src={{ URL::asset('img/01.png')}} alt=""></a></li>
                            <li class="one_quarter"><a href="#"><img src={{ URL::asset('img/01.png')}} alt=""></a></li>
                            <li class="one_quarter first"><a href="#"><img src={{ URL::asset('img/01.png')}} alt=""></a>
                            </li>
                            <li class="one_quarter"><a href="#"><img src={{ URL::asset('img/01.png')}} alt=""></a></li>
                            <li class="one_quarter"><a href="#"><img src={{ URL::asset('img/01.png')}} alt=""></a></li>
                        </ul>--}}
                        {{--<figcaption>Gallery Description Goes Here</figcaption>--}}
                    </figure>
                </div>
                <!-- ################################################################################################ -->
                <!-- ################################################################################################ -->
            {{--<nav class="pagination">
                <ul>
                    <li><a href="#">&laquo; Previous</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><strong>&hellip;</strong></li>
                    <li><a href="#">6</a></li>
                    <li class="current"><strong>7</strong></li>
                    <li><a href="#">8</a></li>
                    <li><a href="#">9</a></li>
                    <li><strong>&hellip;</strong></li>
                    <li><a href="#">14</a></li>
                    <li><a href="#">15</a></li>
                    <li><a href="#">Next &raquo;</a></li>
                </ul>
            </nav>--}}
            <!-- ################################################################################################ -->
            </div>
            <!-- ################################################################################################ -->
            <!-- / main body -->
            <div class="clear"></div>
        </main>
    </div>
@endsection


<script>
    import Button from "../../js/Jetstream/Button";
    export default {
        components: {Button}
    }
</script>
