function editWorkspaceTitle(e) {
    e.stopPropagation();
    let form = e.target.parentElement.parentElement;

    let prevoustStatus = form.cloneNode(true);
    form.innerHTML = `<form class="workspacename" action="${
        window.location.href
    }" method="post">
    <input type="hidden" name="_token" value="${document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")}">

    <label for="title">
    Workspace Name <br>
        <input name="title" id="title" cols="30" rows="10" value="Workspace Name"></input>
    </label>
    <label for="ability">
        Ability <br>
        <select name="ability" id="ability">
            <option value="private">Private</option>
            <option value="public">Public</option>
        </select>
    </label>
    <div class="button">
    <button id="save" type="submit" value="Submit">Save</button>
    <button id="cancel">Cancel</button>

    </div>
</form>`;
}

function doAfterClickCancel(e) {
    e.preventDefault();
    form.parentElement.replaceChild(prevoustStatus, form);
    // lam gi khi click cancel
    form.querySelector("#save").removeEventListener("click", doAfterClickSave);
    form.querySelector("#cancel").removeEventListener(
        "click",
        doAfterClickCancel
    );
    document
        .querySelector(".workspace-name .edit")
        .addEventListener("click", editWorkspaceTitle);
}

setTimeout(() => {
    form.querySelector("#cancel").addEventListener("click", doAfterClickCancel);
}, 0);

document
    .querySelector(".workspace-name .edit")
    .addEventListener("click", editWorkspaceTitle);
