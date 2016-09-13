<?php

    // Script By Qassim Hassan, wp-time.com

    // go to https://developers.facebook.com and create a new app

    $app_id = "xxxxxx"; // enter your app id

    $app_secret = "xxxxxx"; // enter your app secret

    $redirect_uri = "http://localhost/login-with-facebook/callback.php"; // enter your redirect url (Site URL from app settings)

    $scope = "public_profile"; // we need scope of public_profile, but you can change it for another result, check list of scopes: https://developers.facebook.com/docs/facebook-login/permissions

?>
