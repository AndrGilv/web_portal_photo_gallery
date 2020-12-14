@section('body')

    {{--@php
        use App\Models\Photo;
        use Illuminate\Support\Facades\Storage;

        $url = Storage::url('test.jpg');
        $photos = Photo::all();
    @endphp

    <div>body</div>
    --}}{{--<img src="{{$url}}">
    <div>{{$url}}</div>--}}{{--
--}}{{--    <div>{{$data}}</div>--}}{{--
    @foreach($photos as $photo)
        <p>user: {{$photo->user->fio}}</p>
        <img src="{{$photo->photo_url}}">
        <p>name: {{$photo->name}}</p>
        <p>description: {{$photo->description}}</p>
        <p>story: {{$photo->story}}</p>
        <p>location: {{$photo->location}}</p>
        <p>date: {{$photo->date}}</p>
        <br>
        <br>
        <br>
        <br>
    @endforeach--}}
    <div class="wrapper row3">
        <main class="hoc container clear">
            <!-- main body -->
            <!-- ################################################################################################ -->
            <div class="content">
                <!-- ################################################################################################ -->
                <div id="gallery">
                    <figure>
                        {{--<header class="heading">Gallery Title Goes Here</header>--}}
                        @php
                            use App\Models\Photo;
                            use Illuminate\Support\Facades\Storage;

                            /*$url = Storage::url('test.jpg');*/
                            $categories = \App\Models\Category::all();
                        @endphp

                        <div class="bg-light container-fluid p-4 mb-5 rounded-lg">
                            <form class="photo_filter_form">
                                <div class="form-group">
                                    <label for="category_select">Категория</label>
                                    <select class="form-control" id="category_select">
                                        <option id="category_all" selected>Все категории</option>
                                        @foreach($categories as $category)
                                            <option id="category_{{$category->id}}">{{$category->category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="period_select">Период</label>
                                    <select class="form-control" id="period_select">
                                        <option id="period_all" selected>Все время</option>
                                        <option id="year" >Последний год</option>
                                        <option id="month" >Последний месяц</option>
                                        <option id="weak" >Последняя неделя</option>
                                        <option id="day" >Последний день</option>
                                    </select>
                                </div>
                                {{--<div class="form-group">
                                    <label for="commentText{{$photo->id}}">Комментарий</label>
                                    <input type="text" class="form-control comment_text" id="commentText{{$photo->id}}" placeholder="Ваш комментарий...">

                                </div>--}}



                                <button type="submit" class="btn btn-primary photo_filter_btn">Обновить список</button>
                            </form>
                        </div>

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
                                    <button id="btn_show_{{$photo->id}}" class="btn-primary btn btn_show">Раскрыть детали</button>

                                    <div id="photo_info_{{$photo->id}}" class="photo_info pt-2" style="display: none">
                                        <p><i>Описание: </i>{{$photo->description}}</p>
                                        <p><i>История создания фото: </i>{{$photo->story}}</p>
                                        <p><i>Локация съёмки: </i>{{$photo->location}}</p>
                                        <p><i>Дата создания фото: </i>{{$photo->date}}</p>

                                        @if(Auth::id() == $photo->user_id)
                                            <hr/>
                                            <div class="row">
                                                <a class="btn btn-secondary mr-3" href="/edit_photo/{{$photo->id}}">Отредактировать фото</a>
                                                <a class="btn btn-danger deletePhotoBtn" id="photo_{{$photo->id}}" >Удалить фото</a>
                                            </div>
                                        @endif
                                        <hr/>

                                        <div id="comments{{$photo->id}}">
                                            <button id="show_first_comments{{$photo->id}}" class="btn btn-primary show_first_comments">Раскрыть комментарии к фото</button>
                                            {{--<p>Комментарии</p>
                                            @for($i = 0; $i < ($photo->comments->count() > 5? 5 : $photo->comments->count()); $i++)
                                                <div class="mb-3" id="{{$photo->comments[$i]->id}}">
                                                    <p class="m-0"><i>Пользователь: </i>{{$photo->comments[$i]->user->fio}}</p>
                                                    <p class="m-0"><i>Дата: </i>{{$photo->comments[$i]->date}}</p>
                                                    <p class="m-0"><i>Комментарий: </i>{{$photo->comments[$i]->comment}}</p>
                                                </div>

                                            @endfor
                                            <button id="show_all_comments_btn_{{$photo->id}}" class="btn pt-2 show_all_comments_btn">Показать весь список комментариев</button>--}}
                                        </div>

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
