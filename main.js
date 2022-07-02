function Submit(ID, checkExistsList) {
    console.log(checkExistsList);
    yes = true
    checkExistsList.every((checkExists, i) => {
        console.log(checkExists);
        if (document.getElementById(checkExists).value === "") {
            alert('missing' + checkExists);
            yes = false
            return true;
        }
    })
    if (yes) {
        document.getElementById(ID).submit();
    }
}
function passwordNSubmit(ID) {
    rcvPassword = prompt("type password:")
    var inputHidden = document.createElement("input")
    inputHidden.setAttribute("name", "Password")
    inputHidden.setAttribute("type", "hidden")
    inputHidden.setAttribute("value", rcvPassword)
    document.getElementById(ID).appendChild(inputHidden)
    Submit(ID,[])
}