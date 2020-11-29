<template>
    <div>
       <div class="content">
			<div class="container-fluid">
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
	
					<div class="_overflow _table_div">
						<table class="_table">
								<!-- TABLE TITLE -->
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Category</th>
								<th>Slot</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
							<tr v-for="(item, i) in slotLists" :key="i">
								<td>{{item.id}}</td>
								<td>{{item.name}}</td>
								<td class="_table_name" v-if="item.category">
									{{item.category.categoryName}}
								</td>
								<td v-if="item.slot">{{item.slot.slot}}</td>
								<td v-if="item.slot">{{item.slot.datee}}</td>
								<td>
									<button class="_btn _action_btn view_btn1" type="button" @click="viewDetails(item, i)">View Details</button>
									<Button type="error" size="small" @click="showDeletingModal(item, i)"  :loading="item.isDeleting">Delete</Button>			
								</td>
							</tr>
								<!-- ITEMS -->
						</table>
					</div>
					<Modal
					v-model="viewDetailsModal"
					:mask-closable="false"
					:closable="false" 
                    fullscreen title="Booking Details" 
                    style="font-size:16px!important"
					>

					<div class="row">
						<div class="col-md-6">
							<ul class="details_list _mar_b20">
								<li><span class="deatils_title"> Name:</span> <span>{{dataDetails.name}}</span></li>
								<li><span class="deatils_title"> Age:</span> <span>{{dataDetails.age}}</span></li>
								<li><span class="deatils_title"> Birth Date:</span> <span>{{dataDetails.birth_date}}</span></li>
								<li><span class="deatils_title"> address:</span> <span>{{dataDetails.address}}</span></li>
								<li><span class="deatils_title"> Name:</span> <span>{{dataDetails.city}}</span></li>
								<li><span class="deatils_title"> State:</span> <span>{{dataDetails.state}}</span></li>
								<li><span class="deatils_title"> Zip:</span> <span>{{dataDetails.zip}}</span></li>
								<li><span class="deatils_title"> Home phone:</span> <span>{{dataDetails.home_phone}}</span></li>
								<li><span class="deatils_title"> Work phone:</span> <span>{{dataDetails.work_phone}}</span></li>
								<li><span class="deatils_title"> cell phone:</span> <span>{{dataDetails.cell_phone}}</span></li>
								<li><span class="deatils_title"> email:</span> <span>{{dataDetails.email}}</span></li>
								<li><span class="deatils_title"> occupation:</span> <span>{{dataDetails.occupation}}</span></li>
								<li><span class="deatils_title"> employer:</span> <span>{{dataDetails.employer}}</span></li>
								<li><span class="deatils_title"> ss:</span> <span>{{dataDetails.ss}}</span></li>
								<li><span class="deatils_title"> Marital status:</span> <span>{{dataDetails.marital_status}}</span></li>
								<li><span class="deatils_title"> gender:</span> <span>{{dataDetails.gender}}</span></li>
								<li><span class="deatils_title"> guardian name:</span> <span>{{dataDetails.guardian_name}}</span></li>
								<li><span class="deatils_title"> guardian cell phone:</span> <span>{{dataDetails.guardian_cell_phone}}</span></li>
								<li><span class="deatils_title"> guardian work phone:</span> <span>{{dataDetails.guardian_work_phone}}</span></li>
								<li><span class="deatils_title"> Do you have child?:</span> <span>{{dataDetails.have_child}}</span></li>
								<li><span class="deatils_title"> total child:</span> <span>{{dataDetails.total_child}}</span></li>
								<li><span class="deatils_title"> best contact:</span> <span>{{dataDetails.best_contact}}</span></li>
								<li><span class="deatils_title"> text reminder:</span> <span>{{dataDetails.text_reminder}}</span></li>
								<li><span class="deatils_title"> relative name:</span> <span>{{dataDetails.relative_name}}</span></li>
								<li><span class="deatils_title"> relative relationship:</span> <span>{{dataDetails.relative_relationship}}</span></li>
								<li><span class="deatils_title"> relative phone:</span> <span>{{dataDetails.relative_phone}}</span></li>
								<li><span class="deatils_title"> other name(not living with you):</span> <span>{{dataDetails.other_name}}</span></li>
								<li><span class="deatils_title"> other relationship:</span> <span>{{dataDetails.other_relationship}}</span></li>
								<li><span class="deatils_title"> other phone:</span> <span>{{dataDetails.other_phone}}</span></li>
								<li><span class="deatils_title"> Who reffered you to Dr Bandak?:</span> <span>{{dataDetails.another_patient}}</span></li>
								<li><span class="deatils_title"> May we thank them?:</span> <span>{{dataDetails.thank_them}}</span></li>
								<li><span class="deatils_title"> physician:</span> <span>{{dataDetails.physician}}</span></li>
								<li><span class="deatils_title"> website:</span> <span>{{dataDetails.website}}</span></li>
								<li><span class="deatils_title"> internet:</span> <span>{{dataDetails.internet}}</span></li>
								<li><span class="deatils_title"> other:</span> <span>{{dataDetails.other}}</span></li>
								<li><span class="deatils_title"> primary doctor:</span> <span>{{dataDetails.primary_doctor}}</span></li>
								<li><span class="deatils_title"> primary doctor phone:</span> <span>{{dataDetails.primary_doctor_phone}}</span></li>
								<li><span class="deatils_title"> primary doctor fax:</span> <span>{{dataDetails.primary_doctor_fax}}</span></li>
								<li><span class="deatils_title"> reason for visit:</span> <span>{{dataDetails.reason_for_visit}}</span></li>
								<li><span class="deatils_title"> patient name:</span> <span>{{dataDetails.patient_name}}</span></li>
								<li><span class="deatils_title"> appointment date:</span> <span>{{dataDetails.appointment_date}}</span></li>
								<li><span class="deatils_title"> medications:</span> <span>{{dataDetails.medications}}</span></li>
								<li><span class="deatils_title"> dose:</span> <span>{{dataDetails.dose}}</span></li>
								<li><span class="deatils_title"> dose per day:</span> <span>{{dataDetails.dose_per_day}}</span></li>
								<li><span class="deatils_title"> aspirin:</span> <span>{{dataDetails.aspirin}}</span></li>
								<li><span class="deatils_title"> boold thinners:</span> <span>{{dataDetails.boold_thinners}}</span></li>
								<li><span class="deatils_title"> advil:</span> <span>{{dataDetails.advil}}</span></li>
								<li><span class="deatils_title"> vitamins:</span> <span>{{dataDetails.vitamins}}</span></li>
							</ul>
							<ul class="details_list _mar_b20">
								<h5 class="deatils_top">Social History</h5>
								<li><span class="deatils_title"> tobacco use:</span> <span>{{dataDetails.tobacco_use}}</span></li>
								<li><span class="deatils_title"> tobacco per day:</span> <span>{{dataDetails.tobacco_per_day}}</span></li>
								<li><span class="deatils_title"> tobacco used year:</span> <span>{{dataDetails.tobacco_per_year}}</span></li>
								<li><span class="deatils_title"> pipe use:</span> <span>{{dataDetails.pipe_use}}</span></li>
								<li><span class="deatils_title"> alcohol use:</span> <span>{{dataDetails.alcohol_use}}</span></li>
								<li><span class="deatils_title"> alcohol per week:</span> <span>{{dataDetails.alcohol_per_week}}</span></li>
								<li><span class="deatils_title"> drug use:</span> <span>{{dataDetails.drug_use}}</span></li>
								<li><span class="deatils_title"> Used needles for inject drugs:</span> <span>{{dataDetails.used_needles}}</span></li>
								<li><span class="deatils_title"> caffine intake:</span> <span>{{dataDetails.caffine_intake}}</span></li>
								<li><span class="deatils_title"> caffine cups per day:</span> <span>{{dataDetails.caffine_cups_per_day}}</span></li>
								<li><span class="deatils_title"> weight loss:</span> <span>{{dataDetails.weight_loss}}</span></li>
								<li><span class="deatils_title"> how many pound loss:</span> <span>{{dataDetails.weight_loss_pound}}</span></li>
								<li><span class="deatils_title"> exercise:</span> <span>{{dataDetails.exercise}}</span></li>
							</ul>
						</div>
						<div class="col-md-6">
							<ul class="details_list _mar_b20">
								<h5 class="deatils_top ">Reviews Of System</h5>
								<li><span class="deatils_title"> constinutional recent_fever:</span> <span>{{dataDetails.constinutional_recent_fever}}</span></li>
								<li><span class="deatils_title"> constinutional unexplained_weight:</span> <span>{{dataDetails.constinutional_unexplained_weight}}</span></li>
								<li><span class="deatils_title"> constinutional fatigue:</span> <span>{{dataDetails.constinutional_fatigue}}</span></li>
								<li><span class="deatils_title"> lungs cough:</span> <span>{{dataDetails.lungs_cough}}</span></li>
								<li><span class="deatils_title"> lungs wheezing:</span> <span>{{dataDetails.lungs_wheezing}}</span></li>
								<li><span class="deatils_title"> skin rashes:</span> <span>{{dataDetails.skin_rashes}}</span></li>
								<li><span class="deatils_title"> skin changing moles:</span> <span>{{dataDetails.skin_changing_moles}}</span></li>
								<li><span class="deatils_title"> skin self exam:</span> <span>{{dataDetails.skin_self_exam}}</span></li>
								<li><span class="deatils_title"> eye change in vision:</span> <span>{{dataDetails.eye_change_in_vision}}</span></li>
								<li><span class="deatils_title"> gastrointestinal heartburn:</span> <span>{{dataDetails.gastrointestinal_heartburn}}</span></li>
								<li><span class="deatils_title"> gastrointestinal blood in stool:</span> <span>{{dataDetails.gastrointestinal_blood_in_stool}}</span></li>
								<li><span class="deatils_title"> gastrointestinal nausea vomiting:</span> <span>{{dataDetails.gastrointestinal_nausea_vomiting}}</span></li>
								<li><span class="deatils_title"> gastrointestinal pain:</span> <span>{{dataDetails.gastrointestinal_pain}}</span></li>
								<li><span class="deatils_title"> neurological headaches:</span> <span>{{dataDetails.neurological_headaches}}</span></li>
								<li><span class="deatils_title"> neurological fainting:</span> <span>{{dataDetails.neurological_fainting}}</span></li>
								<li><span class="deatils_title"> ear nose throat difficulty hearing:</span> <span>{{dataDetails.ear_nt_difficulty_hearing}}</span></li>
								<li><span class="deatils_title"> ear nose throat trouble swallowing:</span> <span>{{dataDetails.ear_nt_trouble_swallowing}}</span></li>
								<li><span class="deatils_title"> ear nose throat difficulty breathing:</span> <span>{{dataDetails.ear_nt_difficulty_breathing}}</span></li>
								<li><span class="deatils_title"> genitourinary painful urination:</span> <span>{{dataDetails.genitourinary_painful_urination}}</span></li>
								<li><span class="deatils_title"> genitourinary penile discharge:</span> <span>{{dataDetails.genitourinary_penile_discharge}}</span></li>
								<li><span class="deatils_title"> pyschiatric depression:</span> <span>{{dataDetails.pyschiatric_depression}}</span></li>
								<li><span class="deatils_title"> pyschiatric anexiety:</span> <span>{{dataDetails.pyschiatric_anexiety}}</span></li>
								<li><span class="deatils_title"> pyschiatric sleep problem:</span> <span>{{dataDetails.pyschiatric_sleep_problem}}</span></li>
								<li><span class="deatils_title"> pyschiatric see a psychiatrist:</span> <span>{{dataDetails.pyschiatric_see_a_psychiatrist}}</span></li>
								<li><span class="deatils_title"> pyschiatric anexiety_medications:</span> <span>{{dataDetails.pyschiatric_anexiety_medications}}</span></li>
								<li><span class="deatils_title"> pyschiatric problem with self imgage?:</span> <span>{{dataDetails.pyschiatric_prb_with_self_img}}</span></li>
								<li><span class="deatils_title"> pyschiatric interest in doing things:</span> <span>{{dataDetails.pyschiatric_interest_in_doing_things}}</span></li>
								<li><span class="deatils_title"> breast lumps:</span> <span>{{dataDetails.breast_lumps}}</span></li>
								<li><span class="deatils_title"> breast nipple discharge:</span> <span>{{dataDetails.breast_nipple_discharge}}</span></li>
								<li><span class="deatils_title"> breast pain:</span> <span>{{dataDetails.breast_pain}}</span></li>
								<li><span class="deatils_title"> musculoskeletal muscle pain:</span> <span>{{dataDetails.musculoskeletal_muscle_pain}}</span></li>
								<li><span class="deatils_title"> musculoskeletal joint pains:</span> <span>{{dataDetails.musculoskeletal_joint_pains}}</span></li>
								<li><span class="deatils_title"> musculoskeletal joint swelling:</span> <span>{{dataDetails.musculoskeletal_joint_swelling}}</span></li>
								<li><span class="deatils_title"> heart shortness of breath:</span> <span>{{dataDetails.heart_shortness_of_breath}}</span></li>
								<li><span class="deatils_title"> heart chest pain:</span> <span>{{dataDetails.heart_chest_pain}}</span></li>
								<li><span class="deatils_title"> heart palpitations:</span> <span>{{dataDetails.heart_palpitations}}</span></li>
								<li><span class="deatils_title"> blood unexplained lumps:</span> <span>{{dataDetails.blood_unexplained_lumps}}</span></li>
								<li><span class="deatils_title"> blood easy bruising:</span> <span>{{dataDetails.blood_easy_bruising}}</span></li>
							</ul>
							<ul class="details_list _mar_b20">
								<h5 class="deatils_top">Allergies</h5>
								<li><span class="deatils_title"> latex:</span> <span>{{dataDetails.latex}}</span></li>
								<li><span class="deatils_title"> local anesthetics:</span> <span>{{dataDetails.local_anesthetics}}</span></li>
								<li><span class="deatils_title"> iodine/betadine:</span> <span>{{dataDetails.iodine_or_betadine}}</span></li>
							</ul>
							<ul class="details_list _mar_b20">
								<h5 class="deatils_top">Personal Medical History</h5>
								<li><span class="deatils_title"> heart disease:</span> <span>{{dataDetails.heart_disease}}</span></li>
								<li><span class="deatils_title"> high blood pressure:</span> <span>{{dataDetails.high_blood_pressure}}</span></li>
								<li><span class="deatils_title"> high cholesterol:</span> <span>{{dataDetails.high_cholesterol}}</span></li>
								<li><span class="deatils_title"> thyroid problem:</span> <span>{{dataDetails.thyroid_problem}}</span></li>
								<li><span class="deatils_title"> asthma:</span> <span>{{dataDetails.asthma}}</span></li>
								<li><span class="deatils_title"> psychiatric disease:</span> <span>{{dataDetails.psychiatric_disease}}</span></li>
								<li><span class="deatils_title"> bleeding problem:</span> <span>{{dataDetails.bleeding_problem}}</span></li>
							</ul>
							<ul class="details_list _mar_b20">
								<h5 class="deatils_top">Surgical History</h5>
								<li><span class="deatils_title"> surgical history:</span> <span>{{dataDetails.surgical_history}}</span></li>
							</ul>
							<ul class="details_list _mar_b20">
								<h5 class="deatils_top">Family History</h5>
								<li><span class="deatils_title"> alcoholism:</span> <span>{{dataDetails.family_alcoholism}}</span></li>
								<li><span class="deatils_title"> high colesterol:</span> <span>{{dataDetails.family_high_colesterol}}</span></li>
								<li><span class="deatils_title"> high blood pressure:</span> <span>{{dataDetails.family_high_blood_pressure}}</span></li>
								<li><span class="deatils_title"> heart disease:</span> <span>{{dataDetails.family_heart_disease}}</span></li>
								<li><span class="deatils_title"> depression:</span> <span>{{dataDetails.family_depression}}</span></li>
								<li><span class="deatils_title"> stroke:</span> <span>{{dataDetails.family_stroke}}</span></li>
								<li><span class="deatils_title"> asthma:</span> <span>{{dataDetails.family_asthma}}</span></li>
								<li><span class="deatils_title"> cancer:</span> <span>{{dataDetails.family_cancer}}</span></li>
							</ul>
						</div>
					</div>
				
						 <div slot="footer">
                            <Button type="default" @click="viewDetailsModal=false">Close</Button>
                        </div>

					</Modal>
					<deleteModal></deleteModal>
					 <div style="text-align:center;" class="pagination_div _mar_t30">
                      	<Page :current="pagination.current_page" :total="pagination.total" @on-change="getpaginate" :page-size="parseInt(pagination.per_page)" />
                    </div>


					
				</div>
			</div>
    	</div>
	</div>
