<template>
    <Head title="Teachers" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-400 leading-tight">Teacher</h2>
        </template>

        <div class="px-4 w-full h-[720px] relative">
            <table v-if="teachers.data.length > 0" class="table table-auto overflow-y-auto p-3 mt-3">
                <thead>
                    <tr class="bg-accent text-white text-lg">
                        <th>Firstname</th>
                        <th>Middlename</th>
                        <th>Lastname</th>
                    </tr>
                </thead>
                <tbody class="bg-base-200">
                    <tr v-for="teacher in teachers.data" class="text-lg">
                        <td>{{ teacher.firstname }}</td>
                        <td>{{ teacher.middlename }}</td>
                        <td>{{ teacher.lastname }}</td>
                    </tr>
                </tbody>
            </table>

            <Container v-else>
                <div class="p-6 text-gray-900">No Sections found...</div>
            </Container>

            <Pagination
                class-name="absolute bottom-0 right-0 mr-4"
                :last-page-url="teachers.last_page_url"
                :prev-page-url="teachers.prev_page_url"
                :next-page-url="teachers.next_page_url"
                :first-page-url="teachers.first_page_url"
                :current-page="teachers.current_page"
            />
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import Container from '@/Components/Container.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';

defineProps({
    teachers : {
        type : Object,
        required: true
    }
})
</script>
<style lang="">

</style>
