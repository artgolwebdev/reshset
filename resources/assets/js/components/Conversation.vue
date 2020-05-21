<template>
   <div>
        <div class="conversation">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{ contact ? contact.name : 'Select a contact' }}</h4>
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