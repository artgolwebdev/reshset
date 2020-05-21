<template>
    <div>
        <div class="chat-app">
            <div class="col-md-8">
                <conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"></conversation>
            </div>
            <div class="col-md-4">
                <contacts-list :contacts="contacts" @selected="startConversationWith"></contacts-list>
            </div>
        </div>
    </div>
</template>
<script>
import Conversation from './Conversation.vue';
import ContactsList from './ContactsList.vue';

export default {
    props: {
        user : { 
            type : Object , 
            required : true 
        }
    },
    data(){
        return {
            selectedContact:null ,
            messages : [] , 
            contacts : [] , 
        }
    },
    mounted(){

        Echo.private('App.User.'+this.user.id)
        .listen('NewMessage',(e)=>{
            console.log(e);
            console.log("444444444444444");
            this.handleIncoming(e);
        })

        console.log("yo");
        console.log(this.user);
        this.$http.get("/chat/contacts")
        .then((response)=>{
            console.log(response);
            this.contacts = response.body;
        });
    
    },
    methods : {
        handleIncoming(e){
            if(this.selectedContact && e.message.from == this.selectedContact.id){
                this.saveNewMessage(e.message);
                return;
            }
            console.log("handle");
            console.log(e);
            console.log("handle");
            this.$store.commit('add_msg',e.message);
            this.updateUnreadCount(e.contact[0],false);
            document.getElementById("new_message_audio").play();
        },
        saveNewMessage(message){
            this.messages.push(message);
        },
        startConversationWith(contact){
            console.log("================");
            console.log(contact);
            console.log("================");
            this.updateUnreadCount(contact,true);

            this.$http.get(`/conversation/${contact.id}`)
            .then((response)=>{
                console.log("re",response);
                console.log("contact",contact);
                if(response.body.length){
                    console.log("ttttttttT",response);
                    response.body.forEach((msg)=>{
                        this.$store.commit('delete_msg',msg.id);
                    })
                    this.messages = response.body;
                }
                this.selectedContact = contact;
            })
        },
        updateUnreadCount(contact,reset){
            console.log("update count");
            console.log(contact);
            console.log(reset);
            console.log("update count");
            
            this.contacts =  this.contacts.map((single)=>{
                if(single.id != contact.id){
                    return single;
                }
                if(reset){
                    single.unread = 0;
                }else{
                    single.unread += 1;
                }
                return single;
            })
        }
    },
    components : {
        Conversation , 
        ContactsList
    }
}
</script> 

<style>
    /*.chat-app{
        display:flex;
        justify-content: space-between;
    }*/

    .chat-app{
    }

</style>  