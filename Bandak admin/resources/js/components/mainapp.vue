<template>
    <div>
      <div v-if="$store.state.user">
      <!--========== ADMIN SIDE MENU one ========-->
      <div class="_1side_menu" >
        <div class="_1side_menu_logo">
          <h3 style="text-align:center;">Plastic Surgery</h3>
          <!--<img src="/img/logo.jpg" style="width: 108px;margin-left: 68px;"/>-->
        </div>

        <!--~~~~~~~~ MENU CONTENT ~~~~~~~~-->
        <div class="_1side_menu_content">
          <div class="_1side_menu_img_name">
            <!-- <img class="_1side_menu_img" src="/pic.png" alt="" title=""> -->
            <p class="_1side_menu_name">Admin</p>
          </div>

          <!--~~~ MENU LIST ~~~~~~-->
          <div class="_1side_menu_list">
            <ul class="_1side_menu_list_ul">
              <li><router-link to="/"><Icon type="ios-speedometer" /> Dashboard</router-link></li>
              <li><router-link to="category"><Icon type="ios-aperture" /> Category</router-link></li>
               <li><router-link to="booking"><Icon type="logo-buffer" /> All slots</router-link></li>
               <li><router-link to="booked_slot"> <Icon type="logo-foursquare" /> Booked slots</router-link></li>
               <li><router-link to="booking_details"> <Icon type="ios-paper" /> Booking Details</router-link></li>
              <!-- <li><router-link to="adminusers"><Icon type="ios-speedometer" /> Admin users</router-link></li> -->
              <li><a href="/logout"><Icon type="md-log-in" /> Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!--========== ADMIN SIDE MENU ========-->

      <!--========= HEADER ==========-->
      <div class="header">
        <div class="_2menu _box_shadow">
          <div class="_2menu_logo">
            <ul class="open_button">
              <li>
                <Icon type="ios-list" />
              </li>
              <!--<li><Icon type="ios-albums" /></li>-->
            </ul>
          </div>
        </div>
      </div>
      <!--========= HEADER ==========-->
    </div>
    	<router-view/>
    </div>
</template>

<script>
export default {
    props: ['user'],
    data(){
       return {
          isLoggedIn : true, 
       }
    }, 
    created(){
       this.$store.commit('updateUser', this.user)
    }
}
</script>