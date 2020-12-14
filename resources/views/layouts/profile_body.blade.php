@section('body')


    <div class="wrapper row3">
        <main class="hoc container clear">
            <div class="content">
                <div id="gallery">
                    <figure>

                        <div class="bg-light container-fluid p-4 mb-5 rounded-lg ">
                            <div class="row align-items-center">
                                <div class="col-4 mx-auto" >
                                    <form method="post" id="editProfileForm" action="javascript:void(0)">
                                        @php

                                        @endphp
                                        <input hidden id="userId" value="{{$user->id}}"/>
                                        <div class="form-group">
                                            <label>Firstname</label>
                                            <input id="firstnameInput" type="text" name="firstname" class="form-control p_input" value="{{$user->firstname}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Lastname</label>
                                            <input id="lastnameInput" type="text" name="lastname" class="form-control p_input" value="{{$user->lastname}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input id="nameInput" type="text" name="name" class="form-control p_input" value="{{$user->name}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input id="emailInput" type="email" name="email" class="form-control p_input" value="{{$user->email}}">
                                        </div>
                                        {{--<div class="form-group">
                                            <label>Password</label>
                                            <input id="passwordInput" type="password" name="password" class="form-control p_input" >
                                        </div>--}}


                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block enter-btn save_profile_btn">Сохранить</button>
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
