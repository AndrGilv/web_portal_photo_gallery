/*if ($("#editProfileForm").length > 0) {
            $("#editProfileForm").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 50
                    },
                    email: {
                        required: true,
                        maxlength: 50,
                        email: true,
                    },
                    firstname: {
                        required: true
                    },
                    lastname: {
                        required: true
                    },
                    password: {
                        required: true
                    },
                },
                messages: {
                    name: {
                        required: "Please enter name",
                        maxlength: "Your name maxlength should be 50 characters long."
                    },
                    email: {
                        required: "Please enter valid email",
                        email: "Please enter valid email",
                        maxlength: "The email name should less than or equal to 50 characters",
                    },
                    firstname: {
                        required: "Please enter firstname",
                    },
                    lastname: {
                        required: "Please enter lastname",
                    },
                    password: {
                        required: "Please enter password",
                    },
                },
                submitHandler: function(form) {
                    alert('2')
                    $('.save_profile_btn').html('Please Wait...');
                    $(".save_profile_btn"). attr("disabled", true);
                    $.ajax({
                        url: "/edit_profile",
                        type: "POST",
                        data: $('#editProfileForm').serialize(),
                        success: function( response ) {
                            $('#submit').html('Submit');
                            $("#submit"). attr("disabled", false);
                            alert('Ajax form has been submitted successfully');
                            //document.getElementById("contactUsForm").reset();
                        },
                        error: function(data){
                            console.log(data);
                        }

                    });
                }
            })
        }*/
