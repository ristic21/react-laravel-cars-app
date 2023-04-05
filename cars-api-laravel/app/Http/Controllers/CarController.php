<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $brand = $request->query('brand');
        $model = $request->query('model');

        $cars = Car::searchByBrand($brand) // select * from cars where brand like '%$brand%';
            ->searchByModel($model)
            ->paginate(); // select * from cars where brand like '%$brand%' and model like '%$model%';


        return response()->json($cars);
    }



 
    public function store(CreateCarRequest $request)
    {
        $car = Car::create($request->validated());
        return response()->json($car);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return response()->json($car);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $car->update($request->validated());
        return response()->json($car);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
    }
}
