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
    Submit(ID,[])
}