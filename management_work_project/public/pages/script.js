const node = document.createElement("div");
node.className = "sub-items";
node.innerHTML = `<div class="item">
<img src="pages/image/project-icon.png" alt="" class="icon">
<h4 class="item-name">
    Project
</h4>
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
const parent = document.querySelector(".workspace-container");
var workspaces = document.querySelectorAll(".workspace-container .item");
workspaces.forEach((e) => {
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
