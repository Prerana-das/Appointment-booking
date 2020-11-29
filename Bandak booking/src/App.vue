<template>
    <div>
         <div class="booking_area _padd_tb80">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
                        <h3 class="s_title _mar_b10 text-center">Select Category</h3>
						<div class="booking_left">
							<ul class="category_list">
								<li v-for="(item,i) in categoryLists" :key="i">
                                    <span @click="handleChange2(item)"
                                    :class=" item.id == category3 ?'active_list': ''">
                                         {{ item.categoryName }}
                                    </span>
                                </li>
							</ul>
						</div>
					</div>
					<div class="col-md-9">
						<div class="booking_right">
							<div class="available_date _mar_b50">
								<div class="available_date_title_area">
									<h3 class="s_title _mar_b10">Available Date</h3>
									<!-- <p class="month">May 2020</p> -->
								</div>
                                <div class="calender_area">
                                    <DatePicker
                                        :value="value3"
                                        type="date"
                                        @on-change="handleChange"
                                        >
                                        <!-- <a href="javascript:void(0)" @click="handleClick">
                                            <Icon type="ios-calendar-outline"></Icon>
                                            <template v-if="value3 === ''">Select date</template>
                                            <template v-else>{{ value3 }}</template>
                                        </a> -->
                                    </DatePicker>
                               
                                </div>
							</div>
							<div class="time_slot">
                                <template v-if="slotLists.length > 0">
                                    <h3 class="s_title _mar_b10">Select Your Desired Slot</h3>
                                   <ul class="time_slot_list">
									<!-- <li class="active_list"><span>08:00 - 08:30</span></li> -->
									    <li v-for="(item,index) in slotLists" :key="index"
                                         @click="selectSlot(item,index)"
                                         :class="index == editIndex ? 'active_list':''"
                                         >
                                            <span :class="item.isBooked == 1 ? 'bookedSlot':''">{{item.slot}}</span>
                                        </li>
                                    </ul>
                                    <button class="block_btn _mar_t50" @click="bookingSlot">Book Now</button>
                                </template>
                                <template v-else>
                                    <div class="alert_msg">
                                        <Alert>No avilable slots</Alert>
                                    </div>
                                </template>
							</div>
						</div>
					</div>
                    <Modal v-model="bookingModal"
                    :mask-closable="false"
					:closable="false" 
                    fullscreen title="Book Your Appointment" 
                    style="font-size:16px!important">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Name</p>
                                    <Input type="text" v-model="formData.name" placeholder="Name" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Age</p>
                                    <Input type="number" v-model="formData.age" placeholder="Age" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Birth Date</p>
                                    <Input type="text" v-model="formData.birth_date" placeholder="Birth Date" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Address</p>
                                    <Input type="text" v-model="formData.address" placeholder="Address" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">City</p>
                                    <Input type="text" v-model="formData.city" placeholder="City" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">State</p>
                                    <Input type="text" v-model="formData.state" placeholder="State" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Zip</p>
                                    <Input type="number" v-model="formData.zip" placeholder="Zip" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Home Phone</p>
                                    <Input type="number" v-model="formData.home_phone" placeholder="Home Phone" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Work Phone</p>
                                    <Input type="number" v-model="formData.work_phone" placeholder="Work Phone" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Cell Phone</p>
                                    <Input type="number" v-model="formData.cell_phone" placeholder="Cell Phone" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Email</p>
                                    <Input type="email" v-model="formData.email" placeholder="Email" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Occupation</p>
                                    <Input type="text" v-model="formData.occupation" placeholder="Occupation" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Employer</p>
                                    <Input type="text" v-model="formData.employer" placeholder="Employer" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">SS#</p>
                                    <Input type="number" v-model="formData.ss" placeholder="SS#" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Marital Status</p>
                                    <Input type="text" v-model="formData.marital_status" placeholder="M S D W" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Gender</p>
                                    <RadioGroup v-model="formData.gender">
                                        <Radio label="male">Male</Radio>
                                        <Radio label="female">Female</Radio>
                                    </RadioGroup>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Guardian Name</p>
                                    <Input type="text" v-model="formData.guardian_name" placeholder="Guardian Name" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Guardian Cell Phone</p>
                                    <Input type="number" v-model="formData.guardian_cell_phone" placeholder="Guardian Cell Phone" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Guardian Work Phone</p>
                                    <Input type="number" v-model="formData.guardian_work_phone" placeholder="Guardian Work Phone" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Do you have children?</p>
                                    <Input type="text" v-model="formData.have_child" placeholder="Y/N" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">How many children?</p>
                                    <Input type="number" v-model="formData.total_child" placeholder="Total child" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Best way to contact you</p>
                                    <CheckboxGroup v-model="formData.best_contact">
                                        <Checkbox label="Mail"></Checkbox>
                                        <Checkbox label="E-mail"></Checkbox>
                                        <Checkbox label="Phone"></Checkbox>
                                    </CheckboxGroup>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">May we TEXT appointment reminders to your cell#?</p>
                                    <Input type="text" v-model="formData.text_reminder" placeholder="Y/N" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Emergency Contact: Relative Name</p>
                                    <Input type="text" v-model="formData.relative_name" placeholder="Relative name" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Relative Relationship</p>
                                    <Input type="text" v-model="formData.relative_relationship" placeholder="Relative relationship" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Relative Phone</p>
                                    <Input type="number" v-model="formData.relative_phone" placeholder="Phone" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Other Contact(not living with you)</p>
                                    <Input type="text" v-model="formData.other_name" placeholder="Name" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Other Relationship</p>
                                    <Input type="text" v-model="formData.other_relationship" placeholder="Relationship" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Other Phone</p>
                                    <Input type="number" v-model="formData.other_phone" placeholder="Phone" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Who referred you to Dr Bandak? Another Patient:</p>
                                    <Input type="text" v-model="formData.another_patient" placeholder="Another Patient Name" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">If so,May we thank them?</p>
                                    <Input type="text" v-model="formData.thank_them" placeholder="Y/N" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Physician</p>
                                    <Input type="text" v-model="formData.physician" placeholder="Physician" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Website</p>
                                    <Input type="text" v-model="formData.website" placeholder="Website" />
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Internet</p>
                                    <Input type="text" v-model="formData.internet" placeholder="Internet" />
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Other</p>
                                    <Input type="text" v-model="formData.other" placeholder="other" />
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Primary Doctor Name</p>
                                    <Input type="text" v-model="formData.primary_doctor" placeholder="Primary Doctor" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Primary Doctor Phone</p>
                                    <Input type="number" v-model="formData.primary_doctor_phone" placeholder="Primary Doctor Phone" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Primary Doctor Fax</p>
                                    <Input type="number" v-model="formData.primary_doctor_fax" placeholder="Primary Doctor Fax" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Reason for today's visit</p>
                                    <Input v-model="formData.reason_for_visit" type="textarea" placeholder="Enter something..."></Input>
                                </div>
                            </div>
                        </div>
                         <div class="row">
                             <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Patient Name</p>
                                   <Input type="text" v-model="formData.patient_name" placeholder="Patient Name" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Appointment Date</p>
                                    <Input type="text" v-model="formData.appointment_date" placeholder="Appointment Date" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Are you a new patient?</p>
                                    <RadioGroup v-model="formData.new_or_old" class="radio_btn_tm">
                                        <Radio label="yes">Yes</Radio>
                                        <Radio label="no">No</Radio>
                                    </RadioGroup>
                                </div>
                            </div>
                            <div class="col-md-12 _mar_t20">
                                <p class="subTitle _mar_b5">Review of Systems: <span>Please check YES or NO on any current sysmptoms you have </span></p>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="subTitle _mar_b5">Contitutionsal</p>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Rececnt Fever/sweats</span>
                                        <RadioGroup v-model="formData.constinutional_recent_fever" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Unexplained Weight loss/gain</span>
                                        <RadioGroup v-model="formData.constinutional_unexplained_weight" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div">
                                        <span class="single_item_div_left">Unexplained Fatugue</span>
                                        <RadioGroup v-model="formData.constinutional_fatigue" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="subTitle _mar_b5">Lungs</p>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Cough</span>
                                        <RadioGroup v-model="formData.lungs_cough" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Wheezing</span>
                                        <RadioGroup v-model="formData.lungs_wheezing" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="subTitle _mar_b5">Skin</p>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Rashes</span>
                                        <RadioGroup v-model="formData.skin_rashes" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">New or changeing moles</span>
                                        <RadioGroup v-model="formData.skin_changing_moles" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div">
                                        <span class="single_item_div_left">Do you do self skin exams?</span>
                                        <RadioGroup v-model="formData.skin_self_exam" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="subTitle _mar_b5">Eyes</p>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Change in vision</span>
                                        <RadioGroup v-model="formData.eye_change_in_vision" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="subTitle _mar_b5">Gastrointestinal</p>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Heartburn/reflux</span>
                                        <RadioGroup v-model="formData.gastrointestinal_heartburn" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                     <div class="single_item_div">
                                        <span class="single_item_div_left">Blood in stool</span>
                                        <RadioGroup v-model="formData.gastrointestinal_blood_in_stool" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Nausea vomiting</span>
                                        <RadioGroup v-model="formData.gastrointestinal_nausea_vomiting" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div">
                                        <span class="single_item_div_left">Pain</span>
                                        <RadioGroup v-model="formData.gastrointestinal_pain" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="subTitle _mar_b5">Neurological</p>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Headaches</span>
                                        <RadioGroup v-model="formData.neurological_headaches" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Memory Loss</span>
                                        <RadioGroup v-model="formData.neurological_memory_loss" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div">
                                        <span class="single_item_div_left">Fainting</span>
                                        <RadioGroup v-model="formData.neurological_fainting" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="subTitle _mar_b5">Ear Nose & Throat</p>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Difficulty hearing</span>
                                        <RadioGroup v-model="formData.ear_nt_difficulty_hearing" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Trouble swallowing</span>
                                        <RadioGroup v-model="formData.ear_nt_trouble_swallowing" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div">
                                        <span class="single_item_div_left">Difficulty breathing</span>
                                        <RadioGroup v-model="formData.ear_nt_difficulty_breathing" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="subTitle _mar_b5">Genitourinary</p>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Painful urination</span>
                                        <RadioGroup v-model="formData.genitourinary_painful_urination" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Penile discharge</span>
                                        <RadioGroup v-model="formData.genitourinary_penile_discharge" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="subTitle _mar_b5">Psychiatric</p>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Depression</span>
                                        <RadioGroup v-model="formData.pyschiatric_depression" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Anxiety</span>
                                        <RadioGroup v-model="formData.pyschiatric_anexiety" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div">
                                        <span class="single_item_div_left">Sleep problems</span>
                                        <RadioGroup v-model="formData.pyschiatric_sleep_problem" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div">
                                        <span class="single_item_div_left">Do you see a psychiattrist?</span>
                                        <RadioGroup v-model="formData.pyschiatric_see_a_psychiatrist" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div">
                                        <span class="single_item_div_left">Any anxiety medications?</span>
                                        <RadioGroup v-model="formData.pyschiatric_anexiety_medications" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div">
                                        <span class="single_item_div_left">Any problems with self image?</span>
                                        <RadioGroup v-model="formData.pyschiatric_prb_with_self_img" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                     <div class="single_item_div">
                                        <span class="single_item_div_left">Do you have little interest or pleasure in soing thing?</span>
                                        <RadioGroup v-model="formData.pyschiatric_interest_in_doing_things" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="subTitle _mar_b5">Breast</p>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Lumps</span>
                                        <RadioGroup v-model="formData.breast_lumps" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Nipple discharge</span>
                                        <RadioGroup v-model="formData.breast_nipple_discharge" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div">
                                        <span class="single_item_div_left">Pain</span>
                                        <RadioGroup v-model="formData.breast_pain" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="subTitle _mar_b5">Musculoskeletal</p>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Muscle pains</span>
                                        <RadioGroup v-model="formData.musculoskeletal_muscle_pain" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Joint pains</span>
                                        <RadioGroup v-model="formData.musculoskeletal_joint_pains" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div">
                                        <span class="single_item_div_left">Joint swelling</span>
                                        <RadioGroup v-model="formData.musculoskeletal_joint_swelling" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="subTitle _mar_b5">Heart</p>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Shortness of breath</span>
                                        <RadioGroup v-model="formData.heart_shortness_of_breath" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Chest pains</span>
                                        <RadioGroup v-model="formData.heart_chest_pain" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div">
                                        <span class="single_item_div_left">Palpitations</span>
                                        <RadioGroup v-model="formData.heart_palpitations" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="subTitle _mar_b5">Blood/Lymphatic</p>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Unexplained lumps</span>
                                        <RadioGroup v-model="formData.blood_unexplained_lumps" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                    <div class="single_item_div _mar_b10">
                                        <span class="single_item_div_left">Easy bruising</span>
                                        <RadioGroup v-model="formData.blood_easy_bruising" class="radio_btn_tm">
                                            <Radio label="yes">Yes</Radio>
                                            <Radio label="no">No</Radio>
                                        </RadioGroup>
                                    </div>
                                </div>
                            </div>
                         </div>
                         <div class="row _mar_t20">
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Medications</p>
                                    <Input type="text" v-model="formData.medications" placeholder="Medications" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Dose</p>
                                    <Input type="text" v-model="formData.dose" placeholder="Dose" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">How many times per day?</p>
                                    <Input v-model="formData.dose_per_day" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter full details..."></Input>
                                </div>
                            </div>
                         </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Do you take Aspirin?</p>
                                    <RadioGroup v-model="formData.aspirin" class="radio_btn_tm">
                                        <Radio label="yes">Yes</Radio>
                                        <Radio label="no">No</Radio>
                                    </RadioGroup>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Blood thinners</p>
                                    <RadioGroup v-model="formData.boold_thinners" class="radio_btn_tm">
                                        <Radio label="yes">Yes</Radio>
                                        <Radio label="no">No</Radio>
                                    </RadioGroup>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Advil</p>
                                    <RadioGroup v-model="formData.advil" class="radio_btn_tm">
                                        <Radio label="yes">Yes</Radio>
                                        <Radio label="no">No</Radio>
                                    </RadioGroup>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Vitamins</p>
                                    <RadioGroup v-model="formData.vitamins" class="radio_btn_tm">
                                        <Radio label="yes">Yes</Radio>
                                        <Radio label="no">No</Radio>
                                    </RadioGroup>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <p class="subTitle _mar_b5">Allergies: <span>Name any allergies you have </span></p>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Latex</p>
                                    <RadioGroup v-model="formData.latex">
                                        <Radio label="yes">Yes</Radio>
                                        <Radio label="no">No</Radio>
                                    </RadioGroup>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Local Anesthetics</p>
                                    <RadioGroup v-model="formData.local_anesthetics">
                                        <Radio label="yes">Yes</Radio>
                                        <Radio label="no">No</Radio>
                                    </RadioGroup>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Iodine/Betadine</p>
                                    <RadioGroup v-model="formData.iodine_or_betadine">
                                        <Radio label="yes">Yes</Radio>
                                        <Radio label="no">No</Radio>
                                    </RadioGroup>
                                </div>
                            </div>
                        </div>

                          <div class="row">
                            <div class="col-md-12">
                                <p class="subTitle _mar_b5">Personal Medical History: <span>Please indicate whether you have had any of the following medical problems with dates</span></p>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Heart Disease</p>
                                    <Input type="text" v-model="formData.heart_disease" placeholder="Y/N with Date" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">High Blood Pressure</p>
                                    <Input type="text" v-model="formData.high_blood_pressure" placeholder="Y/N with Date" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">High Cholesterol</p>
                                    <Input type="text" v-model="formData.high_cholesterol" placeholder="Y/N with Date" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Diabetes</p>
                                    <Input type="text" v-model="formData.diabetes" placeholder="Y/N with Date" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Thyroid Problems</p>
                                    <Input type="text" v-model="formData.thyroid_problem" placeholder="Y/N with Date" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Asthma</p>
                                    <Input type="text" v-model="formData.asthma" placeholder="Y/N with Date" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Breast Cancer</p>
                                    <Input type="text" v-model="formData.breast_cancer" placeholder="Y/N with Date" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Psychiatric Disease</p>
                                    <Input type="text" v-model="formData.psychiatric_disease" placeholder="Y/N with Date" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Bleeding Problems</p>
                                    <Input type="text" v-model="formData.bleeding_problem" placeholder="Y/N with Date" />
                                </div>
                            </div>
                         </div>
                          <div class="row">
                            <div class="col-md-12">
                                <p class="subTitle _mar_b5">Surgical History:<span> Please list all surgeries and dates</span></p>
                            </div>
                             <div class="col-6 col-md-6">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Surgical History</p>
                                    <Input v-model="formData.surgical_history" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter something..."></Input>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                                <p class="subTitle _mar_b5">Family History: <span>Please indicate family members with any of the following conditions</span></p>
                            </div>
                             <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Alcoholism </p>
                                    <Input type="text" v-model="formData.family_alcoholism" placeholder="Alcoholism" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">High Colesterol</p>
                                    <Input type="text" v-model="formData.family_high_colesterol" placeholder="High Colesterol" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">High Blood Pressure</p>
                                    <Input type="text" v-model="formData.family_high_blood_pressure" placeholder="High Blood Pressure" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Heart Disease</p>
                                    <Input type="text" v-model="formData.family_heart_disease" placeholder="Heart Disease" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Depression/Suicide</p>
                                    <Input type="text" v-model="formData.family_depression" placeholder="Depression/Suicide" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Stroke </p>
                                    <Input type="text" v-model="formData.family_stroke" placeholder="Stroke" />
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Bleeding/Clotting Problems</p>
                                    <Input type="text" v-model="formData.family_bleeding" placeholder="Bleeding/Clotting Problems" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Asthama </p>
                                    <Input type="text" v-model="formData.family_asthma" placeholder="Asthama" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Cancer </p>
                                    <Input type="text" v-model="formData.family_cancer" placeholder="Cancer" />
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                                <p class="subTitle _mar_b5">Social History:</p>
                            </div>
                             <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Do you smoke cigarate? </p>
                                    <RadioGroup v-model="formData.tobacco_use">
                                        <Radio label="yes">Yes</Radio>
                                        <Radio label="no">No</Radio>
                                    </RadioGroup>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">How many packs per day?</p>
                                    <Input type="text" v-model="formData.tobacco_per_day" placeholder="packs/day" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Used Year</p>
                                    <Input type="text" v-model="formData.tobacco_per_year" placeholder="Year" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Do you use </p>
                                   <CheckboxGroup v-model="formData.pipe_use">
                                        <Checkbox label="Pipe"></Checkbox>
                                        <Checkbox label="Cigar"></Checkbox>
                                        <Checkbox label="Snuff"></Checkbox>
                                        <Checkbox label="Chew"></Checkbox>
                                    </CheckboxGroup>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Do you drink alcohol?</p>
                                    <RadioGroup v-model="formData.alcohol_use">
                                        <Radio label="yes">Yes</Radio>
                                        <Radio label="no">No</Radio>
                                    </RadioGroup>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Drinks per week </p>
                                    <Input type="text" v-model="formData.alcohol_per_week" placeholder="Drinks per week" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Do you use any recreational drugs? </p>
                                    <RadioGroup v-model="formData.drug_use">
                                        <Radio label="yes">Yes</Radio>
                                        <Radio label="no">No</Radio>
                                    </RadioGroup>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Have you used needles to inject drugs? </p>
                                    <RadioGroup v-model="formData.used_needles">
                                        <Radio label="yes">Yes</Radio>
                                        <Radio label="no">No</Radio>
                                    </RadioGroup>
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Caffine Intake</p>
                                    <Input type="text" v-model="formData.caffine_intake" placeholder="Coffee/tea/soda" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Cups per day</p>
                                    <Input type="text" v-model="formData.caffine_cups_per_day" placeholder="cups/day" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Weight: Have you loss weight?</p>
                                    <RadioGroup v-model="formData.weight_loss">
                                        <Radio label="yes">Yes</Radio>
                                        <Radio label="no">No</Radio>
                                    </RadioGroup>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">How many pounds did you loss?</p>
                                    <Input type="text" v-model="formData.weight_loss_pound" placeholder="Pounds" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="_3login_input_group _mar_b15">
                                    <p class="registration_title _mar_b5">Do you excercise?</p>
                                    <RadioGroup v-model="formData.exercise">
                                        <Radio label="yes">Yes</Radio>
                                        <Radio label="no">No</Radio>
                                    </RadioGroup>
                                </div>
                            </div>
                          </div>


                          <div slot="footer">
                            <Button type="default" @click="bookingModal=false">Close</Button>
                            <Button type="primary" @click="bookNow" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding..' : 'Book Now'}}</Button>
                        </div>
                        
                    </Modal>
				</div>
			</div>
		</div>


          
    </div>
