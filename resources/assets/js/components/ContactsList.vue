<template>
   <div>
     <div class="contacts-list">
         <div class="panel panel-default">
             <div class="panel-heading">
                 <h4>Your contacts</h4>
             </div>
             <div class="panel-body">
                <ul v-if="contacts.length">
                    <li v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)" :class="{ 'selected' : contact   === selected }">
                        <div class="avatar">
                            <img :src="contact.avatar" :alt="contact.name">
                        </div>
                        <div class="contact">
                            <p class="name">{{ contact.name }}</p>
                            <p class="email">{{ contact.email }}</p>
                        </div>
                    <span class="unread" v-if="contact.unread">
                        {{ contact.unread }}
                        </span>
                    </li>
                </ul>
                <p v-if="!contacts.length">No contacts found...</p>
             </div>
         </div>
    </div>
   </div>
</template>
<script>  
export default {
    props : {
        contacts : {
            type : Array 
        }
    },
    data(){
        return {
            selected  : this.contacts.length ? this.contacts[0] : null
        }
    },
    methods : {
        selectContact(contact){
            this.selected = contact; 
            this.$emit("selected",contact);
        }
    },
    mounted() {
        
    },
    computed : {
        sortedContacts(){
            return _.sortBy(this.contacts,[(contact)=>{
                if(contact == this.selected){
                    return Infinity;
                }
                console.log("unread : " + contact.unread);
                return contact.unread;
            }]).reverse();
        }
    }
}
</script>

<style>
.unread{
    background:#82e0a8;
    color:#fff;
    position: relative;
    right: 10px;
    top:20px;
    display:flex;
    justify-content: center;
    align-items: center;
    font-size:12px;
    padding:4px;
    border-radius:3px;
    line-height:20px;
    min-width:20px;
    max-height:20px;
}

.contacts-list{
}

/*.contacts-list{
    flex:2;
    max-height: 600px;
    overflow-y: auto;
    border-left:1px solid #a6a6a6;
}
*/
.contacts-list ul {
    padding: 0px;
    margin:0px;
}

.contacts-list ul li {
    list-style: none;
    padding-left:0;
    display: flex;
    padding:2px;
    height:80px;
    position: relative;
    cursor:pointer;
      padding-left:20px;
    padding-right:20px;
}

.contacts-list ul li.selected { 
    background:#dfdfdf;
}

.contacts-list .avatar{
    flex:1;
    display: flex;
    align-items: center;
}

.avatar img {
    width: 45px;
    border-radius:50%;
    margin:0 auto; 
}

.contacts-list .contact{
    flex:3;
    font-size:12px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.contacts-list .contact p {
    margin:0px;
}

.contacts-list .contact p.name{
    font-weight: bold;
}
</style>