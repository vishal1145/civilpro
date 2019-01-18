window.chatAPIAddress="http://157.230.57.197:9100";
window.socketAPIAddress="http://157.230.57.197:9200";

var app = angular.module("data", []);

app.controller("mainController", function ($scope, $http, $rootScope) {

    $rootScope.$broadcast('onLoadingProgress', false);

    $rootScope.setUnreadCount = function () {
        var msgs = $scope.allmessages; // JSON.parse(localStorage.getItem("MESSAGES"));
        var allUnreadMessages = 0;
        for (var i = 0; i < msgs.length; i++) {
            var unread = true;
            for (var j = 0; j < msgs[i].ReadBy.length; j++) {
                if (msgs[i].ReadBy[j].userid === $scope.userId) {
                    unread = false;
                }
            }
            if (unread)
                allUnreadMessages++;
        }
        try{
        $rootScope.unreadCount = allUnreadMessages;
        //$rootScope.unreadCount=10;
        if($rootScope.unreadCount > 0)
        {
           
          var x = document.getElementById("unreadcount").innerHTML = allUnreadMessages;
        }
    }catch(err){
        //document.getElementById("unreadcount").innerHTML = err.msg;
    }
        

    }

    $scope.userId = localStorage.getItem("USERID");
    if ($scope.userId) {
        $http.get(window.chatAPIAddress+'/GETUSERCHATGROUPS/' + $scope.userId).then((res) => {
            localStorage.setItem("GROUPS", JSON.stringify(res.data.groups));
            localStorage.setItem("MESSAGES", JSON.stringify(res.data.messages));
            $scope.allmessages = res.data.messages;
            $rootScope.setUnreadCount();
            $rootScope.$broadcast('onLoadingProgress', true);
        })
    }

    angular.element(document).ready(function () {
        startChat();
    });

    function startChat() {
        window.socket = io(window.socketAPIAddress);
        window.socket.on('connect', function () {
            window.socket.emit('connectUser', {
                UserId: $scope.userId
            });
        });

        window.socket.on('onTextMessage', function (data) {            
            $scope.allmessages.push(data.messageInfo);
            $rootScope.setUnreadCount();
            $rootScope.$broadcast('onTextMessage', data);
        });
        window.socket.on('onMediaMessage', function (data) {
            $scope.allmessages.push(data.messageInfo);
            $rootScope.setUnreadCount();
            $rootScope.$broadcast('onMediaMessage', data);
        });
        window.socket.on('onTyping', function (data) {
            $rootScope.$broadcast('onTyping', data);
        });
        window.socket.on('onReadNotification', function (data) {
            $rootScope.$broadcast('onReadNotification', data);
        });

        window.socket.on('onStopTyping', function (data) {
            $rootScope.$broadcast('onStopTyping', data);
        });
    }
});


