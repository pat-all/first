/**
 * function adding product to cart
 *
 * @param itemId - ID of a product
 * @return if success: refresh data of cart
 */
function addToCart(itemId) {
    console.log("js - addToCart("+ itemId +")");
    $.ajax({
        type: "POST",
        async: false,
        url: "/cart/addtocart/" + itemId + "/",
        dataType: "json",
        success: function(data) {
            if(data["success"]){
                $("#cartCntItems").html(data["cntItems"]);

                $("#addCart_" + itemId).hide();
                $("#removeCart_" + itemId).show();

                // isEmptyCart(data);
            }
        }
    });
}

function removeFromCart(itemId) {
    console.log("js - removeFromCart("+ itemId +")");
    $.ajax({
        type: "POST",
        async: false,
        url: "/cart/removefromcart/" + itemId + "/",
        dataType: "json",
        success: function(data) {
            if(data["success"]){
                $("#cartCntItems").html(data["cntItems"]);

                $("#addCart_" + itemId).show();
                $("#removeCart_" + itemId).hide();

                // isEmptyCart(data);
            }
        }
    });
}

function isEmptyCart(data) {
    if (data["cntItems"] === 0){
        $("#cartCntItems").html("Empty")
    }
}
/**
 * function calculates total price of product
 * @param itemId
 */
function conversionPrice(itemId) {

    var itemPrice = $("#itemPrice_" + itemId).attr("data-price");
    var newCnt = $("#itemCnt_" + itemId).val();
    var itemRealPrice;

    if (newCnt < 0){
        $("#itemCnt_" + itemId).val(0);
        newCnt = 0;
    }

    itemRealPrice = newCnt * itemPrice;

    $("#itemRealPrice_" + itemId).html(itemRealPrice);
}

function getData(obj) {
    var hData = {};
    $("input, textarea, select", obj).each(function () {
        if (this.name && this.name != ""){
            hData[this.name] = this.value;
            console.log("hData[" + this.name + "] = " + hData[this.name]);
        }
    });
    return hData;
}


function registerNewUser() {
    var postData = getData("#registerBox");

    $.ajax({
        type: "POST",
        async: false,
        url: "/user/register/0/",
        data: postData,
        dataType: "json",
        success: function (data) {
            if (data["success"]){
                alert(data["message"]);

                //>left side block
                $("#registerBox").hide();

                $("#userLink")
                    .attr("href", "/user/")
                    .html(data["userName"]);

                $("#userBox").show();
                //<

                $("#loginBox").hide();
                $("#btnSaveOrder").show();
            }else {
                alert(data["message"]);
            }
        }
    })
}

function login(){
    var email = $("#loginEmail").val();
    var pwd   = $("#loginPwd").val();

    var postData = "email=" + email + "&pwd=" + pwd;

    $.ajax({
        type: "POST",
        async: false,
        url: "/user/login/0/",
        data: postData,
        dataType: "json",
        success: function (data) {
            if(data["success"]){
                $("#registerBox").hide();
                $("#loginBox").hide();

                $("#userLink").
                    attr("href", "/user/").
                    html(data["displayName"]);
                $("#userBox").show();

                //> fill the fields on a order page
                $("name").val(data["name"]);
                $("phone").val(data["phone"]);
                $("address").val(data["address"]);
                //<

                $("#btnSaveOrder").show();
            } else {
                alert(data["message"]);
            }
        }
    });
}

function showRegBox() {
    $("#registerBoxHidden").toggle("fast");
}

/**
 * userDataUpdate
 *
 */
function updateUserData() {
    console.log("js - updateUserData");
    var phone   = $("#newPhone").val();
    var address = $("#newAddress").val();
    var pwd1    = $("#newPwd1").val();
    var pwd2    = $("#newPwd2").val();
    var curPwd  = $("#curtPwd").val();
    var name    = $("#newName").val();

    var postData = {phone: phone,
                    address: address,
                    pwd1: pwd1,
                    pwd2: pwd2,
                    curPwd: curPwd,
                    name: name
    };

    $.ajax({
        type: "POST",
        async: false,
        url: "/user/update/0/",
        data: postData,
        dataType: "json",
        success: function (data) {
            if (data["success"]){
                $("#userLink").html(data["userName"]);
                alert(data["message"]);
            } else {
                alert(data["message"]);
            }
        }
    })
}

/**
 * save order in data base
 */
function saveOrder() {
    var postData = getData("#frmOrder");
    $.ajax({
        type: "POST",
        async: false,
        url: "/cart/saveorder/0/",
        data: postData,
        dataType: "json",
        success: function (data) {
            if (data["success"]){
                alert(data["message"]);
                $(location).attr("href", "/");
            } else {
                alert("message");
            }
        }
    })
}

function showOrderedProducts(id) {
    $("#purchaseForOrder_" + id).toggle("fast");
}