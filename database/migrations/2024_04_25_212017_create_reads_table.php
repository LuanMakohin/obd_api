<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->string('pids_supported_01_20')->nullable(); // PIDs supported [01 - 20]
            $table->string('monitor_status_since_dtcs_cleared')->nullable(); // Monitor status since DTCs cleared
            $table->string('freeze_dtc')->nullable(); // Freeze DTC
            $table->string('fuel_system_status')->nullable(); // Fuel system status
            $table->string('calculated_engine_load')->nullable(); // Calculated engine load
            $table->string('engine_coolant_temperature')->nullable(); // Engine coolant temperature
            $table->string('short_term_fuel_trim_bank_1')->nullable(); // Short term fuel trim — Bank 1
            $table->string('long_term_fuel_trim_bank_1')->nullable(); // Long term fuel trim — Bank 1
            $table->string('short_term_fuel_trim_bank_2')->nullable(); // Short term fuel trim — Bank 2
            $table->string('long_term_fuel_trim_bank_2')->nullable(); // Long term fuel trim — Bank 2
            $table->string('fuel_pressure')->nullable(); // Fuel pressure
            $table->string('intake_manifold_absolute_pressure')->nullable(); // Intake manifold absolute pressure
            $table->string('engine_rpm')->nullable(); // Engine RPM
            $table->string('vehicle_speed')->nullable(); // Vehicle speed
            $table->string('timing_advance')->nullable(); // Timing advance
            $table->string('intake_air_temperature')->nullable(); // Intake air temperature
            $table->string('maf_air_flow_rate')->nullable(); // MAF air flow rate
            $table->string('throttle_position')->nullable(); // Throttle position
            $table->string('commanded_secondary_air_status')->nullable(); // Commanded secondary air status
            $table->string('oxygen_sensors_present_2_banks')->nullable(); // Oxygen sensors present (in 2 banks)
            $table->string('oxygen_sensor_1_short_term_fuel_trim')->nullable(); // Oxygen Sensor 1 - Short term fuel trim
            $table->string('oxygen_sensor_2_short_term_fuel_trim')->nullable(); // Oxygen Sensor 2 - Short term fuel trim
            $table->string('oxygen_sensor_3_short_term_fuel_trim')->nullable(); // Oxygen Sensor 3 - Short term fuel trim
            $table->string('oxygen_sensor_4_short_term_fuel_trim')->nullable(); // Oxygen Sensor 4 - Short term fuel trim
            $table->string('oxygen_sensor_5_short_term_fuel_trim')->nullable(); // Oxygen Sensor 5 - Short term fuel trim
            $table->string('oxygen_sensor_6_short_term_fuel_trim')->nullable(); // Oxygen Sensor 6 - Short term fuel trim
            $table->string('oxygen_sensor_7_short_term_fuel_trim')->nullable(); // Oxygen Sensor 7 - Short term fuel trim
            $table->string('oxygen_sensor_8_short_term_fuel_trim')->nullable(); // Oxygen Sensor 8 - Short term fuel trim
            $table->string('obd_standards_vehicle_conforms_to')->nullable(); // OBD standards this vehicle conforms to
            $table->string('oxygen_sensors_present_4_banks')->nullable(); // Oxygen sensors present (in 4 banks)
            $table->string('auxiliary_input_status')->nullable(); // Auxiliary input status
            $table->string('run_time_since_engine_start')->nullable(); // Run time since engine start
            $table->string('pids_supported_21_40')->nullable(); // PIDs supported [21 - 40]
            $table->string('distance_traveled_with_mil_on')->nullable(); // Distance traveled with malfunction indicator lamp (MIL) on
            $table->string('fuel_rail_pressure_relative_to_manifold_vacuum')->nullable(); // Fuel Rail Pressure (relative to manifold vacuum)
            $table->string('fuel_rail_gauge_pressure')->nullable(); // Fuel Rail Gauge Pressure (diesel, or gasoline direct injection)
            $table->string('oxygen_sensor_1_fuel_air_equivalence_ratio')->nullable(); // Oxygen Sensor 1 - Fuel–Air Equivalence Ratio
            $table->string('oxygen_sensor_2_fuel_air_equivalence_ratio')->nullable(); // Oxygen Sensor 2 - Fuel–Air Equivalence Ratio
            $table->string('oxygen_sensor_3_fuel_air_equivalence_ratio')->nullable(); // Oxygen Sensor 3 - Fuel–Air Equivalence Ratio
            $table->string('oxygen_sensor_4_fuel_air_equivalence_ratio')->nullable(); // Oxygen Sensor 4 - Fuel–Air Equivalence Ratio
            $table->string('oxygen_sensor_5_fuel_air_equivalence_ratio')->nullable(); // Oxygen Sensor 5 - Fuel–Air Equivalence Ratio
            $table->string('oxygen_sensor_6_fuel_air_equivalence_ratio')->nullable(); // Oxygen Sensor 6 - Fuel–Air Equivalence Ratio
            $table->string('oxygen_sensor_7_fuel_air_equivalence_ratio')->nullable(); // Oxygen Sensor 7 - Fuel–Air Equivalence Ratio
            $table->string('oxygen_sensor_8_fuel_air_equivalence_ratio')->nullable(); // Oxygen Sensor 8 - Fuel–Air Equivalence Ratio
            $table->string('commanded_egr')->nullable(); // Commanded EGR
            $table->string('egr_error')->nullable(); // EGR Error
            $table->string('commanded_evaporative_purge')->nullable(); // Commanded evaporative purge
            $table->string('fuel_tank_level_input')->nullable(); // Fuel Tank Level Input
            $table->string('warm_ups_since_codes_cleared')->nullable(); // Warm-ups since codes cleared
            $table->string('distance_traveled_since_codes_cleared')->nullable(); // Distance traveled since codes cleared
            $table->string('evap_system_vapor_pressure')->nullable(); // Evap. System Vapor Pressure
            $table->string('absolute_barometric_pressure')->nullable(); // Absolute Barometric Pressure
            $table->string('oxygen_sensor_1_fuel_air_eq_ratio')->nullable(); // Oxygen Sensor 1 - Fuel–Air Equivalence Ratio (duplicate)
            $table->string('oxygen_sensor_2_fuel_air_eq_ratio')->nullable(); // Oxygen Sensor 2 - Fuel–Air Equivalence Ratio (duplicate)
            $table->string('oxygen_sensor_3_fuel_air_eq_ratio')->nullable(); // Oxygen Sensor 3 - Fuel–Air Equivalence Ratio (duplicate)
            $table->string('oxygen_sensor_4_fuel_air_eq_ratio')->nullable(); // Oxygen Sensor 4 - Fuel–Air Equivalence Ratio (duplicate)
            $table->string('oxygen_sensor_5_fuel_air_eq_ratio')->nullable(); // Oxygen Sensor 5 - Fuel–Air Equivalence Ratio (duplicate)
            $table->string('oxygen_sensor_6_fuel_air_eq_ratio')->nullable(); // Oxygen Sensor 6 - Fuel–Air Equivalence Ratio (duplicate)
            $table->string('oxygen_sensor_7_fuel_air_eq_ratio')->nullable(); // Oxygen Sensor 7 - Fuel–Air Equivalence Ratio (duplicate)
            $table->string('oxygen_sensor_8_fuel_air_eq_ratio')->nullable(); // Oxygen Sensor 8 - Fuel–Air Equivalence Ratio (duplicate)
            $table->string('catalyst_temp_bank_1_sensor_1')->nullable(); // Catalyst Temperature: Bank 1, Sensor 1
            $table->string('catalyst_temp_bank_2_sensor_1')->nullable(); // Catalyst Temperature: Bank 2, Sensor 1
            $table->string('catalyst_temp_bank_1_sensor_2')->nullable(); // Catalyst Temperature: Bank 1, Sensor 2
            $table->string('catalyst_temp_bank_2_sensor_2')->nullable(); // Catalyst Temperature: Bank 2, Sensor 2
            $table->string('pids_supported_41_60')->nullable(); // PIDs supported [41 - 60]
            $table->string('monitor_status_this_drive_cycle')->nullable(); // Monitor status this drive cycle
            $table->string('control_module_voltage')->nullable(); // Control module voltage
            $table->string('absolute_load_value')->nullable(); // Absolute load value
            $table->string('fuel_air_commanded_eq_ratio')->nullable(); // Fuel–Air commanded equivalence ratio
            $table->string('relative_throttle_position')->nullable(); // Relative throttle position
            $table->string('ambient_air_temperature')->nullable(); // Ambient air temperature
            $table->string('absolute_throttle_position_b')->nullable(); // Absolute throttle position B
            $table->string('absolute_throttle_position_c')->nullable(); // Absolute throttle position C
            $table->string('absolute_throttle_position_d')->nullable(); // Absolute throttle position D
            $table->string('absolute_throttle_position_e')->nullable(); // Absolute throttle position E
            $table->string('absolute_throttle_position_f')->nullable(); // Absolute throttle position F
            $table->string('commanded_throttle_actuator')->nullable(); // Commanded throttle actuator
            $table->string('time_run_with_mil_on')->nullable(); // Time run with MIL on
            $table->string('time_since_trouble_codes_cleared')->nullable(); // Time since trouble codes cleared
            $table->string('max_value_for_fuel_air_eq_ratio')->nullable(); // Maximum value for Fuel–Air equivalence ratio, oxygen sensor voltage, oxygen sensor current, and intake manifold absolute pressure
            $table->string('max_value_for_air_flow_rate_from_maf')->nullable(); // Maximum value for air flow rate from mass air flow sensor
            $table->string('fuel_type')->nullable(); // Fuel Type
            $table->string('ethanol_fuel_percentage')->nullable(); // Ethanol fuel percentage
            $table->string('absolute_evap_system_vapor_pressure')->nullable(); // Absolute Evap system Vapor Pressure
            $table->string('evap_system_vapor_pressure_2')->nullable(); // Evap system vapor pressure
            $table->string('short_term_secondary_oxygen_sensor_trim')->nullable(); // Short term secondary oxygen sensor trim
            $table->string('long_term_secondary_oxygen_sensor_trim')->nullable(); // Long term secondary oxygen sensor trim
            $table->string('short_term_secondary_oxygen_sensor_trim_2')->nullable(); // Short term secondary oxygen sensor trim (duplicate)
            $table->string('long_term_secondary_oxygen_sensor_trim_2')->nullable(); // Long term secondary oxygen sensor trim (duplicate)
            $table->string('fuel_rail_absolute_pressure')->nullable(); // Fuel rail absolute pressure
            $table->string('relative_accelerator_pedal_position')->nullable(); // Relative accelerator pedal position
            $table->string('hybrid_battery_pack_remaining_life')->nullable(); // Hybrid battery pack remaining life
            $table->string('engine_oil_temperature')->nullable(); // Engine oil temperature
            $table->string('fuel_injection_timing')->nullable(); // Fuel injection timing
            $table->string('engine_fuel_rate')->nullable(); // Engine fuel rate
            $table->string('emission_requirements_to_vehicle')->nullable();// Emission requirements to which vehicle is designed
            $table->timestamps();

            $table->foreign('vehicle_id')->references('id')->on('vehicles');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reads');
    }
};
