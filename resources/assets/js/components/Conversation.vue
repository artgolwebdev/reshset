<template>
   <div>
        <div class="conversation">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-default btn-sm pull-left" href="#" @click="goBack">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                    </a>
                    <h4 class="pull-right">{{ contact ? contact.name : 'Select a contact' }}</h4>
                    <div class="clearfix"></div>
                </div>
                <message-feed :contact="contact" :messages="messages" ></message-feed>
                <div class="panel-footer">
                   <message-composer @send="sendMessage"></message-composer>
                </div>
            </div>
        </div>
   </div>
</template>
<script>
import MessageComposer from './MessageComposer.vue';
import MessageFeed from './MessageFeed.vue';
export default {
    props : {
        contact : Object , 
        messages : {
            type: Array , 
            default : []
        } ,
    },
    mounted(){
        console.log("conversation mounted");
        console.log(this.contact);
    },
    methods : {
        sendMessage(text){
            console.log(text);
            if(!this.contact){
                return;
            }
            this.$http.post('/conversation/send',{
                contact_id : this.contact.id , 
                text : text 
            }).then((response)=>{
                console.log(response);
                this.$emit('new',response.body);
            })
        },
        goBack(){
            this.$emit('back');
        }
    },
    components : {
        MessageComposer,
        MessageFeed
    }
}
</script>
<style scoped>
/*.conversation{
    flex:2;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width:500px;  
}*/

.conversation{
}
</style>