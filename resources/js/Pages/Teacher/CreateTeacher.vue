<template>
    <Head title="Add User"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-400 leading-tight">Teacher - More Information</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <AddTeacherForm :user="user"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AddTeacherForm from './Partials/AddTeacherForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    user : {
        type : Object,
        required : true
    }
})
</script>

