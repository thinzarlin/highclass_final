<?php

namespace App\Imports;

use App\Models\Car;
use App\Models\Cargo;
use App\Models\City;
use App\Models\Gate;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CargoImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $car_id = 0;
        $tour_id = 0;
        foreach ($collection as $key => $row) {
            if ($key >= 0 && $key <= 14 && $key != 1) continue;

            if ($key == 1) {
                $car_arr = explode(" ", $row[2]);
                $tour_arr = explode(" ", $row[14]);

                $car_id = Car::where('car_no', $car_arr[0])->first()?->id;
                $tour_id = Tour::where('mm_name', $tour_arr[0])->first()?->id;

                continue;
            } else {
                if ($row[14] != 0) {
                    $date = Carbon::instance(Date::excelToDateTimeObject($row[6]));
                    $from_arr = array_map('trim', explode("\n", trim($row[2])));
                    $to_arr = array_map('trim', explode("\n", trim($row[3])));
                    $sender_arr = array_map('trim', explode("\n", trim($row[4])));
                    $receiver_arr = array_map('trim', explode("\n", trim($row[5])));
                    $current_arr = array_map('trim', explode("\n", trim($row[25])));

                    $cargo = new Cargo();
                    $cargo->date = $date->format('Y-m-d');
                    $cargo->ref_no = Cargo::generateRefNo($date->format('Ym'));
                    $cargo->car_id = $car_id;
                    $cargo->tour_id = $tour_id;

                    $cargo->cargo_no = $row[1];
                    $cargo->from_city_id = City::where('mm_name', $from_arr[0])->first()->id;
                    $cargo->from_gate_id = Gate::where('mm_name', $from_arr[1])->where('city_id', $cargo->from_city_id)->first()?->id;
                    $cargo->from_gate_note = ($cargo->from_gate_id) ? '' : $from_arr[1];
                    $cargo->to_city_id = City::where('mm_name', $to_arr[0])->first()->id;
                    $cargo->to_gate_id = Gate::where('mm_name', $to_arr[1])->where('city_id', $cargo->to_city_id)->first()?->id;
                    $cargo->to_gate_note = ($cargo->to_gate_id) ? '' : $to_arr[1];
                    $cargo->sender_name = $sender_arr[0];
                    $cargo->sender_phone = $sender_arr[1];
                    $cargo->receiver_name = $receiver_arr[0];
                    $cargo->receiver_phone = $receiver_arr[1];

                    $cargo->item_name = $row[7];
                    $cargo->qty = $row[8];
                    $cargo->cargo_amt = $row[9];
                    // $cargo->commission = $row[10];
                    $cargo->khauk_to = $row[11];
                    $cargo->deli = $row[12];
                    // $cargo->paid_amt = $row[13];
                    // $cargo->balance = $row[14];
                    $cargo->site_shin = $row[15];
                    $cargo->site_shin_prev_car = $row[16];

                    // $cargo->cash_cargo_amt = $row[17];
                    // $cargo->credit_cargo_amt = $row[18];
                    // $cargo->cash_khauk_to = $row[19];
                    // $cargo->credit_khauk_to = $row[20];
                    // $cargo->cash_deli = $row[21];
                    // $cargo->credit_deli = $row[22];
                    $cargo->bawdar_fee = $row[23];
                    $cargo->total = $cargo->cargo_amt + $cargo->khauk_to + $cargo->deli + $cargo->bawdar_fee;

                    $cargo->remark = $row[24];
                    // $cargo->current_city_id = City::where('mm_name', $current_arr[0])->first()->id;
                    // $cargo->current_gate_id = Gate::where('mm_name', $current_arr[1])->first()?->id;
                    // $cargo->current_gate_note = ($cargo->current_gate_id)? '': $current_arr[1];
                    // $cargo->current_state = $current_arr[2];
                    // $cargo->status = $row[26];
                    $cargo->created_user_id = Auth::id();

                    // echo "<pre>";
                    // print_r($cargo);
                    // echo "</pre>";

                    $cargo->save();
                }
            }
        }
    }
}
