<?php

namespace App\Http\Controllers;

use App\Models\Read;
use App\Models\User;


class FeaturesController extends Controller
{
    public function lastWeek($userId, $vehicleId = null) {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado.'], 404);
        }
        $vehicles = $user->vehicles;

        if (!$vehicles || $vehicles->count() === 0) {
            return response()->json(['error' => 'Este usuário não possui veículos.'], 404);
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
            return response()->json(['error' => 'Este veículo não possui leituras na última semana.'], 404);
        }

        return response()->json($readings, 200);


    }

    public function warnings($userId, $vehicleId = null) {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado.'], 404);
        }
        $vehicles = $user->vehicles;

        if (!$vehicles || $vehicles->count() === 0) {
            return response()->json(['error' => 'Este usuário não possui veículos.'], 404);
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
            return response()->json(['error' => 'Este veículo não possui leituras na última semana.'], 404);
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
            return response()->json(['message' => 'Nenhuma leitura anormal encontrada.'], 200);
        }

        return response()->json($anomalies, 200);
    }

    public function averagesAndMessages($userId, $vehicleId = null) {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado.'], 404);
        }

        $vehicles = $user->vehicles;

        if (!$vehicles || $vehicles->count() === 0) {
            return response()->json(['error' => 'Este usuário não possui veículos.'], 404);
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
            return response()->json(['error' => 'Nenhuma leitura encontrada para o(s) veículo(s) especificado(s) na última semana.'], 404);
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
            $messages[] = "engine_rpm - Sua média de RPM está acima de 2000 RPM. Você deve evitar RPMs mais altos para melhorar a economia de combustível.";
        }
        if ($averages['vehicle_speed'] > 100) {
            $messages[] = "vehicle_speed - Sua velocidade média do veículo está acima de 100 km/h. Dirigir em altas velocidades pode diminuir a eficiência do combustível e aumentar o risco de acidentes.";
        }

        if ($averages['oxygen_sensor_1_fuel_air_eq_ratio'] < 14.7) {
            $messages[] = "oxygen_sensor_1_fuel_air_eq_ratio - Sua mistura de combustível parece estar rica. Isso pode levar a uma diminuição na eficiência do combustível e aumento das emissões.";
        }

        if ($averages['oxygen_sensor_1_fuel_air_eq_ratio'] > 14.7) {
            $messages[] = "oxygen_sensor_1_fuel_air_eq_ratio - Sua mistura de combustível parece estar pobre. Isso pode levar a falhas de ignição do motor e aumento das emissões.";
        }


        if ($averages['intake_air_temperature'] > 40) {
            $messages[] = "intake_air_temperature - Sua temperatura de admissão de ar está acima do normal. Isso pode afetar o desempenho do motor e a eficiência do combustível.";
        }

        if ($averages['maf_air_flow_rate'] < 3.0) {
            $messages[] = "maf_air_flow_rate - Suas leituras do Sensor de Fluxo de Ar Massivo (MAF) estão mais baixas do que o esperado. Isso pode indicar um problema com o sistema de entrada de ar.";
        }



        return response()->json([
            'messages' => $messages
        ], 200);
    }

}
