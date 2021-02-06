<?php
if($request['method'] == "POST")
    // If the content-type is JSON
    if($request['content-type'] == "application/json") {
        // Getting the input JSON
        $input = file_get_contents("php://input");

        // Decoding it
        $getContents = json_decode($input, true);

        // getting all fields
        $accessToken = !empty($getContents['accessToken']) ? $getContents['accessToken'] : null;
        // The UUID of the user without dashes
        $selectedProfile = !empty($getContents['selectedProfile']) ? $getContents['selectedProfile'] : null;
        // The id of the server
        $serverId = !empty($getContents['serverId']) ? $getContents['serverId'] : null;

        if (!is_null($accessToken) && !is_null($selectedProfile) && !is_null($serverId)) {
            // Sending a request to the database to get the user from the access token
            $req = Core\Queries::execute('SELECT * FROM openauth_users WHERE accessToken=:accessToken', ['accessToken' => $accessToken]);

            // If the user was found (the request response isn't empty)
            if (!empty($req)) {
                if ($selectedProfile == str_replace("-", "", $req->UUID)) {
                    $username = $req->username;

                    // Drop all other user connections in table:
                    $delete_others = Core\Queries::execute('DELETE FROM openauth_connections WHERE username=:username', ['username' => $username]);

                    $ip = getIp();
                    // Say that the user has connected at given time:
                    Core\Queries::execute('INSERT INTO openauth_connections (username, serverId, ip, time) VALUES (:username, :serverid, :ip, :time)', [
                        'username' => $username,
                        'serverid' => $serverId,
                        'ip' => $ip,
                        'time' => getTimeFloat()
                    ]);

                    header("HTTP/1.1 204 NO CONTENT");
                    // header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
                    // remove the above lign otherwise minecraft does not recognise the result

                } else {
                    header('Content-Type: application/json');
                    echo error(3);
                }
            } else {
                header('Content-Type: application/json');
                // Printing the fourth error
                echo error(4);
            }
        } else {
            header('Content-Type: application/json');
            // Printing the fourth error
            echo error(4);
        }
    }
    else {

        header('Content-Type: application/json');
        // Printing the sixth error
        echo error(6);
    }
// Else if the request method isn't POST
else {
    header('Content-Type: application/json');
    // Printing the first error
    echo error(1);
}
