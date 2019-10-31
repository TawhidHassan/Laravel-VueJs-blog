export default {
    state:{
        //step 3
        category:[],
        post:[],
        blogpost:[],
        singlepost:[],
        allcategories:[],

    },
    getters:{
        //step 4 last step
       getcategory(state){
            return state.category
       },
        getallposts(state)
        {
            return state.post
        },
        getallblogposts(state)
        {
            return state.blogpost
        },
        singlepost(state){
            return state.singlepost
        },
        allcategories(state){
            return state.allcategories
        },

    },
    actions:{
        //step 1
        categoryes(context){

            axios.get('/categoryes')
                .then((response)=>{
                    context.commit('categ',response.data.categories)
                })
        },
        getallpost(context)
        {
            axios.get('/posts')
                .then((response)=>{
                    console.log(response.data)
                    context.commit('allposts',response.data.posts)
                })
        },
        getallblogpost(context)
        {
            axios.get('/blogposts')
                .then((response)=>{
                    console.log(response.data)
                    context.commit('allblogposts',response.data.posts)
                })
        },
        getPostById(context,payload){
            axios.get('/singlepost/'+payload)
                .then((response)=>{
                    context.commit('siglePost',response.data.post)
                })
        },
        allcategories(context){
            axios.get('/categories')
                .then((response)=>{
                    context.commit('allcategories',response.data.categories)
                })
        },
        getPostByCatId(context,payload){
            axios.get('/categorypost/'+payload)
                .then((response)=>{
                    console.log(response.data.posts)
                    context.commit('getPostByCatId',response.data.posts)
                })
        },
        searchpost(context,payload)
        {
            axios.get('/search/?s='+payload)
                .then((response)=>{
                    console.log(response.data.posts)
                    context.commit('searchposts',response.data.posts)
                })
        },
    },
    mutations:{
        //step 2 and make state like category,post on the top state function
        categ(state,data)
        {
            return state.category=data
        },
        allposts(state,data)
        {
            return state.post=data
        },
        allblogposts(state,data)
        {
            return state.blogpost=data
        },
        siglePost(state,payload){
            return state.singlepost = payload
        },
        allcategories(state,payload){
            return state.allcategories  = payload
        },
        getPostByCatId(state,payload){
            state.blogpost = payload
        },
        searchposts(state,payload){
            state.blogpost = payload

        },
    }

}
