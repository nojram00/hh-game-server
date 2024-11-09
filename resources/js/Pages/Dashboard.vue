<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Container from '@/Components/Container.vue';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-400 leading-tight">Dashboard</h2>
        </template>

        <Container>
            <div class="p-6 text-gray-900">You're logged in!</div>
        </Container>
    </AuthenticatedLayout>
</template>
