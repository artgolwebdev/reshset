<template>
    <div>
    </div>
</template>
<script>
export default {
    props : ['id'],
    mounted(){
        this.get_auth_user_data();
        this.listen();
    },
    methods : {
        get_auth_user_data(){
            this.$http.get('/get_auth_user_data')
            .then((response)=>{
                this.$store.commit('auth_user_data',response.body);
            })
        },
        listen(){
            Echo.private('App.User.'+this.id)
                .notification((notification)=>{
                        new Noty({
                            type : 'info' , 
                            text : notification.name + " " +notification.message , 
                        }).show();
                    this.$store.commit('add_not',notification);
                    document.getElementById("noty_audio").play();
                })
                .listen('NewMessage',(message)=>{
                    this.$store.commit('add_msg',message.message.id);
                    document.getElementById("new_message_audio").play();
                })
                .listen('NewPost',(post)=>{
                    this.$store.commit('add_post',post.post);
                })
                .listen('NewLike',(like)=>{
                    this.$store.commit('update_post_likes',{
                        id : like.post_id , 
                        like : like.like 
                    })
                })
                .listen('NewComment',(comment)=>{
                    this.$store.commit('update_post_comments',{
                        id : comment.post_id , 
                        comment : comment.comment 
                    });
                })
        },
    }
}
</script>