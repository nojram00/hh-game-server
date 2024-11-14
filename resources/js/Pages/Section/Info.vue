<template>
    <Head :title="'Section - ' + section_name" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-400 leading-tight">Section - {{  section_name }}</h2>
            <p>Teacher: {{ teacher }}</p>
        </template>

        <div class="px-4 w-full relative h-[720px]">
            <Link class="btn absolute top-0 right-0 mr-10 mt-5" :href="route('edit-section.get', section_id)">Update Info</Link>
            <table v-if="students.data.length > 0" class="table table-auto p-3 mt-3">
                <thead>
                    <tr class="bg-accent text-white text-lg">
                        <th class="">Firstname</th>
                        <th>Middlename</th>
                        <th>Lastname</th>
                        <th>Pre Test</th>
                        <th>Post Test</th>
                        <th>Tera Mastery</th>
                        <th>Ecology Mastery</th>
                        <th>Momentum Mastery</th>
                        <th>Quantum Mastery</th>
                        <th>...</th>
                    </tr>
                </thead>
                <tbody class="bg-base-200">
                    <tr v-for="student in students.data" class="text-lg p-8">
                        <td>{{ student.firstname }}</td>
                        <td>{{ student.middlename }}</td>
                        <td>{{ student.lastname }}</td>
                        <td>{{ student.pre_test_score }}</td>
                        <td>{{ student.post_test_score }}</td>
                        <td>{{ student.tera_mastery }}</td>
                        <td>{{ student.ecology_mastery }}</td>
                        <td>{{ student.momentum_mastery }}</td>
                        <td>{{ student.quantum_mastery }}</td>
                        <td><Link :href="route('student', student.id)">More</Link></td>
                    </tr>
                </tbody>
            </table>

            <Container v-else>
                <div class="p-6 text-gray-900">No students found...</div>
            </Container>

            <Pagination
                class-name="absolute bottom-0 right-0 mr-4"
                :last-page-url="students.last_page_url"
                :prev-page-url="students.prev_page_url"
                :next-page-url="students.next_page_url"
                :first-page-url="students.first_page_url"
                :current-page="students.current_page"
            />
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import Container from '@/Components/Container.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    students: {
        type : Object,
        required: true
    },
    section_name : {
        type: String
    },
    teacher : {
        type: String
    },
    section_id : {
        type : Number
    }
})
</script>
<style lang="">

</style>
