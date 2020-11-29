<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = ['id','category_id','slot_id','new_or_old','name','age','birth_date','address','city','state','zip','home_phone','work_phone','cell_phone',
    'email','occupation','employer','ss','marital_status','gender','guardian_name','guardian_cell_phone','guardian_work_phone',
    'have_child','total_child','best_contact','text_reminder','relative_name','relative_relationship','relative_phone',
    'other_name','other_relationship','other_phone','another_patient','thank_them','physician','website','internet',
    'other','primary_doctor','primary_doctor_phone','primary_doctor_fax','reason_for_visit','patient_name','appointment_date',
    'constinutional_recent_fever','constinutional_unexplained_weight','constinutional_fatigue','lungs_cough','lungs_wheezing',
    'skin_rashes','skin_changing_moles','skin_self_exam','eye_change_in_vision','gastrointestinal_heartburn','gastrointestinal_blood_in_stool',
    'gastrointestinal_nausea_vomiting','gastrointestinal_pain','neurological_headaches','neurological_memory_loss','neurological_fainting',
    'ear_nt_difficulty_hearing','ear_nt_trouble_swallowing','ear_nt_difficulty_breathing','genitourinary_painful_urination','genitourinary_penile_discharge',
    'pyschiatric_depression','pyschiatric_anexiety','pyschiatric_sleep_problem','pyschiatric_see_a_psychiatrist','pyschiatric_anexiety_medications',
    'pyschiatric_prb_with_self_img','pyschiatric_interest_in_doing_things','breast_lumps','breast_nipple_discharge','breast_pain',
    'musculoskeletal_muscle_pain','musculoskeletal_joint_pains','musculoskeletal_joint_swelling','heart_shortness_of_breath',
    'heart_chest_pain','heart_palpitations','blood_unexplained_lumps','blood_easy_bruising','medications','dose','dose_per_day',
    'aspirin','boold_thinners','advil','vitamins','latex','local_anesthetics','iodine_or_betadine','heart_disease','high_blood_pressure',
    'high_cholesterol','diabetes','thyroid_problem','asthma','breast_cancer','psychiatric_disease','bleeding_problem','surgical_history',
    'family_alcoholism','family_high_colesterol','family_high_blood_pressure','family_heart_disease','family_depression','family_stroke','family_bleeding',
    'family_asthma','family_cancer','tobacco_use','tobacco_per_day','tobacco_per_year','pipe_use','alcohol_use','alcohol_per_week','drug_use',
    'used_needles','caffine_intake','caffine_cups_per_day','weight_loss','weight_loss_pound','exercise'];

    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }
    public function slot(){
        return $this->belongsTo('App\Slot','slot_id');
    }


}