</template>


<script>
export default {
  data(){
    return {
        categoryLists:[],
        slotLists:[],
        allSlotLists:[],
        value3: '',
        category3:'',
        bookingModal:false,
        firstCategory:'',
        editIndex:-1,
        isAdding : false,
        selected_slot_id:'',
        formData:{
            category_id:'',
            slot_id:'',
            new_or_old:'',
            name:'',
            age:'',
            birth_date:'',
            address:'',
            city:'',
            state:'',
            zip:'',
            home_phone:'',
            work_phone:'',
            cell_phone:'',
            email:'',
            occupation:'',
            employer:'',
            ss:'',
            marital_status:'',
            gender:'',
            guardian_name:'',
            guardian_cell_phone:'',
            guardian_work_phone:'',
            have_child:'',
            total_child:'',
            best_contact:[],
            text_reminder:'',
            relative_name:'',
            relative_relationship:'',
            relative_phone:'',
            other_name:'',
            other_relationship:'',
            other_phone:'',
            another_patient:'',
            thank_them:'',
            physician:'',
            website:'',
            internet:'',
            other:'',
            primary_doctor:'',
            primary_doctor_phone:'',
            primary_doctor_fax:'',
            reason_for_visit:'',
            patient_name:'',
            appointment_date:'',
            constinutional_recent_fever:'',
            constinutional_unexplained_weight:'',
            constinutional_fatigue:'',
            lungs_cough:'',
            lungs_wheezing:'',
            skin_rashes:'',
            skin_changing_moles:'',
            skin_self_exam:'',
            eye_change_in_vision:'',
            gastrointestinal_heartburn:'',
            gastrointestinal_blood_in_stool:'',
            gastrointestinal_nausea_vomiting:'',
            gastrointestinal_pain:'',
            neurological_headaches:'',
            neurological_memory_loss:'',
            neurological_fainting:'',
            ear_nt_difficulty_hearing:'',
            ear_nt_trouble_swallowing:'',
            ear_nt_difficulty_breathing:'',
            genitourinary_painful_urination:'',
            genitourinary_penile_discharge:'',
            pyschiatric_depression:'',
            pyschiatric_anexiety:'',
            pyschiatric_sleep_problem:'',
            pyschiatric_see_a_psychiatrist:'',
            pyschiatric_anexiety_medications:'',
            pyschiatric_prb_with_self_img:'',
            pyschiatric_interest_in_doing_things:'',
            breast_lumps:'',
            breast_nipple_discharge:'',
            breast_pain:'',
            musculoskeletal_muscle_pain:'',
            musculoskeletal_joint_pains:'',
            musculoskeletal_joint_swelling:'',
            heart_shortness_of_breath:'',
            heart_chest_pain:'',
            heart_palpitations:'',
            blood_unexplained_lumps:'',
            blood_easy_bruising:'',
            medications:'',
            dose:'',
            dose_per_day:'',
            aspirin:'',
            boold_thinners:'',
            advil:'',
            vitamins:'',
            latex:'',
            local_anesthetics:'',
            iodine_or_betadine:'',
            heart_disease:'',
            high_blood_pressure:'',
            high_cholesterol:'',
            diabetes:'',
            thyroid_problem:'',
            asthma:'',
            breast_cancer:'',
            psychiatric_disease:'',
            bleeding_problem:'',
            surgical_history:'',
            family_alcoholism:'',
            family_high_colesterol:'',
            family_high_blood_pressure:'',
            family_heart_disease:'',
            family_depression:'',
            family_stroke:'',
            family_bleeding:'',
            family_asthma:'',
            family_cancer:'',
            tobacco_use:'',
            tobacco_per_day:'',
            tobacco_per_year:'',
            pipe_use:[],
            alcohol_use:'',
            alcohol_per_week:'',
            drug_use:'',
            used_needles:'',
            caffine_intake:'',
            caffine_cups_per_day:'',
            weight_loss:'',
            weight_loss_pound:'',
            exercise:'',

        }
    }
},
  methods : {
    handleChange2 (item) {
        this.category3 = item.id;
        this.editIndex=-1
        this.getSlot();
    },
    handleChange (date) {
        this.value3 = date;
        this.editIndex=-1
        this.getSlot();
    },
    async getSlot() {
      const res = await this.callApi('get',`${this.siteUri}getslots?category3=${this.category3}&value3=${this.value3}`);
      if (res.status === 200) {
        this.slotLists = res.data;
      }
    },
    selectSlot(item,index){
        this.editIndex = index
        this.formData.category_id=this.category3
        this.formData.slot_id=item.id
    },
    bookingSlot(){
        if(this.editIndex>=0){
            for(let i of this.slotLists){
                if(this.formData.slot_id==i.id && i.isBooked==0){
                    this.bookingModal=true
                }
            } 
        }
    },

     async bookNow(){
        if(this.formData.category_id=='') return this.e('Category is required')
        if(this.formData.slot_id=='') return this.e('Slot is required')
        if(this.formData.name.trim()=='') return this.e('Name is required')
        if(this.formData.age=='') return this.e('Age is required')
        if(this.formData.birth_date.trim()=='') return this.e('Birth date is required')
        if(this.formData.address.trim()=='') return this.e('Address is required')
        if(this.formData.city.trim()=='') return this.e('City is required')
        if(this.formData.state.trim()=='') return this.e('State is required')
        if(this.formData.zip=='') return this.e('Zip is required')
        if(this.formData.home_phone=='') return this.e('Home phone is required')
        if(this.formData.work_phone=='') return this.e('Work phone required')
        if(this.formData.cell_phone=='') return this.e('Cell phone is required')
        if(this.formData.email.trim()=='') return this.e('Email is required')
        if(this.formData.occupation.trim()=='') return this.e('Occupation is required')
        if(this.formData.employer.trim()=='') return this.e('Employer is required')
        if(this.formData.ss=='') return this.e('SS is required')
        if(this.formData.marital_status.trim()=='') return this.e('Marital status is required')
        if(this.formData.gender=='') return this.e('Gender is required')
        if(this.formData.guardian_name.trim()=='') return this.e('Guardian name is required')
        if(this.formData.guardian_cell_phone=='') return this.e('Guardian cell phone is required')
        if(this.formData.guardian_work_phone=='') return this.e('Guardian work phone is required')
        if(this.formData.have_child.trim()=='') return this.e('Do you have child field is required')
        if(this.formData.total_child=='') return this.e('Total child is required')
        if(this.formData.best_contact=='') return this.e('Best contact is required')
        if(this.formData.text_reminder=='') return this.e('Text reminder is required')
        if(this.formData.relative_name=='') return this.e('Relative name is required')
        if(this.formData.relative_relationship=='') return this.e('Relative relation is required')
        if(this.formData.relative_phone=='') return this.e('Relative phone is required')
        if(this.formData.other_name=='') return this.e('Other name is required')
        if(this.formData.other_relationship=='') return this.e('Other relation is required')
        if(this.formData.another_patient=='') return this.e('Another patient is required')
        if(this.formData.thank_them=='') return this.e('Thank them is required')
        if(this.formData.physician=='') return this.e('Physician is required')
        if(this.formData.website=='') return this.e('Website is required')
        if(this.formData.internet=='') return this.e('Internet is required')
        if(this.formData.other=='') return this.e('Other is required')
        if(this.formData.primary_doctor=='') return this.e('Primary doctor name is required')
        if(this.formData.primary_doctor_phone=='') return this.e('Primary doctor phone is required')
        if(this.formData.primary_doctor_fax=='') return this.e('Primary doctor phone is required')
        if(this.formData.reason_for_visit=='') return this.e('Reason for visit is required')
        if(this.formData.patient_name=='') return this.e('Patient name is required')
        if(this.formData.appointment_date=='') return this.e('Appointment date is required')
        if(this.formData.new_or_old=='') return this.e('New or existing petient is required')
        if(this.formData.constinutional_recent_fever=='') return this.e('Constinutional recent fever is required')
        if(this.formData.constinutional_unexplained_weight=='') return this.e('Constinutional unexplained weight is required')
        if(this.formData.constinutional_fatigue=='') return this.e('Constinutional fatigue is required')
        if(this.formData.lungs_cough=='') return this.e('Lungs cough is required')
        if(this.formData.lungs_wheezing=='') return this.e('Lungs wheezing is required')
        if(this.formData.skin_rashes=='') return this.e('Skin rashes is required')
        if(this.formData.skin_changing_moles=='') return this.e('Skin changing moles is required')
        if(this.formData.skin_self_exam=='') return this.e('Skin self exam is required')
        if(this.formData.eye_change_in_vision=='') return this.e('Eye change in vision is required')
        if(this.formData.gastrointestinal_heartburn=='') return this.e('Gastrointestinal heartburn is required')
        if(this.formData.gastrointestinal_blood_in_stool=='') return this.e('Gastrointestinal blood in stool is required')
        if(this.formData.gastrointestinal_nausea_vomiting=='') return this.e('Gastrointestinal nausea vomiting is required')
        if(this.formData.gastrointestinal_pain=='') return this.e('Gastrointestinal pain is required')
        if(this.formData.neurological_headaches=='') return this.e('Neurological headaches is required')
        if(this.formData.neurological_memory_loss=='') return this.e('Neurological memory loss is required')
        if(this.formData.neurological_fainting=='') return this.e('Neurological fainting is required')
        if(this.formData.ear_nt_difficulty_hearing=='') return this.e('ear nose difficulty hearing is required')
        if(this.formData.ear_nt_trouble_swallowing=='') return this.e('ear nose trouble swallowing is required')
        if(this.formData.ear_nt_difficulty_breathing=='') return this.e('ear nose difficulty breathing is required')
        if(this.formData.genitourinary_painful_urination=='') return this.e('Genitourinary painful urination is required')
        if(this.formData.genitourinary_penile_discharge=='') return this.e('Genitourinary penile discharge is required')
        if(this.formData.pyschiatric_depression=='') return this.e('pyschiatric depression is required')
        if(this.formData.pyschiatric_anexiety=='') return this.e('Pyschiatric anexiety is required')
        if(this.formData.pyschiatric_sleep_problem=='') return this.e('pyschiatric sleep problem is required')
        if(this.formData.pyschiatric_see_a_psychiatrist=='') return this.e('pyschiatric see apsychiatrist is required')
        if(this.formData.pyschiatric_anexiety_medications=='') return this.e('Pyschiatric anexiety medications is required')
        if(this.formData.pyschiatric_prb_with_self_img=='') return this.e('Pyschiatric problem with self image is required')
        if(this.formData.pyschiatric_interest_in_doing_things=='') return this.e('Pyschiatric interest in doing things is required')
        if(this.formData.breast_lumps=='') return this.e('Breast lumps is required')
        if(this.formData.breast_nipple_discharge=='') return this.e('Breast nipple discharge is required')
        if(this.formData.breast_pain=='') return this.e('Breast pain is required')
        if(this.formData.musculoskeletal_muscle_pain=='') return this.e('Musculoskeletal muscle pain is required')
        if(this.formData.musculoskeletal_joint_pains=='') return this.e('Musculoskeletal joint pains is required')
        if(this.formData.musculoskeletal_joint_swelling=='') return this.e('musculoskeletal joint swelling is required')
        if(this.formData.heart_shortness_of_breath=='') return this.e('Heart shortness of breath is required')
        if(this.formData.heart_chest_pain=='') return this.e('Heart chest pain is required')
        if(this.formData.heart_palpitations=='') return this.e('Heart palpitations is required')
        if(this.formData.blood_unexplained_lumps=='') return this.e('Blood unexplained lumps is required')
        if(this.formData.blood_easy_bruising=='') return this.e('Blood easy bruising is required')
        if(this.formData.medications=='') return this.e('Medications is required')
        if(this.formData.dose=='') return this.e('Dose is required')
        if(this.formData.dose_per_day=='') return this.e('Dose per day is required')
        if(this.formData.aspirin=='') return this.e('Aspirin is required')
        if(this.formData.boold_thinners=='') return this.e('Boold thinners is required')
        if(this.formData.advil=='') return this.e('Advil is required')
        if(this.formData.vitamins=='') return this.e('Vitamins is required')
        if(this.formData.latex=='') return this.e('Latex is required')
        if(this.formData.local_anesthetics=='') return this.e('Local anesthetics is required')
        if(this.formData.iodine_or_betadine=='') return this.e('Iodine is required')
        if(this.formData.heart_disease=='') return this.e('Heart disease is required')
        if(this.formData.high_blood_pressure=='') return this.e('High blood pressure  is required')
        if(this.formData.high_cholesterol=='') return this.e('High cholesterol is required')
        if(this.formData.diabetes=='') return this.e('Diabetes is required')
        if(this.formData.thyroid_problem=='') return this.e('Thyroid problem is required')
        if(this.formData.Asthma=='') return this.e('Asthma is required')
        if(this.formData.breast_cancer=='') return this.e('Breast cancer is required')
        if(this.formData.psychiatric_disease=='') return this.e('Psychiatric disease is required')
        if(this.formData.bleeding_problem=='') return this.e('Bleeding problem is required')
        if(this.formData.surgical_history=='') return this.e('Surgical history is required')
        if(this.formData.family_alcoholism=='') return this.e('Alcoholism is required')
        if(this.formData.family_high_colesterol=='') return this.e('High colesterol is required')
        if(this.formData.family_high_blood_pressure=='') return this.e('High blood pressure is required')
        if(this.formData.family_heart_disease=='') return this.e('Heart disease is required')
        if(this.formData.family_depression=='') return this.e('Depression is required')
        if(this.formData.family_stroke=='') return this.e('Stroke is required')
        if(this.formData.family_bleeding=='') return this.e('Bleeding is required')
        if(this.formData.family_asthma=='') return this.e('Asthma is required')
        if(this.formData.family_cancer=='') return this.e('Cancer is required')
        if(this.formData.tobacco_use=='') return this.e('Tobacco use is required')
        if(this.formData.tobacco_per_day=='') return this.e('Tobacco use per day is required')
        if(this.formData.tobacco_per_year=='') return this.e('Tobacco use year is required')
        if(this.formData.pipe_use=='') return this.e('Pipe use is required')
        if(this.formData.alcohol_use=='') return this.e('Alcohol use is required')
        if(this.formData.alcohol_per_week=='') return this.e('Alcohol per week is required')
        if(this.formData.drug_use=='') return this.e('drug use is required')
        if(this.formData.used_needles=='') return this.e('used_ needles  is required')
        if(this.formData.caffine_intake=='') return this.e('caffine intake is required')
        if(this.formData.caffine_cups_per_day=='') return this.e('caffine cups per day is required')
        if(this.formData.weight_loss=='') return this.e('weight_loss is required')
        if(this.formData.exercise=='') return this.e('Exercise is required')


        const res = await this.callApi('post', `${this.siteUri}add_booking`,this.formData)
        if(res.status===200){
            this.s('Your form submitted successfully!')
            this.bookingModal=false
            this.formData={}

        }
        
        else{
            if(res.status==422){
                if(res.data.errors.email){
                    this.e(res.data.errors.email[0])
                }
                
            }else{
                this.swr()
            }
            
        }
    },
  },
  async created() {
    var d = new Date(),
    month = '' + (d.getMonth() + 1),
    day = '' + d.getDate(),
    year = d.getFullYear();
    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;
    this.value3=[year, month, day].join('-')
        
    const [res1, res2,res3,res4] = await Promise.all([ 
        this.callApi('get',`${this.siteUri}/get_all_category`),
        this.callApi('get',`${this.siteUri}/get_all_slot_list`),
        this.callApi('get',`${this.siteUri}/get_first_category`),
		this.callApi('get',`${this.siteUri}getslots?category3=${this.category3}&value3=${this.value3}`)
		])
		if(res1.status == 200 && res2.status == 200 && res3.status == 200 && res4.status == 200){
            this.categoryLists = res1.data
            this.allSlotLists=res2.data
            this.category3=res3.data.id
			this.slotLists= res4.data
		}
		else{
			this.swr()
        }

  }
}
</script>

