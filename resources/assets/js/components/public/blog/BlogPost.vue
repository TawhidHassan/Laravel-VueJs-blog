<template>
    <span id="blogpost">
         <section id="inner-headline">
      <div class="container">
        <div class="row">
          <div class="span4">
            <div class="inner-heading">
              <h2>Blog left sidebar</h2>
            </div>
          </div>
          <div class="span8">
            <ul class="breadcrumb">
              <li><a href="#"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
              <li><a href="#">Blog</a><i class="icon-angle-right"></i></li>
              <li class="active">Blog</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
         <section id="content">
      <div class="container">
        <div class="row">
          <div class="span8">
            <article v-for="post in allpost">
              <div class="row">
                <div class="span8">
                  <div class="post-image">
                    <div class="post-heading">
                      <h3><a href="#">{{post.title}}</a></h3>
                    </div>
                    <img :src="ourImage(post.photo)" alt="" width="400" height="200"/>
                  </div>
                  <p>
                    {{post.description|sortlenght(120,"...")}}
                  </p>
                  <div class="bottom-article">
                    <ul class="meta-post">
                      <li><i class="icon-calendar"></i><a href="#">{{post.created_at|timeformat}}</a></li>
                      <li><i class="icon-user"></i><a href="#" v-if="post.user"> {{post.user.name}}</a></li>
                      <li><i class="icon-folder-open"></i><a href="#"> Blog</a></li>
                      <li><i class="icon-comments"></i><a href="#">4 Comments</a></li>
                    </ul>
                    <router-link :to="`/blog/${post.id}`" class="pull-right">Continue reading <i class="icon-angle-right"></i></router-link>
                  </div>
                </div>
              </div>
            </article>
            <div id="pagination">
              <span class="all">Page 1 of 3</span>
              <span class="current">1</span>
              <a href="#" class="inactive">2</a>
              <a href="#" class="inactive">3</a>
            </div>
          </div>
            <BlogSidebar></BlogSidebar>
        </div>
      </div>
    </section>
    </span>
</template>

<script>

    import BlogSidebar from "./BlogSidebar";

    export default {
        name: "BlogPost",
        components: {
            BlogSidebar
        },
        mounted(){

            this.$store.dispatch('getallblogpost');
        },
        computed:{
            allpost()
            {
                return this.$store.getters.getallblogposts
            }
        },
        methods:{

            getAllCategoryPost(){
                if(this.$route.params.id!=null){
                    this.$store.dispatch('getPostByCatId',this.$route.params.id);
                }else{
                    this.$store.dispatch('getallblogpost');
                }
            },
            ourImage(img){
                return "uploadimage/"+img;
            },
        },
        watch:{
            $route(to,from){
                this.getAllCategoryPost();
            }
        }
    }
</script>

<style scoped>

</style>
