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
            let count_number_confirm = document.querySelector("#count_number_confirm");
            if (count_number) {
                document.querySelector('#count_number').innerText = data.count;
            } else {
                let countNumber = createElement('div');
                countNumber.className = "fly_item";
                let renderNumber = `
                    <span  class="item_number" id="count_number">{{ App\Models\OrderDetail::where('status', 0)->count() }}
                </span>
                `;
                let count = {{ App\Models\OrderDetail::where('status', 0)->count() }};
                count_number_confirm.innerText =count;
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
                let count_number_ship = document.querySelector("#count_number_ship");
                let count = {{ App\Models\OrderDetail::where('status', 0)->count() }};
                count_number_ship.innerText =count;
                document.querySelector(".profile-dropdown").appendChild(countNumber);
            }
        });
    </script>
@endcan
<script>
    // window.addEventListener('load', () => {
    //     $("#load-data").fadeOut("slow");
    //     $("#page").fadeIn("slow");
    // })

    // function block_screen() {
    //     $("#load-data").fadeIn("slow");
    //     $("#page").fadeOut("slow");
    // }
    //
    // function unblock_screen() {
    //     $("#page").fadeIn("slow");
    //     $("#load-data").fadeOut("slow");
    // }


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
                        <i class="fa-solid fa-x close-toast"></i>
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
                <i class="fa-solid fa-x close-toast"></i>
                `
        notifications.appendChild(toast);
        setTimeout(() => removeToast(toast), 3000)
    };

    // Tao close toast
    document.querySelector('.notification').addEventListener('click', function (e) {
        if (e.target.classList.contains('close-toast')) {
            removeToast(e.target.parentElement);
        }
    });

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
