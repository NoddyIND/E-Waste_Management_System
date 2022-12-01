function formDisplay(){
    if ( document.getElementById('achievement') )
        document.getElementById('achievement').style.display='none';
    var B = document.getElementById("request");
    B.style.display = "none";
    var C = document.getElementById("formtag"),
    displayValue = "";
    C.style.display = displayValue;
    document.getElementById("btn_status").style.display = "none";
}

function closeReq(){
    if ( document.getElementById('achievement') )
        document.getElementById('achievement').style.display="";
    var E = document.getElementById("request");
    E.style.display = "";
    var F = document.getElementById("formtag");
    F.style.display = "none";
    document.getElementById("btn_status").style.display = "";
}

function achive(){
    var G = document.getElementById("col_sep");
    G.style.display = "";
    var H = document.getElementById("achive");
    H.style.display = "";
    var I = document.getElementById("achievement");
    I.style.display = "none";
    var J = document.getElementById("request");
    J.style.display = "none";
    var K = document.getElementById("formtag");
    K.style.display = "none";
    var A = document.getElementById("detail");
    A.style.display = "none";
    var S = document.getElementById("detail_btn");
    S.style.display = "";
    document.getElementById("btn_status").style.display = "none";
}

function backAchive(){
  var L = document.getElementById("col_sep");
    L.style.display = "none";
    var M = document.getElementById("achive");
    M.style.display = "none";
    var N = document.getElementById("achievement");
    N.style.display = "";
    var O = document.getElementById("request");
    O.style.display = "";
    var P = document.getElementById("formtag");
    P.style.display = "none";
    document.getElementById("btn_status").style.display = "";
    
}

function details(){
    var Q = document.getElementById("col_sep");
    Q.style.display = "none";
    var R = document.getElementById("detail");
    R.style.display = "";
    var S = document.getElementById("detail_btn");
    S.style.display = "none";

}

function status(){
    document.getElementById("request").style.display = "none";
    document.getElementById("achievement").style.display = "none";
    document.getElementById("btn_status").style.display = "none";
    document.getElementById("status_back_btn").style.display = "";
    document.getElementById("status").style.display = "";

}

function status_back(){
    document.getElementById("request").style.display = "";
    document.getElementById("achievement").style.display = "";
    document.getElementById("btn_status").style.display = "";
    document.getElementById("status_back_btn").style.display = "none";
    document.getElementById("status").style.display = "none";
}

$(document).ready(function () {
    $('select').selectize({
        sortField: 'text'
    });
});