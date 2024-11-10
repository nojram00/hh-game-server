<template>
    <section>
        <header>
            <h2 class="text-lg font-medium">Add User Information</h2>


        </header>

        <form @submit.prevent="submit" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Username"/>
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                />
            </div>

            <div>
                <InputLabel for="email" value="Email"/>
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="text"
                    class="mt-1 block w-full"
                />
            </div>

            <div>
                <InputLabel for="password" value="Password"/>
                <TextInput
                    id="name"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Proceed</PrimaryButton>
            </div>
        </form>
    </section>
</template>
<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, useForm, router } from '@inertiajs/vue3';

const form = useForm({
    name : "",
    email : "",
    password : ""
})

const submit = () => {
    router.post(route('create-user.post'), form)
}
</script>
<style lang="">

</style>
