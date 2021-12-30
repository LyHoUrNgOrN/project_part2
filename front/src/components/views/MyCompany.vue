<template>
  
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
  

</style>