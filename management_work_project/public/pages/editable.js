var form;
function editWorkspaceTitle(e) {
    e.stopPropagation();
    let initName = document.getElementById("workspace-name").innerText;
    form = e.target.parentElement.parentElement;
    let prevoustStatus = form.cloneNode(true);
    form.innerHTML = `<form class="workspacename" action="${
        document
        .querySelector('meta[name="updateworkspaceurl"]')
        .getAttribute("content")}"
    }" method="post">
    <input type="hidden" name="_token" value="${document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")}">

    <label for="title">
    Workspace Name <br>
        <input name="title" id="title" cols="30" rows="10" value="${initName}"></input>
    </label>

    <div class="button">
    <button id="save" type="submit" value="Submit">Save</button>
    <button id="cancel">Cancel</button>

    </div>
</form>`;
    setTimeout(() => {
        document.querySelector(".workspace-header #cancel").onclick = doAfterClickCancel;
    }, 0);
}

function doAfterClickCancel(e) {
    e.preventDefault();
    window.location.reload();
}

document
    .querySelector(".workspace-name .edit")
    .addEventListener("click", editWorkspaceTitle);
