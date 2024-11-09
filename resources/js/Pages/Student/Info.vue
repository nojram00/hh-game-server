<template>
    <Head :title="'Student - ' + student.name" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-400 leading-tight">Student info: {{  student.name }}</h2>
        </template>

        <div class="px-4 w-full relative h-[720px]">

        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    student : {
        type : Object
    }
})
</script>
<style lang="">

</style>
