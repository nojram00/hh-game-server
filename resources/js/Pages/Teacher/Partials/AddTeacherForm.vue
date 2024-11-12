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
import { Link, router, useForm } from '@inertiajs/vue3';
import { toRef, toRefs } from 'vue';

const props = defineProps({
    user : {
        type: Object,
        required : true
    }
})

const form = useForm({
    firstname : "",
    lastname : "",
    middlename : ""
})


const submit = () => {
    router.post(route('create-teacher.post', props.user.id), form)
}
</script>
<style lang="">

</style>
