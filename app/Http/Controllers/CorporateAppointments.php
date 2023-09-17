<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CorporateAppointment;
use App\Models\AppointmentsRoleRelation;
use App\Models\User;
use Auth;


class CorporateAppointments extends Controller
{

    public function index(Request $req){
        dd($req);
    }

    public function add_corporate_appointments(Request $req){
        $url = url()->previous();
        $corporate_appointment = new CorporateAppointment();

        $corporate_appointment->title = $req->input('title');

        if(strstr($req->input('contact_id')," ", true) == 'account'){
            $account_id = trim(strstr($req->input('contact_id')," "));
            $corporate_appointment->account_id = $account_id;
        }else{
            $corporate_appointment->contact_id = $req->input('contact_id');
        }

        $corporate_appointment->company_id = $req->input('company_id');
        $corporate_appointment->position_1 = $req->input('position_1');
        $corporate_appointment->position_2 = $req->input('position_2');
        $corporate_appointment->appointed_date = $req->input('appointed_date');
        $corporate_appointment->appointment_terminated_date = $req->input('appointment_terminated_date');
        $corporate_appointment->status = 1;
        if(empty($req->input('appointment_terminated_date'))){
            $corporate_appointment->status = null;
        }
        $corporate_appointment->user_id = Auth::user()->id;

        if($corporate_appointment->save() ){
            $rols_id = $req->input('role_id');
            if(!empty( $rols_id)){
                foreach($rols_id as  $role_id){
                    $appointments_role_relation = new AppointmentsRoleRelation();
                    $appointments_role_relation->appointment_id = $corporate_appointment->id;
                    $appointments_role_relation->appointments_roles_id  = $role_id;
                    $appointments_role_relation->save();
                }
            }
            return redirect()->to($url)->with('success',  'Corporate Appointment is created');
        }
        return redirect()->to($url)->with('danger',  'Corporate Appointment is not created');
    }

    public function update(Request $req){
        $url = url()->previous();
        if($req->input('id')){
            $id = $req->input('id');
            $corporate_appointment = CorporateAppointment::find($id);
        }
        $all_roles = AppointmentsRoleRelation::where('appointment_id', '=', $id)->delete();
  
       
        if(!empty($corporate_appointment)){
            $corporate_appointment->title = $req->input('title');
            if(strstr($req->input('contact_id')," ", true) === 'account'){
                $account_id = trim(strstr($req->input('contact_id')," "));
                $corporate_appointment->account_id = $account_id;
                $corporate_appointment->contact_id = null;
            }else{
                $corporate_appointment->account_id = null;
                $corporate_appointment->contact_id = $req->input('contact_id');
            }
            $corporate_appointment->company_id = $req->input('company_id');
            $corporate_appointment->position_1 = $req->input('position_1');
            $corporate_appointment->position_2 = $req->input('position_2');
            $corporate_appointment->appointed_date = $req->input('appointed_date');
            $corporate_appointment->appointment_terminated_date = $req->input('appointment_terminated_date');
            $corporate_appointment->status = 1;
            if(!empty($req->input('appointment_terminated_date'))){
                $corporate_appointment->status = null;
            }

            $corporate_appointment->user_id = Auth::user()->id;

            if($corporate_appointment->save() ){
                $all_roles = AppointmentsRoleRelation::where('appointment_id', '=', $id)->get();
                $rols_id = $req->input('role_id');
                if(!empty( $rols_id)){
                    foreach($rols_id as  $role_id){
                        $appointments_role_relation = new AppointmentsRoleRelation();
                        $appointments_role_relation->appointment_id = $id;
                        $appointments_role_relation->appointments_roles_id  = $role_id;
                        $appointments_role_relation->save();
                    }
                }
                return redirect()->to($url)->with('success',  'Corporate Appointment is edited');
            }

        }else{
            return redirect()->to($url)->with('danger',  'Corporate Appointment is not Found');
        }

    }

    public function delete_corporate_appointments($id){
        $url = url()->previous();
        $corporate_appointment = CorporateAppointment::find($id);

        if( $corporate_appointment->delete()){
            return redirect()->to($url)->with('success',  'Corporate Appointment is Deleted');
        }
        return redirect()->to($url)->with('danger',  'Corporate Appointment is not Found');
    }


}
