<template>

    <div>
        <div v-if="!posts.length" class="text-center well"><b>Nothing found...</b></div>
        <signlepost
         v-else
         v-for="post in posts"
         :avatar="post.user.avatar"
         :user_name="post.user.name"
         :created_at="post.created_at"
         :content="post.content"
         :post_id="post.id"
         :comments="post.comments"
         >
        </signlepost>
     </div>
</template>
<script>
import SinglePost  from './SignlePost.vue'

export default {
    props : {
        user_id : {
            type : Number , 
            default : 0
        },
        post_id : {
            type: Number , 
            default : 0 
        }
    },
    mounted(){
        this.get_feed();
    },
    components:{ 
        SinglePost
    },
    methods : {
        get_feed(){
            if(this.post_id != 0 ){
               this.$http.get('/getsinglepost/'+this.post_id)
               .then((response)=>{
                   response.body.forEach((post)=>{
                       this.$store.commit('add_post',post);
                   })
               });
            }else{
            this.$http.get('/feed/'+this.user_id)
                .then((response)=>{
                    response.body.forEach((post)=>{
                        this.$store.commit('add_post',post);
                    })
                })
            }
            
        }
    },

    computed : {
        posts(){
          return this.$store.getters.all_posts.sort((a,b)=>{
               return new Date(b.created_at) - new Date(a.created_at);
           })
        }
    }
    
}
</script>
