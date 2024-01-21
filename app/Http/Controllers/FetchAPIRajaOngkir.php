<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FetchAPIRajaOngkir extends Controller
{
    public function getCity()
    {
        try {
            $apiKey = 'acdbb2489b37f36a2fa19aceeb7720fa';
            $apiUrlCity = 'https://api.rajaongkir.com/starter/city';

            $response = Http::withHeaders([
                'key' => $apiKey,
                'Accept' => 'application/json', // Adjust content type as needed
            ])->get($apiUrlCity);

            if ($response->successful()) {
                $jsonAPI = $response->json();
                $data = $jsonAPI['rajaongkir'];
                $results = $data['results'];
                $ResAPICity = $results;
            } else {
                $ResAPICity = response()->json(['error' => 'Failed to fetch data from the API'], $response->status());
            }

            return $ResAPICity;
        } catch (\Throwable $th) {
            $ResAPICost = $th->getMessage();
            return view("home", ['ResAPICost' => $ResAPICost]);
        }
    }

    public function getAPIDataCities()
    {
        try {
            $arrayDatas = [
                "ListCities" => $this->getCity(),
            ];

            return view("home", ['arrayDatas' => $arrayDatas]);
        } catch (\Throwable $th) {
            $ResAPICost = $th->getMessage();
            return view("home", ['ResAPICost' => $ResAPICost]);
        }
    }

    public function getAPIDatas(Request $request)
    {
        try {
            $fromCity = $request->input("kota-awal");
            $destCity = $request->input("kota-tujuan");
            $wPackage = $request->input("weight-package");
            $vendorCourier = $request->input("vendor-courier");

            $filterData = [
                "origin" => $fromCity,
                "destination" => $destCity,
                "weight" => $wPackage,
                "courier" => $vendorCourier
            ];

            $apiKey = 'acdbb2489b37f36a2fa19aceeb7720fa';
            $apiUrlCost = "https://api.rajaongkir.com/starter/cost";

            $response = Http::withHeaders([
                'key' => $apiKey,
                'Accept' => 'application/json', // Adjust content type as needed
            ])->post($apiUrlCost, $filterData);

            if ($response->successful()) {
                $datasCost = $response->json();
                $dataCost = $datasCost["rajaongkir"];
                $query = $dataCost["query"];
                $origin = $dataCost["origin_details"];
                $destination = $dataCost["destination_details"];
                $resAPICost = $dataCost["results"];
            } else {
                $ResAPICost = response()->json(['error' => 'Failed to fetch data from the API'], $response->status());
            }

            $arrayDatas = [
                "ListCities" => $this->getCity(),
                "ResAPIQuery" => $query,
                "ResAPIOrigin" => $origin,
                "ResAPIDest" => $destination,
                "ResAPICost" => $resAPICost,
            ];

            return view("home", ['arrayDatas' => $arrayDatas]);
        } catch (\Throwable $th) {
            $ResAPICost = $th->getMessage();
            return view("home", ['ResAPICost' => $ResAPICost]);
        }
    }
}
