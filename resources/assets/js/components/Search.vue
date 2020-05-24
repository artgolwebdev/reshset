<template>
    <div>
        <input type="text" class="form-control" placeholder="Search" v-on:keydown="setTarget" v-model="target">
        <i class="glyphicon glyphicon-remove icon-to-close" v-if="user_results.length || posts_results.length" @click="clearResults()">
            Close results
        </i>
        <br>
        <div class="panel panel-default panel-results" v-if="user_results.length || posts_results.length  ">
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
             if(this.target.length >0){
                this.check();
            }else{
                this.posts_results = [];
                this.user_results = [];
            }
        }
    },

}
</script>

<style>
    .icon-to-close{
        margin-top:4px;
        color: darkred;
        font-size:10px;
        float:right;
        cursor:pointer;
    }
    
    .panel-results{
        width:100%;
    }

    .panel-results .panel-body-wrapper{
        overflow: auto;
        height: inherit;
    }

    @media(max-width:400px){
        .icon-to-close{
            z-index: 26;
            top: 4px;
        }

        .panel-results{
                width: 100%;
            min-width: unset;
             z-index: 22;
             top: 36px;
             height: auto;
             left: 0px; 
        }
    }
</style>