<template>
    <div>
        <input type="text" class="form-control" placeholder="Type to search" v-model="target">
        <br>
        <p class="text-center" v-if="loading">Loading...</p>
        <ul v-if="user_results.length" class="list-group"><b>Users:</b>
            <li class="list-group-item" v-for="result in user_results">
                <img :src="result.avatar" width="40px"> 
                {{ result.name }}  
                registered : <timeago :datetime="result.created_at" :auto-update="60"></timeago>
                <button class="pull-right btn btn-sm btn-info" @click="showuser(result.slug)">show user</button>
            </li>
        </ul>
        <ul v-if="posts_results.length" class="list-group"><b>Posts:</b>
            <div v-for="result in posts_results">
                   <div class="panel panel-default">
                        <div class="panel-heading">
                            <img :src="avatar" class="avatart-feed">
                            {{ result.user.name }}

                            <span class="pull-right">
                                <timeago :datetime="result.created_at" :auto-update="60"></timeago>
                            </span>
                        </div>  
                        <div class="panel-body">
                            <p>{{ result.content }}</p>
                        </div>
                            <div class="panel-footer">
                                  <button class="btn btn-sm btn-info" @click="showpost(result.id)">show post</button>
                            </div>
                    </div>
            </div>
        </ul>
    </div>
</template>
<script>
export default {
    data() {
        return { 
            target : '' ,
            user_results  : [] , 
            posts_results : [] , 
            loading : false 
        }
    },
    mounted(){
        
    },
    methods : {
        showpost(id){
            document.location.href="post/"+id;
        },
        showuser(slug){
            document.location.href="profile/"+slug;
        },
        check(){
            this.loading = true;
            this.$http.post('searchdata',{target:this.target})
            .then((response)=>{
                console.log(response);
                this.loading = false;
                this.user_results = response.body.user_results;
                this.posts_results = response.body.posts_results;
            })
        }
    },
    watch : {
        target(){
            if(this.target.length >0){
                this.check();
            }else{
                this.posts_results = [];
                this.user_results = [];
            }
        }
    }
}
</script>