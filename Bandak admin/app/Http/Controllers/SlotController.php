<?php

namespace App\Http\Controllers;

use App\Slot;
use App\Category;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    //

    public function get_all_slot(Request $request){
        // return Slot::with('category')->orderBy('id','desc')->get();
        $total = $request->total;
        $data = Slot::with('category')->orderBy('id','desc');
        return $data->paginate($total);
    }

    public function get_all_booked_slot(Request $request){
        $total = $request->total;
        $data = Slot::with('category')->where('isBooked',1)->orderBy('id','desc');
        return $data->paginate($total);
    }


    public function add_slot(Request $request){
        $reqData = $request->all();
        $slotData = $reqData['slot'];

        $neww = implode("-", $slotData);

        Slot::create([
            'category_id' => $request->category_id,
            'datee' => $request->datee,
            'slot' => $neww,
        ]);

         $data = Slot::with('category')->orderBy('id','desc')->first();

        return response()->json([
            'data' => $data,
              'success' => true
          ],201);
    }

    public function delete_slot(Request $request){
        return Slot::where('id', $request->id)->delete();
    }

    public function edit_slot(Request $request){
        $reqData = $request->all();
        $slotData = $reqData['slot'];

        $neww = implode("-", $slotData);
        // validate request 
        $this->validate($request, [
            'category_id' => 'required',
            'datee' => 'required',
            'slot' => 'required',
        ]);

         Slot::where('id', $request->id)->update([
            'category_id' => $request->category_id,
            'datee' => $request->datee,
            'slot' => $neww,
        ]);

        $data = Slot::where('id',$reqData['id'])->with('category')->orderBy('id','desc')->first();

        return response()->json([
            'data' => $data,
            'success' => true
           ],200);
    }

    public function sortByCategory(Request $request){
        $total = $request->total;
        $data = $request['categoryBySearch'];
        if($data=='All'){
            $allData = Slot::with('category')->orderBy('id','desc');
            return $allData->paginate($total);
        }
        $searchData= Slot::with('category')
                    ->where('category_id',$request['categoryBySearch']);

        return $searchData->paginate($total);
    }
    public function get_all_slot_list(Request $request){
        return Slot::with('category')->get();
    }
    
    public function getslots(Request $request){

        $toady=date("Y-m-d");

        $data= $request['value3'];
            if($request['category3']==''){
                $firstCategory = Category::select('id')->first();

                return Slot::with('category')
                ->where('category_id',$firstCategory['id'])
                ->where('datee',$data)
                ->where('datee','>=',$toady)
                ->orderBy('id','desc')->get();
            }
        return Slot::with('category')
        ->where('category_id',$request['category3'])
        ->where('datee',$data)
        ->where('datee','>=',$toady)
        ->orderBy('id','desc')->get();
    }

    public function delete_booked_slot(Request $request){
        return Slot::where('id', $request->id)->delete();
    }

    

}
