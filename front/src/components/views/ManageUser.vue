<template>
  <v-card>
    <v-card-title>
      
      <v-text-field class="rounded-pill pa-10"
        v-model="search"
        color="#44C7F5"
        append-icon="mdi-magnify"
        label="Search by alumni, company and batch..."
        single-line
        hide-details
        outlined
        
      ></v-text-field>
      <v-col cols="2">
        <v-dialog transition="dialog-top-transition" max-width="600">
             <template v-slot:activator="{ on, attrs }">
              <v-btn color="#44C7F5" dark class="ma-10 pa-7 rounded-pill" width="60%" v-bind="attrs" v-on="on">
                Create ERO
              </v-btn>
            </template>
            <template v-slot:default="dialog">
              <v-card>
                <v-toolbar color="primary" dark>Define ERO Account</v-toolbar>
                  <v-card-actions class="justify-start">
                  <v-btn text @click="dialog.value = false">Save</v-btn>
                  <v-btn text @click="dialog.value = false">Close</v-btn>
                </v-card-actions>
              </v-card>
            </template>
        </v-dialog>
      </v-col>
    </v-card-title>
    <v-data-table 
      color="error"
      :headers="headers"
      :items="users"
      :search="search"
    ></v-data-table>
    
  </v-card>
  
</template>

<script>
export default{
  data () {
    return {
      search: '',
      headers: [
        // {
        //   filterable: false,
          
        // },
        { text: 'Profile', value: 'profile'},
        { text: 'First name', value: 'first_name' },
        { text: 'Last name', value: 'last_name' },
        { text: 'Role', value: 'type' },
        { text: 'Delete', value: 'delete'},
      ],
      users: [
        {
          profile: 'PNC',
          first_name : 'Frozen',
          last_name: 'sare',
          type: 'admin',
          delete: 'mi'
          
        },
        {
          profile: 'PNC',
          first_name : 'Phea',
          last_name: 'mean',
          type: 'alumni',
          
        },
        {
          profile: 'PNC',
          first_name : 'thin',
          last_name: 'mey',
          type: 'Ero',
        },
      ],
    }
  },
}
</script>

<style scoped>
.head{
  background-color: red;
}
</style>

