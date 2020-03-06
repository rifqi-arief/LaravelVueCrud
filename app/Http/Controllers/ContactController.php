<?php

namespace App\Http\Controllers;

use DB;
use App\ContactModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function addContact(Request $request){
        Log::debug($request->All());

        $validator  = Validator::make($request->all(), [
            'name'      => 'required',
            'phone'     => 'required',
            // 'id_gender' => 'required',
            // 'address'   => 'required',
        ]);

        if ($validator->fails()) {
            $validator_message = $validator->messages()->first();
            $res = array(
                'status'    => false,
                'message'   => $validator_message,
            );
            Log::error($res);
            return response()->json($res, 400);
        }
        
        try{    
            $contact = new ContactModel;
            $contact->name      = $request->name;
            $contact->phone     = $request->phone;
            $contact->gender    = $request->gender;
            $contact->address   = $request->address;

            $contact->save();

            $res = array(
                'status'    => true,
                'message'   => "succes add contact",
            );
        
            Log::debug($res);
            return response()->json($res,200);    
        }catch(\Exception $ex){
            Log::error($ex->getMessage());

            $res = array(
                'status'    => false,
                'message'   => $ex->getMessage(),
            );
            return response()->json($res, 500);
        }
    }

    public function getAllContact(){
        try{    
            $contact = ContactModel::all();
            Log::debug($contact);
            return response()->json($contact,200);    
        }catch(\Exception $ex){
            Log::error($ex->getMessage());

            $res = array(
                'status'    => false,
                'message'   => $ex->getMessage(),
            );
            return response()->json($res, 500);
        }
    }

    public function getContact($id){
        try{    
            $contact = ContactModel::where('id', '=',$id)->first();

            return response()->json($contact,200);    
        }catch(\Exception $ex){
            Log::error($ex->getMessage());

            $res = array(
                'status'    => false,
                'message'   => $ex->getMessage(),
            );
            return response()->json($res, 500);
        }
    }

    public function editContact(Request $request){
        Log::debug($request->All());

        $validator  = Validator::make($request->all(), [
            'id_contact'    => 'required',
            'name'          => 'required',
            'phone'         => 'required',
            'gender'        => 'required',
            'address'       => 'required',
        ]);

        if ($validator->fails()) {
            $validator_message = $validator->messages()->first();
            $res = array(
                'status'    => false,
                'message'   => $validator_message,
            );
            Log::error($res);
            return response()->json($res, 400);
        }

        try {
            
            $contact = ContactModel::where('id', '=', $request->id_contact)->first();
            if($contact == null){
                $res = array(
                    'status'    => false,
                    'message'   => "contact not found",
                );
                Log::error($res);
                return response()->json($res, 404);                    
            }
            
            ContactModel::where('id', $request->id_contact)
                ->update([
                    'name'      => $request->name,
                    'phone'     => $request->phone,
                    'gender'    => $request->gender,
                    'address'   => $request->address,
                ]);

            $res = array(
                'status'    => true,
                'message'   => "succes edit contact",
            );
        
            Log::debug($res);
            return response()->json($res,200);    
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            $res = array(
                'status'    => false,
                'message'   => $ex->getMessage(),
            );
            return response()->json($res, 500);
        }
    }

    public function deleteContact($id){
        try {
            $contact  = ContactModel::where('id', '=', $id);
            $contact->delete();

            $res = array(
                'status'    => true,
                'message'   => "succes delete contact",
            );
        
            Log::debug($res);
            return response()->json($res,200);    
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            $res = array(
                'status'    => false,
                'message'   => $ex->getMessage(),
            );
            return response()->json($res, 500);
        }
    }
}
