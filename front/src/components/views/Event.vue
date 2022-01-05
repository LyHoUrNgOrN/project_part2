<template>
  <div>
    <v-container>
      <v-row>
        <v-col cols="12" md="6" sm="6">
          <v-card class="mx-auto" max-width="545">
            <v-img
              class="white--text align-end"
              src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
              height="200px"
            >
              <v-card-title>Title Event ...</v-card-title>
            </v-img>
            <div class="float-right d-f">
              <v-card-subtitle class="pb-0 cyan--text h3">
                Phnom Penh
              </v-card-subtitle>
            </div>

            <div>
              <v-card-text class="text--primary mt-3">
                <v-text
                  ><div class="red--text">
                    <span class="event_start">Start</span>
                    <span class="date ml-2">Mon, 27/11/2021 3:00 PM</span>
                  </div></v-text
                >
                <v-text
                  ><div class="red--text">
                    <span class="event_end"> End </span
                    ><span class="date ml-2">Mon, 27/11/2021 4:00 PM</span>
                  </div></v-text
                >

                <div>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Facilis voluptatibus sunt cumque minus sed voluptate porro ex
                  at nulla. Dolore obcaecati non aut temporibus sapiente dolor
                  sit quos earum esse!
                </div>

                <v-btn color="blue" class="mt-3 white--text" small
                  >Contact</v-btn
                >
              </v-card-text>
            </div>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {};
</script>
<style scoped>
</style>