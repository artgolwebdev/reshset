<template>
    <div></div>
</template>
<script>
export default {

    mounted() {
        this.listen()
    },
    props : ['id'],
    methods : {
        listen(){  
            console.log("neeeeeeeeeeeeeeeeewwwwwwwwwwwwwwwwwwwwwwwwww"); 
            Echo.private('App.User.'+this.id)
            .listen('NewPost',(e)=>{
                console.log(e);
                console.log("new post here");
                this.$store.commit('add_post',e.post);
            });
            console.log("poooooooooooooooooooooooooost");
        }
    }
}
</script>