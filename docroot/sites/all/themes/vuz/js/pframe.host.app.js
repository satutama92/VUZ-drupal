/*
    Pframe solution. Host App. Included in parent page (that contains the iframe)
    Version: 1.1.9
    Author: Jinn Nguyen
*/

/* Setup Communication Request Handler */
HostPframeHandler = function (msgData) {
    switch (msgData.code) {
        case "loadziggyesaf":
            var easfMasterKey = msgData.msg;
            //PM.removeAllMastersExceptCurrentPframeDetails('#frmContent');
            PM.removeAllMastersExceptCurrentSharedPframe();
            PM.loadZiggyESAF(easfMasterKey);
            break;
        case "closeesaf":
            var pframeSelector = msgData.msg;
            PM.removeAllMastersExceptCurrentSharedPframe();
            break;
        case "updatemasterdata":
            var updateUrl = msgData.msg;
            PM.updateMasterData(updateUrl, null);
            break;
        case "reconstructlayoutmultiobjs":
            var updateUrl = msgData.msg;
            PM.reconstructLayoutContent(updateUrl, '', '', 'Append', PM.triggerMultiObjectsBC);
            break;
        case "updatemasterdatamultiobjs":
            var updateUrl = msgData.msg;
            PM.updateMasterData(updateUrl, '', PM.triggerMultiObjectsBC);
            break;
        case "closemultiobjs":
            var pframeSelector = msgData.msg;
            PM.removeAllMastersExceptCurrentSharedPframe(pframeSelector);
            break;
        case "setmulobjectextraattr":
            var attrInfo = JSON.parse(msgData.msg);
            PM.setSharedPframeAttribute(attrInfo.attrName, attrInfo.attrValue);
            break;
        case "updatemultiobjstatus":
            var statuses = JSON.parse(msgData.msg);
            var oPframe = PM.Controls.getByType('pframepane')[0];
            oPframe.setStatus(statuses.containerStatus);
            PM.triggerMultiObjectsBC();
            break;
    }
}


/* Function that send request to client pframe */
PFHost.sendZiggyRequestToDiv = function (serializedFormData) {
    var msgData = PFHost.Msg.composeMessage("saveincidentziggy", serializedFormData); //for PFrame
    PFHost.Msg.sendRequest(msgData);
};

PFHost.setPframeShowUnloadMessage = function (show) {
    var msgData = PFHost.Msg.composeMessage("setshowunloadmessage", show); //for PFrame
    PFHost.Msg.sendRequest(msgData);
};


PFHost.triggerMultiObjectAction = function (actionName) {
    switch (actionName) {
        case "Recalculate":
            var msgData = PFHost.Msg.composeMessage("recalculate", ""); //for PFrame
            PFHost.Msg.sendRequest(msgData);
            break;
        case "Calculate":
            var msgData = PFHost.Msg.composeMessage("calculate", ""); //for PFrame
            PFHost.Msg.sendRequest(msgData);
            break;
    }
};

