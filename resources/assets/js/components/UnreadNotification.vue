<template>
    <div>
 
    </div>
</template>

<script>
    export default {
        mounted() {
            this.listen()
        },
        props : ['id'],
        methods : {
            listen(){
                console.log("newwwwwwwwwwwww messages");
                  Echo.private('App.User.'+this.id)
                    .listen('NewMessage',(e)=>{
                        console.log(e);
                        console.log("new message here");
                        this.$store.commit('add_msg',e.message.id);
                        document.getElementById("new_message_audio").play();
                    })
            }
        }
    }
</script>
