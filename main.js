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
    for (const key in addHidden){
        console.log(key);
        document.getElementsByName(key).value = addHidden[key];
    }
    if (yes) {
        document.getElementById(ID).submit();
    }
}
const mysql = require('mysql2');
keyDir = "././serverFiles/key.txt"
const pool = mysql.createPool({
  host: '호스트',
  user: '유저',
  database: '데이터베이스',
  password: '비밀번호',
});
