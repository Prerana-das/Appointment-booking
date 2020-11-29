<template>
    <div>
       <div class="content">
			<div class="container-fluid">
				
				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Category <Button @click="addModal=true"><Icon type="md-add" /> Add Category</Button></p>

					<div class="_overflow _table_div">
						<table class="_table">
								<!-- TABLE TITLE -->
							<tr>
								<th>ID</th>
								<th>Category name</th>
								<th>Created at</th>
								<th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
							<tr v-for="(category, i) in categoryLists" :key="i" v-if="categoryLists.length">
								<td>{{category.id}}</td>
								<td class="_table_name">{{category.categoryName}}</td>
								<td>{{category.created_at}}</td>
								<td>
									<Button type="info" size="small" @click="showEditModal(category, i)">Edit</Button>
									<Button type="error" size="small" @click="showDeletingModal(category, i)"  :loading="category.isDeleting">Delete</Button>
									
								</td>
							</tr>
								<!-- ITEMS -->
					</table>
					</div>
				</div>


				<!-- tag adding modal -->
				<Modal
					v-model="addModal"
					title="Add category"
					:mask-closable="false"
					:closable="false"

					>
                    
					<Input v-model="data.categoryName" placeholder="Add category name"  />
            
					<div slot="footer">
						<Button type="default" @click="addModal=false">Close</Button>
						<Button type="primary" @click="addCategory" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding..' : 'Add Category'}}</Button>
					</div>

				</Modal>
				<!-- tag editing modal -->
				<Modal
					v-model="editModal"
					title="Edit category"
					:mask-closable="false"
					:closable="false"

					>
					<Input v-model="editData.categoryName" placeholder="Add category name"  />
					<div slot="footer">
						<Button type="default" @click="closeEditModal">Close</Button>
						<Button type="primary" @click="editCategory" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Updating..' : 'Update Category'}}</Button>
					</div>
				</Modal>
				<deleteModal></deleteModal>
				<div style="text-align:center;" class="pagination_div _mar_t30">
					<Page :current="pagination.current_page" :total="pagination.total" @on-change="getpaginate" :page-size="parseInt(pagination.per_page)" />
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
			data : {
				categoryName: ''
			}, 
			addModal : false, 
			editModal : false, 
			isAdding : false, 
			categoryLists : [], 
			editData : {
				categoryName: ''
			}, 
			index : -1, 
			showDeleteModal: false, 
			isDeleing : false,
			deleteItem: {}, 
            deletingIndex: -1, 
			token: '', 
			isEditingItem: false,
			websiteSettings: [],
			page:1,
			total:"4",
			pagination: {},

		}
	},

	methods : {
		async getpaginate(page = 1){
			const res  = await this.callApi('get',`app/get_category?page=${page}&total=${ parseInt(this.total)}`)
			if(res.status == 200){
				this.categoryLists = res.data.data
				this.pagination = res.data
			}
			else{
				this.swr()
			}
		},
		async addCategory(){
			if(this.data.categoryName.trim()=='') return this.e('Category name is required')
			const res = await this.callApi('post', 'app/create_category', this.data)
			if(res.status===201){
				console.log(res.data)
				this.categoryLists.unshift(res.data)
				this.s('Category has been added successfully!')
				this.addModal = false
				this.data.categoryName = ''
			}else{
				if(res.status==422){
					if(res.data.errors.categoryName){
						this.e(res.data.errors.categoryName[0])
					}
					
				}else{
					this.swr()
				}
				
			}

		},
		async editCategory(){
			if(this.editData.categoryName.trim()=='') return this.e('Category name is required')
			const res = await this.callApi('post', 'app/edit_category', this.editData)
			if(res.status===200){
				this.categoryLists[this.index].categoryName = this.editData.categoryName
				this.s('Category has been edited successfully!')
				this.editModal = false
				
			}else{
				if(res.status==422){
					if(res.data.errors.categoryName){
						this.e(res.data.errors.categoryName[0])
					}
					
				}else{
					this.swr()
				}
				
			}

		},
		showEditModal(category, index){
			// let obj = {
			// 	id : tag.id, 
			// 	tagName : tag.tagName
			// }
			console.log(category)
			this.editData = category
			this.editModal = true
			this.index = index
			this.isEditingItem = true
		}, 
		
		showDeletingModal(category, i){
		 const deleteModalObj  =  {
				showDeleteModal: true, 
				deleteUrl : 'app/delete_category', 
				data : category, 
				deletingIndex: i, 
				isDeleted : false,
			}
			this.$store.commit('setDeletingModalObj', deleteModalObj)
			// this.deleteItem = tag
			this.deletingIndex = i
			this.showDeleteModal = true

		},  
		closeEditModal(){
			this.isEditingItem = false
			this.editModal = false
		}
	}, 

	async created(){
        this.token = window.Laravel.csrfToken
		const res = await this.callApi('get', `app/get_category?total=${this.total}`)
		if(res.status==200){
			this.categoryLists = res.data.data
			this.pagination = res.data
		}else{
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
				this.categoryLists.splice(obj.deletingIndex,1)
			}
		}
	}


	
}
</script>