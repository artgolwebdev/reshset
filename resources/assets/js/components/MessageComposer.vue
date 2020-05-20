<template>
    <div>
        <div class="composer">
            <textarea v-model="message" @keydown.enter="send" placeholder="Message"></textarea>
        </div>
    </div>
</template>
<script>
export default {
    data() { 
        return {
            message : '' 
        }  
    },
    mounted(){
        console.log('Message composer counted');
    },
    methods : {
        send(e){
            e.preventDefault();
            if(this.message == ''){
                return;
            }
            this.$emit('send',this.message);
            this.message='';
        }
    }
}
</script>

<style scoped>
    .composer textarea{
        width:90%;
        resize:none;
        border-radius: 3px;
        border:1px solid grey;
        padding: 6px;
        margin:18px;
    }
</style>