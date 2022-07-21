function Submit(ID, checkExistsList = [], addHidden = []) {
    console.log(addHidden['executeType']);
    yes = true
    checkExistsList.every((checkExists, i) => {
        console.log(checkExists);
        if (document.getElementById(checkExists).value === "") {
            alert('missing' + checkExists);
            yes = false
            return true;
        }
    })
    for (const key in addHidden) {
        console.log(key);
        document.getElementsByName(key).value = addHidden[key];
    }
    if (yes) {
        document.getElementById(ID).submit();
    }
}

function getAndShowPost(articleId){
    document.getElementById("commentSection").innerHTML = ""
    fetch('commentReload.php?articleId='+articleId).then(function (response) {
        response.text().then(function (content) {
            document.getElementById("commentSection").innerHTML = content;
        })
    })
}