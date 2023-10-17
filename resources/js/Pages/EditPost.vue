
<template>
    <AppLayout title="EditPost">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Post
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <h1 style="margin: 20px; text-align: center; font-size: 40px;"><b>See all your posts!</b></h1>

                    <div style="margin: 3%; padding: 20px">
                        <input style="width: 90%; margin-right: 2%; margin-left: 2%; margin-bottom: 2%; border: 2px solid #C0C0C0;"  placeholder="Title"  data-rules="required" class="form-control" v-model="post.title" >
                        <textarea style="width: 90%; margin-right: 2%; margin-left: 2%; margin-bottom: 2%; border: 2px solid #C0C0C0;" id="ContactForm-body" class="text-area field__input" placeholder="Body"  v-model="post.body"></textarea>
                        <button v-if="sendMessage != 1"  class="btn" style="width: 50%; margin-left: 25%; background-color: black; color: white" @click="sendMessages()">Send Mensaje Correct!</button>
                        <p v-if="sendMessage != 0" style="color: black;text-align: center;margin-top: 10px;display: flex;justify-content: center;">
                            <svg v-if="sendMessage == 2" style="float: left; margin-right: 10px; margin-top: 1px" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                            </svg>
                            {{messageText}}
                        </p>
                    </div>

                </div>
            </div>
        </div>

    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';

export default {
    name: "EditPost",
    props: ['post'],
    components: {
        AppLayout,
        Welcome
    },
    data()
    {
        return{
            messageText: '',
            sendMessage: 0,
        }
    },
    methods:
        {
            sendMessages(){
                if(this.post.title != '' && this.post.body != '' ){
                    this.sendMessage = 1;
                    this.messageText = 'Message sent succesfully';
                    axios.post('/sendMessages', this.form);
                }
                else {
                    this.sendMessage = 2;
                    this.messageText = 'You must enter:';
                    if(this.post.title == '' ){this.messageText = this.messageText  + ' title,';}
                    if(this.post.body == '' ){this.messageText = this.messageText  + ' body,';}
                    this.messageText = this.messageText.slice(0, -1);
                }
            },
        },
    mounted() {
    },
    computed: {
    },
}
</script>
