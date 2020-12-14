@section('body')


    <div class="wrapper row3">
        <main class="hoc container clear">
            <div class="content">
                <div id="gallery">
                    <figure>

                        <div class="bg-light container-fluid p-4 mb-5 rounded-lg ">
                            <div class="row align-items-center">
                                <div class="col mx-auto" >
                                    <form method="POST" id="editPhotoForm" action="/edit_photo">
                                        @php
                                            $user = Auth::user();
                                            $categories = \App\Models\Category::all();
                                        @endphp
                                        <div class="row">
                                            <div class="col col-md-12 d-flex justify-content-center ">
                                                <img class="p-3 " src="{{$photo->photo_url}}">
                                            </div>
                                        </div>
                                        <input hidden id="userId" value="{{Auth::id()}}"/>
                                        <input hidden id="photoId" value="{{$photo->id}}"/>
                                        <div class="form-group">
                                            <label>Название фото</label>
                                            <input id="photo_name" type="text" name="photo_name" class="form-control p_input" value="{{$photo->name}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="category_select">Категория</label>
                                            <select class="form-control" id="category_select">
                                                @foreach($categories as $category)
                                                    @if($category->id == $photo->category_id)
                                                        <option selected id="category_{{$category->id}}">{{$category->category}}</option>
                                                    @else
                                                        <option id="category_{{$category->id}}">{{$category->category}}</option>
                                                    @endif

                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>История фото</label>
                                            <input id="photo_story" type="text" name="photo_story" class="form-control p_input" value="{{$photo->story}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Описание фото</label>
                                            <input id="photo_description" type="text" name="photo_description" class="form-control p_input" value="{{$photo->description}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Место съёмки фото</label>
                                            <input id="photo_location" type="text" name="photo_location" class="form-control p_input" value="{{$photo->location}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="photo_date">Дата съёмки</label>
                                            <input class="form-control" id="photo_date" type="date" value="{{$date}}"/>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block enter-btn save_photo_btn">Сохранить</button>
                                        </div>


                                    </form>
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
