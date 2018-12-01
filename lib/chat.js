
window.ipAddress = "http://35.232.123.231";
var app = angular.module("data", []);

app.controller("mainController", function ($scope, $http, $rootScope) {

    $rootScope.$broadcast('onLoadingProgress', false);

    // function getUrlParameter(name) {
    //     name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    //     var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    //     var results = regex.exec(location.search);
    //     return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    // };

    // var id = getUrlParameter('id');
    // if (id === "1")
    //     localStorage.setItem("USERID", "5bf65be2cbfdb41abc8c85f6");
    // else
    //     localStorage.setItem("USERID", "5bf65be2cbfdb41abc8c85f9");

    $scope.userId = localStorage.getItem("USERID");
    if($scope.userId){
        $http.get(window.ipAddress+':8100/GETUSERCHATGROUPS/' + $scope.userId).then((res) => {
            console.log(res);
            localStorage.setItem("GROUPS", JSON.stringify(res.data.groups));
            localStorage.setItem("MESSAGES", JSON.stringify(res.data.messages));
            $rootScope.$broadcast('onLoadingProgress', true);
        })
    }

    angular.element(document).ready(function () {
        startChat();
    });

    function startChat() {
        window.socket = io(window.ipAddress+":8200");
        window.socket.on('connect', function () {
            window.socket.emit('connectUser', { UserId: $scope.userId });
            // window.socket.on('typing',);
            // window.socket.on('stopTyping',);
            // window.socket.on('textMessage',);

        });

        window.socket.on('onTextMessage', function (data) {
            $rootScope.$broadcast('onTextMessage', data);
            console.log(data);
            //socket.emit('readNotification', {GroupId: groupId, SenderId: localStorage.getItem("USERID")});  
        });
        window.socket.on('onMediaMessage', function (data) {
            $rootScope.$broadcast('onMediaMessage', data);
            console.log(data);
            //socket.emit('readNotification', {GroupId: groupId, SenderId: localStorage.getItem("USERID")});  
        });
        window.socket.on('onTyping', function (data) {
            $rootScope.$broadcast('onTyping', data);
            console.log(data);

            //socket.emit('readNotification', {GroupId: groupId, SenderId: localStorage.getItem("USERID")});  
        });
        window.socket.on('onReadNotification', function (data) {
            $rootScope.$broadcast('onReadNotification', data);
            console.log(data);


        });
        window.socket.on('onStopTyping', function (data) {
            $rootScope.$broadcast('onStopTyping', data);
            console.log(data);

            //socket.emit('readNotification', {GroupId: groupId, SenderId: localStorage.getItem("USERID")});  
        });
    }
});


