<template>
  <div>
    <v-col cols="auto">
      <v-dialog
        transition="dialog-top-transition"
        max-width="500"
        v-model="event_dialog"
      >
        <template v-slot:activator="{ on, attrs }">
          <div class="float-right">
            <v-btn color="primary" v-bind="attrs" v-on="on" class="mr-3"
              >Create event</v-btn
            >
            <v-btn color="green" v-bind="attrs" v-on="on">Edit event</v-btn>
          </div>
        </template>
        <template>
          <v-card>
            <v-toolbar color="primary" dark class="text-h5"
              >New event</v-toolbar
            >
            <v-card-text>
              <div class="text-h2">
                <form @submit.prevent>
                  <v-row class="mt-5">
                    <v-col cols="12">
                      <v-text-field
                        v-model="title"
                        label="Event title"
                        :rules="[rules.required]"
                        hide-details="auto"
                        outlined
                        class="rounded"
                        dense
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field
                        outlined
                        type="datetime-local"
                        dense
                        :rules="[rules.required]"
                        hide-details="auto"
                        v-model="date_start"
                        label="Start date"
                        class="rounded"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field
                        outlined
                        type="datetime-local"
                        dense
                        :rules="[rules.required]"
                        hide-details="auto"
                        v-model="date_end"
                        label="End date"
                        class="rounded"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field
                        outlined
                        dense
                        :rules="[rules.required]"
                        hide-details="auto"
                        v-model="city"
                        label="Event place"
                        class="rounded"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-textarea
                        outlined
                        dense
                        :rules="[rules.required]"
                        hide-details="auto"
                        v-model="description"
                        label="Event discription"
                        class="rounded"
                        auto-grow
                        rows="4"
                        row-height="15"
                      ></v-textarea>
                    </v-col>
                  </v-row>
                </form>
              </div>
            </v-card-text>
            <v-card-actions class="justify-end">
              <v-btn text @click="add_event">Close</v-btn>
              <v-btn color="primary" @click="add_event">+Add</v-btn>
            </v-card-actions>
          </v-card>
        </template>
      </v-dialog>
    </v-col>

    <v-container>
      <v-row>
        <v-col cols="12" md="6" sm="6">
          <v-card class="mx-auto mt-10" max-width="600">
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
import moment from 'moment'
export default {

  data() {
    return {
      event_dialog: false,
      title: "",
      date_start: "",
      date_end: "",
      city: "",
      description: "",
      rules: {
        required: (value) => !!value || "Required.",
      },
    };
  },
  methods: {
    dateFomart(date){
      return moment(date).fomart('YYYY/DD/MM hh:mm:ss')
    },

  },
};
</script>
<style scoped>
</style>