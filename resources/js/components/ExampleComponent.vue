<template>
<v-app>
<v-container fluid>
<v-layout row wrap justify-center>
<v-flex xs12 md8 lg6 xl4>

<v-card>
  <v-card-title class="pb-0">
    <h3 class="headline mb-0 primary--text">
      Example Component
    </h3>
  </v-card-title>
  <v-card-text>
    I'm an example component!
  </v-card-text>
</v-card>


</v-flex>
</v-layout>
</v-container>
</v-app>
</template>

<script>
export default {
  created() {
    console.log('created')
  }
}
</script>
