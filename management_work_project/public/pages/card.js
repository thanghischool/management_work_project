function showPopup() {
    document.querySelector(".popup").style.display = "block";
  }
  
  function closePopup() {
    document.querySelector(".popup").style.display = "none";
  }
  
  // Lắng nghe sự kiện click của nút
  document.querySelector(".open-popup").addEventListener("click", showPopup);
  
  // Thêm nút đóng vào bảng pop up
  document.querySelector(".popup").appendChild(document.createElement("button"));
  document.querySelector(".popup .close").addEventListener("click", closePopup);
  