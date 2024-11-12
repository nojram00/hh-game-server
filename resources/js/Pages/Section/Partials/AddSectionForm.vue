<template>
    <section>
        <header>
            <h2 class="text-lg font-medium">Add Section Information</h2>
        </header>

        <form @submit.prevent="form.post(route('create-section.post'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Section Name"/>
                <TextInput
                    id="name"
                    v-model="form.section_name"
                    type="text"
                    class="mt-1 block w-full"
                />
            </div>

            <div class="relative">

                <InputLabel for="teachers" value="Teacher"/>

                <div v-if="loading == true" class="w-full flex items-center justify-center">
                    <span class="loading loading-dots loading-md"></span>
                </div>

                <div v-else class="grid w-full grid-cols-3 gap-4 border-2 border-gray-600 p-5 mt-2 rounded-lg">
                    <label v-for="teacher in teachers.data" :class="`card
                            relative border-2 cursor-pointer
                            shadow-md
                            hover:transform hover:-translate-y-[10%] transition-transform
                            ${form.teacher_id == teacher.id && 'bg-slate-200'}`"
                            name="teacher">
                        <div class="absolute right-0 flex items-center justify-center h-full mr-5">
                            <input id="teachers" type="radio" class="hidden"  v-model="form.teacher_id" :value="teacher.id" name="teacher">
                        </div>
                        <div class="card-body">
                            <h1 class="text-black">{{ teacher.name }}</h1>
                        </div>
                    </label>
                </div>

                <div class="p-5">
                    <div class="join">
                        <button type="button" @click="toggle_page(teachers.prev_page_url)" class="join-item btn hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 fill-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                        <button type="button" class="w-10 btn join-item text-white">{{ teachers.current_page }}</button>
                        <button type="button" @click="toggle_page(teachers.next_page_url)" class="join-item btn hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 fill-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>
                </div>

            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Add Section</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Section Added...</p>
                </Transition>
            </div>


        </form>
    </section>
</template>
<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Pagination from '@/Components/Pagination.vue';
import { useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    teachers : {
        type : Array
    },
    inProduction : {
        type : Boolean
    }
})

const teachers = ref(props.teachers)
const loading = ref(false)

const toggle_page = async (link) => {

    loading.value = true

    if(props.inProduction)
    {
        link = link.replace('http://', 'https://');
    }

    const res = await axios.get(link, {
        headers : {
            "Content-Type" : "application/json"
        }
    })

    teachers.value = res.data;

    loading.value = false
}

const form = useForm({
    section_name : "",
    teacher_id : 0
})
</script>
