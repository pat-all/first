function addToCart(itemId) {
    console.log("js - addToCart()");
    $.ajax({
        type: "POST",
        async: false,
        url: "/Cart/addToCart/" + itemId + "/",
        dataType: "json",
        success: function (data) {
            if(data["success"]){
                $("#cartCntItems").html(data["cntItems"]);

                $("#addCart_" + itemId).hide();
                $("#removeCart_" + itemId).show();
                console.log("ajax success");
            }
        }
    });
}
