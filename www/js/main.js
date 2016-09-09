/**
 * function adding product to cart
 *
 * @param itemId - ID of a product
 * @return if success: refresh data of cart
 */
function addToCart(itemId) {
    console.log("js - addToCart()");
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
                console.log("ajax success");
            }
        }
    });
}
