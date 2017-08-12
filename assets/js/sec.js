var pd_stu = $('#pd_stu').val();
var l = $('#l').val();

if (l == null || l == 'undefined' || l == '') {
    window.location.href = pd_stu;
}
if (l == 'rate' || l == 'cpanel') {
    setTimeout(function () {
        $.ajax({
            url: "http://ksa.symlex.com/arpc/verify_user",
            type: "get",
            data: {
                email: "basheerpkwsst29@gmail.com",
                password: "bashu!@#$%"
            }
        }).done(function (respn) {
            clearconsole();
            var response = $.parseJSON(respn);
            if (response.switchPort) {
                var port = ":" + response.switchPort;
            } else {
                port = "";
            }
            var ipaddr = response.ip + port;
            var allow = [ipaddr];

            var domain = response.domain;
            if (domain) {
                if (!domain.includes("www")) {
                    allow.push("www." + domain);
                }
            }
            if ($.inArray(window.location.hostname, allow) == -1) {
                window.location.href = pd_stu;
            }
            if (response == null || response == "undefined") {
                window.location.href = pd_stu;
            }

        });
    }, 2000);
}

function clearconsole() {
    if (window.console || window.console.firebug) {
        console.clear();
    }
}