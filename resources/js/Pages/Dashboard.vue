<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { reactive } from 'vue';
import axios from 'axios';
const axiosClient = axios.create({
   baseURL: "http://localhost:8000/api"
})

const user = usePage().props.auth.user;

const form = reactive({
  title: null,
  description: null,
  completed: null,
})
function submit() {

  form.append('id_user', user.id);
  axiosClient.post('/tasks', form)
  .then((prop) => {
    console.log(prop);
  })
  .catch(err => {
    console.log(err);
  })
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div>

        <div>
            <section>


                <form @submit.prevent="submit" class="mt-6 space-y-6">
                      @csrf
                    <div>
                        <label for="title">Titulo:</label>
                        <input id="title" v-model="form.title" />
                    </div>
                    <div>
                        <label for="description">Descripción:</label>
                        <input id="description" v-model="form.description" />
                    </div>
                    <div>
                        <label for="completed">Completado:</label>
                        <input id="completed" type="checkbox" v-model="form.completed" />
                    </div>

                    <div class="flex items-center gap-4">
                        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                        </Transition>
                    </div>
                </form>
            </section>
        </div>

    </AuthenticatedLayout>
</template>
