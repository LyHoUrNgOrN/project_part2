<template>
  <div>
    <v-main>
      <v-card class="mx-auto mt-10 pa-8">
        <h1>Current employment</h1>
        <v-container fluid class="d-flex" v-if="show_details">
          <div class="profile me-16">
            <img
              src="https://cahsi.utep.edu/wp-content/uploads/kisspng-computer-icons-user-clip-art-user-5abf13db5624e4.1771742215224718993529.png"
              alt
              width="190"
            />

            <input type="file" id="myFileInput" @change="image" hidden />
            <v-btn
              rounded
              color="cyan white--text"
              width="200"
              onclick="document.getElementById('myFileInput').click()"
            >Change Logo</v-btn>
          </div>
          <v-card-text class="text-h5 mt-10">
            <div class="txt">
              <span class="sub-txt">Company name</span>
              <span>: Advanced Bank of Asia Ltd. (ABA Bank)</span>
            </div>
            <div class="txt">
              <span class="sub-txt">Phone</span>
              <span>: 088 34 52 939</span>
            </div>
            <div class="txt">
              <span class="sub-txt">Email</span>
              <span>: aba@gmail.com</span>
            </div>
          </v-card-text>
        </v-container>

        <v-list>
          <v-list-group
            @click="details"
            :value="false"
            rounded
            prepend-icon="mdi-account-circle"
            style="background : #EFEFEF"
          >
            <template v-slot:activator>
              <v-list-item-title>Users Detail</v-list-item-title>
            </template>

            <v-list-item
              v-for="([title, name], i) in cruds"
              :key="i"
              style="background : #fff"
              link
            >
              <v-list-item-title class="ml-16" width="auto" v-text="title"></v-list-item-title>

              <v-list-item-title v-text="name"></v-list-item-title>
              <v-list-item-icon></v-list-item-icon>
            </v-list-item>
          </v-list-group>
        </v-list>

        <v-row>
          <v-spacer></v-spacer>
          <v-col cols="auto">
            <v-dialog transition="dialog-top-transition" max-width="600">
              <template v-slot:default="dialog">
                <v-card>
                  <v-toolbar color="primary" class="name" dark>Companies Information</v-toolbar>
                  <v-card-text>
                    <v-row>
                      <v-col cols="6">
                        <p>
                          Companies
                          <span class="red--text">*</span>
                        </p>
                        <v-text-field
                          class="rounded-pill"
                          label="Current position ..."
                          :rules="rules"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="current_position"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="6">
                        <p>
                          Human Resources
                          <span class="red--text">*</span>
                        </p>
                        <v-text-field
                          class="rounded-pill"
                          label="HR name ..."
                          :rules="rules"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="hr_name"
                        ></v-text-field>
                      </v-col>

                      <v-col cols="6">
                        <v-text-field
                          class="rounded-pill"
                          label="Company name ..."
                          :rules="rules"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="company_name"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="6">
                        <v-text-field
                          class="rounded-pill"
                          label="HR email ..."
                          :rules="rules"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="hr_email"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="6">
                        <v-text-field
                          class="rounded-pill"
                          label="Comapny phone ..."
                          :rules="rules"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="company_phone"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="6">
                        <v-text-field
                          class="rounded-pill"
                          label="HR phone ..."
                          :rules="rules"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="hr_phone"
                        ></v-text-field>
                      </v-col>
                  

                      <v-col cols="12">
                        <v-text-field
                          class="rounded-pill"
                          label="Company email ..."
                          :rules="rules"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="company_email"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                          class="rounded-pill"
                          label="Company address ..."
                          :rules="rules"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="company_address"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                          class="rounded-pill"
                          label="Company website ..."
                          :rules="rules"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="Company_website"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-card-text>
                  <v-card-actions class="justify-end">
                    <v-btn color="cyan white--text" text @click="dialog.value = false">Cancel</v-btn>
                    <v-btn text @click="dialog.value = false">Save</v-btn>
                  </v-card-actions>
                  
                </v-card>
              </template>

              <template v-slot:activator="{ on, attrs }">
                <v-btn class="white--text" color="#44C7F5" v-bind="attrs" v-on="on">+Add Information</v-btn>
                <v-btn class="green lighten-1 white--text ml-4">Edit Information</v-btn>
              </template>
            </v-dialog>
          </v-col>
        </v-row>
      </v-card>
      <h1>Work experince</h1>
    </v-main>
  </div>
</template>


<script>
export default {
  data() {
    return {
      rules: [value => !!value || "Required."],
      current_position: "",
      hr_name: "",
      company_name: "",
      hr_email: "",
      company_phone: "",
      hr_phone: "",
      Company_email: "",
      company_address: "",
      Company_website: "",
      infoCompany:[],

      show_details: true,
      cruds: [
        ["Company name", "Advanced Bank of Asia Ltd. (ABA Bank)"],
        ["Phone", "+855 23 235 333"],
        ["Email", "aba@gmail.com"],
        ["Website", "https://www.ababank.com"],
        [
          "Address",
          "148 Preah Sihanouk Blvd, Sangkat Boeung Keng Kang I, Khan Boeung Keng Kang, Phnom Penh, Cambodia Human resources"
        ],

        ["Human resources"],

        ["Name", "Sara Vey"],
        ["Phone", "+855 23 235 333"]
      ]
    };
  },
  methods: {
    my_company(){
      this.infoCompany.push(this.name, this.phone, this.email,this.address, this.website, this.hrname, this.hrphone);

      console.log(this.infoCompany)
    }
  },
  mounted() {
    // console.log(localStorage.getItem('reload'))
    // if(localStorage.getItem('reload') == false){
    // localStorage.setItem('reload',true);
    // window.location.reload();
    // }
  }
};
</script>

<style scoped>
.container,
.txt {
  margin-top: 20px;
}
@media (max-width: 960px) {
  .sub-txt {
    width: 100px;
  }
}
@media (max-width: 600px) {
  .container,
  .txt,
  .txt div {
    display: block;
  }
}

</style>