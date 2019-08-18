<template>
  <div>
    <div class="mb-2">
      <inertia-link class="flex items-center group py-2" :class="isUrl('') ? 'text-white border-b border-white' : 'text-blue-200'" :href="route('dashboard')">
        <icon name="dashboard" class="w-6 h-4 mr-2 pl-2 fill-current" />
        <div>Dashboard</div>
      </inertia-link>
    </div>
    <div class="mb-2">
      <inertia-link class="flex items-center group py-2" :class="isUrl('organizations') ? 'text-white border-b border-white' : 'text-blue-200'" :href="route('organizations')">
        <icon name="office" class="w-6 h-4 mr-2 pl-2 fill-current" />
        <div>Organizations</div>
      </inertia-link>
    </div>
    <div class="mb-2">
      <inertia-link class="flex items-center group py-2" :class="isUrl('contacts') ? 'text-white border-b border-white' : 'text-blue-200'" :href="route('contacts')">
        <icon name="users" class="w-6 h-4 mr-2 pl-2 fill-current" />
        <div>Contacts</div>
      </inertia-link>
    </div>
      <div class="mb-2">
      <inertia-link class="flex items-center group py-2" :class="isUrl('audiences') ? 'text-white border-b border-white' : 'text-blue-200'" :href="route('audiences')">
        <icon name="users" class="w-6 h-4 mr-2 pl-2 fill-current" />
        <div>Audiences</div>
      </inertia-link>
    </div>
    <div class="mb-2">
      <inertia-link class="flex items-center group py-2" :class="isUrl('reports') ? 'text-white border-b border-white' : 'text-blue-200'" :href="route('reports')">
        <icon name="printer" class="w-6 h-4 mr-2 pl-2 fill-current" />
        <div>Reports</div>
      </inertia-link>
    </div>
  </div>
</template>

<script>
import Icon from '@/Shared/Icon'

export default {
  components: {
    Icon,
  },
  methods: {
    isUrl(...urls) {
      if (urls[0] === '') {
        return location.pathname.substr(1) === ''
      }

      return urls.filter(url => location.pathname.substr(1).startsWith(url)).length
    },
  },
}
</script>
