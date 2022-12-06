<?php

namespace App\Http\Controllers\Backend;

use App\Models\ShipState;
use App\Models\ShipDivison;
use App\Models\ShipDistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingController extends Controller
{
    public function divisonView(){
        $divisons = ShipDivison::orderBy('divison_name', 'ASC')->get();
        return view('backend.shipping.divison.divison_view', compact('divisons'));
    }

    public function storeDivison(Request $request){
        $request->validate([
          'divison_name' => 'required|min:4|unique:ship_divisons,divison_name', 
        ]);
             
        ShipDivison::insert([
          'divison_name' => $request->divison_name, 
        ]);
  
        return redirect()->back()->with('success', 'Divison Inserted Successfully');
    }

    public function editDivison($id){
        $divison = ShipDivison::findOrFail($id);
 
        return view('backend.shipping.divison.divison_edit', compact('divison'));
    }

    public function updateDivison(Request $request,$id){
        $request->validate([
            'divison_name' => ['required', 'min:4', 'unique:ship_divisons,divison_name,'.$id],

        ],[
          'divison_name.unique' => 'Divison name aready taken',
        ]);

        $data = ShipDivison::find($id);
            $data->divison_name = $request->divison_name;
            $data->save();
    
        return redirect()->route('all.divison')->with('success', 'Successfully updated');
    }

    public function deleteDivison($id){

        ShipDivison::find($id)->delete();   
        return redirect()->back()->with('success', 'Deleted Successfully!');
    }

    public function districtView(){
        $divisons = ShipDivison::orderBy('divison_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        return view('backend.shipping.district.district_view', compact('divisons', 'districts'));
    }

    public function storeDistrict(Request $request){
        $request->validate([
          'divison_id' => 'required',
          'district_name' => 'required|min:2|unique:ship_districts,district_name', 
        ]);
             
        ShipDistrict::insert([
          'divison_id' => $request->divison_id,
          'district_name' => $request->district_name, 
        ]);
  
        return redirect()->back()->with('success', 'District Inserted Successfully');
    }

    public function editDistrict($id){
        $divisons = ShipDivison::orderBy('divison_name', 'ASC')->get();
        $district = ShipDistrict::findOrFail($id);
        return view('backend.shipping.district.district_edit', compact('divisons', 'district'));
    }

    public function updateDistrict(Request $request,$id){
        $request->validate([
            'divison_id' => 'required',
            'district_name' => ['required', 'min:2', 'unique:ship_districts,district_name,'.$id],

        ],[
          'district_name.unique' => 'District name aready taken',
        ]);

        $data = ShipDistrict::find($id);
            $data->divison_id = $request->divison_id;
            $data->district_name = $request->district_name;
            $data->save();
    
        return redirect()->route('all.district')->with('success', 'Successfully updated');
    }

    public function deleteDistrict($id){

        ShipDistrict::find($id)->delete();   
        return redirect()->back()->with('success', 'Deleted Successfully!');
    }

    public function stateView(){
        $divisons = ShipDivison::orderBy('divison_name', 'ASC')->get();
        // $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $states =  ShipState::orderBy('state_name', 'ASC')->get();
        return view('backend.shipping.state.state_view', compact('divisons', 'states'));
    }

    public function storeState(Request $request){
        $request->validate([
          'divison_id' => 'required',
          'district_id' => 'required',
          'state_name' => 'required|min:2|unique:ship_states,state_name', 
        ]);
             
        ShipState::insert([
          'divison_id' => $request->divison_id,
          'district_id' => $request->district_id,
          'state_name' => $request->state_name, 
        ]);
  
        return redirect()->back()->with('success', 'State Inserted Successfully');
    }

    public function editState($id){
        $divisons = ShipDivison::orderBy('divison_name', 'ASC')->get();
        $state = ShipState::findOrFail($id);
        return view('backend.shipping.state.state_edit', compact('divisons', 'state'));
    }

    public function updateState(Request $request,$id){
        $request->validate([
            'divison_id' => 'required',
            'district_id' => 'required',
            'state_name' => ['required', 'min:2', 'unique:ship_states,state_name,'.$id],

        ],[
          'state_name.unique' => 'State name aready taken',
        ]);

        $data = ShipState::find($id);
            $data->divison_id = $request->divison_id;
            $data->district_id = $request->district_id;
            $data->state_name = $request->state_name;
            $data->save();
    
        return redirect()->route('all.state')->with('success', 'Successfully updated');
    }

    public function getDistrict($divisonId){
        $districts = ShipDistrict::where('divison_id', $divisonId)->orderBy('district_name', 'ASC')->get();

        return response()->json([
            'districts' => $districts
        ]);
    }

    public function getStates($districtId){
        $states = ShipState::where('district_id', $districtId)->orderBy('state_name', 'ASC')->get();

        return response()->json([
            'states' => $states
        ]);
    }

    public function deleteState($id){

        ShipState::find($id)->delete();   
        return redirect()->back()->with('success', 'Deleted Successfully!');
    }
}
