<template>
    <div>
       <div class="content">
			<div class="container-fluid">
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
				<div class="_dashboard_action_title">
					<p class="_title0">Slot <Button @click="addModal=true"><Icon type="md-add" /> Add Slot</Button></p>
					<div class="_dashboard_actions _d_flex align-items-center">
					<Select class="_mar_l10 _mar_r10" v-model="categoryBySearch" @on-change="sortBy" placeholder="Sort By Category">
						<Option  value="All" >All</Option>
						<Option v-for="item in categoryLists" :value="item.id" :key="item.id">
							{{ item.categoryName }}
						</Option>
					</Select>
					</div>
				</div>
				<Modal
					v-model="addModal"
					title="Add Slot"
					:mask-closable="false"
					:closable="false"
					>
                    <div class="col-md-12">
						<div class="form-input">
							<Select v-model="formData.category_id" placeholder="Select Category">
							<Option v-for="item in categoryLists" :value="item.id" :key="item.id">
								{{ item.categoryName }}
							</Option>
							</Select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-input">
							<DatePicker 
							@on-change="handleChange"
							type="date" placeholder="Select date"
							>
							</DatePicker>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-input">
							<TimePicker v-model="formData.slot" format="hh:mm A" type="timerange" placement="bottom-end" placeholder="Select time"></TimePicker>
						</div>
					</div>

					<div slot="footer">
						<Button type="default" @click="addModal=false">Close</Button>
						<Button type="primary" @click="storeSlot" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding..' : 'Add Slot'}}</Button>
					</div>

				</Modal>

			
					<div class="_overflow _table_div">
						<table class="_table">
								<!-- TABLE TITLE -->
							<tr>
								<th>ID</th>
								<th>Category</th>
								<th>Date</th>
								<th>Slot</th>
								<th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
							<tr v-for="(item, i) in slotLists" :key="i" :class="item.isBooked == 1 ? 'booked_slot':''">
								<td>{{item.id}}</td>
								<td class="_table_name">
									<span v-if="item.category">{{item.category.categoryName}}</span>
								</td>
								<td class="">{{item.datee}}</td>
								<td class="">{{item.slot}}
									<!-- <span v-if=""></span> -->
								</td>
								<td>
									<Button type="info" size="small" @click="isEditOn(item, i)">Edit</Button>
									<Button type="error" size="small" @click="showDeletingModal(item, i)"  :loading="item.isDeleting">Delete</Button>			
								</td>
							</tr>
								<!-- ITEMS -->
						</table>
					</div>
						<Modal
						v-model="editModal"
						title="Edit slot"
						:mask-closable="false"
						:closable="false"

						>
						<div class="col-md-12">
							<div class="form-input">
								<Select v-model="editData.category_id" placeholder="Select Category">
								<Option v-for="item in categoryLists" :value="item.id" :key="item.id">
									{{ item.categoryName }}
								</Option>
								</Select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-input">
								<DatePicker 
								@on-change="handleChangeEdit"
								type="date" placeholder="Select date"
								>
								</DatePicker>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-input">
								<TimePicker v-model="editData.slot" format="hh:mm A" type="timerange" placement="bottom-end" placeholder="Select time"></TimePicker>
							</div>
						</div>
						<div slot="footer">
							<Button type="default"  @click="editModal=false">Close</Button>
							<Button type="primary" @click="editCategory" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Updating..' : 'Update Slot'}}</Button>
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
			addModal : false, 
			editModal : false, 
			isAdding : false,  
			categoryLists:[],
			formData:{
				category_id:'',
				datee:'',
				slot:[],
			},
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
		}
	},

	methods : {
		handleChange (date) {
			this.formData.datee = date;
		},
		handleChangeEdit (date) {
			this.editData.datee = date;
		},
		async storeSlot(){
			if(this.formData.category_id=='') return this.e('Category is required')
			if(this.formData.datee=='') return this.e('Date is required')
			if(this.formData.slot=='') return this.e('Please select time slot')
			if(this.formData.slot[0] == ''){
				this.i("Please select time slot")
				return;
			}
        	const res = await this.callApi('post', 'app/add_slot',this.formData)
			if(res.status==201){
				this.s('Slot added successfully!')
				this.slotLists.unshift(res.data.data)
				this.formData={}
				this.addModal=false
				this.formData.datee=''
			}	
		},

		async editCategory(){
			if(this.editData.category_id=='') return this.e('Category is required')
			if(this.editData.datee=='') return this.e('Date is required')
			if(this.editData.slot=='') return this.e('Please select time slot')
			if(this.editData.slot[0] == ''){
				this.i("Please select time slot")
				return;
			}
			const res = await this.callApi('post', 'app/edit_slot', this.editData)
			if(res.status===200){
				this.s('Slot has been edited successfully!')
				this.slotLists[this.editIndex] = res.data.data
				this.editModal = false	
			}else{
				if(res.status==422){
					if(res.data.errors.categoryName){
						this.e(res.data.errors.categoryName[0])
					}
					if(res.data.errors.iconImage){
						this.e(res.data.errors.iconImage[0])
					}
					
				}else{
					this.swr()
				}
				
			}
		},
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
		isEditOn(item,index){
			this.editData.id = item.id
			this.editData.category_id = item.category_id
			this.editData.datee = item.datee
			this.editData.slot = item.slot
			
			this.editIndex = index
			this.editModal = true
		},
		showDeletingModal(item, i){
		 const deleteModalObj  =  {
				showDeleteModal: true, 
				deleteUrl : 'app/delete_slot', 
				data : item, 
				deletingIndex: i, 
				isDeleted : false,
			}
			this.$store.commit('setDeletingModalObj', deleteModalObj)
		},
		 async sortBy(){
          const res2 =await this.callApi('get',`app/sortByCategory?categoryBySearch=${this.categoryBySearch}&total=${this.total}`)
          if(res2.status == 200){
			  this.slotLists = res2.data.data
			  this.pagination = res2.data
          }       
		},
		// dayDateFormat(){
		// 	for(let d of this.slotLists){
		// 		if(d.datee){
		// 			this.today = new Date(d.datee);
		// 			d.datee=this.today.getDate() +' '+ this.days[this.today.getDay()]
		// 		}	
		// 	}
		// }
		

		
	}, 

	async created(){
	const [res1, res2] = await Promise.all([ 
		this.callApi('get','app/get_all_categoryy'),
		this.callApi('get',`app/get_all_slot?total=${this.total}`) 
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