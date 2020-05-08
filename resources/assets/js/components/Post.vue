<template>
    <div>
        <div class="panel panel-default" v-if="!hidden">
            <div class="panel-body">
                <textarea class="form-control" rows="5" v-model="content" :placeholder="placeholder"></textarea>
                <br>
                <button class="btn btn-success pull-right" :disabled="not_working" @click="create_post()">Create a post</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props : {
          user_id : {
            type : Number , 
            default : 0
        },
    },
    mounted(){
        if(this.user_id !=0){
            this.checkIfFriends();
        }
        console.log("From Post:")
        console.log(this.$store.state.auth_user.id);
    },
    data() {
        return { 
            content : '' , 
            not_working : true ,
            hidden : false ,
            placeholder : "Post Content"
        }
    },
    methods : {
        checkIfFriends(){
            this.$http.get('/check_relationship_status/'+this.user_id)
            .then((response)=>{
               if(response.body.status != "friends"){
                   this.hidden = true;
               }
            })
        },
        create_post(){
            this.$http.post('/create/post',{content:this.content})
            .then((response)=>{
                this.content = '';  
                console.log(response);
                new Noty({
                    type : 'success' , 
                    layout : 'topRight', 
                    text : 'Your post has been published',
                    theme : 'mint'  ,
                    progressBar : true , 
                    timeout : 3500
                }).show();
                this.$store.commit('add_post',response.body)
            })
        }
    },
    computed : {
  
    },
    watch : {
        content(){
            if(this.content.length > 0 ){
                this.not_working = false;
            }else{
                this.not_working = true;
            }
        }
    }

}
</script>