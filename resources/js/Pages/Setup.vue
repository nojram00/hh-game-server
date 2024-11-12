<template>
    <GuestLayout>
        <Head title="Setup your profile"/>
        <header class="py-5">
            <h1 class="text-lg">Setup your teacher profile to continue...</h1>
        </header>
        <form @submit.prevent="submit" class="space-y-5">
            <div>
                <InputLabel for="firstname" value="Firstname"/>

                <TextInput
                    id="firstname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.firstname"
                    required
                    autofocus
                    autocomplete="firstname"
                />
            </div>

            <div>
                <InputLabel for="middlename" value="Middlename"/>

                <TextInput
                    id="middlename"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.middlename"
                />
            </div>

            <div>
                <InputLabel for="lastname" value="Lastname"/>

                <TextInput
                    id="lastname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.lastname"
                    required
                    autofocus
                    autocomplete="lastname"
                />
            </div>

            <div>
                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Continue
                </PrimaryButton>
            </div>

        </form>

    </GuestLayout>
</template>
<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm, router } from '@inertiajs/vue3';


const form = useForm({
    firstname : "",
    lastname : "",
    middlename : ""
})

const submit = () => {
    console.log(form)
    router.post(route('setup.post'), form)
}

</script>
<style lang="">

</style>
