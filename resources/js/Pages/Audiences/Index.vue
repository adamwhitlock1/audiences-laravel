<template>
  <layout title="Audiences">
    <div class="mb-6 flex justify-between content-center items-center">
      <h1 class="font-bold text-3xl w-2/3">Audiences</h1>

      <div class="w-1/3 flex justify-end">
        <inertia-link class="btn-indigo mx-1" :href="route('audiences.create')">
          <span>Create</span>
          <span class="hidden md:inline">Audience</span>
        </inertia-link>

        <inertia-link class="btn-green mx-1" :href="route('audiences.import')">
          <span>Import</span>
          <span class="hidden md:inline">All Audiences</span>
        </inertia-link>
      </div>
    </div>
    <p v-if="audiences.data.length <= 10" class="p-6 w-full bg-gray-100 text-lg"
      >Loading</p
    >
    <transition name="fade">
      <div v-if="audiences.data.length > 10" class="mt-6 bg-transparent">
        <v-client-table
          :data="audiences.data"
          :columns="columns"
          :options="options"
          theme="bulma"
          name="aud"
          class="audience-table"
        >
          <!--                <div slot="key" slot-scope="props"><save-btn :entry="props.row"/></div>-->
        </v-client-table>
      </div>
    </transition>
  </layout>
</template>

<script>
import _ from 'lodash'
import axios from 'axios'
import Layout from '@/Shared/Layout'

export default {
  components: {
    Layout,
  },
  props: {
    audiences: Object,
    filters: Object,
  },
  created() {
    // console.log(this.audiences)
    axios.get('/api/all-audiences').then((res) => {
      // console.log(res.data)
      this.allDataReady = true
      this.audiences.data = res.data
    })
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
      allDataReady: false,
      columns: ['odc_id', 'name', 'estimated_size', 'description'],
      options: {
        customSorting: {
          odc_id: function(ascending) {
            return function(a, b) {
              var lastA = parseInt(a['odc_id'])
              var lastB = parseInt(b['odc_id'])

              if (ascending) return lastA >= lastB ? 1 : -1

              return lastA <= lastB ? 1 : -1
            }
          },
          estimated_size: function(ascending) {
            return function(a, b) {
              var lastA = parseInt(a['estimated_size'].replace(/,/g, ''))
              var lastB = parseInt(b['estimated_size'].replace(/,/g, ''))
              if (ascending) return lastA >= lastB ? 1 : -1

              return lastA <= lastB ? 1 : -1
            }
          },
        },
        headings: {
          odc_id: 'ODC ID ',
          name: 'Audience Name',
          estimated_size: 'Est. Size ',
          description: 'Description',
        },
      },
    }
  },
  methods: {
    reset() {
      this.form = _.mapValues(this.form, () => null)
    },
  },
}
</script>
