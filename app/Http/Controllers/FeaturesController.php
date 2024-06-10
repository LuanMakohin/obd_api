<?php

namespace App\Http\Controllers;

use App\Models\Read;
use App\Models\User;


class FeaturesController extends Controller
{
    public function lastWeek($userId, $vehicleId = null) {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }
        $vehicles = $user->vehicles;

        if (!$vehicles || $vehicles->count() === 0) {
            return response()->json(['error' => 'This user has no vehicles.'], 404);
        }

        $vehicleIds = $vehicles->pluck('id');

        $oneWeekAgo = now()->subWeek();

        $readings = Read::whereIn('vehicle_id', $vehicleIds)
            ->where('created_at', '>=', $oneWeekAgo)
            ->get();

        if ($vehicleId) {
            $readings = Read::where('vehicle_id', $vehicleId)
                ->where('created_at', '>=', $oneWeekAgo)
                ->get();
        }


        if (!$readings || $readings->count() === 0) {
            return response()->json(['error' => 'This vehicle has no readings in the last week.'], 404);
        }

        return response()->json($readings, 200);


    }

    public function warnings($userId, $vehicleId = null) {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }
        $vehicles = $user->vehicles;

        if (!$vehicles || $vehicles->count() === 0) {
            return response()->json(['error' => 'This user has no vehicles.'], 404);
        }

        $vehicleIds = $vehicles->pluck('id');

        $oneWeekAgo = now()->subWeek();

        $readings = Read::whereIn('vehicle_id', $vehicleIds)
            ->where('created_at', '>=', $oneWeekAgo)
            ->get();

        if ($vehicleId) {
            $readings = Read::where('vehicle_id', $vehicleId)
                ->where('created_at', '>=', $oneWeekAgo)
                ->get();
        }


        if (!$readings || $readings->count() === 0) {
            return response()->json(['error' => 'This vehicle has no readings in the last week.'], 404);
        }

        $anomalies = [];

        foreach ($readings as $read) {
            $abnormalValues = [];

            if ($read->engine_coolant_temperature < 70 || $read->engine_coolant_temperature > 110) {
                $abnormalValues['engine_coolant_temperature'] = $read->engine_coolant_temperature;
            }

            if ($read->engine_rpm > 7000) {
                $abnormalValues['engine_rpm'] = $read->engine_rpm;
            }

            if ($read->vehicle_speed > 200) {
                $abnormalValues['vehicle_speed'] = $read->vehicle_speed;
            }

            if ($read->maf_air_flow_rate > 50) {
                $abnormalValues['maf_air_flow_rate'] = $read->maf_air_flow_rate;
            }

            if (!empty($abnormalValues)) {
                $anomalies[] = [
                    'reading_id' => $read->id,
                    'vehicle_id' => $read->vehicle_id,
                    'abnormal_values' => $abnormalValues
                ];
            }
        }

        if (empty($anomalies)) {
            return response()->json(['message' => 'No abnormal readings found.'], 200);
        }

        return response()->json($anomalies, 200);
    }

    public function averagesAndMessages($userId, $vehicleId = null) {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        $vehicles = $user->vehicles;

        if (!$vehicles || $vehicles->count() === 0) {
            return response()->json(['error' => 'This user has no vehicles.'], 404);
        }

        $vehicleIds = $vehicles->pluck('id');

        $oneWeekAgo = now()->subWeek();

        $readings = Read::whereIn('vehicle_id', $vehicleIds)
            ->where('created_at', '>=', $oneWeekAgo)
            ->get();

        if ($vehicleId) {
            $readings = Read::where('vehicle_id', $vehicleId)
                ->where('created_at', '>=', $oneWeekAgo)
                ->get();
        }

        if (!$readings || $readings->isEmpty()) {
            return response()->json(['error' => 'No readings found for the specified vehicle(s) in the last week.'], 404);
        }

        $fieldValues = [];

        foreach ($readings as $reading) {
            $fieldValues['id'][] = $reading->id;
            foreach ($reading->getAttributes() as $field => $value) {
                $numericValue = is_numeric($value) ? (float) $value : null;

                if (!isset($fieldValues[$field])) {
                    $fieldValues[$field] = [];
                }
                $fieldValues[$field][] = $numericValue;
            }
        }

        $averages = [];
        foreach ($fieldValues as $field => $values) {
            $averages[$field] = array_sum($values) / count($values);
        }

        $messages = [];
        if ($averages['engine_rpm'] > 2000) {
            $messages[] = "engine_rpm - Your RPM average is above 2000 RPM. You should avoid higher RPM to improve fuel economy.";
        }
        if ($averages['vehicle_speed'] > 100) {
            $messages[] = "vehicle_speed - Your average vehicle speed is above 100 km/h. Driving at high speeds may decrease fuel efficiency and increase the risk of accidents.";
        }

        if ($averages['oxygen_sensor_1_fuel_air_eq_ratio'] < 14.7) {
            $messages[] = "oxygen_sensor_1_fuel_air_eq_ratio - Your fuel mixture appears to be rich. This may lead to decreased fuel efficiency and increased emissions.";
        }

        if ($averages['oxygen_sensor_1_fuel_air_eq_ratio'] > 14.7) {
            $messages[] = "oxygen_sensor_1_fuel_air_eq_ratio - Your fuel mixture appears to be lean. This may lead to engine misfires and increased emissions.";
        }

        if ($averages['intake_air_temperature'] > 40) {
            $messages[] = "intake_air_temperature - Your intake air temperature is above normal. This may affect engine performance and fuel efficiency.";
        }

        if ($averages['maf_air_flow_rate'] < 3.0) {
            $messages[] = "maf_air_flow_rate - Your Mass Airflow Sensor (MAF) readings are lower than expected. This may indicate a problem with the air intake system.";
        }


        return response()->json([
            'messages' => $messages
        ], 200);
    }

}