app.controller("chatController", function ($scope,$http) {
    $scope.loadingProgress = false;
    $scope.currentGroup = null;
    $scope.userId = localStorage.getItem("USERID");
    $scope.loadedAlready = false;

    $scope.loadGroups = function () {
        $scope.groups = JSON.parse(localStorage.getItem("GROUPS"))
        $scope.messages = JSON.parse(localStorage.getItem("MESSAGES"));
        if($scope.groups && $scope.groups.length>0 && $scope.loadedAlready == false){
            $scope.openGroup($scope.groups[0]);
            $scope.loadedAlready = true;
        }
    }

    $scope.getDefaultMessage = function (user, groupId, message, isMedia, mediatype, isnotification, taggedMessge) {
        var dateObject = new Date();
        var ClientMessageId = this.generateClientMessageId();
        var obj = {
            GroupId: groupId,
            SenderId: user,
            TextMessage: message,
            ImageUrl: message,
            VideoUrl: message,
            SendTime: moment.utc().format("MM/DD/YYYY HH:mm:ss A"),
            IsActive: "1",
            CreatedBy: user,
            ModifiedBy: user,
            CreatedOn: moment.utc().format("MM/DD/YYYY HH:mm:ss A"),
            ModifiedOn: moment.utc().format("MM/DD/YYYY HH:mm:ss A"),
            MediaType: mediatype,
            ClientMessageId: ClientMessageId,
            ReadStatus: false,
            BlurURL: "",
            PushStatus: "ServerRecieved",
            ReadBy: [$scope.getReadObject(user, groupId)],
            deleveryStatus: "New",
            DeleverTo: [],
            senderImage: user.image,
            isMedia: isMedia,
            isnotification: isnotification,
            TaggedMessge: taggedMessge
        }

        return obj;
    }

    $scope.generateClientMessageId = function () {
        var d = new Date();
        return d.getTime();
    }

    $scope.getReadObject = function (userid, groupid) {
        // return "";
        return {
            userid: userid,
            time: moment.utc().format("MM/DD/YYYY HH:mm:ss A")
        };
    }

    $scope.sendMessage = function () {

        if ($scope.typedmessage) {
            window.socket.emit('textMessage', { GroupId: $scope.currentGroup._id, SenderId: $scope.userId, MsgText: $scope.typedmessage, ClientMessageId: "-1", isNotification: false });
            var ClientMessageId = $scope.generateClientMessageId();
            var obj = $scope.getDefaultMessage($scope.userId, $scope.currentGroup._id, $scope.typedmessage, false, "0", false, "");
            $scope.messages.push(obj);
            $scope.typedmessage = "";
            scrollToBottom();
        }
    }

    $scope.openFile = function () {
        document.getElementById("img").click();
    }

    $scope.manageUnreadCount = function (data) {
        for (var gCounter = 0; gCounter < $scope.groups.length; gCounter++) {
            if ($scope.groups[gCounter]._id === data.messageInfo.GroupId && $scope.currentGroup._id !== data.messageInfo.GroupId) {
                $scope.groups[gCounter].unreadCount = ($scope.groups[gCounter].unreadCount || 0) + 1;
            }
        }
    }

    $scope.sendReadNotifcation = function (groupId) {
        try {
            window.socket.emit('readNotification', { GroupId: groupId, SenderId: $scope.userId });
        }
        catch (ex) {
            console.log(ex);
        }
    }

    $scope.mediaMessage = function (file) {
        console.log(file);
        var msg = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSl2ibKfw9K6ntYDgzFx55xcEiOZSO7YBASCruP5R5ckNE2Sv5K";
        window.socket.emit('mediaMessage', { GroupId: $scope.currentGroup._id, SenderId: $scope.userId, MsgText: msg, ClientMessageId: -1, TaggedMessge: "defaultMessage", MediaType: 0, VideoImage: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSl2ibKfw9K6ntYDgzFx55xcEiOZSO7YBASCruP5R5ckNE2Sv5K" });
        var ClientMessageId = $scope.generateClientMessageId();
        var obj = $scope.getDefaultMessage($scope.userId, $scope.currentGroup._id, msg, true, "0", false, "");
        $scope.messages.push(obj);
        scrollToBottom();
        $scope.$apply();
    }

    $scope.openGroup = function (group) {
        group.unreadCount = 0;
        $scope.currentGroup = group;
        $scope.sendReadNotifcation(group._id);
    }


    $scope.searchMessage = function(searchText){
       for(var mCounter =0;mCounter<$scope.messages.length;mCounter++){
           if($scope.messages[mCounter].TextMessage.indexOf(searchText) >= 0){
            $scope.messages[mCounter].hideOnUI = false;
           } else{
           $scope.messages[mCounter].hideOnUI = true;
           }
        }
        $scope.$apply();
    }

    $scope.valuechange = function ($event) {
        if ($event.keyCode == 13) {
            $scope.sendMessage();
            $scope.typedmessage = "";
        }
        else {
            updateTyping();
        }
    }

    $scope.$on('onLoadingProgress', function (event, data) {
        $scope.loadingProgress = data;
        if($scope.loadingProgress){
            $scope.loadGroups();
        }
    });

    $scope.$on('onTextMessage', function (event, data) {
        $scope.messages.push(data.messageInfo);
        console.log($scope.messages)
        $scope.manageUnreadCount(data);
        $scope.sendReadNotifcation(data.messageInfo.GroupId);
        scrollToBottom();
        $scope.$apply();
    });
    $scope.$on('onMediaMessage', function (event, data) {
        $scope.messages.push(data.messageInfo);
        console.log($scope.messages)
        $scope.manageUnreadCount(data);
        $scope.sendReadNotifcation(data.messageInfo.GroupId);
        scrollToBottom();
        $scope.$apply();
    });

    $scope.$on('onReadNotification', function (event, data) {
        console.log(data);

    });

    $scope.$on('onTyping', function (event, data) {
        console.log(data);
        for (var gCounter = 0; gCounter < $scope.groups.length; gCounter++) {
            if ($scope.groups[gCounter]._id === data.GroupId) {
                $scope.groups[gCounter].isTyping = true;
            }
        }

        if ($scope.currentGroup._id === data.GroupId) {
            $scope.currentGroup.isTyping = true;
        }

        $scope.$apply();
    });

    $scope.$on('onStopTyping', function (event, data) {
        console.log(data);
        for (var gCounter = 0; gCounter < $scope.groups.length; gCounter++) {
            if ($scope.groups[gCounter]._id === data.GroupId) {
                $scope.groups[gCounter].isTyping = false;
            }
        }

        if ($scope.currentGroup._id === data.GroupId) {
            $scope.currentGroup.isTyping = false;
        }

        $scope.$apply();
    });



    TYPING_TIMER_LENGTH = 700;
    lastTypingTime = null;
    function updateTyping() {
        lastTypingTime = (new Date()).getTime();
        window.socket.emit('typing', { GroupId: $scope.currentGroup._id, SenderId: $scope.userId });
        setTimeout(function () {
            var typingTimer = (new Date()).getTime();
            var timeDiff = typingTimer - lastTypingTime;
            if (timeDiff >= self.TYPING_TIMER_LENGTH) {
                window.socket.emit('stopTyping', { GroupId: $scope.currentGroup._id, SenderId: $scope.userId });
            }
        }, TYPING_TIMER_LENGTH)
    }

    function scrollToBottom(){
        var div = document.getElementById("chatContent");
        div.scrollTop = div.scrollHeight - div.clientHeight;
     }

    
    //relaod parallal in case of fallback 
    var userId = localStorage.getItem("USERID");
    if(userId){
        $http.get(window.ipAddress+':8100/GETUSERCHATGROUPS/' + userId).then((res) => {
            console.log(res);
            localStorage.setItem("GROUPS", JSON.stringify(res.data.groups));
            localStorage.setItem("MESSAGES", JSON.stringify(res.data.messages));
            $scope.loadGroups();
        })
    }
});


