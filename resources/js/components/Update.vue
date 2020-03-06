<template>
  <div>
    <div class="row">
      <div class="col-md-6">
        <br>
        <br>
        <h4>Edit data</h4>
        <br>
        <form @submit.prevent="updateData()">
          <div class="form-group">
            <label>Name</label>
            <input
                type="textfield"
                class="form-control"
                placeholder="Contact Name"
                v-model="form.name"
                required
            >
          </div>
          <div class="form-group">
            <label>Phone</label>
            <input
                type="textfield"
                class="form-control"
                placeholder="Phone Number"
                v-model="form.phone"
                required
            >
          </div>
          <div class="form-group">
            <label>Gender</label>
            <select id="cars"
                class="form-control"
                placeholder="Phone Number"
                v-model="form.gender"
                required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
            </select>  
          </div>
          <div class="form-group">
            <label>Address</label>
            <input
                type="textfield"
                class="form-control"
                placeholder="Address"
                v-model="form.address"
                required
            >
          </div>

          <button class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: '',
        phone: '',
        gender: '',
        address: ''
      }
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      axios
        .get("http://localhost:8000/api/contact/get-contact/" + this.$route.params.id)
        .then(response => {
          // post value yang dari response ke form
          this.form.name = response.data.name;
          this.form.phone = response.data.phone;
          this.form.gender = response.data.gender;
          this.form.address = response.data.address;
        });
    },
    updateData() {
      axios
        .post("http://localhost:8000/api/contact/edit-contact", {
            id_contact: this.$route.params.id,
            name: this.form.name,
            phone: this.form.phone,
            gender: this.form.gender,
            address: this.form.address
        })
        .then(response => {
          this.$router.push("/");
        });
    }
  }
};
</script>
