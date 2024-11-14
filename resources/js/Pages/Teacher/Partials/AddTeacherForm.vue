<template>
    <section>
        <header>
            <h2 class="text-lg font-medium">Add Teacher Information</h2>
        </header>

        <form @submit.prevent="submit" class="mt-6 space-y-6">
            <div>
                <InputLabel for="firstname" value="Firstname"/>
                <TextInput
                    id="firstname"
                    v-model="form.firstname"
                    type="text"
                    class="mt-1 block w-full"
                />
            </div>

            <div>
                <InputLabel for="middlename" value="Middlename"/>
                <TextInput
                    id="middlename"
                    v-model="form.middlename"
                    type="text"
                    class="mt-1 block w-full"
                />
            </div>

            <div>
                <InputLabel for="lastname" value="Lastname"/>
                <TextInput
                    id="lastname"
                    v-model="form.lastname"
                    type="text"
                    class="mt-1 block w-full"
                />
            </div>

            <div class="relative">

                <InputLabel for="teachers" value="Section"/>

                <div v-if="loading == true" class="w-full flex items-center justify-center">
                    <span class="loading loading-dots loading-md"></span>
                </div>

                <div v-else class="grid w-full grid-cols-3 gap-4 border-2 border-gray-600 p-5 mt-2 rounded-lg">
                    <label v-for="section in sections.data" :class="`card
                            relative border-2 cursor-pointer
                            shadow-md
                            hover:transform hover:-translate-y-[10%] transition-transform
                            ${form.section_id == section.id && 'bg-slate-200'}`"
                            name="teacher">
                        <div class="absolute right-0 flex items-center justify-center h-full mr-5">
                            <input id="teachers" type="radio" class="hidden"  v-model="form.section_id" :value="section.id" name="section">
                        </div>
                        <div class="card-body">
                            <h1 class="text-black">{{ section.section_name }}</h1>
                        </div>
                    </label>
                </div>

                <div class="p-5">
                    <div class="join">
                        <button :disabled="sections.prev_page_url === null" type="button" @click="navigate(sections.prev_page_url)" class="join-item btn hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 fill-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                        <button type="button" class="w-10 btn join-item text-white">{{ sections.current_page }}</button>
                        <button :disabled="sections.next_page_url === null" type="button" @click="navigate(sections.next_page_url)" class="join-item btn hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 fill-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Teacher Info Added...</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, router, useForm, usePage } from '@inertiajs/vue3';
import { toRef, toRefs, ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    user : {
        type: Object,
        required : true
    },
    sections : {
        type: Object,
        required : true
    },
    in_production : {
        type : Boolean
    }
})

const { pageProps } = usePage();

const form = useForm({
    firstname : "",
    lastname : "",
    middlename : "",
    section_id : null
})

const sections = ref(props.sections);
const loading = ref(false);


const submit = () => {
    router.post(route('create-teacher.post', props.user.id), form)
}

const navigate = async (url) => {

    loading.value = true;
    console.log("Page Props",pageProps)

    if(props.in_production)
    {
        url = url.replace("http://", "https://");
    }

    const response = await axios.get(url, {
        headers : {
            "Accept" : "application/json"
        }
    });

    if(response.status === 200)
    {
        sections.value = response.data;
    }
    else
    {
        sections.value = props.sections;
    }


    loading.value = false;



}

</script>
<style lang="">

</style>
