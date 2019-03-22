function callapi(data, success) {
    return new Promise((resolve, reject) => {
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": window.chatAPIAddress + "/api/database",
            "method": "POST",
            "headers": {
                "Content-Type": "application/json",
                "cache-control": "no-cache",
            },
            "processData": false,
            "data": JSON.stringify(data)
        }

        $.ajax(settings).done(function (response) {
            resolve(response);
        });
    });
}


function callsharedapi(data) {
    return new Promise((resolve, reject) => {
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": window.chatAPIAddress + "/api/manager",
            "method": "POST",
            "headers": {
                "Content-Type": "application/json",
            },
            "processData": false,
            "data": JSON.stringify(data)
        }

        $.ajax(settings).done(function (response) {
            console.log(response);
        });
    });
}