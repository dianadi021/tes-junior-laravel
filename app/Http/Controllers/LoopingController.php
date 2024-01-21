<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoopingController extends Controller
{
    public function postLoop(Request $request)
    {
        $totalLooping = $request->input("input-user");

        $kelipatanTigaNLima = 'Bage Concat';
        $kelipatanTiga = 'Bage';
        $kelipatanLima = 'Concat';
        $munculBageconcat = 0;
        $number = [];

        for ($i = 0; $i < $totalLooping; $i++) {
            $row = $i + 1;

            if ($munculBageconcat === 5) {
                break;
            }

            if ($munculBageconcat >= 2) {
                $kelipatanLima = 'Bage';
                $kelipatanTiga = 'Concat';
            }

            if ($row % 3 === 0 && $row % 5 === 0) {
                array_push($number, "($row => $kelipatanTigaNLima)");
                $munculBageconcat += 1;
            } elseif ($row % 3 === 0) {
                array_push($number, "($row => $kelipatanTiga)");
            } elseif ($row % 5 === 0) {
                array_push($number, "($row => $kelipatanLima)");
            } else {
                array_push($number, $row);
            }
        }

        $HasilPerulangan = [
            'kelipatanTigaNLima' => $kelipatanTigaNLima,
            'kelipatanTiga' => $kelipatanTiga,
            'kelipatanLima' => $kelipatanLima,
            'munculBageconcat' => $munculBageconcat,
            'number' => $number,
        ];

        return view("home", ['HasilPerulangan' => $HasilPerulangan]);
    }
}
