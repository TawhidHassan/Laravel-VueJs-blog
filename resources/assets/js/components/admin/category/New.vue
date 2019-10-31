<template>
    <!-- Main content -->
    <section class="content ">
        <div class="container-fluid">
            <div class="row align-content-around">
                <!-- left column -->
                <div class="col-md-10 offset-1">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add New Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form"  @submit.prevent="addCategory" @keydown="form.onKeydown($event)">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="cat_name">Category name</label>
                                    <input type="text" id="cat_name" v-model="form.cat_name" name="cat_name" placeholder="Enter category name" class="form-control" :class="{ 'is-invalid': form.errors.has('cat_name') }">
                                    <has-error :form="form" field="cat_name"></has-error>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</template>

<script>
    export default {
        name: "New",
        data()
        {
            return{
                // Create a new form instance
                form: new Form({
                    cat_name: '',
                })
            }
        },
        methods:
        {
            addCategory()
            {
                // Submit the form via a POST request
                this.form.post('/addcategory')
                    .then(({ data }) => {
                        this.$router.push('/categorylist')
                        Toast.fire({
                            type: 'success',
                            title: 'Data added successfully'
                        })
                    })
                    .catch(()=>{

                    })
            }

        }



    }
</script>

<style scoped>

</style>
