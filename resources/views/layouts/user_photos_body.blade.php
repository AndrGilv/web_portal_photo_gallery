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
                        <div class="bg-light container-fluid p-4 mb-5 rounded-lg">
                            <form class="download_photo_form">
                                <div class="form-group">
                                    <label for="photo_name">Название фото</label>
                                    <input class="form-control" id="photo_name" type="text" placeholder="Введите название фото"/>
                                </div>
                                <div class="form-group">
                                    <label for="photo_date">Дата съёмки</label>
                                    <input class="form-control" id="photo_date" type="date" value="{{\Carbon\Carbon::now()->toDateString()}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="photo_description">Описание</label>
                                    <input class="form-control" id="photo_description" type="text" placeholder="Введите описание фото"/>
                                </div>
                                <div class="form-group">
                                    <label for="photo_location">Место съёмки</label>
                                    <input class="form-control" id="photo_location" type="text" placeholder="Введите место съёмки фото"/>
                                </div>
                                <div class="form-group">
                                    <label for="photo_story">Историю фото</label>
                                    <input class="form-control" id="photo_story" type="text" placeholder="Введите историю фото"/>
                                </div>
                                <input hidden id="photographer_id" value="{{Auth::id()}}"/>
                                <div class="form-group">
                                    <label for="category_select">Категория</label>
                                    <select class="form-control" id="category_select">
                                        @foreach($categories as $category)
                                            <option id="category_{{$category->id}}">{{$category->category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="photo_file">Фото</label>
                                    <input type="file" class="form-control-file" id="photo_file" name="photo_file" >
                                </div>
                                <div class="row">
                                    <div class="col col-md-12 d-flex justify-content-center ">
                                        <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                             alt="preview image" style="max-height: 500px;">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary download_photo_btn" id="download_photo_btn">Загруить фото</button>
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

                                        <hr/>
                                        <div class="row">
                                            <a class="btn btn-secondary mr-3" href="/edit_photo/{{$photo->id}}">Отредактировать фото</a>
                                            <a class="btn btn-danger deletePhotoBtn" id="photo_{{$photo->id}}" >Удалить фото</a>
                                        </div>
                                        <hr/>

                                        <div id="comments{{$photo->id}}">
                                            <button id="show_first_comments{{$photo->id}}" class="btn btn-primary show_first_comments">Раскрыть комментарии к фото</button>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

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
