<template>
  <div>
    <Base-search> </Base-search>
    <div>
      <div class="form-user">
        <h1>Alumni</h1>
        <v-simple-table>
          <template v-slot:default>
            
            <thead>
              <tr class="text-center">
                <th>Profile</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Batch</th>
                <th>Current Position</th>
                <th>Company</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="info in Info" :key="info">
                <td>
                  <img
                    src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png"
                    alt=""
                    width="50"
                    class="ma-2"
                  />
                </td>
                <td>{{ info.firstName }}</td>
                <td>{{ info.lastName }}</td>
                <td>{{ info.batch }}</td>
                <td>{{ info.current_position }}</td>
                <td>{{ info.company }}</td>
                <td>
                  <v-icon color="red" @click="deleteItem(user.id)">
                    mdi-delete
                  </v-icon>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </div>
    </div>
  </div>

  
</template>

<script>
export default {
  data() {
    return {
      Info:[
        {
          firstName: 'chum',
          lastName: 'Phea',
          batch: '2021',
          current_position: 'WEB',
          company: 'JPJ'
        },
        {
          firstName: 'chum',
          lastName: 'Phea',
          batch: '2021',
          current_position: 'WEB',
          company: 'JPJ'
        },
        {
          firstName: 'chum',
          lastName: 'Phea',
          batch: '2021',
          current_position: 'WEB',
          company: 'JPJ'
        },
        
      ]
     

      
    };
  },
  methods: {
    // getUser() {
    //   axios
    //     .get("http://127.0.0.1:8000/api/user")
    //     .then((result) => {
    //       this.users = result.data;
    //     })
    //     .catch((err) => {
    //       console.log(err.response.data.message);
    //     });
    // },
  },
  mounted() {
    
  },
};
</script>
<style scoped>
.form-user {
  width: 100%;
}
h1{
  margin-left: 3%;
  margin-bottom: 2%;
}
</style>

