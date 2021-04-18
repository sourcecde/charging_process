<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

class RateController extends Controller
{
    public function index()
    {
        return view('rate');
    }

    public function getTime($time)
    {
        $d = new DateTime($time);
        $d->format('Y-m-d\TH:i:s.u'); // 2016-10-06T09:50:54.000000
        return $d->format('Y-m-d h:i:s'); // 2016-10-06 09:50.00
    }

    public function differenceInMinutes($startdate, $enddate)
    {
        $t1 = strtotime(str_replace('/', '-', $startdate));
        $t2 = strtotime(str_replace('/', '-', $enddate));
        return abs($t1 - $t2) / 60;
    }


    function store(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $energy = $_POST['energy'];
            $time = $_POST['time'];
            $transaction = $_POST['transaction'];
            $timestampStart = $_POST['timestampStart'];
            $timestampStop = $_POST['timestampStop'];
            $meterStart = $_POST['meterStart'];
            $meterStop = $_POST['meterStop'];

            $array = array("rate" => array("energy" => $energy,
                "time" => $time, "transaction" => $transaction),
                "cdr" => array("meterStart" => $meterStart, "timestampStart" => $timestampStart,
                    "meterStop" => $meterStop, "timestampStop" => $timestampStop));
            $body = json_encode($data = $array);
        } else {
            $body = file_get_contents('php://input');
        }

        $object = json_decode($body, true);
        $new_arr = is_array($object) ? array_values($object) : array();

        $allReading = array_reduce($new_arr, 'array_merge', array());

        $energy = $allReading["energy"];
        $time = $allReading["time"];
        $transaction = $allReading["transaction"];
        $meterStart = $allReading["meterStart"];
        $meterStop = $allReading["meterStop"];
        $timestampStart = $allReading["timestampStart"];
        $timestampStop = $allReading["timestampStop"];


        $this->meterStart = $meterStart;
        $this->meterStop = $meterStop;
        $this->timestampStart = $timestampStart;
        $this->timestampStop = $timestampStop;
        $this->energy = $energy;
        $this->transaction = $transaction;

        $timePrice = round($this->differenceInMinutes($this->getTime($this->timestampStart),
                $this->getTime($this->timestampStop)) * $time / 60, 3);

        $energyPrice = round(((($this->meterStop - $this->meterStart) / 1000) * $energy), 3);

        $cdr = round(($timePrice + $energyPrice + $transaction), 2);

        $data = array(
            'overall' => $cdr,
            "components" => array(
                "energy" => $energyPrice,
                "time" => $timePrice,
                "transaction" => $transaction
            )
        );
        echo json_encode($data);
        exit;
    }
}