<style>
.bookedSlot{
    background-color: #88807ed6;
    color: #fff;
}
.ivu-modal-header-inner {
    font-size:18px!important;
}
.single_item_div {
    display: flex;
}
.single_item_div_left {
    margin-right:5px;
}
.subTitle {
    font-weight: bold;
    font-size: 15px;
    margin-bottom: 10px!important;
}
.subTitle span{
    font-weight: normal;
    font-size: 13px;
}
body{
    background-color: #fbfcff;
}
.category_list li {
    background-color: #EBF1FE;
    margin-bottom: 15px;
    box-shadow: 0px 1px 4px -2px #74dabd8f;
    text-align: center;
    font-weight: 600;
    cursor: pointer;
    border-radius: 1px;
}
.category_list li span {
    padding: 15px 10px;
    display: block;
}
.date_list {
    display: flex;
    padding: 10px 0px;
    border-top: 1px solid #dddddd75;
    border-bottom: 1px solid #dddddd75;
}
.date_list li {
    margin-right: 18px;
    padding: 11px 20px;
    font-weight: 600;
    display: inline-grid;
    vertical-align: middle;
    align-items: center;
    cursor: pointer;
    color: #333333d9;
}
.time_slot_list li {
    display: inline-block;
    background-color: #EBF1FE;
    margin: 20px 20px 0px 0px;
    font-size: 15px;
    width: 23.18%;
    text-align: center;
    cursor: pointer;
    position: relative;
    box-shadow: 0px 1px 4px -2px #74dabd8f;
    border-radius: 1px;
    margin-bottom: 20px;
}
.time_slot_list li span {
    padding: 14px 10px;
    display: block;
}
.date_list li:last-child i {
    font-size: 18px;
    color: #0000007a;
}
.date_list li:first-child{
   color: #59bfb8!important;
}
.category_list {
    padding-right: 20px;
}
.time_slot_list li:nth-child(1),.time_slot_list li:nth-child(2), .time_slot_list li:nth-child(3), .time_slot_list li:nth-child(4){
    margin-top: 0px;
}
.available_date_title_area {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.active_list {
    background-color: #63aca8!important;
    color: #fff;
}
.time_slot_list li:nth-child(4n) {
    margin-right: 0px;
}
.s_title {
    font-size: 19px;
}
.month {
    border: 1px solid #ddddddab;
    padding: 0px 10px;
    color: #696363;
}
._padd_tb80 {
    padding: 70px 0px;
}
ul li {
    list-style: none;
}
.block_btn {
    padding: 10px 35px;
    background-color: #59bfb8;
    border: 1px solid #59bfb8;
    cursor: pointer;
    transition: .5s;
    text-transform: capitalize;
    color: #fff;
    border-radius: 1px;
}
.block_btn:hover {
    background-color: #4ca09b;
    border-color: #4ca09b;
}
._mar_b5{
   margin-bottom: 5px;
}
._mar_b10{
    margin-bottom:10px;
}
._mar_b15{
    margin-bottom:15px;
}
._mar_b50{
    margin-bottom:50px;
}
._mar_t50{
    margin-top:35px;
}
._mar_t20{
    margin-top:20px;
}
.alert_msg{
    width:70%;
}
.alert_msg .ivu-alert-info {
    padding: 19px 10px!important;
    text-align: center!important;
    font-size: 15px!important;
    font-weight: 600!important;
}
.booking_left {
    height: -webkit-calc(100% - (20px + 30px));
    height: calc(100% - (20px + 30px));
    flex: 1 1;
    overflow: auto;
    height: 75vh;
}
 .booking_left::-webkit-scrollbar {
    width: 5px; 
  }
  
  .booking_left::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px #e4f6ff;
    box-shadow: inset 0 0 6px #e4f6ff; 
  }
  .booking_left::-webkit-scrollbar-thumb {
    background-color:  #59bfb8c4;
    outline: 1px solid #fff; 
  }
@media only screen and (max-width: 767px) { 
    .category_list {
        padding-right: 0px;
        margin-bottom: 20px;
    }
    .time_slot_list li:nth-child(4n) {
        margin-right: 20px;
    }
    .time_slot_list li:nth-child(2n) {
        margin-right: 0px;
    }
    .time_slot_list li {
        font-size: 14px;
        width: 47.3%;
    }
    .booking_right{
        margin-bottom: 1000px;
    }
    ._padd_tb80 {
        padding: 30px 0px;
    }
    .ivu-date-picker {
        width: 100%!important;
    }
    .alert_msg {
        width: 100%;
    }
    .booking_left {
        height: 350px!important;
        margin-bottom:20px;
    }
    .s_title{
        font-size:18px;
    }
}
@media only screen and (min-width: 768px) and (max-width: 991px) { 
    .time_slot_list li:nth-child(4n) {
        margin-right: 20px;
    }
    .time_slot_list li:nth-child(3n) {
        margin-right: 0px;
    }
    .time_slot_list li {
        font-size: 14px;
        width: 30.7%;
    }
    .s_title{
        font-size:18px;
    }
 }
</style>