</template>


<script>
import deleteModal from '../components/deleteModal.vue'
import {mapGetters} from 'vuex'
export default {
	data(){
		return { 
			isAdding : false,  
			categoryLists:[],
			editData:{
				category_id:'',
				datee:'',
				slot:[],
			},
			slotLists:[],
			showDeleteModal: false, 
			isDeleing : false,
			deleteItem: {}, 
			deletingIndex: -1, 
			editIndex:-1,
			days:['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'],
			categoryBySearch:'',
			dateArr:[],
			 page:1,
			total:"10",
			pagination: {},
			viewDetailsModal:false,
			dataDetails:{}
		}
	},

	methods : {
		async getpaginate(page = 1){
			const res  = await this.callApi('get',`app/get_all_slot?page=${page}&total=${ parseInt(this.total)}`)
			if(res.status == 200){
				this.slotLists = res.data.data
				this.pagination = res.data
				// this.users = res1.data.data
			}
			else{
				this.swr()
			}
		},
		showDeletingModal(item, i){
		 const deleteModalObj  =  {
				showDeleteModal: true, 
				deleteUrl : 'app/delete_booking', 
				data : item, 
				deletingIndex: i, 
				isDeleted : false,
			}
			this.$store.commit('setDeletingModalObj', deleteModalObj)     
		},
		viewDetails(item,i){
			this.viewDetailsModal=true
			this.dataDetails = item;
		}
		

		
	}, 

	async created(){
	const [res1, res2] = await Promise.all([ 
		this.callApi('get','app/get_category'),
		this.callApi('get',`app/get_booking_details?total=${this.total}`) 
		])
		if(res1.status == 200 && res2.status == 200){
			this.categoryLists = res1.data
			this.slotLists= res2.data.data
			this.pagination = res2.data
		}
		else{
			this.swr()
		}
	},
	components : {
		deleteModal
	},
	computed : {
		...mapGetters(['getDeleteModalObj'])
	},
	watch : {
		getDeleteModalObj(obj){
			if(obj.isDeleted){
				this.slotLists.splice(obj.deletingIndex,1)
			}
		}
	}
	
}
</script>
<style>
.ivu-modal-header-inner {
    font-size:18px!important;
}
</style>