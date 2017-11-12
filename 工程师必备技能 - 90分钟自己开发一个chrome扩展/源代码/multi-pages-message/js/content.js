chrome.runtime.onMessage.addListener(function(message, sender, sendResponse){
    if(message == 'Hello'){
        $('#title').html('我收到了监听');
    }
});