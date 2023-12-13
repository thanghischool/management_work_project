function applyEditableTitleToList(listQuery, titleQuery, blockwallQuery){
    lists = Array.from(document.querySelectorAll(listQuery));
    console.log(lists);
    lists.forEach(list => {
        const title = list.querySelector(titleQuery);
        console.log(title);
        const blockwall = list.querySelector(blockwallQuery);
        blockwall.onclick = (e) => {
            blockwall.hidden = true;
            title.focus();
            title.select();
            title.onblur = (e1) => {
                blockwall.hidden = false;
                // làm gì khi người dùng sửa đổi dữ liệu ở đây
                //...
            };
        }
    });
}
