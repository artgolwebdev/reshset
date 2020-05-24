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
              <div class="close" >
            <i class="glyphicon glyphicon-remove icon-to-close" @click="clearResults()"></i>
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

<style>
    .icon-to-close{
        margin-top:4px;
        color: darkred;
        font-size:10px;
        cursor:pointer;
        position: relative;
        right: 10px;
    }
    
    .panel-results{
        width: 300px;
        position: absolute;
        z-index: 222;
    }

    .panel-results .panel-body-wrapper{
        overflow: auto;
        height: inherit;
    }
    
    .input-group-addon {
        padding:2px;
    }

    

    @media(max-width:400px){

        .panel-results{
            width:100%;
            position: relative;
            z-index: 0;
        }

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