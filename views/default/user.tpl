{*User's page*}
<h2>Your register data</h2>
<table class="user-data">
    <tr>
        <td>Login (email)</td>
        <td>{$arUser["email"]}</td>
    </tr>
    <tr>
        <td>Name</td>
        <td><input type="text" id="newName" value="{$arUser["name"]}" placeholder="Name"></td>
    </tr>
    <tr>
        <td>Phone</td>
        <td><input type="text" id="newPhone" value="{$arUser["phone"]}" placeholder="Phone"></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><textarea id="newAddress" placeholder="Address">{$arUser["address"]}</textarea></td>
    </tr>
    <tr>
        <td>New password</td>
        <td><input type="password" id="newPwd1" value="" placeholder="New password"></td>
    </tr>
    <tr>
        <td>Confirm new password</td>
        <td><input type="password" id="newPwd2" value="" placeholder="Confirm password"></td>
    </tr>
    <tr>
        <td>To save changes enter your password</td>
        <td><input type="password" id="curtPwd" value="" placeholder="Current password"></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="button" value="Save" onclick="updateUserData();"></td>
    </tr>
</table>