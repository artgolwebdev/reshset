<template>
    <div>
       


        <div class="input-group">
            <input type="text" class="form-control input-sm" placeholder="ex:John Douw" v-on:keyup="setTarget" v-model="target">
            <span id="basic-addon1" class="input-group-addon">
                <button :disabled="isDisabled" @click="check" class="btn btn-xs btn-info">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
            </span>
        </div> 
        <div class="panel panel-default panel-results" v-if="user_results.length || posts_results.length  ">
            <div class="panel-footer">
                <div class="close" >
                        <i class="glyphicon glyphicon-remove icon-to-close" @click="clearResults()"></i>
                </div>
            </div>
            <div class="panel-body panel-body-wrapper">
              <ul v-if="user_results.length" class="list-group"><b>Users:</b>
                    <li class="list-group-item" v-for="result in user_results">
                        <img :src="result.avatar" width="40px"> 
                        {{ result.name }}  
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
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return { 
            isDisabled : true , 
            target : '' ,
            user_results  : [] , 
            posts_results : [] , 
            loading : false 
        }
    },
    mounted(){
        
    },
    methods : {
        clearResults(){
            this.user_results = [];
            this.posts_results = [];
            this.target = '';
        },
        showpost(id){
            document.location.href= window.OriginalLink  + "/post/"+id;
        },
        showuser(slug){
            document.location.href= window.OriginalLink  + "/profile/"+slug;
        },
        check(){
            this.loading = true;
            this.$http.post('/searchdata',{target:this.target})
            .then((response)=>{
                console.log(response);
                this.loading = false;
                this.user_results = response.body.user_results;
                this.posts_results = response.body.posts_results;
            })
        },
        setTarget(){
            console.log(this.target);
            console.log(this.target.length);
             if(this.target.length > 0){
                this.isDisabled = false;
                this.check();
            }else{
                this.isDisabled = true;
                this.posts_results = [];
                this.user_results = [];
            }
        }
    },

}
</script>
<style scoped>
    .panel-results:after{
        content: '';
        width: 0px;
        height: 0px;
        border-right: 14px solid transparent;
        border-left: 14px solid transparent;
        border-top: 14px solid transparent;
        border-bottom: 14px solid #f5f5f5;
        position: absolute;
        top: -28px;
        left: 1%;
    }
</style>