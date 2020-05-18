<template>
    <div>
        <div class="chat-app">
            <conversation :contact="selectedContact" :messages="messages"></conversation>
            <contacts-list :contacts="contacts"></contacts-list>
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
        console.log("yo");
        console.log(this.user);
        this.$http.get("/chat/contacts")
        .then((response)=>{
            console.log(response);
            this.contacts = response.body;
        })
    
    },
    components : {
        Conversation , 
        ContactsList
    }
}
</script>