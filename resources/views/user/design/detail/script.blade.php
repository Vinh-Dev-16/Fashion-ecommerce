<script src="https://cdn.ckeditor.com/ckeditor5/45.0.0/classic/ckeditor.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        ClassicEditor
            .create(document.querySelector('#editor'),{
                simpleUpload: {
                    uploadUrl: '', // Đặt URL tải lên là rỗng để tắt tính năng tải lên
                }
            })
            .then( newEditor => {
                editor = newEditor;
            })
            .catch(error => {
                console.error(error);
            });
    });

    function wishlist() {
        let user_id = $('#user_id').val();
        let product_id = $('#product_id').val();
        let has_love = $('#has-love').val();
        $.ajax({
            url: "{{ route('page_offer.love') }}",
            method: "POST",
            data: {
                user_id: user_id,
                product_id: product_id,
                love: has_love,
            },
            success: function (data) {
                $('#wish_love').fadeOut(300, function () {
                    $(this).html(data.view);
                    $(this).fadeIn(300);
                });
                $('#wishlist_number').text(data.count);
                if (data.status == 0) {
                    $('#has-love').val(1);
                    createNoti('Đã xóa khỏi danh sách yêu thích');
                } else {
                    $('#has-love').val(0);
                    createNoti('Đã thêm vào danh sách yêu thích');
                }
            },
            error: function (data) {
                createToast('Đã xảy ra lỗi');
            }
        });
    }

    const addToCart = document.querySelector('#add_to_cart');

    addToCart.addEventListener('click', (e) => {
        e.preventDefault();
    });
    function add_cart($product_id) {
        var color = $('input[name="color"]:checked').val() ? color = $('input[name="color"]:checked').val() : createToast('Bạn chưa chọn màu');
        var size = $('input[name="size"]:checked').val() ? size = $('input[name="size"]:checked').val() : createToast('Bạn chưa chọn size');
        var stock = $('#stock').val() ? quantity = $('#stock').val() : createToast('Bạn chưa chọn số lượng');
        if (color && size && stock) {
            $.ajax({
                url: "{{ route('cart') }}",
                method: "POST",
                data: {
                    product_id: $product_id,
                    color: color,
                    size: size,
                    quantity: stock,
                },
                success: function (data) {
                    $('#mini_cart').fadeOut(300, function () {
                        $(this).html(data.view);
                        $(this).fadeIn(300);
                    });
                    $('#item_number').text(data.count);
                    $('#card_head').text(data.count);
                    createNoti('Đã thêm vào giỏ hàng');
                    $('#form_cart')[0].reset();
                },
                error: function (data) {
                    createToast('Đã xảy ra lỗi');
                }
            });
        }
    }

    function remove_cart($product_id) {
        $.ajax({
            url: "{{ route('remove_cart') }}",
            method: "POST",
            data: {
                product_id: $product_id,
            },
            success: function (data) {
                $('#mini_cart').fadeOut(200, function () {
                    $(this).html(data.view);
                    $(this).fadeIn(200);
                });
                $('#item_number').text(data.count);
                $('#card_head').text(data.count);
                createNoti('Đã xóa sản phẩm');
            },
            error: function (data) {
                createToast('Đã xảy ra lỗi');
            }
        });
    }


    // upload image

    const form = document.querySelector("#form-upload-image"),
        fileInput = document.querySelector(".file-input"),
        progressArea = document.querySelector(".progress-area"),
        uploadedArea = document.querySelector(".uploaded-area");
    form.addEventListener("click", () =>{
        fileInput.click();
    });
    fileInput.onchange = ({target})=>{
        const files = fileInput.files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if(file) {
                let fileName = file.name;
                if (fileName.length >= 12) {
                    let splitName = fileName.split('.');
                    fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
                }
                uploadFile(fileName);
            }
        }
    }
    function uploadFile(name) {
        let data = new FormData();
        data.append("fileInput", fileInput.files[0]);

        $.ajax({
            type: "POST",
            url: "{{ route('detail.feedback.load_images') }}",
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
                            let uploadedHTML = `<li class="row-image">
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
            success: function (response) {
                if (response.status === 'success') {
                    let imageUrl = response.url
                    let imageHTML = `{{ asset('') }}${imageUrl}`;
                    const img = document.createElement("img");
                    img.src = imageHTML;
                    img.alt = 'ảnh upload';
                    $('#show-image-upload').append(img);
                } else {
                    createToast(response.message);
                }
            },
            error: function (error) {
                createToast('Đã xảy ra lỗi');
            },
        });
    }

    // feedback

    function send_feed_back(product_id)
    {
        let editorContent = editor.getData();
        let rate = $('input[name="rate"]:checked').val();
        let title = $('input[name="title"]').val();
        let name = $('input[name="name"]').val();
        let email = $('input[name="email"]').val();
        $.ajax({
            url: "{{ route('detail.feedback.store') }}",
            method: "POST",
            data: {
                product_id: product_id,
                rate: rate,
                title: title,
                content: editorContent,
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
                        $('.rate_sum').text(data.rate  + ' sao');
                        $('.count_feedback').text(data.count);
                        $('.rate_count_start').text(data.rate);
                        $('#show_rating').html(data.html);
                        createNoti(data.message);
                        break;
                }
            },
            error: function (data) {
                createToast('Đã xảy ra lỗi');
            }
        });
    }
    function confirmation(eve, id) {
        swal({
            title: 'Bạn có chắc là xóa nó chứ?',
            text: 'Bạn không thể rollback nó',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
            .then((willCancle) => {
                if (willCancle) {
                    delete_rate(id);
                }
            })
        return false;
    }

   function delete_rate(id){
        $.ajax({
            url: "{{ route('detail.feedback.destroy') }}",
            method: "POST",
            data: {
                id: id,
            },
            success: function (data) {
                $('#review_ul').fadeOut(300, function () {
                    $(this).html(data.view);
                    $(this).fadeIn(300);
                });
                $('.render_count').text(data.count + ' đánh giá');
                $('.rate_sum').text(data.rate  + ' sao');
                $('.count_feedback').text(data.count);
                $('.rate_count_start').text(data.rate);
                $('#show_rating').html(data.html);
                createNoti(data.message);
            },
            error: function (data) {
                createToast('Đã xảy ra lỗi');
            }
        });
    }

    const dpt_menu = document.querySelectorAll('.dpt_menu');
    const close_menu = document.querySelectorAll('#close_menu');

    for (let i of dpt_menu) {
        i.classList.add('active');
    }
    close_menu.forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            for (let i of dpt_menu) {
                i.classList.toggle('active');
            }
        });
    })

    // Check produtct stock

    function soldOut(element) {
        createToast('Xin lỗi đã hết hàng');
        return false;
    }

    // slider images

    var productThumb = new Swiper('.small_image', {

        breakpoints: {
            481: {
                spaceBetween: 32,
            }
        },
        navigation: {
            nextEl: '.swiper-button-next-small',
            prevEl: '.swiper-button-prev-small',
        },
    });

    var productBig = new Swiper('.big_image', {
        loop: true,
        spaceBetween: 10,
        centeredSlides: true,
        autoplay: {
            delay: 5500,
            disableOnInteraction: false,
        },
        autoHeight: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: productThumb,
        }
    });


    // Check stock
    let quantity = document.querySelector('#stock');
    let minus = document.querySelector('.minus');
    let plus = document.querySelector('.plus');

    minus.addEventListener('click', (e) => {
        let value = parseInt(quantity.value);
        if (value > 1) {
            value -= 1;
            quantity.value = value;
        }
    });

    plus.addEventListener('click', (e) => {
        let value = parseInt(quantity.value);
        if (value < {{ $product->stock }}) {
            value += 1;
            quantity.value = value;
        }
    });

    quantity.addEventListener('change', (e) => {
        if (e.target.value > {{ $product->stock }}) {
            e.target.value = {{ $product->stock }};
            quantity.value = {{ $product->stock }};
        }
    });
</script>

@if (!Auth::check())
    <script>
        review_btn.addEventListener('click', (e) => {
            e.preventDefault();
            createToast('Bạn cần phải đăng nhập');
        })
    </script>
@endif
