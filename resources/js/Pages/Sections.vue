<template>
    <Head title="Sections" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-400 leading-tight">Sections</h2>
        </template>

        <div class="px-4 w-full h-[720px] relative">

            <div class="top-0 left-0 ml-3 pt-3">
                <Link :href="route('create-section.get')" method="GET" class="btn">Add Section</Link>
            </div>

            <table v-if="sections.data.length > 0" class="table table-auto overflow-y-auto p-3 mt-3">
                <thead>
                    <tr class="bg-accent text-white text-lg">
                        <th>Section Name</th>
                        <th>Student Count</th>
                        <th>...</th>
                    </tr>
                </thead>
                <tbody class="bg-base-200">
                    <tr v-for="section in sections.data" class="text-lg">
                        <td>{{ section.section_name }}</td>
                        <td>{{ section.students_count }}</td>
                        <td><Link :href="route('section', section.id)">More</Link></td>
                    </tr>
                </tbody>
            </table>

            <Container v-else>
                <div class="p-6 text-gray-900">No Sections found...</div>
            </Container>

            <Pagination
                class-name="absolute bottom-0 right-0 mr-4"
                :last-page-url="sections.last_page_url"
                :prev-page-url="sections.prev_page_url"
                :next-page-url="sections.next_page_url"
                :first-page-url="sections.first_page_url"
                :current-page="sections.current_page"
            />
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import Container from '@/Components/Container.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';

defineProps({
    sections: {
        type : Object,
        required: true
    }
})
</script>
<style lang="">

</style>
