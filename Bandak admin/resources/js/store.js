import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export default new Vuex.Store({
    state : {
        conuter : 1000, 
        deleteModalObj : {
            showDeleteModal: false, 
            deleteUrl : '', 
            data : null, 
            deletingIndex: -1, 
            isDeleted : false,

        }, 
        user: false, 
    }, 
    getters: {
        getCounter(state){
           return state.conuter
        }, 
        getDeleteModalObj(state){
            return state.deleteModalObj
        }
        

       

    },

    mutations: {
        changeTheCounter(state, data){
            state.conuter += data
        }, 
        setDeleteModal(state, data){
            // const deleteModalObj = {
            //     showDeleteModal: false, 
            //     deleteUrl : '', 
            //     data : data, 
            //     deletingIndex: -1, 
            //     isDeleted : true,
            // }
            // state.deleteModalObj = deleteModalObj
            state.deleteModalObj = data
        },
        setDeletingModalObj(state, data){
            state.deleteModalObj = data
        },
        updateUser(state, data){
            state.user = data
        },
    }, 



    actions :{
        changeCounterAction({commit}, data){
            commit('changeTheCounter', data)
        }
    }


})