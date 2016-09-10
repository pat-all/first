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
