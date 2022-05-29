<?php

namespace App\Http\Controllers;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // return all cars to index view with order by id (desc) &  with 5 elements in the page
    public function index(){
        $data['cars'] = Car::orderBy('id','desc')->paginate(5);
        return view('cars.index', $data);
    }

    // go to create new car view 
    public function create(){
        return view('cars.create');
    }

    // add new company with validation 
    public function store(Request $request){
        // validat requird data
        $request->validate([
            'model' => 'required',
            'brand' => 'required',
            'price' => 'required'
        ]);

        // new object from car model ** 
        $car = new Car();

        // passing request entities to the model  
        $car->model = $request->model;
        $car->brand = $request->brand;
        $car->price = $request->price;

        // save the record to the db
        $car->save();

        // redirect to index view with success msg 
        return redirect()->route('cars.index')->with('success','Car has been created successfully.');
    }

    public function show(Car $car){
        // show specific car 
        return view('cars.show',compact('car'));
    } 


    // go to edit route with the $car var
    public function edit(Car $car){
    return view('cars.edit',compact('car'));
    }

    // update car details 
    public function update(Request $request, $id){
        // validate requird data
        $request->validate([
            'model' => 'required',
            'brand' => 'required',
            'price' => 'required'
        ]);

        // get car record from model by -> id
        $car = Car::find($id);

        // passing new values to the model 
        $car->model = $request->model;
        $car->brand = $request->brand;
        $car->price = $request->price;
        // update new values 
        $car->update();

        return redirect()->route('cars.index')->with('success','Car Has Been updated successfully');
    }

    // delete specific car
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success','Car has been deleted successfully');
    }

}
