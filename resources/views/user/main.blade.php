@can('confirm-order')
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('194699ac18e541ed2d38', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('popup-channel');
        channel.bind('my-event', function (data) {
            createNoti(data.name + ' đã đặt hàng');
            let count_number = document.querySelector("#count_number");
            if (count_number) {
                document.querySelector('#count_number').innerText = data.count;
            } else {
                let countNumber = createElement('div');
                countNumber.className = "fly_item";
                let renderNumber = `
                    <span  class="item_number" id="count_number">{{ App\Models\OrderDetail::where('status', 0)->count() }}
                </span>
`;
                countNumber.innerHTML = renderNumber;
                document.querySelector(".profile-dropdown").appendChild(countNumber);
            }
        });
    </script>
@endcan
@can('confirm-shipper')
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('194699ac18e541ed2d38', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('popup-confirm');
        channel.bind('my-handle', function (data) {
            createNoti('Đã có đơn hàng cần ship');
            if (count_number) {
                document.querySelector('#count_number').innerText = data.count;
            } else {
                let countNumber = createElement('div');
                countNumber.className = "fly_item";
                let renderNumber = `
                    <span class="item_number" id="count_number">{{ App\Models\OrderDetail::where('status', 2)->where('ship',0)->count() }}
                </span>
`;
                countNumber.innerHTML = renderNumber;
                document.querySelector(".profile-dropdown").appendChild(countNumber);
            }
        });
    </script>
@endcan
<script>
    window.addEventListener('load', () => {
        $("#load-data").fadeOut("slow");
        $("#page").fadeIn("slow");
    })

    function block_screen() {
        $("#load-data").fadeIn("slow");
        $("#page").fadeOut("slow");
    }

    function unblock_screen() {
        $("#page").fadeIn("slow");
        $("#load-data").fadeOut("slow");
    }

    // Phần sidebar

    copyMenu();

    function copyMenu() {
        let dptCategory = document.querySelector('.dpt_cat');
        let dptPlace = document.querySelector('.departments');
        dptPlace.innerHTML = dptCategory.innerHTML;

        let mainNav = document.querySelector('.header_nav nav');
        let navPlace = document.querySelector('.off_canvas nav');
        navPlace.innerHTML = mainNav.innerHTML;

    }

    const menuButton = document.querySelector('.trigger'),
        closeButton = document.querySelector('.t_close'),
        addclass = document.querySelector('.site');
    menuButton.addEventListener('click', () => {
        addclass.classList.toggle('showmenu');
    });

    closeButton.addEventListener('click', () => {
        addclass.classList.remove('showmenu');
    });

    // Tao remove toast

    const notifications = document.querySelector('.notification');
    const toast = document.querySelector('.toasts');
    const timer = 3000;

    const removeNoti = (noti) => {
        noti.classList.add("hide");
        if (noti.timeoutId) clearTimeout(noti.timeoutId);
        setTimeout(() => noti.remove(), 400);
    };


    // Tao Toast

    function createNoti(message) {
        const noti = document.createElement('li');
        noti.className = `toasts success`;
        noti.innerHTML = `
                        <div class="column">
                            <i class="fa-solid fa-check"></i>
                            <span>${message}</span>
                        </div>
                        <i class="fa-solid fa-x"></i>
                        `
        notifications.appendChild(noti);
        setTimeout(() => removeNoti(noti), 3000)
    };

    // Tao remove toast

    const removeToast = (toast) => {
        toast.classList.add("hide");
        if (toast.timeoutId) clearTimeout(toast.timeoutId);
        setTimeout(() => toast.remove(), 400);
    };


    // Tao Toast

    function createToast(toastMessage) {
        const toast = document.createElement('li');
        toast.className = `toasts error`;
        toast.innerHTML = `
                <div class="column">
                    <i class="fa-solid fa-bug"></i>
                    <span>${toastMessage}</span>
                </div>
                <i class="fa-solid fa-x"></i>
                `
        notifications.appendChild(toast);
        setTimeout(() => removeToast(toast), 3000)
    };

    const submenu = document.querySelectorAll('.has_child .icon_small');
    submenu.forEach((menu) => menu.addEventListener('click', togglePage));

    function togglePage(e) {
        e.preventDefault();
        submenu.forEach((item) => item != this ? item.closest('.has_child').classList.remove('expand') : null);
        if (this.closest('.has_child').classList != 'expand') ;
        this.closest('.has_child').classList.toggle('expand');
    }

    // Search

    const search = document.getElementById('search_product');
    const search_result = document.querySelector('.search_results');

    searchProduct();

    // Lấy Value ở ô input

    function searchProduct() {
        search.addEventListener('keyup', function (e) {
            if (e.target.value) {
                send(e.target.value.trim());
                search_result.style.display = 'block';
            } else {
                search_result.style.display = 'none';
            }
        })

        document.addEventListener('click', (e) => {
            if (e.target != search_result) {
                search_result.style.display = "none";
            }
        })
    }

    // Search dữ liệu

    async function send(data) {
        const res = await fetch(`{{route('search')}}?data=${data}`)
            .then((response) => response.json())
            .then((data) => {
                show(data);
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }

    // Show Data

    function show(data) {
        if (data.results.length > 0) {
            let output = '';
            data.results.slice(0, 5).map(function (item) {
                if (item.sale == 0) {
                    item.images.slice(0, 1).map((image) => {
                        output += `
                            <a href="{{ url('detail/${item.slug}') }}">
                                <li><img src="${image.path}" alt="${item.name}">
                                <span>${(item.name).substring(0, 30)}</span>
                        </li>
                            </a>
                        `
                    });
                } else {
                    item.images.slice(0, 1).map((image) => {
                        output += `
                            <a href="{{ url('pageoffer/${item.slug}') }}">
                                <li><img src="${image.path}" alt="${item.name}">
                                <span>${(item.name).substring(0, 50)}</span>
                        </li>
                            </a>
                        `
                    });
                }
            });
            search_result.innerHTML = output;
        } else {
            search_result.innerHTML = '<li> <span> Không tìm thấy sản phẩm </span></li>';
        }
    }


    // add to Cart

    // function addCart(id) {
    //     let colorRadio = document.getElementsByName('color');
    //     for (let i of colorRadio) {
    //         if (i.checked) {
    //             var color = i.value;
    //         }
    //     }
    //     let sizeRadio = document.getElementsByName('size');
    //     for (let i of sizeRadio) {
    //         if (i.checked) {
    //             var size = i.value;
    //         }
    //     }
    //     let quantity = document.querySelector("input[name='stock']").value;
    //     if (color == undefined && size == undefined) {
    //         message = "Phải chọn color và size";
    //         createNoti(message);
    //     } else if (size == undefined) {
    //         message = "Phải chọn size";
    //         createNoti(message);
    //     } else if (color == undefined) {
    //         message = "Phải chọn color";
    //         createNoti(message);
    //     }
    //     sendCart(id, color, size, quantity)
    //     console.log(id, color, size, quantity)
    //     return false;
    // }
    //
    // async function sendCart(id, color, size, quantity) {
    //     const res = await fetch(`http://127.0.0.1:8000/cart/${id}`, {
    //
    //         method: 'POST',
    //         headers: {
    //             "Content-Type": "application/json",
    //             "X-Requested-With": "XMLHttpRequest",
    //         },
    //         body: JSON.stringify({
    //             color: parseInt(color),
    //             size: parseInt(size),
    //             quantity: parseInt(quantity),
    //         }),
    //     })
    //         .then((response) => response.json())
    //         .then((data) => {
    //             showCart(data);
    //             message = "Đã thêm vào giỏ hàng";
    //             createNoti(message)
    //             let form_cart = document.querySelector('#form_cart');
    //             console.log(form_cart);
    //             form_cart.reset();
    //         })
    //         .catch((error) => {
    //             console.error("Error:", error);
    //         });
    // }

    // remove cart
    {{--if (document.querySelector('#item_remove')) {--}}
    {{--    document.querySelector('#item_remove').addEventListener('click', (e) => {--}}
    {{--        e.preventDefault();--}}
    {{--    });--}}
    {{--}--}}

    {{--async function removeCart(id) {--}}
    {{--    const res = await fetch(`http://127.0.0.1:8000/removecart/${id}`)--}}
    {{--        .then((response) => response.json())--}}
    {{--        .then((data) => {--}}
    {{--            showCart(data);--}}
    {{--        })--}}
    {{--        .catch((error) => {--}}
    {{--            console.error("Error:", error);--}}
    {{--        });--}}
    {{--}--}}

    {{--function showCart(data) {--}}
    {{--    console.log(data);--}}
    {{--    let render = '';--}}
    {{--    let card_render = '';--}}
    {{--    let item_number = document.querySelector('#item_number');--}}
    {{--    item_number.innerText = data.cart.length;--}}
    {{--    data.cart.map((cart) => {--}}
    {{--        if (cart.product.discount) {--}}
    {{--            var price = (cart.product.price - (cart.product.price * ((cart.product.discount) / 100))) * cart--}}
    {{--                .quantity--}}
    {{--        } else {--}}
    {{--            var price = cart.product.price * cart.quantity--}}
    {{--        }--}}
    {{--        ;--}}
    {{--        render += `--}}
    {{--                                    <li class="item" style="margin-bottom: 1em">--}}
    {{--                                        ${--}}
    {{--            (() => {--}}
    {{--                if ((cart.product.sale) == 0) {--}}
    {{--                    return `--}}
    {{--                                                            <div class="thumbnail object_cover">--}}
    {{--                                                                <a href="{{ url('detail/${cart.product.id}') }}"><img src="${cart.image}"></a>--}}
    {{--                                                            </div>--}}
    {{--                                                            <div class="item_content">--}}
    {{--                                                                <p><a href="{{ url('detail/${cart.product.id}') }}">${(cart.product.name).substring(0, 30)}</a>--}}
    {{--                                                                </p>--}}
    {{--                                                                        `--}}
    {{--                } else {--}}
    {{--                    return `--}}
    {{--                                                        <div class="thumbnail object_cover">--}}
    {{--                                                            <a href="{{ url('pageoffer/${cart.product.id}')}}">--}}
    {{--                                                                <img src="${cart.image}">--}}
    {{--                                                            </a>--}}
    {{--                                                        </div>--}}
    {{--                                                        <div class="item_content">--}}
    {{--                                                            <p>--}}
    {{--                                                            <a href="{{url('pageoffer/${cart.product.id}')}}">--}}
    {{--                                                                ${(cart.product.name).substring(0, 30)}--}}
    {{--                                                             </a>--}}
    {{--                                                            </p >--}}
    {{--                `--}}
    {{--                }--}}
    {{--            })()--}}
    {{--        }--}}
    {{--                                            <span class="price">--}}
    {{--                                                <span>${price.toLocaleString('vi-VN')} VND</span>--}}
    {{--                                                <span class="fly_item"><span>${cart.quantity}x</span></span>--}}
    {{--                                            </span>--}}
    {{--                                        </div>--}}
    {{--                                        <a href="#" class="item_remove" id="item_remove" onclick="removeCart(${cart.product.id})">--}}
    {{--                                                <i class="ri-close-line" ></i>--}}
    {{--                                            </a>--}}
    {{--                                    </li>--}}
    {{--        `;--}}
    {{--        let ship = (15000 * data.cart.length).toLocaleString('vi-VN');--}}
    {{--        console.log(data.cart.length)--}}
    {{--        const caculator = data.cart.reduce((total, cartItem) => {--}}
    {{--            if (cart.product.discount) {--}}
    {{--                return total + cartItem.quantity * (cartItem.product.price - ((cartItem.product--}}
    {{--                    .price) * ((cartItem.product.discount) / 100)));--}}
    {{--            } else {--}}
    {{--                return total + cartItem.quantity * (cartItem.product.price);--}}
    {{--            }--}}
    {{--        }, 0);--}}
    {{--        let total = caculator.toLocaleString('vi-VN')--}}

    {{--        card_render = `--}}
    {{--                                        <p>Phí ship</p>--}}
    {{--                                        <p><strong> ${(15000).toLocaleString('vi-VN')} * ${data.cart.length} = ${ship}  VND</strong></p>--}}
    {{--                                        <p>Tổng tiền</p>--}}
    {{--                                        <p><strong>${(caculator + (15000 * data.cart.length)).toLocaleString('vi-VN')}--}}
    {{--                                                VND</strong></p>--}}
    {{--                                    `--}}
    {{--    })--}}

    {{--    document.querySelector('#subtotal').innerHTML = card_render;--}}
    {{--    document.querySelector('#card_body').innerHTML = render;--}}
    {{--    document.querySelector('#card_head').innerText = `Có ${data.cart.length} sản phẩm`;--}}
    {{--    if (data.cart.length > 0) {--}}
    {{--        document.querySelector('.checkout_page').innerHTML = `--}}
    {{--            <a href="http://127.0.0.1:8000/checkout" class="primary_button">CheckOut</a>--}}
    {{--            `;--}}
    {{--    } else {--}}
    {{--        document.querySelector('.checkout_page').innerHTML = `--}}
    {{--            <a href="#" onclick="createToast('Bạn cần có đơn hàng hoặc đăng nhâp')" class="primary_button">CheckOut</a>--}}
    {{--            `;--}}
    {{--    }--}}
    {{--};--}}

</script>
@if (Session::has('success') || Session::has('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            function removeToast(toast) {
                toast.classList.add("hide");
                if (toast.timeoutId) clearTimeout(toast.timeoutId);
                setTimeout(() => toast.remove(), 400);
            }

            setTime();

            function setTime() {
                setTimeout(() => removeToast(toast), 3000)
            }
        });
    </script>
@endif
@if (Auth::check())
    <script>
        let profileDropdownList = document.querySelector(".profile-dropdown-list");
        let btn = document.querySelector(".profile-dropdown-btn");

        let classList = profileDropdownList.classList;

        const toggle = () => classList.toggle("active");

        window.addEventListener("click", function (e) {
            if (!btn.contains(e.target)) classList.remove("active");
        });
    </script>
@endif
