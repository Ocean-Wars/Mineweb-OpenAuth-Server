<?php

/**
 * This method allow us to send the answer to the server with the skin of the user
 * @param $username String the username of the player that joined
 */
function send_response_with_skin($username) {
    $player_infos = Core\Queries::execute('SELECT * FROM openauth_users WHERE username=:username', ['username' => $username]);
    if (!empty($player_infos)) {
        $uuid = $player_infos->UUID;

        // TODO: get the skin

        $result = [
            'id' => $uuid,
            'name' => $username,
            'properties' => [
                [
                    'name' => 'textures',
                    'value' => 'ewogICJ0aW1lc3RhbXAiIDogMTYxMTY3ODI3OTc4NiwKICAicHJvZmlsZUlkIiA6ICI0NTY2ZTY5ZmM5MDc0OGVlOGQ3MWQ3YmE1YWEwMGQyMCIsCiAgInByb2ZpbGVOYW1lIiA6ICJUaGlua29mZGVhdGgiLAogICJzaWduYXR1cmVSZXF1aXJlZCIgOiB0cnVlLAogICJ0ZXh0dXJlcyIgOiB7CiAgICAiU0tJTiIgOiB7CiAgICAgICJ1cmwiIDogImh0dHA6Ly90ZXh0dXJlcy5taW5lY3JhZnQubmV0L3RleHR1cmUvNzRkMWUwOGIwYmI3ZTlmNTkwYWYyNzc1ODEyNWJiZWQxNzc4YWM2Y2VmNzI5YWVkZmNiOTYxM2U5OTExYWU3NSIKICAgIH0sCiAgICAiQ0FQRSIgOiB7CiAgICAgICJ1cmwiIDogImh0dHA6Ly90ZXh0dXJlcy5taW5lY3JhZnQubmV0L3RleHR1cmUvYjBjYzA4ODQwNzAwNDQ3MzIyZDk1M2EwMmI5NjVmMWQ2NWExM2E2MDNiZjY0YjE3YzgwM2MyMTQ0NmZlMTYzNSIKICAgIH0KICB9Cn0',
                    'signature' => 'GEQvky+a56n4xkvK8xKXsMXayNGe9ZgzvGpWOdieGLn4w8WowZwNC8AhAF71mqsKnpazG4zyDhFAfPAq8CnLahwFKbDNds8BzmvYJ1uThWweaYq34ucgLAjwrVmoM4hi5GLFG5OY2Ne1uZvXdpEmzmXDrrgpR8HZ+uCFYPNwE2SNrAfBaeNZKj0p0JqxfA9S5KNszWTDIxNjuDzINEVTQcsoPz0lxQggpwbeloDET21rdx5sCk2F9ysGwx2Gha42Z7mc0iH1ySTKp/Z2cgb5cRNv+PLXmW9YwEjdjkBWaxg1hNe78WoO9AyoNZeK8YhemmmYDPlagZGg0JNkOrsdmofoPhfUvl61VUAha1QpW9Qe7hlFj4Sy4bhqIPrIKFf8jnU5f58zdqIF333UKgrINfnoPItGHJSRq6Z3Z6/2XJysvLDdo77CxiqauUJ5Uu1WLqDPGMvdZfxU8+krN+66gSt3kZUvgaAG+Gg0thUCQkBKXjVrDiNxICaKtaBWWaSOahrk/2ueltxPxjE/o36X8G4eDfUov0RW3ZFLseTNtaAocGFkIpiQyJwdmet4ibn0xWw5S1n0h9jTRikW8skw3X3D3E+zKLjU9W7lCkBQnKAYDhysnY2umrRsZ1ecW1YQeC5QJ7L+Ru5OfzHcPE2VvF+08D7zRqYzjqAP+7aZgtI='
                ]
            ]
        ];

        echo json_encode($result);
    }
}

if($request['method'] == "GET") {
    if (!empty($request['query'])) {
        // the username of the player
        $username = !empty($request['query']["username"]) ? $request['query']["username"] : null;

        // The id of the server
        $serverId = !empty($request['query']['serverId']) ? $request['query']['serverId'] : null;

        // ip of the user, to prevent proxy, it is optional
        $ip = !empty($request['query']['ip']) ? $request['query']['ip'] : null;

        if (!is_null($username) && !is_null($serverId)) {
            $connection_query = Core\Queries::execute('SELECT * FROM openauth_connections WHERE username=:username', ['username' => $username]);
            if (!empty($connection_query)) {
                if ($connection_query->serverId == $serverId) {
                    $curr_time = microtime();
                    $connection_time = $connection_query->time;
                    // if less than 2 seconds
                    if (curr_time - connection_time < 2000) {
                        // ip is facultative, depending on if prevent proxy option is true or not
                        if (is_null($ip)) {
                            $ip = $connection_query->ip;
                        }

                        // we verify that the ip is correct
                        if ($ip == $connection_query->ip) {
                            send_response_with_skin($username);
                        }
                    }
                }
            }
        }
    }

    // if our tests fail, we don't return anything
}
else
    // Printing the first error
    echo error(1);
