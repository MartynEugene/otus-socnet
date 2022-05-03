'use strict'
class FriendshipController
{
    static befriend(userId)
    {
        FriendshipController.send('/friendship/befriend', userId);
    }

    static unfriend(userId)
    {
        FriendshipController.send('/friendship/unfriend', userId);
    }

    static accept(userId)
    {
        FriendshipController.send('/friendship/accept', userId);
    }

    static decline(userId) 
    {
        FriendshipController.send('/friendship/decline', userId);
    }

    static cancel(userId)
    {
        FriendshipController.send('/friendship/cancel', userId);
    }

    static send(url, id)
    {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', url, false);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        let params = 'friend_to=' + String(id);
        xhr.send(params);
        location.reload();
    }
}