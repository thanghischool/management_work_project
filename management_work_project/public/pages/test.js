
function addItemToChecklist(content){
    const container = document.querySelector(".checklist .slide-body");
    const check = document.createElement("div");
    check.className = "check";
    check.innerHTML = `<input type="checkbox" checked="checked">
    <p class="check-content">${content}</p>`;
    container.insertBefore(check, container.lastElementChild);
    const lastElementChild = container.lastElementChild;
    const firstElementChild = container.firstElementChild;
    console.dir(container);
    console.log(container.parentElement);
}
addItemToChecklist("Hello");
addItemToChecklist("Hii");