app.controller("chatController", function ($scope, $http, $rootScope) {
    $scope.loadingProgress = false;
    $scope.currentGroup = null;
    $scope.userId = localStorage.getItem("USERID");
    $scope.loadedAlready = false;

    $scope.loadGroups = function () {
        $scope.groups = JSON.parse(localStorage.getItem("GROUPS"))
        $scope.messages = JSON.parse(localStorage.getItem("MESSAGES"));
        if ($scope.groups && $scope.groups.length > 0 && $scope.loadedAlready == false) {

            for (var gCounter = 0; gCounter < $scope.groups.length; gCounter++) {
                $scope.groups[gCounter].unreadCount = $scope.getUnreadCount($scope.groups[gCounter]);
            }

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
            window.socket.emit('textMessage', {
                GroupId: $scope.currentGroup._id,
                SenderId: $scope.userId,
                MsgText: $scope.typedmessage,
                ClientMessageId: "-1",
                isNotification: false
            });
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

    $scope.getUnreadCount = function (group) {
        console.log(group);
        $scope.messages = $scope.messages || [];
        var allUnreadMessages = 0;
        for (var i = 0; i < $scope.messages.length; i++) {

            if ($scope.messages[i].GroupId == group.id) {
                var index = -1;
                for (var j = 0; j < $scope.messages[i].ReadBy.length; j++) {
                    if ($scope.messages[i].ReadBy[j].userid === $scope.userId) {
                        index = i;
                    }
                }
                if (index === -1)
                    allUnreadMessages++;
            }
        }
        return allUnreadMessages;
    }


    $scope.manageUnreadCount = function (data) {
        for (var gCounter = 0; gCounter < $scope.groups.length; gCounter++) {
            if ($scope.groups[gCounter]._id === data.messageInfo.GroupId && $scope.currentGroup._id !== data.messageInfo.GroupId) {
                $scope.groups[gCounter].unreadCount = ($scope.groups[gCounter].unreadCount || 0) + 1;
            }
        }
        $rootScope.setUnreadCount();
    }

    $scope.sendReadNotifcation = function (groupId) {
        try {
            window.socket.emit('readNotification', {
                GroupId: groupId,
                SenderId: $scope.userId
            });
            var msgs = JSON.parse(localStorage.getItem("MESSAGES"));
            for (var i = 0; i < msgs.length; i++) {
                var isExist = false;
                msgs[i].ReadBy = msgs[i].ReadBy || [];
                for (var j = 0; j < msgs[i].ReadBy.length; j++) {
                    if (msgs[i].ReadBy[j].userid !== $scope.userId) {
                        isExist = true;
                    }
                }
                if (!isExist){
                    msgs[i].ReadBy.push({
                        userid: $scope.userId
                    });
                }
            }
            localStorage.setItem("MESSAGES", JSON.stringify(msgs));
            $rootScope.setUnreadCount();
        } catch (ex) {}
    }

    $scope.mediaMessage = function (file) {
        var msg = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSl2ibKfw9K6ntYDgzFx55xcEiOZSO7YBASCruP5R5ckNE2Sv5K";
        window.socket.emit('mediaMessage', {
            GroupId: $scope.currentGroup._id,
            SenderId: $scope.userId,
            MsgText: msg,
            ClientMessageId: -1,
            TaggedMessge: "defaultMessage",
            MediaType: 0,
            VideoImage: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSl2ibKfw9K6ntYDgzFx55xcEiOZSO7YBASCruP5R5ckNE2Sv5K"
        });
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


    $scope.searchMessage = function (searchText) {
        for (var mCounter = 0; mCounter < $scope.messages.length; mCounter++) {
            if ($scope.messages[mCounter].TextMessage.indexOf(searchText) >= 0) {
                $scope.messages[mCounter].hideOnUI = false;
            } else {
                $scope.messages[mCounter].hideOnUI = true;
            }
        }
        $scope.$apply();
    }

    $scope.valuechange = function ($event) {
        if ($event.keyCode == 13) {
            $scope.sendMessage();
            $scope.typedmessage = "";
        } else {
            updateTyping();
        }
    }

    $scope.$on('onLoadingProgress', function (event, data) {
        $scope.loadingProgress = data;
        if ($scope.loadingProgress) {
            $scope.loadGroups();
        }
    });

    $scope.$on('onTextMessage', function (event, data) {
        $scope.messages.push(data.messageInfo);
        if($scope.currentGroup._id !== data.messageInfo.GroupId)
            $scope.manageUnreadCount(data);
        else
            $scope.sendReadNotifcation(data.messageInfo.GroupId);
        scrollToBottom();
        $scope.$apply();
    });
    $scope.$on('onMediaMessage', function (event, data) {
        $scope.messages.push(data.messageInfo);
        if($scope.currentGroup._id !== data.messageInfo.GroupId)
            $scope.manageUnreadCount(data);
        else
            $scope.sendReadNotifcation(data.messageInfo.GroupId);
        scrollToBottom();
        $scope.$apply();
    });

    $scope.$on('onReadNotification', function (event, data) {

    });

    $scope.$on('onTyping', function (event, data) {
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
        window.socket.emit('typing', {
            GroupId: $scope.currentGroup._id,
            SenderId: $scope.userId
        });
        setTimeout(function () {
            var typingTimer = (new Date()).getTime();
            var timeDiff = typingTimer - lastTypingTime;
            if (timeDiff >= self.TYPING_TIMER_LENGTH) {
                window.socket.emit('stopTyping', {
                    GroupId: $scope.currentGroup._id,
                    SenderId: $scope.userId
                });
            }
        }, TYPING_TIMER_LENGTH)
    }

    function scrollToBottom() {
        var div = document.getElementById("chatContent");
        div.scrollTop = div.scrollHeight - div.clientHeight;
    }


    //relaod parallal in case of fallback 
    var userId = localStorage.getItem("USERID");
    if (userId) {
        $http.get(window.chatAPIAddress+'/GETUSERCHATGROUPS/' + userId).then((res) => {
            localStorage.setItem("GROUPS", JSON.stringify(res.data.groups));
            localStorage.setItem("MESSAGES", JSON.stringify(res.data.messages));
            $rootScope.setUnreadCount();
            $scope.loadGroups();
        })
    }

    $scope.highlight = function (type) {
        if (type == 1) {

            document.getElementById("liall").classList.add("active");
            document.getElementById("limy").classList.remove("active");

            document.getElementById("all_files").classList.add("active");
            document.getElementById("my_files").classList.remove("active");


        } else {
            document.getElementById("liall").classList.remove("active");
            document.getElementById("limy").classList.add("active");

            document.getElementById("all_files").classList.remove("active");
            document.getElementById("my_files").classList.add("active");

        }
    }


    var templates = {
        prefix: "",
        suffix: " ago",
        seconds: "less than a minute",
        minute: "about a minute",
        minutes: "%d minutes",
        hour: "about an hour",
        hours: "about %d hours",
        day: "a day",
        days: "%d days",
        month: "about a month",
        months: "%d months",
        year: "about a year",
        years: "%d years"
    };
    var template = function (t, n) {
        return templates[t] && templates[t].replace(/%d/i, Math.abs(Math.round(n)));
    };

    var timer = function (time) {
        if (!time) return;
        time = time.replace(/\.\d+/, ""); // remove milliseconds
        time = time.replace(/-/, "/").replace(/-/, "/");
        time = time.replace(/T/, " ").replace(/Z/, " UTC");
        time = time.replace(/([\+\-]\d\d)\:?(\d\d)/, " $1$2"); // -04:00 -> -0400
        time = new Date(time * 1000 || time);

        var now = new Date();
        var seconds = ((now.getTime() - time) * .001) >> 0;
        var minutes = seconds / 60;
        var hours = minutes / 60;
        var days = hours / 24;
        var years = days / 365;

        return templates.prefix + (
            seconds < 45 && template('seconds', seconds) || seconds < 90 && template('minute', 1) || minutes < 45 && template('minutes', minutes) || minutes < 90 && template('hour', 1) || hours < 24 && template('hours', hours) || hours < 42 && template('day', 1) || days < 30 && template('days', days) || days < 45 && template('month', 1) || days < 365 && template('months', days / 30) || years < 1.5 && template('year', 1) || template('years', years)) + templates.suffix;
    };

    setInterval(function () {
        if ($scope.messages && $scope.messages.length) {
            for (var mcounter = 0; mcounter < $scope.messages.length; mcounter++) {
                $scope.messages[mcounter].displaysenttime = timer($scope.messages[mcounter].SendTime);
            }
        }
    }, 1000);
});