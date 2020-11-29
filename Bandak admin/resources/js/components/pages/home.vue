<template>
    <div>
       <div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3">
						<div class="_1adminOverveiw_card _box_shadow _border_radious _mar_b30 _1adminOverveiw_bg_one">
							<div class="_1adminOverveiw_card_left">
								<p class="_1adminOverveiw_card_left_num">{{categoryLists.total}}</p>

								<p class="_1adminOverveiw_card_left_title">Total Categories</p>
							</div>
							<div class="_1adminOverveiw_card_right">
								<Icon type="ios-paper" />
							</div>
						</div>
					</div>

					<div class="col-12 col-md-3">
						<div class="_1adminOverveiw_card _box_shadow _border_radious _mar_b30 _1adminOverveiw_bg_two">
							<div class="_1adminOverveiw_card_left">
								<p class="_1adminOverveiw_card_left_num">{{bookingLists.total}}</p>

								<p class="_1adminOverveiw_card_left_title">Total Booking</p>
							</div>
							<div class="_1adminOverveiw_card_right">
								<Icon type="ios-paper-outline" />
							</div>
						</div>
					</div>

					<div class="col-12 col-md-3">
						<div class="_1adminOverveiw_card _box_shadow _border_radious _mar_b30 _1adminOverveiw_bg_two">
							<div class="_1adminOverveiw_card_left">
								<p class="_1adminOverveiw_card_left_num">{{slotLists.total}}</p>

								<p class="_1adminOverveiw_card_left_title">Total Slots</p>
							</div>
							<div class="_1adminOverveiw_card_right">
								<Icon type="md-copy" />
							</div>
						</div>
					</div>

					<div class="col-12 col-md-3">
						<div class="_1adminOverveiw_card _box_shadow _border_radious _mar_b30 _1adminOverveiw_bg_two">
							<div class="_1adminOverveiw_card_left">
								<p class="_1adminOverveiw_card_left_num">{{bookedLists.total}}</p>

								<p class="_1adminOverveiw_card_left_title">Booked Slots</p>
							</div>
							<div class="_1adminOverveiw_card_right">
								<Icon type="md-list-box" />
							</div>
						</div>
					</div>
				</div>	

			</div>
		</div>
    </div>
</template>


<script>
import {mapGetters} from 'vuex'
export default {
	data(){
		return { 
			isAdding : false,
			total:"10",
			categoryLists:[],
			bookingLists:[], 
			slotLists:[],
			bookedLists:[]
		}
	},

	methods : {
			
	}, 

	async created(){
	const [res1, res2,res3,res4] = await Promise.all([ 
		this.callApi('get', `app/get_category?total=${this.total}`),
		this.callApi('get',`app/get_booking_details?total=${this.total}`),
		this.callApi('get',`app/get_all_slot?total=${this.total}`),
		this.callApi('get',`app/get_all_booked_slot?total=${this.total}`)
		])
		if(res1.status == 200 && res2.status == 200 && res2.status == 200 && res2.status == 200){
			this.categoryLists = res1.data
			this.bookingLists= res2.data
			this.slotLists= res3.data
			this.bookedLists= res4.data
		}
		else{
			this.swr()
		}
	},
	
	
}
</script>