$(document).ready(function ()
{
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $(document).on('click', '.deleteUserBtn',  function(event){
        event.preventDefault();

        var idString = $(this).attr('id');
        var userId = idString.replace("delete_user_", "");
        var userCardId = "user_card_" + userId;
        console.log("id value = ",userId);

        $.ajax({
            type:'post',
            url: "/delete_user",
            data: {userId:userId},
            dataType: 'json',
            success: (data) => {
                alert('Пользователь успешно удалено!')
                $("#"+userCardId).remove();
            },
            error: function(data){
                console.log(data);
            }
        });

    });

    $(document).on('click', '.deletePhotoBtn',  function(event){
        event.preventDefault();

        var idString = $(this).attr('id');
        var photoId = idString.replace("photo_", "");
        var photoCardId = "photo_card_" + photoId;
        console.log("id value = ",photoId);

        $.ajax({
            type:'post',
            url: "/delete_photo",
            data: {photoId:photoId},
            dataType: 'json',
            success: (data) => {
                alert('Фото успешно удалено!')
                $("#"+photoCardId).remove();
            },
            error: function(data){
                console.log(data);
            }
        });

    });

    $(document).on('click', '.save_photo_btn',  function(event){
        event.preventDefault();

        var category = $('#category_select').find(":selected").attr('id');
        var categoryId = category.replace("category_", "");
        var userId = $('#userId').val();
        var photoId = $('#photoId').val();
        var photoStory = $('#photo_story').val();
        var photoLocation = $('#photo_location').val();
        var photoDescription = $('#photo_description').val();
        var photoName = $('#photo_name').val();
        var photoDate = $('#photo_date').val();
        console.log(category + "\n" + categoryId + "\n" + userId  + "\n" + photoStory + "\n"
            + photoLocation + "\n" + photoDescription + "\n" + photoName + '\n' + photoDate +'\n'+photoId);


        $.ajax({
            type:'POST',
            url: "/edit_photo",
            data: {categoryId:categoryId, userId:userId, photoStory:photoStory, photoLocation:photoLocation,
                photoDescription:photoDescription, photoName:photoName, photoDate:photoDate, photoId:photoId},
            dataType: 'json',
            success: (data) => {
                alert('Фото успешно изменено!')
            },
            error: function(data){
                console.log(data);
            }
        });

    });

    $(document).on('click', '.save_profile_btn',  function(event){
        event.preventDefault();
        var userId = $('#userId').val();
        var firstname = $('#firstnameInput').val();
        var lastname = $('#lastnameInput').val();
        var name = $('#nameInput').val();
        var email = $('#emailInput').val();
        //var password = $('#passwordInput').val();


        console.log(userId + "\n" + firstname + "\n" +lastname + "\n" +name + "\n"+email /*+ "\n" +password*/);

        $.ajax({
            type:'POST',
            url: "/edit_profile",
            data: {userId:userId, firstname:firstname, lastname:lastname, name:name,
                email:email},
            dataType: 'json',
            success: (data) => {
                alert("Профиль сохранён")

                /*var photo = data['photo'];
                console.log(photo);

                $('.photo_list').prepend(`<div class="bg-light container-fluid p-4 mb-5 rounded-lg ">
                                    <p class="card-title"><i>Пользователь: </i>${photo.user.fio}</p>
                                    <p class="card-subtitle"><i>Категория: </i>${photo.category.category}</p>
                                    <div class="row">
                                        <div class="col col-md-12 d-flex justify-content-center ">
                                            <a href="/photo/${photo.id}">
                                                <img class="p-3" src="${photo.photo_url}">
                                            </a>
                                        </div>
                                    </div>
                                    <p><i>Название фото: </i>${photo.name}</p>
                                    <button id="btn_show_${photo.id}" class="btn-primary btn btn_show">Раскрыть детали</button>

                                    <div id="photo_info_${photo.id}" class="photo_info pt-2" style="display: none">
                                        <p><i>Описание: </i>${photo.description}</p>
                                        <p><i>История создания фото: </i>${photo.story}</p>
                                        <p><i>Локация съёмки: </i>${photo.location}</p>
                                        <p><i>Дата создания фото: </i>${photo.date}</p>

                                        <hr/>

                                        <div id="comments${photo.id}">
                                            <button id="show_first_comments${photo.id}" class="btn btn-primary show_first_comments">Раскрыть комментарии к фото</button>

                                        </div>

                                    </div>

                                </div>`);*/
            },
            error: function(data){
                console.log(data);
            }
        });

    });


    $('#photo_file').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview-image-before-upload').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    $(document).on('click', '.download_photo_btn',  function(event){
        event.preventDefault();
        var category = $('#category_select').find(":selected").attr('id');
        var categoryId = category.replace("category_", "");
        var userId = $('#photographer_id').val();
        var imageFile = $('#photo_file').data();
        var photoStory = $('#photo_story').val();
        var photoLocation = $('#photo_location').val();
        var photoDescription = $('#photo_description').val();
        var photoName = $('#photo_name').val();
        var photoDate = $('#photo_date').val();
        console.log(category + "\n" + categoryId + "\n" + userId + "\n" + imageFile + "\n" + photoStory + "\n"
            + photoLocation + "\n" + photoDescription + "\n" + photoName + '\n' + photoDate);

        var formData = new FormData($('.download_photo_form')[0]);
        formData.append('categoryId', categoryId)
        formData.append('userId', userId)
        formData.append('photoStory', photoStory)
        formData.append('photoLocation', photoLocation)
        formData.append('photoDescription', photoDescription)
        formData.append('photoName', photoName)
        formData.append('photoDate', photoDate)
        console.log(formData);


        $.ajax({
            type:'POST',
            url: "/image-upload",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,

            success: (data) => {
                var photo = data['photo'];
                console.log(photo);

                $('.photo_list').prepend(`<div class="bg-light container-fluid p-4 mb-5 rounded-lg ">
                                    <p class="card-title"><i>Пользователь: </i>${photo.user.fio}</p>
                                    <p class="card-subtitle"><i>Категория: </i>${photo.category.category}</p>
                                    <div class="row">
                                        <div class="col col-md-12 d-flex justify-content-center ">
                                            <a href="/photo/${photo.id}">
                                                <img class="p-3" src="${photo.photo_url}">
                                            </a>
                                        </div>
                                    </div>
                                    <p><i>Название фото: </i>${photo.name}</p>
                                    <button id="btn_show_${photo.id}" class="btn-primary btn btn_show">Раскрыть детали</button>

                                    <div id="photo_info_${photo.id}" class="photo_info pt-2" style="display: none">
                                        <p><i>Описание: </i>${photo.description}</p>
                                        <p><i>История создания фото: </i>${photo.story}</p>
                                        <p><i>Локация съёмки: </i>${photo.location}</p>
                                        <p><i>Дата создания фото: </i>${photo.date}</p>

                                        <hr/>

                                        <div id="comments${photo.id}">
                                            <button id="show_first_comments${photo.id}" class="btn btn-primary show_first_comments">Раскрыть комментарии к фото</button>

                                        </div>

                                    </div>

                                </div>`);
                $('.download_photo_form')[0].reset();
                $('#preview-image-before-upload').attr('src', 'https://www.riobeauty.co.uk/images/product_image_not_found.gif');
            },
            error: function(data){
                console.log(data);
            }
        });

    });

    $(document).on('click', '.photo_filter_btn',  function(event){
        event.preventDefault();
        var category = $('#category_select').find(":selected").attr('id');
        var categoryId = category.replace("category_", "");
        var period = $('#period_select').find(":selected").attr('id');
        console.log(category + " " + period);
        jQuery.ajax({
            type : 'GET',
            url : `/photo_list/${categoryId}/${period}`,
            success : function (dataWithPagination) {
                // data = dataWithPagination.data;
                data = dataWithPagination;
                console.log(dataWithPagination);
                $('.photo_list').empty();
                var photosListHtml = "";

                $.each(data, function (index, value) {
                    // console.log(value);
                    photosListHtml += `<div class="bg-light container-fluid p-4 mb-5 rounded-lg ">
                                    <p class="card-title"><i>Пользователь: </i>${value.user.fio}</p>
                                    <p class="card-subtitle"><i>Категория: </i>${value.category.category}</p>
                                    <div class="row">
                                        <div class="col col-md-12 d-flex justify-content-center ">
                                            <a href="/photo/${value.id}">
                                                <img class="p-3" src="${value.photo_url}">
                                            </a>
                                        </div>
                                    </div>
                                    <p><i>Название фото: </i>${value.name}</p>
                                    <button id="btn_show_${value.id}" class="btn-primary btn btn_show">Раскрыть детали</button>

                                    <div id="photo_info_${value.id}" class="photo_info pt-2" style="display: none">
                                        <p><i>Описание: </i>${value.description}</p>
                                        <p><i>История создания фото: </i>${value.story}</p>
                                        <p><i>Локация съёмки: </i>${value.location}</p>
                                        <p><i>Дата создания фото: </i>${value.date}</p>

                                        <hr/>

                                        <div id="comments${value.id}">
                                            <button id="show_first_comments${value.id}" class="btn btn-primary show_first_comments">Раскрыть комментарии к фото</button>

                                        </div>

                                    </div>

                                </div>`;

                });
                // photosListHtml += `${dataWithPagination.links}`;


                $('.photo_list').html(photosListHtml);
            },
            error: function (JSONrequest, status, error) {
                var request = jQuery.parseJSON( JSONrequest.responseText );
                alert(request.message);
            }
        });
    });


    $(document).on('click', '.show_first_comments',  function(event){
        event.preventDefault();
        var idString = $(this).attr('id');
        var id = idString.replace("show_first_comments", "");
        var commentsDivId = "comments" + id;
        var userId = $('meta[name="user-id"]').attr('content')
        jQuery.ajax({
            type : 'GET',
            url : `/photo/${id}/first_comments`,
            success : function (data) {

                $(commentsDivId).empty();
                var commentsHtml = "<p>Комментарии</p>";
                if(userId !== ""){
                    commentsHtml += `<form id="send_comment_form_${id}">
                                        <div class="form-group">
<!--                                            <label for="commentText${id}">Комментарий</label>-->
                                            <input type="text" class="form-control comment_text" id="commentText${id}" placeholder="Ваш комментарий...">
                                        </div>
                                        <input hidden type="text" class="comment_photo_id" value="${id}">
                                        <input hidden type="text" class="comment_user_id" value="${userId}">
                                        <button type="submit" class="btn btn-primary send_comment_btn" id="send_comment_btn_${id}">Отправить комментарий</button>
                                    </form>`;
                }
                commentsHtml += `<div class="p-2" id="comments_list_${id}">`;
                if(data.length > 0){
                    $.each(data, function (index, value) {
                        console.log(value);
                        commentsHtml += `<div class="mb-3" id="${value.id}">`+
                            `<p class="m-0"><i>Пользователь: </i>${value.user.fio}</p>`+
                            `<p class="m-0"><i>Дата: </i>${value.date}</p>`+
                            `<p class="m-0"><i>Комментарий: </i>${value.comment}</p></div>`;
                    });
                    if(data.length >= 3){
                        commentsHtml += `</div> <button id="show_all_comments_btn_${id}" class="btn pt-2 show_all_comments_btn">Показать весь список комментариев</button>`;
                    }

                }


                /*$('#article_list').prepend('<tr id="line'+ article.id +'" style="display: flex">\n' +
                    '                <td class="lineID">'+ article.id +'</td>\n' +
                    '                <td class="lineTitle">'+ article.title +'</td>\n' +
                    '                <td class="lineDesc">'+ article.description +'</td>\n' +
                    '                <td class="lineAge">'+ age.name +'</td>\n' +
                    '                <td class="lineKind">'+ kind.kind +'</td>\n' +
                    '                <td>\n' +
                    '                    <form  class="updateForm" style="display: inline-block;">\n' +
                    /!*'                        <input type="hidden" name="_method" value="PUT">\n' +*!/
                    '                        <input class="updateId" type="hidden" name="id" value='+ article.id +'>\n' +
                    '                        <button class="updateBtn" type="submit" style="outline: none;  border: 0; background: transparent;  ">\n' +
                    '                            <span class="glyphicon  glyphicon-pencil" style="color: #2a6496"></span>\n' +
                    '                        </button>\n' +
                    '                    </form>\n' +
                    '                    <form  class="deleteForm" style="display: inline-block;">\n' +
                    /!* '                        <input type="hidden" name="_method" value="DELETE">\n' +*!/
                    '                        <input class="deleteId" type="hidden" name="id" value='+ article.id +'>\n' +
                    '                        <button class="deleteBtn" type="submit" style="outline: none;  border: 0; background: transparent;  ">\n' +
                    '                            <span class="glyphicon  glyphicon-remove" style="color: #2a6496"></span>\n' +
                    '                        </button>\n' +
                    '                    </form>\n' +
                    '                </td>\n' +
                    '            </tr>');
                $('#title').val('')
                $('#description').val('')*/
                console.log(commentsHtml);
                $(`#${commentsDivId}`).html(commentsHtml);
            },
            error: function (JSONrequest, status, error) {
                var request = jQuery.parseJSON( JSONrequest.responseText );
                alert(request.message);
            }
        });
    });

    $(document).on('click', '.show_all_comments_btn',  function(event) {

        event.preventDefault();
        var idString = $(this).attr('id');
        var id = idString.replace("show_all_comments_btn_", "");
        var commentsDivId = "comments_list_" + id;
        jQuery.ajax({
            type : 'GET',
            url : `/photo/${id}/all_comments`,
            success : function (data) {

                $(commentsDivId).empty();
                var commentsHtml = "";
                $.each(data, function (index, value) {
                    console.log(value);
                    commentsHtml += `<div class="mb-3" id="${value.id}">`+
                        `<p class="m-0"><i>Пользователь: </i>${value.user.fio}</p>`+
                        `<p class="m-0"><i>Дата: </i>${value.date}</p>`+
                        `<p class="m-0"><i>Комментарий: </i>${value.comment}</p></div>`;
                    /*{{--<p>Комментарии</p>
                    @for($i = 0; $i < ($photo->comments->count() > 5? 5 : $photo->comments->count()); $i++)
                    <div class="mb-3" id="{{$photo->comments[$i]->id}}">
                            <p class="m-0"><i>Пользователь: </i>{{$photo->comments[$i]->user->fio}}</p>
                        <p class="m-0"><i>Дата: </i>{{$photo->comments[$i]->date}}</p>
                        <p class="m-0"><i>Комментарий: </i>{{$photo->comments[$i]->comment}}</p>
                        </div>

                    @endfor
                    <button id="show_all_comments_btn_{{$photo->id}}" class="btn pt-2 show_all_comments_btn">Показать весь список комментариев</button>--}}*/
                });


                /*$('#article_list').prepend('<tr id="line'+ article.id +'" style="display: flex">\n' +
                    '                <td class="lineID">'+ article.id +'</td>\n' +
                    '                <td class="lineTitle">'+ article.title +'</td>\n' +
                    '                <td class="lineDesc">'+ article.description +'</td>\n' +
                    '                <td class="lineAge">'+ age.name +'</td>\n' +
                    '                <td class="lineKind">'+ kind.kind +'</td>\n' +
                    '                <td>\n' +
                    '                    <form  class="updateForm" style="display: inline-block;">\n' +
                    /!*'                        <input type="hidden" name="_method" value="PUT">\n' +*!/
                    '                        <input class="updateId" type="hidden" name="id" value='+ article.id +'>\n' +
                    '                        <button class="updateBtn" type="submit" style="outline: none;  border: 0; background: transparent;  ">\n' +
                    '                            <span class="glyphicon  glyphicon-pencil" style="color: #2a6496"></span>\n' +
                    '                        </button>\n' +
                    '                    </form>\n' +
                    '                    <form  class="deleteForm" style="display: inline-block;">\n' +
                    /!* '                        <input type="hidden" name="_method" value="DELETE">\n' +*!/
                    '                        <input class="deleteId" type="hidden" name="id" value='+ article.id +'>\n' +
                    '                        <button class="deleteBtn" type="submit" style="outline: none;  border: 0; background: transparent;  ">\n' +
                    '                            <span class="glyphicon  glyphicon-remove" style="color: #2a6496"></span>\n' +
                    '                        </button>\n' +
                    '                    </form>\n' +
                    '                </td>\n' +
                    '            </tr>');
                $('#title').val('')
                $('#description').val('')*/
                console.log(commentsHtml);
                $(`#${commentsDivId}`).html(commentsHtml);
                $(`#show_all_comments_btn_${id}`).hide();
            },
            error: function (JSONrequest, status, error) {
                var request = jQuery.parseJSON( JSONrequest.responseText );
                alert(request.message);
            }
        });
    });

    $(document).on('click', '.send_comment_btn',  function(event){
        event.preventDefault();
        var idString = $(this).attr('id');
        var id = idString.replace("send_comment_btn_", "");
        var form = $(`#send_comment_form_${id}`);

        var photoId = $(`#send_comment_form_${id} .comment_photo_id`).val();
        var userId = $(`#send_comment_form_${id} .comment_user_id`).val();
        console.log("photoId = ", photoId);
        console.log("userId = ", userId);

        var commentText = $(`#send_comment_form_${id} .comment_text`).val();
        console.log("commentText = ", commentText);

        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        jQuery.ajax({
            type : 'POST',
            url : "/create_comment",
            dataType: 'json',
            data : {comment:commentText, user_id: userId, photo_id: photoId },
            success : function (data) {
                var comment = data['comment'];
                var userFio = data['userFio'];

                $(`#comments_list_${id}`).prepend(`<div class="mb-3" id="${comment.id}">
                                                <p class="m-0"><i>Пользователь: </i>${userFio}</p>
                                                <p class="m-0"><i>Дата: </i>${comment.date}</p>
                                                <p class="m-0"><i>Комментарий: </i>${comment.comment}</p>
                                            </div>`);


            },
            error: function (JSONrequest, status, error) {
                var request = jQuery.parseJSON( JSONrequest.responseText );
                console.log(request.message)

            }
        });
    });

    $(document).on('click', '.btn_show',  function(event){

        var idString = $(this).attr('id');
        var id = "photo_info_" + idString.replace("btn_show_", "");
        console.log("id value = ",id);
        $(`#${id}`).toggle('show');
    });


});


