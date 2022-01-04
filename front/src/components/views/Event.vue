<template>
    <div class="la">
        <v-container>
            <v-row>
                <v-col cols="6">
                    <v-card class="mx-auto" id="lp" max-width="545">
                    <v-img
                        class="white--text align-end"
                        src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
                        height="200px"
                    >
                    <v-card-title>Title Event ...</v-card-title>
                    </v-img>

                    <v-card-subtitle
                        class="blue--text"
                        id="name"
                    > Phnom Penh </v-card-subtitle>
                    <v-card-subtitle  class="black--text" id="start1"> Start Date </v-card-subtitle>
                    <input type="datetime-local" id="dateTime" name="dateTime" value="2017-08-28T13:01" />
                    <v-card-subtitle class="black--text" id="start1" > End Date </v-card-subtitle>
                    <input type="datetime-local" id="dateTime" name="dateTime" value="2017-08-28T13:01" /><br><br><hr>

                    <v-card-actions>
                        <v-btn color="blue" text>Description</v-btn>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="show = !show">
                            <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
                        </v-btn>
                    </v-card-actions>

                    <v-expand-transition>
                        <div v-show="show">
                            <v-card-text>
                                I'm a thing. But, like most politicians, he promised more than he could deliver. 
                                You won't have time for sleeping, soldier, not with all the bed making you'll be doing. 
                                Then we'll go with that data file! Hey, you add a one and two zeros to that or we walk! 
                                You're going to do his laundry? I've got to find a way to escape.
                            </v-card-text>
                        </div>
                    </v-expand-transition>
                    </v-card>
                </v-col>

                <v-col cols="6">
                    <v-card class="mx-auto" max-width="545">
                    <v-img
                        class="white--text align-end"
                        src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
                        height="200px"
                    >
                    <v-card-title>Title Event ...</v-card-title>
                    </v-img>

                    <v-card-subtitle class="blue--text" id="name"> Phnom Penh </v-card-subtitle>
                    <v-card-subtitle class="black--text" id="start1" > Start Date </v-card-subtitle>
                    <input type="datetime-local" id="dateTime" name="dateTime" value="2017-08-28T13:01" />
                    <v-card-subtitle class="black--text" id="start1" > End Date </v-card-subtitle>
                    <input type="datetime-local" id="dateTime" name="dateTime" value="2017-08-28T13:01" /><br><br> <hr>

                    <v-card-actions>
                        <v-btn color="blue" text >Description</v-btn>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="show = !show">
                           <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
                        </v-btn>
                    </v-card-actions>

                    <v-expand-transition>
                        <div v-show="show">
                            <v-card-text>
                                I'm a thing. But, like most politicians, he promised more than he could deliver. 
                                You won't have time for sleeping, soldier, not with all the bed making you'll be doing. 
                                Then we'll go with that data file! Hey, you add a one and two zeros to that or we walk! 
                                You're going to do his laundry? I've got to find a way to escape.
                            </v-card-text>
                        </div>
                    </v-expand-transition>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
    export default {
        data: () => ({
        show: false,
        }),
    }
</script>

<style scoped>
    #name{
        margin-left: 75%;
        font-size: 17px;
    }
    .la{
    margin-top: 20px; 
    }
    #start1{
        font-size: 17px;
    }
    #dateTime{
        margin-left: 15px;
    }

</style>