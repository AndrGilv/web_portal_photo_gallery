@section('body')


    <div class="wrapper row3">
        <main class="hoc container clear">
            <div class="content">
                <div id="gallery">
                    <figure>

                        <div class="bg-light container-fluid p-4 mb-5 rounded-lg ">
                            <p class="card-title"><i>Пользователь: </i>{{$photo->user->fio}}</p>
                            <p class="card-subtitle"><i>Категория: </i>{{$photo->category->category}}</p>
                            <div class="row">
                                <div class="col col-md-12 d-flex justify-content-center ">
                                    <img class="p-3 " src="{{$photo->photo_url}}">
                                </div>
                            </div>
                            <p><i>Название фото: </i>{{$photo->name}}</p>

                            <div id="photo_info_{{$photo->id}}" class="photo_info pt-2" >
                                <p><i>Описание: </i>{{$photo->description}}</p>
                                <p><i>История создания фото: </i>{{$photo->story}}</p>
                                <p><i>Локация съёмки: </i>{{$photo->location}}</p>
                                <p><i>Дата создания фото: </i>{{$photo->date}}</p>

                                <hr/>

                                <div id="comments{{$photo->id}}">

                                    <p>Комментарии</p>
                                    @if(Auth::check())
                                        <form id="send_comment_form_{{$photo->id}}">
                                            <div class="form-group">
                                                <input type="text" class="form-control comment_text" id="commentText{{$photo->id}}" placeholder="Ваш комментарий...">
                                            </div>
                                            <input hidden type="text" class="comment_photo_id" value="{{$photo->id}}">
                                            <input hidden type="text" class="comment_user_id" value="{{Auth::id()}}">
                                            <button type="submit" class="btn btn-primary send_comment_btn" id="send_comment_btn_{{$photo->id}}">Отправить комментарий</button>
                                        </form>
                                    @endif
                                    <div class="p-2" id="comments_list_{{$photo->id}}">
                                        @for($i = 0; $i < ($photo->comments->count() > 25? 25 : $photo->comments->count()); $i++)
                                            <div class="mb-3" id="{{$photo->comments[$i]->id}}">
                                                <p class="m-0"><i>Пользователь: </i>{{$photo->comments[$i]->user->fio}}</p>
                                                <p class="m-0"><i>Дата: </i>{{$photo->comments[$i]->date}}</p>
                                                <p class="m-0"><i>Комментарий: </i>{{$photo->comments[$i]->comment}}</p>
                                            </div>
                                        @endfor
                                    </div>
                                    @if($photo->comments->count() >= 25)
                                        <button id="show_all_comments_btn_{{$photo->id}}" class="btn pt-2 show_all_comments_btn">Показать весь список комментариев</button>
                                    @endif

                                </div>

                            </div>

                        </div>

                    </figure>
                </div>

            </div>

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
