<template>
  <layout title="Dashboard">
    <h1 class="mb-8 font-bold text-3xl">Audiences Dashboard</h1>
    <p class="mb-12 leading-normal">Browse audiences and view their potential advertising reach. Save any audience into a collection and export that collection as a CSV.</p>
    <div>
        <div class="w-full md:w-1/2 xl:w-1/3 p-3">
            <!--Metric Card-->
            <div class="bg-blue-100 rounded-lg shadow p-8">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pl-3 text-center">
                        <div class="rounded-full p-6 bg-blue-700"><font-awesome-icon icon="user-friends" class="text-white text-lg     " /></div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-gray-600">Total Audiences</h5>
                        <h3 class="font-bold text-3xl">{{ audienceTotals }}</h3>
                    </div>
                </div>
            </div>
            <inertia-link class="btn-indigo -mt-4 mr-4 float-right" href="/audiences">Browse Audiences</inertia-link>
            <!--/Metric Card-->
        </div>
    </div>
  </layout>
</template>

<script>
import Layout from '@/Shared/Layout'

export default {
  components: {
    Layout,
  },
  props: {
    audienceTotals: Number,
  },
}
</script>
