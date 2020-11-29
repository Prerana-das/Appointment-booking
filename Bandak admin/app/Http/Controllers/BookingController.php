<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Slot;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //
    public function add_booking(Request $request){
        $this->validate($request, [
            'email' => 'email',
        ]);
        $best_contact = $request->best_contact;

        $best_contact1 =implode(" ", $best_contact);

        $pipe = $request->pipe_use;
        $pipe1 =implode(" ", $pipe);

        $data= Booking::create([
            'category_id' => $request->category_id,
            'slot_id' => $request->slot_id,
            'new_or_old' => $request->new_or_old,
            'name' => $request->name,
            'age' => $request->age,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'home_phone' => $request->home_phone,
            'work_phone' => $request->work_phone,
            'cell_phone' => $request->cell_phone,
            'email' => $request->email,
            'occupation' => $request->occupation,
            'employer' => $request->employer,
            'ss' => $request->ss,
            'marital_status' => $request->marital_status,
            'gender' => $request->gender,
            'guardian_name' => $request->guardian_name,
            'guardian_cell_phone' => $request->guardian_cell_phone,
            'guardian_work_phone' => $request->guardian_work_phone,
            'have_child' => $request->have_child,
            'total_child' => $request->total_child,
            'best_contact' => $best_contact1,
            'text_reminder' => $request->text_reminder,
            'relative_name' => $request->relative_name,
            'relative_relationship' => $request->relative_relationship,
            'relative_phone' => $request->relative_phone,
            'other_name' => $request->other_name,
            'other_relationship' => $request->other_relationship,
            'other_phone' => $request->other_phone,
            'another_patient' => $request->another_patient,
            'thank_them' => $request->thank_them,
            'physician' => $request->physician,
            'website' => $request->website,
            'internet' => $request->internet,
            'other' => $request->other,
            'primary_doctor' => $request->primary_doctor,
            'primary_doctor_phone' => $request->primary_doctor_phone,
            'primary_doctor_fax' => $request->primary_doctor_fax,
            'reason_for_visit' => $request->reason_for_visit,
            'patient_name' => $request->patient_name,
            'appointment_date' => $request->appointment_date,
            'constinutional_recent_fever' => $request->constinutional_recent_fever,
            'constinutional_unexplained_weight' => $request->constinutional_unexplained_weight,
            'constinutional_fatigue' => $request->constinutional_fatigue,
            'lungs_cough' => $request->lungs_cough,
            'lungs_wheezing' => $request->lungs_wheezing,
            'skin_rashes' => $request->skin_rashes,
            'skin_changing_moles' => $request->skin_changing_moles,
            'skin_self_exam' => $request->skin_self_exam,
            'eye_change_in_vision' => $request->eye_change_in_vision,
            'gastrointestinal_heartburn' => $request->gastrointestinal_heartburn,
            'gastrointestinal_blood_in_stool' => $request->gastrointestinal_blood_in_stool,
            'gastrointestinal_nausea_vomiting' => $request->gastrointestinal_nausea_vomiting,
            'gastrointestinal_pain' => $request->gastrointestinal_pain,
            'neurological_headaches' => $request->neurological_headaches,
            'neurological_memory_loss' => $request->neurological_memory_loss,
            'neurological_fainting' => $request->neurological_fainting,
            'ear_nt_difficulty_hearing' => $request->ear_nt_difficulty_hearing,
            'ear_nt_trouble_swallowing' => $request->ear_nt_trouble_swallowing,
            'ear_nt_difficulty_breathing' => $request->ear_nt_difficulty_breathing,
            'genitourinary_painful_urination' => $request->genitourinary_painful_urination,
            'genitourinary_penile_discharge' => $request->genitourinary_penile_discharge,
            'pyschiatric_depression' => $request->pyschiatric_depression,
            'pyschiatric_anexiety' => $request->pyschiatric_anexiety,
            'pyschiatric_sleep_problem' => $request->pyschiatric_sleep_problem,
            'pyschiatric_see_a_psychiatrist' => $request->pyschiatric_see_a_psychiatrist,
            'pyschiatric_anexiety_medications' => $request->pyschiatric_anexiety_medications,
            'pyschiatric_prb_with_self_img' => $request->pyschiatric_prb_with_self_img,
            'pyschiatric_interest_in_doing_things' => $request->pyschiatric_interest_in_doing_things,
            'breast_lumps' => $request->breast_lumps,
            'breast_nipple_discharge' => $request->breast_nipple_discharge,
            'breast_pain' => $request->breast_pain,
            'musculoskeletal_muscle_pain' => $request->musculoskeletal_muscle_pain,
            'musculoskeletal_joint_pains' => $request->musculoskeletal_joint_pains,
            'musculoskeletal_joint_swelling' => $request->musculoskeletal_joint_swelling,
            'heart_shortness_of_breath' => $request->heart_shortness_of_breath,
            'heart_chest_pain' => $request->heart_chest_pain,
            'heart_palpitations' => $request->heart_palpitations,
            'blood_unexplained_lumps' => $request->blood_unexplained_lumps,
            'blood_easy_bruising' => $request->blood_easy_bruising,
            'medications' => $request->medications,
            'dose' => $request->dose,
            'dose_per_day' => $request->dose_per_day,
            'aspirin' => $request->aspirin,
            'boold_thinners' => $request->boold_thinners,
            'advil' => $request->advil,
            'vitamins' => $request->vitamins,
            'latex' => $request->latex,
            'local_anesthetics' => $request->local_anesthetics,
            'iodine_or_betadine' => $request->iodine_or_betadine,
            'heart_disease' => $request->heart_disease,
            'high_blood_pressure' => $request->high_blood_pressure,
            'high_cholesterol' => $request->high_cholesterol,
            'diabetes' => $request->diabetes,
            'thyroid_problem' => $request->thyroid_problem,
            'asthma' => $request->asthma,
            'breast_cancer' => $request->breast_cancer,
            'psychiatric_disease' => $request->psychiatric_disease,
            'bleeding_problem' => $request->bleeding_problem,
            'surgical_history' => $request->surgical_history,
            'family_alcoholism' => $request->family_alcoholism,
            'family_high_colesterol' => $request->family_high_colesterol,
            'family_high_blood_pressure' => $request->family_high_blood_pressure,
            'family_heart_disease' => $request->family_heart_disease,
            'family_depression' => $request->family_depression,
            'family_stroke' => $request->family_stroke,
            'family_bleeding' => $request->family_bleeding,
            'family_asthma' => $request->family_asthma,
            'family_cancer' => $request->family_cancer,
            'tobacco_use' => $request->tobacco_use,
            'tobacco_per_day' => $request->tobacco_per_day,
            'tobacco_per_year' => $request->tobacco_per_year,
            'pipe_use' =>$pipe1,
            'alcohol_use' => $request->alcohol_use,
            'alcohol_per_week' => $request->alcohol_per_week,
            'drug_use' => $request->drug_use,
            'used_needles' => $request->used_needles,
            'caffine_intake' => $request->caffine_intake,
            'caffine_cups_per_day' => $request->caffine_cups_per_day,
            'weight_loss' => $request->weight_loss,
            'weight_loss_pound' => $request->weight_loss_pound,
            'exercise' => $request->exercise      
        ]);

        Slot::where('id', $request->slot_id)->update([
            'isBooked' => 1
        ]);

        return response()->json([
            'data' => $data,
            'success' => true
           ],200);
    }

    public function get_booking_details(Request $request){
        $total = $request->total;
        $data = Booking::with('category','slot')->orderBy('id','desc');
        return $data->paginate($total);

    }

    public function delete_booking(Request $request){
        return Booking::where('id', $request->id)->delete();
    }




    

}
