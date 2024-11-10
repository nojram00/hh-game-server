<template>
    <div>
        <div class="min-h-screen flex flex-row">
            <aside class="bg-base-200 w-[420px]">
                <div class="flex-col items-center justify-center h-full pt-12">
                    <ul class="menu gap-3 sticky top-0 overflow-x-auto">
                        <li class="text-lg"><a href="#intro">Introduction</a></li>
                        <li class="text-lg"><a href="#students">Students</a>
                            <ul>
                                <li><a href="#s1">Get student list</a></li>
                                <li><a href="#s2">Get specific student</a></li>
                                <li><a href="#s3">Create a new student</a></li>
                                <li><a href="#s4">Assign student to a section</a></li>
                                <li><a href="#s5">Update authenticated student score</a></li>
                                <li><a href="#s6">Update authenticated student progress</a></li>
                                <li><a href="#s7">Assign authenticated student to a section</a></li>
                            </ul>
                        </li>
                        <li class="text-lg"><a href="#users">Users</a>
                            <ul>
                                <li><a href="#u1">Generate auth token</a></li>
                                <li><a href="#u2">Get authenticated student info</a></li>
                            </ul>
                        </li>
                        <li class="text-lg"><a href="#sections">Sections</a>
                            <ul>
                                <li><a href="#sc1">Get section list</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </aside>
            <main class="flex-1 p-10 flex flex-col gap-7">
                <section id="intro">
                    <h1 class="text-2xl font-bold">Introduction</h1>
                    <p class="mt-5">You can use these api endpoints to run and link to your application.</p>
                    <h3>Main url link: <code>'{{  api_url }}/api/v1'</code></h3>
                </section>

                <section id="students">
                    <h1 class="text-2xl font-bold">Students</h1>

                    <p class="mt-5">Here are the api endpoints that use to manipulate scores, progress and student information.</p>

                    <ul class="ml-4 my-5 space-y-5">
                        <li class="ml-4" id="s1">
                            <h1 class="font-bold text-xl">/students</h1>
                            <ul class="space-y-3 m-4">
                                <li>METHOD: GET</li>
                                <li>
                                    REQUEST BODY: None
                                </li>
                                <li>
                                    PARAMETERS : None
                                </li>
                            </ul>
                        </li>
                        <li class="ml-4" id="s2">
                            <h1 class="font-bold text-xl">/student/find/<code class="text-md">{student_id}</code></h1>
                            <ul class="space-y-3 m-4">
                                <li>METHOD: GET</li>
                                <li>
                                    REQUEST BODY: None
                                </li>
                                <li>
                                    PARAMETERS : <code>student_id : int</code>
                                </li>
                            </ul>
                        </li>
                        <li class="ml-4" id="s3">
                            <h1 class="font-bold text-xl">/student/create</h1>
                            <ul class="space-y-3 m-4">
                                <li>METHOD: POST</li>
                                <li>
                                    REQUEST BODY:
                                    <ul class="m-4">
                                        <li><code>email : string</code></li>
                                        <li><code>name : string</code></li>
                                        <li><code>password : string</code></li>
                                        <li><code>firstname : string</code></li>
                                        <li><code>lastname : string</code></li>
                                        <li><code>middlename : string (optional)</code></li>
                                    </ul>
                                </li>
                                <li>
                                    PARAMETERS : None
                                </li>
                            </ul>
                        </li>
                        <li class="ml-4" id="s4">
                            <h1 class="font-bold text-xl">/student/assign-section</h1>
                            <ul class="space-y-3 m-4">
                                <li>METHOD: POST</li>
                                <li>
                                    REQUEST BODY:
                                    <ul class="m-4">
                                        <li><code>student_id : int</code></li>
                                        <li><code>section_id : int</code></li>
                                    </ul>
                                </li>
                                <li>
                                    PARAMETERS : None
                                </li>
                            </ul>
                        </li>
                        <li><h1 class="font-bold text-2xl">Note: The following endpoints requires an authentication token which to put inside an Authorization Header. <br /> To know how to add and generate a token click <a href="" class="underline">here</a>.</h1></li>
                        <li class="ml-4" id="s5">
                            <h1 class="font-bold text-xl">/student/update/score</h1>
                            <ul class="space-y-3 m-4">
                                <li>METHOD: PATCH</li>
                                <li>
                                    REQUEST BODY:
                                    <ul class="m-4">
                                        <li><code>pre_test_score : int</code></li>
                                        <li><code>post_test_score : int</code></li>
                                    </ul>
                                </li>
                                <li>
                                    HEADERS:
                                    <ul class="m-4">
                                        <li><code>Authorization: Bearer {token}</code></li>
                                    </ul>
                                </li>
                                <li>
                                    PARAMETERS : None
                                </li>
                            </ul>
                        </li>
                        <li class="ml-4" id="s6">
                            <h1 class="font-bold text-xl">/student/update/progress</h1>
                            <ul class="space-y-3 m-4">
                                <li>METHOD: PATCH</li>
                                <li>
                                    REQUEST BODY:
                                    <ul class="m-4">
                                        <li><code>ecology_mastery : int</code></li>
                                        <li><code>tera_mastery : int</code></li>
                                        <li><code>momentum_mastery : int</code></li>
                                        <li><code>quantum_mastery : int</code></li>
                                    </ul>
                                </li>
                                <li>
                                    HEADERS:
                                    <ul class="m-4">
                                        <li><code>Authorization: Bearer {token}</code></li>
                                    </ul>
                                </li>
                                <li>
                                    PARAMETERS : None
                                </li>
                            </ul>
                        </li>
                        <li class="ml-4" id="s7">
                            <h1 class="font-bold text-xl">/student/me/assign-section/{section_id}</h1>
                            <ul class="space-y-3 m-4">
                                <li>METHOD: PATCH</li>
                                <li>
                                    REQUEST BODY: None
                                </li>
                                <li>
                                    HEADERS:
                                    <ul class="m-4">
                                        <li><code>Authorization: Bearer {token}</code></li>
                                    </ul>
                                </li>
                                <li>
                                    PARAMETERS : <code>section_id : int</code>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </section>

                <section id="users">
                    <h1 class="text-2xl font-bold">Users</h1>

                    <p class="mt-5">Here are the api endpoints that use to login and view student/user profile.</p>

                    <ul class="ml-4 my-5 space-y-5">
                        <li class="ml-4" id="u1">
                            <h1 class="font-bold text-xl">/auth</h1>
                            <ul class="space-y-3 m-4">
                                <li>METHOD: POST</li>
                                <li>
                                    REQUEST BODY:
                                    <ul class="m-4">
                                        <li><code>email : string</code></li>
                                        <li><code>password : string</code></li>
                                    </ul>
                                </li>
                                <li>
                                    HEADERS: None
                                </li>
                                <li>
                                    PARAMETERS : None
                                </li>
                                <li>
                                    <span>DESCRIPTION (BONUS):</span>
                                    <p class="ml-3 mt-2">This returns a valid token which should be put in Authorization Header.</p>
                                </li>
                            </ul>
                        </li>

                        <li class="ml-4" id="u2">
                            <h1 class="font-bold text-xl">/student-info</h1>
                            <ul class="space-y-3 m-4">
                                <li>METHOD: GET</li>
                                <li>
                                    REQUEST BODY:
                                    <ul class="m-4">
                                        <li><code>email : string</code></li>
                                        <li><code>password : string</code></li>
                                    </ul>
                                </li>
                                <li>
                                    HEADERS:
                                    <ul class="m-4">
                                        <li><code>Authorization : Bearer {token}</code></li>
                                    </ul>
                                </li>
                                <li>
                                    PARAMETERS : None
                                </li>
                            </ul>
                        </li>
                    </ul>
                </section>

                <section id="sections">
                    <h1 class="text-2xl font-bold">Sections</h1>

                    <p class="mt-5">Here are the api endpoints that use to view available sections.</p>

                    <ul class="ml-4 my-5 space-y-5 transitio" id="sc1">
                        <li class="ml-4">
                            <h1 class="font-bold text-xl">/sections</h1>
                            <ul class="space-y-3 m-4">
                                <li>METHOD: GET</li>
                                <li>
                                    REQUEST BODY: NONE
                                </li>
                                <li>
                                    HEADERS: NONE
                                </li>
                                <li>
                                    PARAMETERS : NONE
                                </li>
                            </ul>
                        </li>
                    </ul>
                </section>

            </main>
        </div>
    </div>
</template>
<script setup>
import { onMounted } from 'vue';

defineProps({
    api_url : {
        type: String
    }
})

const highlight = (id) => {
    const section = document.getElementById(id);

    if(section)
    {
        section.classList.add('bg-accent transtition-all ease-in-out');
        setTimeout(() => {
            section.classList.remove('bg-accent transtition-all ease-in-out');
        }, 1500);
    }
}

onMounted(() => {
    const hash = window.location.hash.substring(1);
    if (hash) {
        highlight(hash);
    }

    window.addEventListener('hashchange', () => {
        const newHash = window.location.hash.substring(1);
        if (newHash) {
        highlight(newHash);
        }
    });
});
</script>
