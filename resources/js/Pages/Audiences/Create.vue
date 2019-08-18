<template>
  <layout title="Create Contact">
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-500 hover:text-indigo-800" :href="route('audiences')">Audiences</inertia-link>
      <span class="text-indigo-500 font-medium">/</span> Create
    </h1>
    <div class="bg-white rounded shadow overflow-hidden max-w-lg">
      <form @submit.prevent="submit">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.facebook_id" :errors="$page.errors.facebook_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Facebook ID" />
          <text-input v-model="form.odc_id" :errors="$page.errors.odc_id" class="pr-6 pb-8 w-full lg:w-1/2" label="ODC ID" />
          <text-input v-model="form.name" :errors="$page.errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="Name" />
          <text-input v-model="form.type" :errors="$page.errors.type" class="pr-6 pb-8 w-full lg:w-1/2" label="Type" />
          <text-input v-model="form.sla" :errors="$page.errors.sla" class="pr-6 pb-8 w-full lg:w-1/2" label="SLA" />
          <text-input v-model="form.estimated_size" :errors="$page.errors.estimated_size" class="pr-6 pb-8 w-full lg:w-1/2" label="Estimated Size" />
          <text-input v-model="form.description" :errors="$page.errors.description" class="pr-6 pb-8 w-full lg:w-1/2" label="Description" />
        </div>
        <div class="px-8 py-4 bg-grey-500 border-t border-grey-500 flex justify-end items-center">
          <loading-button :loading="sending" class="btn-indigo" type="submit">Create Audience</loading-button>
        </div>
      </form>
    </div>
  </layout>
</template>

<script>
import Layout from '@/Shared/Layout'
import LoadingButton from '@/Shared/LoadingButton'
import TextInput from '@/Shared/TextInput'

export default {
  components: {
    Layout,
    LoadingButton,
    TextInput,
  },
  props: {
    organizations: Array,
  },
  remember: 'form',
  data() {
    return {
      sending: false,
      form: {
        facebook_id: null,
        odc_id: null,
        name: null,
        type: null,
        sla: null,
        estimated_size: null,
        description: null,
      },
    }
  },
  methods: {
    submit() {
      this.sending = true
      this.$inertia.post(this.route('audiences.store'), this.form)
        .then(() => this.sending = false)
    },
  },
}
</script>
