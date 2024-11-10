<template>
    <Head :title="'Error: ' + code"/>
    <div class="bg-neutral flex justify-center items-center min-h-screen">
        <div class="w-full p-12">
            <div class="flex flex-col gap-3 py-4 items-center space-y-5">
                <h1 class="text-4xl dark:text-white">{{ code }} | {{ error }}</h1>

                <p class="text-lg dark:text-white" v-html="message"></p>

                <div class="">
                    <button @click="back" class="btn">Back</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import Container from '@/Components/Container.vue';
import { Head } from '@inertiajs/vue3';
defineProps({
    code : {
        type : Number
    },
    message : {
        type : String
    },
    error : {
        type : String
    }
})

const back = () => {
    window.history.back();
}
</script>
