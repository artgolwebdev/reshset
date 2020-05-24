<template>
    <div>
        <div class="panel-body" v-if="messages.length">
            <div class="feed" ref="feed">
                <ul v-if="contact">
                    <li v-for="msg in messages" :class="`message ${msg.to == contact.id ? 'sent':'received'}`" :key="msg.id">
                        <div class="text">
                            {{ msg.text }}
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props : {
        contact : {
            type : Object , 
        },
        messages : {
            type : Array , 
            required : true 
        }
    },
    mounted(){
        console.log("mounted message feed");
        console.log(this.contact);
        console.log("mounted message feed");
    },
    methods : {
        scrollToBottom(){
            setTimeout(()=>{
                this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            },50);
        }
    },
    watch : {
        contact(contact){
            this.scrollToBottom();
        },
        messages(message){
            this.scrollToBottom();
        }
    }
}
</script>

<style scoped>

.panel-body{
    padding:0px;
}

.feed{
    background: #f0f0f0;
    height:40vh;
    overflow:auto;
}

.feed ul {
    padding:0px;
}

.feed ul li {
    list-style: none;
    padding:5px;
}

.feed.message{
    margin:10px 0;
    width:100%;
}

.feed ul li.received{
    text-align: right;    
}

.feed ul li.received .text{
        background:#b2b2b2;
}

.feed ul li .text {
    max-width:200px;
    border-radius:5px;
    padding:12px;
    display: inline-block;
}

.feed ul li.sent{
    text-align: left;    
}

.feed ul li.sent .text{
        background:#81c4f9;
}
</style>