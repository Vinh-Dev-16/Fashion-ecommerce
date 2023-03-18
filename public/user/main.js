


// //Phan text
// //  var typingEffect = new Typed(".multi_text",{
// //     strings: ['FASHION AND SO MUCH MORE'],
// //     loop:true,
// //     typeSpeed: 100,
// //     backSpeed: 60,
// //     backDelay: 1500,
// //     showCursor: true,
// //     cursorChar: '|',
// //     autoInsertCss: true
// //   });
//   // Phần progress bar
//   document.addEventListener('DOMContentLoaded',()=>{
//     const value = document.querySelector('.value');
//     document.addEventListener('scroll',()=>{
//     const scrollTop = document.body.scrollTop || document.documentElement.scrollTop;
//      const scrollHeight = document.documentElement.scrollHeight;
//     const clienHeight = document.documentElement.clientHeight;
  
//     const percentage = Math.floor(scrollTop / (scrollHeight-clienHeight) * 100);
//     value.style.width= percentage + '%';
    
//   });
//   });
//  //Phần deal of day
//     let countDate = new Date('16,march,2023 00:00:00').getTime();
//     function countDown(){
//     let now = new Date().getTime();

//     gap =  countDate-now;

//     let seconds=1000;
//     let minutes = seconds *60;
//     let hours = minutes *60;
//     let day = hours *24;
//     let d = Math.floor(gap/(day));
//     let h = Math.floor((gap%(day))/(hours));
//     let m = Math.floor((gap%(hours))/(minutes));
//     let s = Math.floor((gap%(minutes))/(seconds));
    
//     document.querySelector('.days').innerText = d;
//     document.querySelector('.hours').innerText = h;
//     document.querySelector('.minutes').innerText = m;
//     document.querySelector('.seconds').innerText = s;
//  }
//  setInterval(() => {
//     countDown()
//  },1000);

//  //Phan slider
// //  var swiper = new Swiper(".swiper", {
   
// //     loop:true,
// //     centeredSlides: true,
// //     autoplay: {
// //       delay: 6500,
// //       disableOnInteraction: false,
// //     },
// //     pagination: {
// //       el: ".swiper-pagination",
// //       clickable: true,
// //     },
// //   }); 

//  // Phan scroll
// //  const home_landing = document.querySelector('.back_home');
// //  const landing = document.querySelector('.landing_home');
// //  const home_index = document.querySelector('.home_index');
// //  home_landing.onclick = function(){
// //             landing.classList.toggle('active');
// //             home_index.classList.toggle('active');

// // }

