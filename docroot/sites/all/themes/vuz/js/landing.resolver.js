/*
PFRame resolver. (2013) Duc Tuan Nguyen  (Jinn)
***********************************************
Used to integrate with iFrame solution by passing url from host page (DNN CMS)...
- TargetIframe src: By default if the targetChildFrame has a src, this src will be used and append RegistrationHash to it. If protal/instanceId/proxy.ashx is used. THIS SRC must have ?instanceId=... Otherwise, childLPLandingUrl will be used
- 2 modes: lpgo | lplanding . Detected by HOST URL. Note: lplanding mode: used by LPlanding.aspx & emailvalidated.aspx
- allkeys: must be in lowercase

Example:
http://vuz.intrasurance-cms.nl/transferlanding:
<iframe width="100%" scrolling="no" frameborder="0" name="frmContent" id="frmContent" src="http://vuz.intrasurance-cms.nl/portals/1/proxy.ashx?/DIVPublic/EmailValidated.aspx?instanceid=1" style="display: inline-block; height: 1305px;"></iframe>

*/

jQuery(document).ready(function(){
    LPL.landChildFrame();

});

var LPL = LPL || {};
LPL = {
    registrationHashKey: "registrationhash",
    instanceIdKey: "instanceid",
    lpGoLPKey: "lp",
    lpGoProductKey: "to", 
    lpLandingPage: "landing",
    lpGoPage: "lpgo",
    landingMode: "lplanding",
    instanceId: 1,
    childLPLandingUrl: "http://public/DIVPublic/LPLanding.aspx?InstanceId=" + this.instanceId, //only used when targetChildFrame doesn't have src
    targetChildFrameId: "frmContent",

    landChildFrame: function () {    
        
        var targetChildFrame = document.getElementById(LPL.targetChildFrameId);
        if(targetChildFrame == undefined || targetChildFrame == null)
            return false;
        
        var fullChildUrl = LPL.getChildLPLandingUrl(targetChildFrame);
        var queryStringDelimiter = fullChildUrl.indexOf('?') >= 0 ? '&' : '?';

        this.landingMode = LPL.dectectLandingMode();

        if(this.landingMode == this.lpLandingPage)
        {
            var hashValue = LPL.getUrlParameterByName(this.registrationHashKey);
            fullChildUrl = fullChildUrl + queryStringDelimiter + LPL.registrationHashKey + "=" + hashValue;// + "&" + this.instanceIdKey + "=" + this.instanceId;

        }
        else //go page
        {
            var lpValue = LPL.getUrlParameterByName(this.lpGoLPKey);
            var productValue = LPL.getUrlParameterByName(this.lpGoProductKey);
            fullChildUrl = fullChildUrl + queryStringDelimiter + this.lpGoLPKey + "=" + lpValue + "&" + this.lpGoProductKey + "=" + productValue;
        }

        targetChildFrame.src = fullChildUrl;

        return true;
    },

    dectectLandingMode:function() {
        var href = window.location.href.toLowerCase();
        
        if(href.indexOf(this.lpGoPage) >= 0)
            return this.lpGoPage;

        return this.lpLandingPage;
    },

    getChildLPLandingUrl: function(targetChildFrame){
      
        if (targetChildFrame == null || targetChildFrame == undefined)
            return undefined;

        return (targetChildFrame.src != undefined && targetChildFrame.src !== "")? targetChildFrame.src : LPL.childLPLandingUrl;
    },

    //case insensitive (from querystring)
    getUrlParameterByName: function(name) {
        var locationSearch = window.location.search.toLowerCase();
        var match = RegExp('[?&]' + name + '=([^&]*)').exec(locationSearch);
        return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
    }
}
