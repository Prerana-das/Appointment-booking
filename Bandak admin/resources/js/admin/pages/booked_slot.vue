<template>
    <div>
       <div class="content">
			<div class="container-fluid">
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
				<div class="_dashboard_action_title">
					<p class="_title0">Booked slot</p>
					<!-- <div class="_dashboard_actions _d_flex align-items-center _mar_b20">
					<Select class="_mar_l10 _mar_r10" v-model="categoryBySearch" @on-change="sortBy" placeholder="Sort By Category">
						<Option  value="All" >All</Option>
						<Option v-for="item in categoryLists" :value="item.id" :key="item.id">
							{{ item.categoryName }}
						</Option>
					</Select>
					</div> -->
				</div>
	
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
							<tr v-for="(item, i) in slotLists" :key="i" :class="item.isBooked == 1 ? 'booked_slot':''" v-if="item.isBooked==1">
								<td>{{item.id}}</td>
								<td class="_table_name">
									<span v-if="item.category">{{item.category.categoryName}}</span>
								</td>
								<td class="">{{item.datee}}</td>
								<td class="">{{item.slot}}
									<!-- <span v-if=""></span> -->
								</td>
								<td>
									<Button type="error" size="small" @click="showDeletingModal(item, i)"  :loading="item.isDeleting">Delete</Button>			
								</td>
							</tr>
								<!-- ITEMS -->
						</table>
					</div>
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
				deleteUrl : 'app/delete_booked_slot', 
				data : item, 
				deletingIndex: i, 
				isDeleted : false,
			}
			this.$store.commit('setDeletingModalObj', deleteModalObj)
		},
		// async sortBy(){
        //   const res2 =await this.callApi('get',`app/sortByCategory?categoryBySearch=${this.categoryBySearch}&total=${this.total}`)
        //   if(res2.status == 200){
		// 	  this.slotLists = res2.data.data
		// 	  this.pagination = res2.data
        //   }       
		// },
		
	}, 

	async created(){
	const [res1, res2] = await Promise.all([ 
		this.callApi('get','app/get_all_categoryy'),
		this.callApi('get',`app/get_all_booked_slot?total=${this.total}`) 
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