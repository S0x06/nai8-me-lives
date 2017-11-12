function _showDataOnPage(id,data,link){

    //显示一个桌面通知
    if(window.webkitNotifications){

        var notification = window.webkitNotifications.createNotification(
            'images/icon16.png',
            '我是标题',
            data
        );
        notification.show();
        setTimeout(function(){notification.cancel();}, 5000);

    }else if(chrome.notifications){

        var opt = {
            type: 'basic',
            title: '我是标题',
            message:data,
            iconUrl: 'images/icon16.png',
        };
        chrome.notifications.create('', opt, function(id){
            chrome.notifications.onClicked.addListener(function(){
                chrome.notifications.clear(id);
                window.open(link); //optional
            });

            setTimeout(function(){
                chrome.notifications.clear(id);
            }, 5000);
        });

    }else{

    }

}

setInterval(function(){
    _showDataOnPage(100,'hello world','http://nai8.me');
},3000);