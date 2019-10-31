<template>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Category Table</h3>
                        <div class="card-tools">
                            <button class="btn btn-success">
                                <router-link to="/addpost" style="color: #ffffff">Add Category</router-link>

                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>user name</th>
                                <th>Category name</th>
                                <th>Post title</th>
                                <th>Post description</th>
                                <th>Photo</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(post) in allpost" :key="post.id">

                                <td>{{post.id}}</td>
                                <td v-if="post.user">{{post.user.name|sortlenght(10,"...")}}</td>
                                <td v-if="post.category">{{post.category.cat_name}}</td>
                                <td>{{post.title|sortlenght(15,"...")}}</td>
                                <td>{{post.description|sortlenght(30,"...")}}</td>
                                <td><img :src="ourImage(post.photo)" alt="" height="50" width="40"></td>
                                <td>{{post.created_at|timeformat}}</td>
                                <td>
                                    <router-link :to="`edoipost/${post.id}`"  class="btn btn-success" >Edit</router-link>
                                    <a href="" @click.prevent = "deletePost(post.id)" class="btn btn-danger" >Delete</a>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>S.No</th>
                                <th>user name</th>
                                <th>Category name</th>
                                <th>Post title</th>
                                <th>Post description</th>
                                <th>Photo</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</template>

<script>
    export default {
        name: "List",
        mounted(){
            this.$store.dispatch("getallpost")
        },
        computed:{
            allpost()
            {
                return this.$store.getters.getallposts
            }
        },
        methods:{
            ourImage(img){
                return "uploadimage/"+img;
            },
            deletePost(id){
                axios.get('/postdelete/'+id)
                    .then(()=>{
                        this.$store.dispatch("getallpost")
                        Toast.fire({
                            type: 'success',
                            title: 'Post Deleted successfully'
                        })
                    })
                    .catch(()=>{
                    })
            },
        }
    }
</script>

<style scoped>

</style>
