
function applyDragableIntoList(container, item){
    const sortableLists = document.querySelectorAll(container);
    for(const sortableList of sortableLists){
        const items = sortableList.querySelectorAll(item);
        items.forEach((item) => {
            item.addEventListener("dragstart", (e) => {
                // Adding dragging class to item after a delay
                e.stopPropagation();
                setTimeout(() => {
                    item.classList.add("dragging");
                }, 0);
            });
            // Removing dragging class from item on dragend event
            item.addEventListener("dragend", () => {
                item.classList.remove("dragging");
                // gọi API đổi chỗ vị trí list
            });
        });
        
        const initSortableList = (e) => {
            e.preventDefault();
            e.stopPropagation();
            const draggingItem = document.querySelector(item+".dragging");
            // Getting all items except currently dragging and making array of them
            let siblings = [...sortableList.querySelectorAll(item)];
            // Finding the sibling after which the dragging item should be placed
            let aroundItems;
            for(let key in siblings){
                if(siblings[key] === draggingItem) {
                    aroundItems = [siblings[parseInt(key)-1],siblings[parseInt(key)+1]];
                    break;
                }
            }
            if(aroundItems[0] && aroundItems[1]){
                if (e.clientX + sortableList.scrollLeft <= aroundItems[0].offsetLeft + aroundItems[0].offsetWidth / 2) {
                    sortableList.insertBefore(draggingItem, aroundItems[0]);
                } else if(e.clientX + sortableList.scrollLeft >= aroundItems[1].offsetLeft + aroundItems[1].offsetWidth / 2){
                    sortableList.insertBefore(draggingItem, aroundItems[1].nextSibling);
                }
            } else if (aroundItems[0]){
                if (e.clientX + sortableList.scrollLeft <= aroundItems[0].offsetLeft + aroundItems[0].offsetWidth / 2) {
                    sortableList.insertBefore(draggingItem, aroundItems[0]);
                }
            } else if (aroundItems[1]){
                if(e.clientX + sortableList.scrollLeft >= aroundItems[1].offsetLeft + aroundItems[1].offsetWidth / 2){
                    sortableList.insertBefore(draggingItem, aroundItems[1].nextSibling);
                }
            }
        }
        
        sortableList.addEventListener("dragover", initSortableList);
        sortableList.addEventListener("dragenter", e => e.preventDefault());   
    }
}
function newCardElement(title, index, list_ID){
    const card = document.createElement("div");
    card.className = "card-item";
    card.draggable = "true";
    card.index = index;
    card.list_ID = list_ID;
    card.innerHTML = " "+title+ " ";
    card.addEventListener("dragstart", (e) => {
        // Adding dragging class to item after a delay
        e.stopPropagation();
        setTimeout(() => {
            card.classList.add("dragging");
        }, 0);
    });
    // Removing dragging class from item on dragend event
    card.addEventListener("dragend", () => {
        card.classList.remove("dragging");
        // let list_ID = item.parentElement.id;
        let index = card.nextElementSibling;
    });
    return card;
}
function reOrderIndex(itemSelector, containerSelector){
    const containers = document.querySelectorAll(containerSelector);
    containers.forEach((container) => {
        const items = container.querySelectorAll(itemSelector);
        items.forEach((item, index) => {
            item.setAttribute("index", index);
        });
    });
}
function applyDragableIntoCard(container, item){
    const sortableLists = document.querySelectorAll(container);
    for(const key_list in sortableLists){
        if(typeof sortableLists[key_list] == "function"){
            break;
        }
        const items = sortableLists[key_list].querySelectorAll(item);
        const container1 = sortableLists[key_list]?.parentElement?.parentElement;
        items?.forEach((item,key) => {
            item.addEventListener("dragstart", (e) => {
                // Adding dragging class to item after a delay
                e.stopPropagation();
                setTimeout(() => {
                    item.classList.add("dragging");
                }, 0);
            });
            // Removing dragging class from item on dragend event
            item.addEventListener("dragend", () => {
                item.classList.remove("dragging");
                // let list_ID = item.parentElement.id;
                let index = item.nextElementSibling;
            });
        });
        
        const initSortableList = (e) => {
            e.preventDefault();
            e.stopPropagation();
            const draggingItem = document.querySelector(item+".dragging");
            // Getting all items except currently dragging and making array of them
            let siblings = [...sortableLists[key_list].querySelectorAll(item)];
            // Finding the sibling after which the dragging item should be placed
            let aroundItems;
            if (e.clientX + container1.scrollLeft > sortableLists[key_list].offsetLeft && sortableLists[key_list] !== draggingItem.parentElement) sortableLists[key_list].appendChild(draggingItem);
            for(let key in siblings){
                if(siblings[key] === draggingItem) {
                        aroundItems = [siblings[parseInt(key)-1],siblings[parseInt(key)+1]];
                        break;
                }
            }
            if(aroundItems[0] && aroundItems[1]){
                if (e.clientY + container1.scrollTop  <= aroundItems[0].offsetTop + aroundItems[0].offsetHeight / 2) {
                    sortableLists[key_list].insertBefore(draggingItem, aroundItems[0]);
                } else if(e.clientY + container1.scrollTop >= aroundItems[1].offsetTop + aroundItems[1].offsetHeight / 2){
                    sortableLists[key_list].insertBefore(draggingItem, aroundItems[1].nextSibling);
                }
            } else if (aroundItems[0]){
                if (e.clientY + container1.scrollTop <= aroundItems[0].offsetTop + aroundItems[0].offsetHeight / 2) {
                    sortableLists[key_list].insertBefore(draggingItem, aroundItems[0]);
                }
            } else if (aroundItems[1]){
                if(e.clientY + container1.scrollTop >= aroundItems[1].offsetTop + aroundItems[1].offsetHeight / 2){
                    sortableLists[key_list].insertBefore(draggingItem, aroundItems[1].nextSibling);
                }
            }
        }
        
        sortableLists[key_list].addEventListener("dragover", initSortableList);
        sortableLists[key_list].addEventListener("dragenter", e => e.preventDefault());   
    }
}

