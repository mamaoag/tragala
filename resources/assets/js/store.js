import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export const store = new Vuex.Store({

    state: {
        notifs: [],
        posts: []
    },
    getters: {
        all_notifs(state){
            return state.notifs
        },

        all_notifs_count(state){
            return state.notifs.length
        },

        all_posts(state){
            return state.posts
        }
    },
    mutations: {
        add_notif(state,notif){
            state.notifs.push(notif)
        },

        add_post(state,post){
            state.posts.push(post)
        } 
    }
})