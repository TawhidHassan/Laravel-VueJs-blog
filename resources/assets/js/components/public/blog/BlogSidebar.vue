<template>
    <span id="sidebar">
    <div class="span4">
        <aside class="right-sidebar">
            <div class="widget">
                <form class="form-search">
                    <input placeholder="Type something" v-model="ketword" @keyup="Realsearch" type="text" class="input-medium search-query">
                    <button type="submit" class="btn btn-square btn-theme" @click.prevent="Realsearch">Search</button>
                </form>
            </div>
            <div class="widget">
                <h5 class="widgetheading">Categories</h5>
                <ul class="cat">
                    <li v-for="category in allcategories"><i class="icon-angle-right"></i><router-link :to="`/categories/${category.id}`">{{category.cat_name}}</router-link><span> ({{category.posts_count}})</span></li>

                </ul>
            </div>
            <div class="widget">
                <h5 class="widgetheading">Latest posts</h5>
                <ul class="recent">
                   <li v-for="(post,index) in blogpost"  v-if="index<5">
                    <img :src="ourImage(post.photo)" class="pull-left" alt="" width="40" height="40"/>
                    <h6><router-link :to="`/blog/${post.id}`">{{post.title}}</router-link></h6>
                    <p>
                     {{post.description | sortlenght(100,"....")}}
                    </p>
                  </li>

                </ul>
            </div>
            <div class="widget">
                <h5 class="widgetheading">Popular tags</h5>
                <ul class="tags">
                    <li><a href="#">Web design</a></li>
                    <li><a href="#">Trends</a></li>
                    <li><a href="#">Technology</a></li>
                    <li><a href="#">Internet</a></li>
                    <li><a href="#">Tutorial</a></li>
                    <li><a href="#">Development</a></li>
                </ul>
            </div>
        </aside>
    </div>
    </span>

</template>

<script>
    import _ from 'lodash'
    export default {
        name: "BlogSidebar",
        data()
        {
          return{
              ketword:'',
        }
        },
        computed:{
            allcategories(){
                return this.$store.getters.allcategories;
            },
            blogpost()
            {
                return this.$store.getters.getallblogposts
            },
        },
        mounted(){
            this.$store.dispatch('allcategories')
            this.$store.dispatch('getallblogpost')
        },
        methods:{
            ourImage(img){
                return "uploadimage/"+img;
            },
            Realsearch:_.debounce(function () {
                this.$store.dispatch('searchpost',this.ketword)
            },1000)
        },
    }
</script>

<style scoped>

</style>
