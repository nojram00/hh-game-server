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

                <div class="grid w-full grid-cols-3 gap-4 border-2 border-gray-600 p-5 mt-2 rounded-lg">
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
                        <Link :href="teachers.first_page_url" preserve-state class="join-item btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                            </svg>
                        </Link>
                        <Link :href="teachers.prev_page_url" preserve-state class="join-item btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </Link>
                        <p class="join-item btn bg-accent text-white">{{ teachers.current_page }}</p>
                        <Link :href="teachers.next_page_url" preserve-state class="join-item btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </Link>
                        <Link :href="teachers.last_page_url" preserve-state class="join-item btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                            </svg>
                        </Link>
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

const props = defineProps({
    teachers : {
        type : Array
    }
})

const teachers = ref(props.teachers)

const toggle_page = () => {

}

const form = useForm({
    section_name : "",
    teacher_id : 0
})
</script>
