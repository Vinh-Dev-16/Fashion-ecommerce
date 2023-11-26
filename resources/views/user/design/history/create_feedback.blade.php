@if (Auth::check())
    <section class="modal-data">
        <div id="review_form" class="review_form">
            <h4>Viết đánh giá của bạn</h4>
            <div class="form_review_user">
                <div class="user_review">
                    <div class="rating">
                        <p>Bạn có thấy hài lòng?</p>
                        <div class="rate_this">
                            <input type="radio" name="rate"
                                   id="star5" value="5">
                            <label for="star5"><i
                                    class="ri-star-fill"></i></label>
                            <input type="radio" name="rate"
                                   id="star4" value="4">
                            <label for="star4"><i
                                    class="ri-star-fill"></i></label>
                            <input type="radio" name="rate"
                                   id="star3" value="3">
                            <label for="star3"><i
                                    class="ri-star-fill"></i></label>
                            <input type="radio" name="rate"
                                   id="star2" value="2">
                            <label for="star2"><i
                                    class="ri-star-fill"></i></label>
                            <input type="radio" name="rate"
                                   id="star1" value="1">
                            <label for="star1"><i
                                    class="ri-star-fill"></i></label>
                        </div>
                    </div>
                    <div style="color:red; margin-bottom: 15px;" class="text-danger error-text rate_error"></div>
                    <p style="margin-bottom: 20px">
                        <label>Tiêu đề</label>
                        <input type="text" name="title"
                               required style="width: 95%">
                    </p>
                    <div style="color:red; margin-bottom: 15px" class="text-danger error-text title_error"></div>

                    <div id="show-image-upload"
                         style="display: flex; align-content: center; justify-content: left; gap: 15px"></div>

                    <div class="wrapper-upload-image">
                        <header>Tải ảnh lên tại đây</header>
                        <form id="form-upload-image" class="dropzone">
                            <input class="file-input" type="file" name="file" multiple hidden>
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Tải ảnh từ thiết bị của bạn</p>
                        </form>
                        <section class="progress-area"></section>
                        <section class="uploaded-area"></section>
                    </div>
                    <label>Nội dung</label>
                    <textarea id="editor" cols="30" rows="15"
                              name="content"></textarea>
                    <div style="color:red; margin-bottom: 15px" class="text-danger error-text content_error"></div>
                    <p>
                        <input type="text" hidden name="name"
                               value="{{ Auth::user()->name }}">
                        <input type="text" hidden name="email"
                               value="{{ Auth::user()->email }}">
                        <input type="text" hidden="hidden" value="{{Auth::user()->id}}" name="user_id">
                    </p>
                </div>
                <button type="submit" onclick="send_feed_back({{ $product->id }})"
                        class="primary_button"
                        style="border:none; outline:none">
                    Đánh giá
                </button>
            </div>
        </div>
    </section>
    <div class="overlay"></div>

