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
                            type : 'success' , 
                            layout : 'topRight', 
                            text : notification.name + " " +notification.message , 
                            theme : 'mint'  ,
                            progressBar : true , 
                            timeout : 3500
                        }).show();
                    this.$store.commit('add_not',notification);
                    document.getElementById("noty_audio").play();
                })
            }
        }
    }
</script>
