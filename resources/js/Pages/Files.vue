<template>
    <AppLayout title="Files">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Files
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <h1 style="margin: 20px; text-align: center; font-size: 40px;"><b>Upload the files!</b></h1>
                    <button class="btn" style="width: 70%; margin-left: 15%; background-color: black; color: white; margin-bottom: 1%" @click="importUsers()">Import Users</button>
                    <button class="btn" style="width: 70%; margin-left: 15%; background-color: black; color: white;  margin-bottom: 1%" @click="importPublications()">Import Posts</button>

                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';

export default {
    name: "Files",
    props: [''],
    components: {
        AppLayout,
        Welcome
    },
    data()
    {
        return{
            messageText: '',
            sendMessage: 0,
            form:{
                title:'',
                body: ''
            }
        }
    },
    methods:
        {
            importUsers(){
                    axios.post('/importUsers');
            },
            importPublications(){
                axios.post('/importPublications');
            },
        },
    mounted() {
    }
}
</script>
