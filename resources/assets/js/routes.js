
import AdminHome from './components/admin/AdminHome'
import CategoryListComponent from './components/admin/category/List'
import AddCategoryComponent from './components/admin/category/New'
import EditCategoryComponent from './components/admin/category/Edit'
//post
import PostListComponent from './components/admin/post/List'
import AddPostComponent from './components/admin/post/New'
import EditPostComponent from './components/admin/post/Edit'

//public blog
import PublicHome from './components/public/PublicHome'
import PublicBlog from './components/public/blog/BlogPost'
import SinglePost from './components/public/blog/SingleBlog.vue'

export const routes = [
    { path: '/home', component: AdminHome },
    { path: '/categorylist', component: CategoryListComponent },
    { path: '/addcategory', component: AddCategoryComponent },
    { path: '/edoitcategory/:categoryId', component: EditCategoryComponent },
    //post
    { path: '/postlist', component: PostListComponent },
    { path: '/addpost', component: AddPostComponent },
    { path: '/edoipost/:postId', component: EditPostComponent },


    //public blog
    { path: '/', component: PublicHome },
    { path: '/blog', component: PublicBlog },
    {path:'/blog/:id', component:SinglePost},
    {path:'/categories/:id', component:PublicBlog},
]
