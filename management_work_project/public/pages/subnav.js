// Hàm hiển thị menu xổ xuống
// function showSubnav() {
//     // Hiển thị menu xổ xuống
//     document.querySelector(".subnav").style.display = "block";
//   }
  
  // Gắn sự kiện click cho avatar
//   document.querySelector(".avatar").addEventListener("click", showSubnav);

var opensubnav = document.querySelector('.open-subnav-btn')
var subnav = document.querySelector('.subnav')
console.log(opensubnav);

function togglesubnav(e){
    subnav.classList.toggle('hide')
}
opensubnav.addEventListener('click', togglesubnav)
// closesubnav.addEventListener('click', togglesubnav)
