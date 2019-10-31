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
                                <router-link to="/addcategory" style="color: #ffffff">Add Category</router-link>

                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    <select id="" name="" @change="deleteSelect"  v-model="select">
                                    <option value="">select</option>
                                    <option value="">delete all</option>
                                </select><br/>
                                    <input type="checkbox" @click.prevent="selectAll" v-model="all_select">
                                    <span v-if="all_select==false">Check All</span>
                                    <span v-else>Uncheck All</span>
                                </th>
                                <th>S.No</th>
                                <th>Category name</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(category,index) in getallCategory" :key="category.id">

                                <td><input type="checkbox" v-model="categoryItem" :value="category.id"></td>
                                <td>{{index+1}}</td>
                                <td>{{category.cat_name}}</td>
                                <td>{{category.created_at|timeformat}}</td>
                                <td>
                                    <router-link :to="`/edoitcategory/${category.id}`"  class="btn btn-success" style="border-radius: 90%">Edit</router-link>
                                    <a href="#" @click.prevent="deletecategory(category.id)" class="btn btn-danger" style="border-radius: 90%">Delete</a>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>S.No</th>
                                <th>Category name</th>
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
        data()
        {
          return{
              categoryItem:[],
              select:'',
              all_select:false
          }
        },
        mounted(){
            this.$store.dispatch("categoryes")
        },
        computed:{
            getallCategory()
            {
               return this.$store.getters.getcategory
            }
        },
        methods:{
            deletecategory(id)
            {
                axios.get('/deletecategory/'+id)
                    .then(()=>{
                        this.$store.dispatch("categoryes")
                        Toast.fire({
                            type: 'success',
                            title: 'Data deleted successfully'
                        })
                    })
                    .catch(()=>{

                    })
            },
            deleteSelect()
            {
                console.log(this.categoryItem)
                axios.get('/deletecategory/'+this.categoryItem)
                    .then(()=>{
                        this.categoryItem = []
                        this.$store.dispatch("categoryes")
                        Toast.fire({
                            type: 'success',
                            title: 'Category Deleted successfully'
                        })
                    })
            },
            selectAll(){
                if(this.all_select==false){
                    this.all_select = true
                    for(var category in this.getallCategory){
                        this.categoryItem.push(this.getallCategory[category].id)
                    }
                }else{
                    this.all_select = false
                    this.categoryItem = []
                }
            }
        }
    }
</script>

<style scoped>

</style>
