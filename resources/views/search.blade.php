<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--===== Boxicons CSS =====-->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <title>Custom Dropdown Select Menu</title>

    <style>
        /* ===== Google Font Import - Poppins ===== */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body{
            background: #E3F2FD;
        }
        .select-menu{
            width: 380px;
            margin: 140px auto;
        }
        .select-menu .select-btn{
            display: flex;
            height: 55px;
            background: #fff;
            padding: 20px;
            font-size: 18px;
            font-weight: 400;
            border-radius: 8px;
            align-items: center;
            cursor: pointer;
            justify-content: space-between;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .select-btn i{
            font-size: 25px;
            transition: 0.3s;
        }
        .select-menu.active .select-btn i{
            transform: rotate(-180deg);
        }
        .select-menu .options{
            position: relative;
            padding: 20px;
            margin-top: 10px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 3px rgba(0,0,0,0.1);
            display: none;
        }
       .search-bar{
           display: flex;
           height: 55px;
           cursor: pointer;
           padding: 0 16px;
           border-radius: 8px;
           align-items: center;
           background: #fff;
        }


        .select-menu.active .options{
            display: block;
        }
        .options .option{
            display: flex;
            height: 55px;
            cursor: pointer;
            padding: 0 16px;
            border-radius: 8px;
            align-items: center;
            background: #fff;
        }
        .options .option:hover{
            background: #F2F2F2;
        }
        .option i{
            font-size: 25px;
            margin-right: 12px;
        }
        .option .option-text{
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
<div class="select-menu">
    <div class="select-btn">
        <span class="sBtn-text">Select your option</span>
        <i class="bx bx-chevron-down"></i>
    </div>

    <ul class="options">
        <li class="search-bar">
                <input type="search" placeholder="search" id="search"  style="width: 88%">
        </li>
        <div class="showDropdown">
            <div class="dropdown-hide">
                @foreach(App\Models\admin\Product::take(5)->get() as $item)
                <li class="option">
                    <span  class="option-text">
                        {{Illuminate\Support\Str::of($item->name)->words(4)}}
                    </span>
                </li>
                @endforeach
            </div>
        </div>
    </ul>
</div>

<script>
    const optionMenu = document.querySelector(".select-menu"),
        selectBtn = optionMenu.querySelector(".select-btn"),
        options = optionMenu.querySelectorAll(".option"),
        search = document.querySelector("#search"),
        sBtn_text = optionMenu.querySelector(".sBtn-text");
    selectBtn.addEventListener("click", () => optionMenu.classList.toggle("active"));

    const searchURL = 'http://127.0.0.1:8000/search';
    search.addEventListener("keyup", (e)=>{
        let dropdownHide = document.querySelector(".dropdown-hide");
        if (e.target.value) {
              sendData(e.target.value.trim());
              dropdownHide.style.display = 'none';
        } else {
              dropdownHide.style.display = 'block';
        }
    })

    async function sendData(value){
        const res = await fetch(`${searchURL}?data=${value}`)
            .then((response) => response.json())
            .then((data) => {
                showData(data);
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }

    function showData(data) {
        let showDropdown = document.querySelector('.showDropdown');
        if (data.results.length > 0) {
            let output = '';
            data.results.slice(0, 5).map(function(item) {
                output +=
                    `
                        <li class="option">
                            <span value="${item.id}" class="option-text"> ${(item.name).substring(0,30)} </span>
                        </li>
                    `;

                showDropdown.innerHTML = `
                    <div class="dropdown-hide">
                        ${output}
                    </div>
                `;
            });
        }else {
            showDropdown.innerHTML =
                `
                     <div class="dropdown-hide">
                        <li class="option">
                            <span class="option-text">
                                Khong co du lieu
                            </span>
                        </li>
                     </div>
            `;
        }
    }

    options.forEach(option =>{
        option.addEventListener("click", ()=>{
            console.log(1);
            insertData(option);
        });
    });

    function insertData(option){
        let selectedOption = option.querySelector(".option-text").innerText;
        sBtn_text.innerText = selectedOption;
        optionMenu.classList.remove("active");
    }

</script>

</body>
</html>
