"use strict"
class Logout
{
    static logout(url, id)
    {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '/logout');
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send();
        location.reload();
    }
}