<template>
  <div class="name">
    <h1>Companies Information</h1>
    <v-row>
      <v-col cols="5">
        <p>Companies<span class="red--text">*</span></p>
        <v-text-field
          class="rounded-pill"
          label="Current position ..."
          :rules="rules"
          hide-details="auto"
          outlined
          dense
          v-model="name"
        ></v-text-field>

        <v-text-field
          class="rounded-pill"
          label="Comapany name ..."
          :rules="rules"
          hide-details="auto"
          outlined
          dense
          v-model="phone"
        ></v-text-field>

        <v-text-field
          class="rounded-pill"
          label="Comapany phone ..."
          :rules="rules"
          hide-details="auto"
          outlined
          dense
          v-model="phone"
        ></v-text-field>

        <p class="text">
          <v-text-field
            class="rounded-pill"
            label="Company email ..."
            :rules="rules"
            hide-details="auto"
            outlined
            dense
            v-model="email"
          ></v-text-field>
        </p>

        <p class="text">
          <v-text-field
            class="rounded-pill"
            label="Comapny address ..."
            :rules="rules"
            hide-details="auto"
            outlined
            dense
            v-model="address"
          ></v-text-field>
        </p>

        <p class="text">
          <v-text-field
            class="rounded-pill"
            label="Company website ..."
            :rules="rules"
            hide-details="auto"
            outlined
            dense
            v-model="website"
          ></v-text-field>
        </p>
      </v-col>

      <v-col cols="5">
        <p>Human resources<span class="red--text">*</span></p>
        <v-text-field
          class="rounded-pill"
          label="HR name ..."
          :rules="rules"
          hide-details="auto"
          outlined
          dense
          v-model="hrname"
        ></v-text-field>

        <v-text-field
          class="rounded-pill"
          label="HR email ..."
          :rules="rules"
          hide-details="auto"
          outlined
          dense
          v-model="hrname"
        ></v-text-field>

        <v-text-field
          class="rounded-pill"
          label="HR phone ..."
          :rules="rules"
          hide-details="auto"
          outlined
          dense
          v-model="hrphone"
        ></v-text-field>
      </v-col> 
    </v-row>
    
    <div class="btn">
      <button class="one">Cancel</button>
      <button class="two" @click="my_company">Save</button>
    </div>    
  </div>
  
</template>

<script>
export default {
  data() {
    return {
      rules: [value => !!value || "Required."],
      name:'',
      phone : '',
      email: '',
      address: '',
      website: '',
      hrname: '',
      hrphone: '',
      infoCompany:[]
    };
  },
  methods: {
    my_company(){
      this.infoCompany.push(this.name, this.phone, this.email,this.address, this.website, this.hrname, this.hrphone);

      console.log(this.infoCompany)
    }
  },
};
</script>

<style scoped>
.name{
  border: 2px solid #838686;
  margin-left: 200px;
  width: 70%;
  margin-top: 20px;
  border-radius: 10px;
}
.rounded-pill{
  margin-left: 26%;
  width: 90%;
  margin-top: 20px;
}
.text{
  width: 218%;
  margin-left: -107px;
}
p{
  margin-left: 27%;
  margin-top: 20px;
}
h1{
  text-align: center;
}
.one{
  background: rgb(128, 127, 127);
  height: 35px;
  width: 100px;
  margin: 15px;
  border-radius: 5px;
 
}
.two{
  background: rgb(59, 120, 233);
  height: 35px;
  width: 100px;
  border-radius: 5px;
}
.btn{
  margin-left: 63%;
}

</style>