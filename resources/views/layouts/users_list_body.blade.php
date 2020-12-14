@section('body')


    <div class="wrapper row3">
        <main class="hoc container clear">
            <div class="content">
                <div id="gallery">
                    <figure>
                        @php

                        @endphp

                        <div class="users_list">
                            @foreach($users as $user)
                                <div class=" row bg-light container-fluid p-3 mb-3 rounded-lg " id="user_card_{{$user->id}}">
                                    <p class="col-3 mr-3 my-auto">{{$user->fio}}</p>
                                    <p class="col-4 mr-3 my-auto">{{$user->email}}</p>
                                    <a class="col-auto btn btn-primary mr-3 editUserBtn" id="edit_user_{{$user->id}}" href="/profileById/{{$user->id}}">Редактировать</a>
                                    <a class=" col-auto btn btn-primary deleteUserBtn" id="delete_user_{{$user->id}}">Удалить</a>
                                </div>
                            @endforeach
                            {{$users->links()}}

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
