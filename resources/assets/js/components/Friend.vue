<template>
    <div>
        <p class="text-center" v-if="loading">
            <button class="btn btn-sm btn-warning" disabled>Loading</button> 
        </p>
        <p class="text-center" v-if="!loading">
            <button class="btn btn-sm btn-info" v-if="status === 0" @click="add_friend">Add friend</button>  
            <button class="btn btn-sm btn-info" v-if="status === 'pending'" @click="accept_friend">Accept friend</button>  
            <button class="btn btn-sm btn-info" v-if="status === 'waiting'" disabled>Waiting for response</button>
            <button class="btn btn-sm btn-success" v-if="status === 'friends'" disabled>Friends</button>
        </p> 
    </div>
</template>
      
<script>
    export default {
        mounted() {
           this.$http.get('/check_relationship_status/'+ this.profile_user_id)
           .then((response)=>{
               console.log(response);
               this.status = response.body.status;
               this.loading = false;
           })
        },
        props : ['profile_user_id'],
        data (){
            return {
                status : "",
                loading : true 
            }
        },
        methods : {
            add_friend(){
                this.loading = true;
                this.$http.get('/add_friend/'+this.profile_user_id)
                .then((response)=>{
                    console.log(response);
                    if(response.body == 1){
                        this.loading = false;
                        this.status = "waiting";
                          new Noty({
                            type : 'success' , 
                            text : 'Friend request sent' , 
                        }).show();
                    }
                })
            },
            accept_friend(){
                this.loading = true;
                this.$http.get('/accept_friend/'+this.profile_user_id)
                .then((response)=>{
                    console.log(response);
                    if(response.body == 1){
                        this.loading = false;
                        this.status = 'friends';
                        new Noty({
                            type : 'success' , 
                            text : 'You are now friends' , 
                        }).show();
                    }
                });
            }
        }

    }
</script>
