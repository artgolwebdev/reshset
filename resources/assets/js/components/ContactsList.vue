<template>
   <div>
    <h2>Test</h2>
     <div class="contacts-list">
        <ul>
            <li v-for="contact in contacts" :key="contact.id">
            {{
                contact
            }}
                <div class="avatar">
                    <img :src="contact.avatar" :alt="contact.name">
                </div>
                <div class="contact">
                    <p class="name">{{ contact.name }}</p>
                    <p class="email">{{ contact.email }}</p>
                </div>
            </li>
        </ul>
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
    mounted() {
        
    },
}
</script>