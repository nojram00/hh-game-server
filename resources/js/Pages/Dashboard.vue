<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Container from '@/Components/Container.vue';

defineProps({
    student_count : {
        type : Number
    },
    teacher_count : {
        type : Number
    },
    section_count : {
        type : Number
    }
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-400 leading-tight">Dashboard</h2>
        </template>

        <Container>
            <div class="p-6 text-gray-900 grid grid-cols-2 gap-3">
                <div class="card bg-primary min-w-lg">
                    <div class="card-body">
                        <h1 class="text-4xl font-bold">{{ student_count }}</h1>
                        <p>No. of registered students</p>

                        <div class="absolute bottom-0 right-0 p-4">
                            <Link v-if="$page.props.auth.user.role == 'admin'" :href="route('students')" class="btn">View</Link>
                        </div>
                    </div>
                </div>

                <div class="card bg-primary min-w-lg">
                    <div class="card-body relative">
                        <h1 class="text-4xl font-bold">{{ teacher_count }}</h1>
                        <p>No. of registered teachers</p>

                        <div class="absolute bottom-0 right-0 p-4">
                            <Link v-if="$page.props.auth.user.role == 'admin'" :href="route('teachers')" class="btn">View</Link>
                        </div>
                    </div>
                </div>

                <div class="card bg-primary min-w-lg">
                    <div class="card-body relative">
                        <h1 class="text-4xl font-bold">{{ section_count }}</h1>
                        <p>No. of available sections</p>

                        <div class="absolute bottom-0 right-0 p-4">
                            <Link v-if="$page.props.auth.user.role == 'admin'" :href="route('sections')" class="btn">View</Link>
                        </div>
                    </div>
                </div>
            </div>
        </Container>
    </AuthenticatedLayout>
</template>
