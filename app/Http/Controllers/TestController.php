<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Acamposm\Ping\Ping;
use Acamposm\Ping\PingCommandBuilder;


class TestController extends Controller
{
    public function __invoke(Request $request) {
        // Create an instance of PingCommand
        $command = (new PingCommandBuilder('https://google.com'))->count(10)->packetSize(200)->ttl(120);

        $ping = (new Ping($command))->run();

        dd($ping);

        $ip = 'https://google.com';

        // $pingresult = exec("/bin/ping -n 3 $ip", $outcome, $status);
        /*
        if (0 == $status) {
            $status = "alive";
        } else {
            $status = "dead";
        }
        */

        $fp = fSockOpen($ip,80,$errno,$errstr,1);
        if($fp) { $status=0; fclose($fp); } else { $status=1; }
        if (0 == $status) {
            $status = "alive";
        } else {
            $status = "dead";
        }
        echo "The IP address, $ip, is  ".$status;
    }
}
