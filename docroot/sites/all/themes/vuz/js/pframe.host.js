/*
    Pframe solution. Host. Included in parent page (that contains the iframe)
    Version: 1.1.9
    Author: Jinn Nguyen
*/

jQuery(document).ready(function () {
    PFHost.init();
});

Array.prototype.contains = function (obj) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] === obj) {
            return true;
        }
    }
};

/* PFHost - PFrame namespace for Host Page*/
var PFHost = PFHost || {};
PFHost = {
    childOrigins: [
        'http://intraman.ws166.intrasurance.int', 'https://intraman.ws166.intrasurance.int', 
        'http://intrapub.ontwikkeluzelf.nl', 'https://intrapub.ontwikkeluzelf.nl', 
        'http://intrapub.testuzelf.nl', 'https://intrapub.testuzelf.nl', 
        'http://intrapub.accepteeruzelf.nl', 'https://intrapub.accepteeruzelf.nl',
        'http://div.verzekeruzelf.nl', 'https://div.verzekeruzelf.nl',
        'http://zakelijk.verzekeruzelf.nl', 'https://zakelijk.verzekeruzelf.nl',
        'http://verzekeruzelf.ontwikkeluzelf.nl', 'https://verzekeruzelf.ontwikkeluzelf.nl',
        'http://verzekeruzelf.accepteeruzelf.nl','https://verzekeruzelf.accepteeruzelf.nl',
        'http://pvverzekeruzelf.ws166.intrasurance.int', 'https://pvverzekeruzelf.ws166.intrasurance.int',
        'http://pvverzekeruzelf.ontwikkeluzelf.nl', 'https://pvverzekeruzelf.ontwikkeluzelf.nl',
        'http://pvverzekeruzelf.testuzelf.nl', 'https://pvverzekeruzelf.testuzelf.nl', 
        'http://pvverzekeruzelf.accepteeruzelf.nl', 'https://pvverzekeruzelf.accepteeruzelf.nl',
        'http://premievergelijker.verzekeruzelf.nl', 'https://premievergelijker.verzekeruzelf.nl',
        'http://magnum.intrasurance.nl', 'https://magnum.intrasurance.nl',
        'http://localhost:48543', 'https://localhost:48543'

    ], // allowed origin(s) from the hosted page

    currentIframeSelector: 'frmContent', //must be ID of the iframe
    $currentIframe: "",

    // Host Page should always listen for messages from hosted page
    onReceiveMessage: function (event) {
        if (!PFHost.childOrigins.contains(event.origin)) {
            
            return;
        }
        PFHost.$currentIframe = document.getElementById('frmContent');

        var msgData = PFHost.Msg.resolveMessage(event.data); //return a jSon message formed with: "CODE||MSG", return "" if the message is not valid
        if (msgData == "") return;

        // Only resize event is handled here!
        if (msgData.code == "resize") {            
            var height = parseInt(msgData.msg) + 30; //add extra offset value for ie problem
            PFHost.$currentIframe.style.height = height + 'px';
        }
        else if (msgData.code == "movetop") {
            PFHost.moveToTopOfChildFrame();
        }
        else if(msgData.code == "requesthosturl") {
            PFHost.sendUrlToChildPframe();
        }

        HostPframeHandler(msgData);
    },
    init: function() {
        PFHost.$currentIframe = document.getElementById('frmContent');
        PFHost.Msg.receiveMessage(PFHost.onReceiveMessage, PFHost.childOrigins[0]);
    },
    moveToTopOfChildFrame: function () {
        jQuery('html, body').animate({
            scrollTop: PFHost.$currentIframe.style.top
        }, 20);
    },
    sendUrlToChildPframe: function(){
        var msgData = PFHost.Msg.composeMessage("hosturl", window.location.host); //for PFrame
        PFHost.Msg.sendRequest(msgData);
    }
};



// everything is wrapped in the PFHost.Msg function to reduce namespace collisions
PFHost.Msg = function () {
    var interval_id,
    last_hash,
    cache_bust = 1,
    attached_callback,
    window = this;

    return {
        sendRequest: function (message) {
            var target_url = PFHost.childOrigins[0];
            if (!target_url) {
                return;
            }
            var targetFrame = document.getElementById("frmContent");
            if (targetFrame == undefined)
                return;

            var target = targetFrame.contentWindow;
            target_url = "*"; //test
            if (window['postMessage']) {
                // the browser supports window.postMessage, so call it with a targetOrigin
                // set appropriately, based on the target_url parameter.
                target['postMessage'](message, target_url.replace(/([^:]+:\/\/[^\/]+).*/, '$1'));
            } else if (this.childOrigins[0]) {
                // the browser does not support window.postMessage, so use the window.location.hash fragment hack
                target.location = target_url.replace(/#.*$/, '') + '#' + (+new Date) + (cache_bust++) + '&' + message;
            }
        },
        receiveMessage: function (callback, source_origin) {
            // browser supports window.postMessage
            if (window['postMessage']) {
                // bind the callback to the actual event associated with window.postMessage
                if (callback) {
                    attached_callback = function (e) {

                        if ((typeof source_origin === 'string' && e.origin !== source_origin)
                        || (Object.prototype.toString.call(source_origin) === "[object Function]" && source_origin(e.origin) === !1)) {
                            //return !1;
                        }

                        callback(e);
                    };
                }

                if (window['addEventListener']) {
                    window[callback ? 'addEventListener' : 'removeEventListener']('message', attached_callback, !1);
                } else {
                    window[callback ? 'attachEvent' : 'detachEvent']('onmessage', attached_callback);
                }
            } else {
                // a polling loop is started & callback is called whenever the location.hash changes
                interval_id && clearInterval(interval_id);
                interval_id = null;
                if (callback) {
                    interval_id = setInterval(function () {
                        var hash = document.location.hash,
                         re = /^#?\d+&/;
                        if (hash !== last_hash && re.test(hash)) {
                            last_hash = hash;
                            callback({ data: hash.replace(re, ''), origin: originUrl }); //when the parent is location is set the the origin will not matter, set it to the correct one to by pass initial check
                        }
                    }, 100);
                }
            }
        },
        resolveMessage: function (message) { //return a jSon message formed with: "CODE||MSG", return "" if the message is not valid
            if (message == undefined || message == null)
                return "";

            var parts = message.split("||");
            if (parts.length != 2)
                return "";

            return { "code": parts[0], "msg": parts[1] }
        },
        composeMessage: function (code, msg) {
            return '{0}||{1}'.format(code, msg);
        }, 
        getUrlParameterByName: function (name) { //case sensitive
            var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
            return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
        }
    };
}();

String.prototype.format = function () {
    var args = arguments;
    return this.replace(/\{(\d+)\}/g, function (m, n) { return args[n]; });
};
