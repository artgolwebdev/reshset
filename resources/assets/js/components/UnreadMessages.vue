<template>
    <li id="msgs-li">
        <a href="/chat" title="Messages">
            <i class="glyphicon glyphicon-envelope"></i>
            <span class="visible-xs-art"> Messages</span>
            <span class="badge" v-if="all_msg_count!=0">{{ all_msg_count }}</span>
        </a>
    </li>
</template>
<script>
export default {
    mounted(){
        console.log("unread messages mounted");
        this.get_unread_messages();
    },
    methods : {
        get_unread_messages(){
            this.$http.get('/get_unread_messages')
            .then((response)=>{
                console.log(response);
                response.body.forEach((msg)=>{
                    this.$store.commit('add_msg',msg) 
                });
            })
        }
    },
    computed : {
        all_msg_count(){
            return this.$store.getters.get_msgs;
        }
    }
}
</script>