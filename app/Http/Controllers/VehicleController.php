<?php

namespace App\Http\Controllers;

use App\Http\Resources\Vehicle as ResourcesVehicle;
use App\Http\Resources\VehicleCollection;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new VehicleCollection(Vehicle::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'make'  => ['required', Rule::in(['Toyota', 'Honda', 'GMC', 'Ford', 'Nissan', 'Hyundai', 'BMW', 'Mercedes'])],
            'model' => ['required', Rule::in(['Mid Size Truck', 'Full Size Truck', 'Cargo Van', 'Sedan', 'Coupe', 'SUV'])],
            'color' => ['required', Rule::in(['White', 'Red', 'Blue', 'Black', 'Gold', 'Green', 'Grey'])],
            'year'  => ['required', Rule::in([2010, 2011, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020])],
        ]);

        $vehicle        = new Vehicle;
        $vehicle->make  = $request->make;
        $vehicle->model = $request->model;
        $vehicle->color = $request->color;
        $vehicle->year  = $request->year;
        $vehicle->save();

        return (new ResourcesVehicle($vehicle));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        return (new ResourcesVehicle($vehicle));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'make'  => ['required', Rule::in(['Toyota', 'Honda', 'GMC', 'Ford', 'Nissan', 'Hyundai', 'BMW', 'Mercedes'])],
            'model' => ['required', Rule::in(['Mid Size Truck', 'Full Size Truck', 'Cargo Van', 'Sedan', 'Coupe', 'SUV'])],
            'color' => ['required', Rule::in(['White', 'Red', 'Blue', 'Black', 'Gold', 'Green', 'Grey'])],
            'year'  => ['required', Rule::in([2010, 2011, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020])],
        ]);

        $vehicle->make  = $request->make;
        $vehicle->model = $request->model;
        $vehicle->color = $request->color;
        $vehicle->year  = $request->year;
        $vehicle->save();

        $updatedVehivle = $vehicle->fresh();

        return (new ResourcesVehicle($updatedVehivle));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $deleted = $vehicle->delete();

        return response()->json(['deleted' => $deleted]);
    }
}
