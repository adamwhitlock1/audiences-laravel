<template>
  <layout title="Import Audiences">
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link
        class="text-blue-500 hover:text-blue-800"
        :href="route('audiences')"
      >
        Audiences
      </inertia-link>
      <span class="text-blue-500 font-medium">/</span> Import
    </h1>
    <div class="bg-white rounded shadow overflow-hidden max-w-lg">
      <form @submit.prevent="submit">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <file-input
            v-model="form.csv"
            :errors="$page.errors.csv"
            class="pr-6 w-full lg:w-1/2"
            type="file"
            accept=".csv"
            label="CSV file"
          />
          <p class="text-gray-500 py-4">
            Please be patient while importing CSVs. Large files may take several
            minutes to import. Do not navigate away from this page while running
            an import.
          </p>
        </div>
        <div
          class="px-8 py-4 bg-gray-100 border-t border-grey-500 flex justify-end items-center"
        >
          <loading-button
            @click="startImport"
            :loading="sending"
            class="btn-green"
            type="submit"
          >
            Import Audience
          </loading-button>
        </div>
      </form>
      <div v-if="loading">
        <h3 class="text-2xl">Importing the data {{ status }}%</h3>
      </div>
    </div>
  </layout>
</template>

<script>
import Layout from '@/Shared/Layout'
import LoadingButton from '@/Shared/LoadingButton'
import FileInput from '@/Shared/FileInput'

export default {
  components: {
    Layout,
    LoadingButton,
    FileInput,
  },
  props: {
    organizations: Array,
  },
  remember: 'form',
  data() {
    return {
      sending: false,
      form: {
        csv: null,
      },
      status: 0,
      loading: false,
    }
  },
  methods: {
    submit() {
      this.sending = true
      let data = new FormData()
      data.append('csv', this.form.csv || '')
      data.append('_method', 'post')
      this.$inertia.post(this.route('audiences.import'), data).then(() => {
        this.sending = false
        if (Object.keys(this.$page.errors).length === 0) {
          // console.log('SENT')
        }
      })
    },
    startImport() {
      this.loading = true
      this.status = 1
    },
  },
}
</script>