@endif
<script defer>
    $(document).ready(function () {
        $('.overlay').addClass('active');
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(newEditor => {
                editor = newEditor;
            })
            .catch(error => {
                console.error(error);
            });
    })
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('overlay')) {
            $('.modal-data').removeClass('active');
            $('.overlay').removeClass('active');
            $('.show-data').html('');
        }
    })

    let currentAjaxCall = null;
    const form = document.querySelector("#form-upload-image"),
        fileInput = document.querySelector(".file-input"),
        progressArea = document.querySelector(".progress-area"),
        uploadedArea = document.querySelector(".uploaded-area");
    let filesImage = [];
    let xhrArray = [];
    if (form) {
        form.addEventListener("click", () => {
            fileInput.click();
        });
    }
    if (fileInput) {
        fileInput.onchange = ({target}) => {
            const files = fileInput.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (file) {
                    let fileName = file.name;
                    if (fileName.length >= 12) {
                        let splitName = fileName.split('.');
                        fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
                    }
                    xhrArray.push(fileName);
                    filesImage.push(file);
                    showImages();
                    uploadFile(fileName);
                }
            }
        }
    }

    function showImages() {
        let images = '';
        filesImage.forEach(file => {
            images += `<div class="image-upload" style="position: relative">
                            <img src="${URL.createObjectURL(file)}" alt="">
                            <i class="fas fa-times remove-image" onclick="removeImage(this)"></i>
                        </div>`;
        });
        $('#show-image-upload').html(images);
    }

    function removeImage(element) {
        let index = $(element).parent().index();
        filesImage.splice(index, 1);
    }

    function uploadFile(name) {
        let data = new FormData();
        let imageLoad = filesImage[filesImage.length - 1];
        data.append("file", imageLoad);
        $.ajax({
            url: "{{ route('history.feedback.load_images') }}",
            method: "POST",
            data: data,
            processData: false,
            contentType: false,
            xhr: function () {
                let xhr = new XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (e) {
                    if (e.lengthComputable) {
                        let fileLoaded = Math.floor((e.loaded / e.total) * 100);
                        let fileTotal = Math.floor(e.total / 1000);
                        let fileSize;
                        if (fileTotal < 1024) {
                            fileSize = fileTotal + " KB";
                        } else {
                            fileSize = (e.loaded / (1024 * 1024)).toFixed(2) + " MB";
                        }
                        let progressHTML = `<li class="row-image">
                                    <i class="fas fa-file-alt"></i>
                                    <div class="content">
                                    <div class="details">
                                        <span class="name">${name} • Uploading</span>
                                        <span class="percent">${fileLoaded}%</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: ${fileLoaded}%"></div>
                                    </div>
                                    </div>
                                </li>`;
                        uploadedArea.classList.add("onprogress");
                        progressArea.innerHTML = progressHTML;
                        if (e.loaded == e.total) {
                            progressArea.innerHTML = "";
                            let uploadedHTML = `<li class="row-image" data-id="${name}">
                                    <div class="content upload">
                                        <i class="fas fa-file-alt"></i>
                                        <div class="details">
                                        <span class="name">${name} • Uploaded</span>
                                        <span class="size">${fileSize}</span>
                                        </div>
                                    </div>
                                    <i class="fas fa-check"></i>
                                    </li>`;
                            uploadedArea.classList.remove("onprogress");
                            uploadedArea.insertAdjacentHTML("afterbegin", uploadedHTML);
                        }
                    }
                });
                return xhr;
            },
            success: function (data) {
                if (data.status == 0) {
                    createToast(data.message);
                }
            }
        })
    }

    // feedback

    function send_feed_back(product_id) {
        let editorContent = editor.getData();
        let rate = $('input[name="rate"]:checked').val();
        let title = $('input[name="title"]').val();
        let name = $('input[name="name"]').val();
        let email = $('input[name="email"]').val();
        let image = [];
        $('.image-upload').each(function () {
            image.push($(this).find('img').attr('src'));
        });
        $.ajax({
            url: "{{ route('history.feedback.store') }}",
            method: "POST",
            data: {
                product_id: product_id,
                rate: rate,
                title: title,
                content: editorContent,
                images: image,
                name: name,
                email: email,
            },
            beforeSend: function () {
                $(document).find('div.text-danger').text('');
            },
            success: function (data) {
                switch (data.status) {
                    case 0:
                        $.each(data.message, function (prefix, val) {
                            $('div.' + prefix + '_error').text(val[0]);
                        });
                        break;
                    case 2:
                        createToast(data.message);
                        break;
                    case 1:
                        $('#review_ul').fadeOut(300, function () {
                            $(this).html(data.view);
                            $(this).fadeIn(300);
                        });
                        editor.setData('');
                        $('.user_review')[0].reset();
                        $('.render_count').text(data.count + ' đánh giá');
                        $('.rate_sum').text(data.rate + ' sao');
                        $('.count_feedback').text(data.count);
                        $('.rate_count_start').text(data.rate);
                        $('#show_rating').html(data.html);
                        $('#show-image-upload').html('');
                        $('.uploaded-area').html('');
                        createNoti(data.message);
                        break;
                }
            },
            error: function (data) {
                createToast('Đã xảy ra lỗi');
            }
        });
    }

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('overlay')) {
            $('.overlay').removeClass('active');
            $('.show-data').html('');
        }
    })
</script>
