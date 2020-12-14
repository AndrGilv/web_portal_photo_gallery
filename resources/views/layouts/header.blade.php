@section('header')
    <div class="wrapper row0">
        <div id="topbar" class="hoc clear">
            <!-- ################################################################################################ -->
            <div class="fl_left">
                <ul class="nospace inline pushright">
                    <li><i class="fa fa-phone"></i> +7 (654) 321 0987</li>
                    <li><i class="fa fa-envelope-o"></i> photo_gallery@gmail.com</li>
                </ul>
            </div>
            <div class="fl_right">
                <ul class="nospace inline pushright">
                    @if(Auth::check())
                        <li><i class="fa fa-user"></i> <a href="#">{{Auth::user()->getFioAttribute()}}</a></li>
                        <li><i class="fa fa-sign-out"></i> <a href={{ URL::route('logout')}}>Выйти</a></li>
                    @else
                        <li><i class="fa fa-sign-in"></i> <a href={{ URL::route('login')}}>Войти</a></li>
                        <li><i class="fa fa-sign-in"></i> <a href={{ URL::route('register')}}>Зарегистрироваться</a></li>
                    @endIf
                </ul>
            </div>





            <!-- ################################################################################################ -->
        </div>
    </div>

    <div class="bgded" style="background-image:url('{{ URL::asset('img/clover-1225988_1920.jpg')}}');">
        <!-- ################################################################################################ -->
        <div class="wrapper overlay">
            <header id="header" class="hoc clear">
                @if(Auth::check())
                <nav id="mainav" class="clear">
                    <!-- ################################################################################################ -->
                    <ul class="clear">
                        <li class="active"><a href="/">Главная</a></li>
                        {{--
                        <li><a class="drop" href="#">Dropdown</a>
                            <ul>
                                <li><a href="#">Level 2</a></li>
                                <li><a class="drop" href="#">Level 2 + Drop</a>
                                    <ul>
                                        <li><a href="#">Level 3</a></li>
                                        <li><a href="#">Level 3</a></li>
                                        <li><a href="#">Level 3</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Level 2</a></li>
                            </ul>
                        </li>--}}
                        {{--@if(Auth::user()->name == 'admin')--}}
                        @if(Auth::user()->currentTeam->name == "admin")
                            <li><a class="drop" href="#">Администрирование</a>
                                <ul>
                                    <li><a href="/admin/users">Пользователи</a></li>
                                    <li><a href="/admin/photos">Фото</a></li>
                                </ul>
                            </li>
                        @endif
                        <li><a href="{{URL::route('user_photos') }}">Мои фото</a></li>
                        <li><a href="{{URL::route('profile') }}">Профиль</a></li>


                        {{--<li><a href="#">Link Text</a></li>
                        <li><a href="#">Long Link Text</a></li>--}}
                    </ul>
                    <!-- ################################################################################################ -->
                </nav>
                @endif
                <div id="logo">
                    <!-- ################################################################################################ -->
                    <h1><a href="#">Photo gallery</a></h1>
                    <p>Фотогалерея которую мы заслужили</p>
                    <!-- ################################################################################################ -->
                </div>
            </header>
        </div>

    </div>


@endsection
