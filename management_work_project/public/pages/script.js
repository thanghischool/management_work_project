const node = document.createElement("div");
node.className = "sub-items";

const parent = document.querySelector(".workspace-container");
var workspaces = document.querySelectorAll(".workspace-container .item");

workspaces.forEach((e) => {
    let currentLink = window.location.href;
    let arrayCurrentLink = currentLink.split("/");
    if (arrayCurrentLink[arrayCurrentLink.length - 2] == "workspace") {
        currentLink = currentLink.split("/").slice(0, -1).join("/");
    }

    node.innerHTML = `<div class="item">
<img src="pages/image/project-icon.png" alt="" class="icon">
<a class="item-name" href="${currentLink}/${e.id}">
    Project
</a>
</div>
<div class="item">
<img src="pages/image/heart.png" alt="" class="icon">
<h4 class="item-name">
    Hightlights
</h4>
</div>
<div class="item">
<img src="pages/image/group.png" alt="" class="icon">
<h4 class="item-name">
    Menbers
</h4>
</div>
<div class="item">
<img src="pages/image/chatbox.png" alt="" class="icon">
<h4 class="item-name">
    Chat box
</h4>
</div>`;
    let nodeClone = node.cloneNode(true);
    nodeClone.addEventListener("click", (e) => {
        console.log("Route to item page");
    });
    e.addEventListener("click", () => {
        // Them class active vao item
        e.querySelector(".arrow").classList.toggle("active");
        e.classList.toggle("active");
        nodeClone.style.marginTop = 0 + "px";
        if (!e.classList.contains("active")) {
            nodeClone.style.height = 0 + "px";
            setTimeout(() => nodeClone.remove(), 400);
        } else {
            parent.insertBefore(nodeClone, e.nextElementSibling);
            setTimeout(() => {
                nodeClone.style.height = 250 + "px";
                nodeClone.style.marginTop = 5 + "px";
            }, 100);
        }
    });
});
var subitems = document.querySelector(".sub-items");

// subitems.innerHTML = "";

// Access project
function project_specific(id) {
    let currentLink = window.location.href;
    window.location.href = `${currentLink}/project/${id}`;
}

const container = document.querySelector(".project-container");
container.style = "height: " + (window.innerHeight * 70) / 100 + "px";
window.addEventListener("resize", () => {
    const container = document.querySelector(".project-container");
    container.style = "height: " + (window.innerHeight * 70) / 100 + "px";
    console.log(window.innerHeight);
});

console.log(navbar_button);
