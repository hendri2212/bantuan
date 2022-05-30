import { createStore } from 'vuex'
var host = window.location.hostname=='localhost' ? 'http://127.0.0.1:8000/api/' : 'http://10.10.10.9:8000/api/';
export default createStore({
    state: {
        url   : host + "",
        token : localStorage.getItem('telephone')
    },
    mutations: {
    },
    actions: {
        login:function({commit, state}){
            state.token = localStorage.getItem('telephone')
        },
        logout:function({commit, state}){
            state.token = null
        }
    },
    modules: {
    }
})
