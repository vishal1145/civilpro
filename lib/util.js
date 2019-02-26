function callapi(data, success) {
    return new Promise((resolve,reject) => {
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": "http://157.230.57.197:9100/api/database",
            //"url": "http://localhost:9100/api/database",
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