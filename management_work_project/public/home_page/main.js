let play_icon_parent = document.querySelector(
  ".dash-board .start-use .watch-video .play-icon-parent"
);
let play_icon = document.querySelector(
  ".dash-board .start-use .watch-video .play-icon"
);
for (let i = 0; i < 3; i++) {
  for (let j = 0; j < 8; j++) {
    let dot_icon = document.createElement("i");
    dot_icon.classList.add("bi", "bi-dot");
    if (i < 1) {
      if (j >= 3) {
        dot_icon.style.color = "white";
      }
    }
    if (j == 7) {
      let down_line = document.createElement("br");
      dot_icon.appendChild(down_line);
    }
    document
      .querySelector(".dash-board .img-dashboard .bi-container")
      .appendChild(dot_icon);
  }
}

let i = 1;

play_icon.addEventListener("mouseover", () => {
  let time_change_color = setInterval(changeColor, 700);

  play_icon.addEventListener("mouseout", () => {
    clearInterval(time_change_color);
  });
});

function changeColor() {
  if (i == 1) {
    play_icon_parent.style.backgroundColor = "rgb(19, 87, 106)";
    i += 1;
  } else {
    play_icon_parent.style.backgroundColor = "rgb(32, 22, 109)";
    i -= 1;
  }
}
