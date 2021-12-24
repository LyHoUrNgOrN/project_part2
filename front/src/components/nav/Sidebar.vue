<template>
  <div class="pa-2">
    <span>
      <v-icon large color="cyan"> mdi-account-circle </v-icon>
      <v-text class="pa-2">Chum</v-text>
    </span>
    <v-list-item-group
      nav
      dense
      active-class="cyan--text text--accent-4"
      class="text-center"
    >
      <v-list-item :to="{ path: '/profile-view' }">
        <v-list-item-title>My profile</v-list-item-title>
      </v-list-item>
      <v-list-item :to="{ path: '/company-view' }">
        <v-list-item-title>My company</v-list-item-title>
      </v-list-item>

      <v-btn
        depressed
        color="cyan"
        class="signout rounded-lg pa-5 white--text mt-16"
      >
        Sign out
      </v-btn>
    </v-list-item-group>
  </div>
</template>


<script>
export default {
  data() {
    return {};
  },
};
</script>
<style scoped>
.signout {
  width: 100%;
}
</style>