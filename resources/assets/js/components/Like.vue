<template>
    <span>
        <i class="glyphicon glyphicon-heart-empty art-btn-sm" v-if="!auth_user_likes_post" @click="like()"></i>
        <i class="glyphicon glyphicon-heart art-btn-sm" v-else @click="unlike()"></i>
        <div class="badge" v-show="post.likes.length > 0">
            {{ post.likes.length }}
        </div>
        <span v-for="like in post.likes">
          <img :src="like.user.avatar" width="20px" height="20px" class="avatar-like">
        </span>  
    </span>
</template>
<script>
export default {
    mounted(){
        console.log("From like:")
        console.log(this.$store.state.auth_user.id);
    },
    props : ['id'] ,
    methods : {
        like(){
            this.$http.get('/post/like/'+ this.id)
            .then((response)=>{
                this.$store.commit('update_post_likes',{
                    id : this.id , 
                    like : response.body 
                })
            })
        },
        unlike(){
            this.$http.get('/post/unlike/'+this.id)
            .then((response)=>{
                this.$store.commit('delete_post_likes',{
                    post_id : this.id , 
                    like_id : response.body
                });
            })
        }
    },
    computed :  {
        auth_user_likes_post(){
            let checkIndex = this.likers.indexOf(this.$store.state.auth_user.id);
            if(checkIndex === -1){
                return false;
            }else{
                return true;
            }
        },
        likers(){
            let likers = [];
            this.post.likes.forEach((like)=>{
                likers.push(like.user.id);
            });
            return likers;
        },
        post(){
            return this.$store.state.posts.find((post)=>{
                return post.id == this.id;
            });
        }
    }
}
</script>

<style>
    .avatar-like{
        border-radius:50%;
        border:1px solid #ccc;
        margin-right:-5px;
    }
</style>