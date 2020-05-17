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
                Echo.private('App.User.'+this.id)
                .notification((notification)=>{
                    console.log("----------");
                    console.log(notification);
                    console.log("----------");
                        new Noty({
                            type : 'info' , 
                            text : notification.name + " " +notification.message , 
                        }).show();
                    this.$store.commit('add_not',notification);
                    document.getElementById("noty_audio").play();
                })
            }
        }
    }
</script>
